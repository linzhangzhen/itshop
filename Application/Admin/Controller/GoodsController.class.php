<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class GoodsController extends AdminController {

    //列表
    public function showlist(){

        $goods  = D('Goods');
        $data = $goods->getAllGoods();
        $info = $data['info'];
        $page = $data['page'];

        $this->assign('info',$info);
        $this->assign('page',$page);
        //商品列表页面
        $this->display();
    }

    //添加商品
    public function tianjia(){

        $goods = D('Goods');
        //   create()  收集信息，信息安全过滤，自动验证，字段映射；西卡西，这里不用！

        if (IS_POST) {

            //dump($_POST);die;

            $goods->deal_logo($_FILES['goods_logo']);

            $data = I('post.');  //收集信息，安全过滤
            //给商品实现logo图片上传
            //dump($data);die;

            //不使用i()函数，直接收集富文本编辑器的数据
            $data['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
            //维护时间字段
            $data['add_time'] = time();
            $data['upd_time'] = time();
            if ($newid = $goods->add($data)) {
                //会员价维护
                $goods->deal_price($data,$newid);
                //相册维护
                $this->deal_pics($newid);
                //属性维护
                $this->deal_attr($newid);
                $this->success('商品添加成功', U('showlist'), 2);
            } else {
                $this->success('商品添加失败', U('tianjia'), 2);
            }
        } else {
            //获取类型信息
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);

            //获取会员表的信息
            $memberinfo = D('MemberLevel')->select();
            $this->assign('memberinfo',$memberinfo);

            $data = I('post.');
            //展示表单
            $this->display();
        }
    }


    //获取属性分类
    function getAttrByType(){
        //获得客户端传过来的type_id
        $type_id = I('post.type_id');

        //根据$type_id 获得对应的属性信息
        $attrinfo = D('Attribute')
            ->where(array('type_id'=>$type_id))
            ->select();

        echo  json_encode($attrinfo);
    }

    //商品修改
    public function upd(){

        $goods = D('Goods');
        if(IS_POST){
            //把先前存入session的goods_id取出来
            $goods_upd_id = session('goods_upd_id');

            //判断表单提交的goods_id与session中的goods_upd_id是否一致
            if($goods_upd_id!=$_POST['goods_id']){
                //不一致
                $this->error('参数错误，请联系管理员',U('showlist'),2);
            }

            //修改logo信息
            $goods->deal_logo($_FILES['goods_logo'],$_POST['goods_id']);
            //新增相册
            $this->deal_pics($_POST['goods_id']);
            //属性信息收集入库
            $this->deal_attr($_POST['goods_id']);

            //接受表单信息
            $data = I('post.');
            $data['upd_time'] = time();
            $data['goods_member_price'] = $data['goods_member_price'] == 0 ?$data['goods_price']*0.99 : $data['goods_member_price'];
            //不使用i()函数，直接收集富文本编辑器的数据
            $data['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
            if(D('Goods')->save($data)){
                //更新成功
                $this->success('修改商品信息成功',U('showlist'),2);
            }else{
                //更新失败
                $this->error('修改商品信息失败',U('upd',array('goods_id'=>$data['goods_id']),2));
            }
        }else{
            //展示表单
            //获取传递过来的goods_id
            //根据goods_id到数据库（Goods表）获取信息
            $goods_id = I('get.goods_id');
            $info = D('Goods')->where(array('goods_id'=>$goods_id))->find();
            $this->assign('info',$info);

            //把要修改的goods_id存入session
            session('goods_upd_id',$goods_id);

            //根据goods_id获取商品相册
            $picsinfo = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();
            $this->assign('picsinfo',$picsinfo);

            //获取所有的商品类型信息
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);

            //商品修改页面
            $this->display();
        }
    }

    //根据类型获得属性信息（商品修改）
    function getAttrByType2(){
        //获取客户端 传过来的goods_id和 type_id
        $goods_id = I('post.goods_id');
        $type_id = I('post.type_id');

        //获得属性列表信息（实体，空壳）
        //sp_attribute与sp_goods_attr做联表查询，通过attr_id关联
        //保证sp_attribute 属性表的数据是完整的,如果sp_goods_attr关联表有对应数据则一并查出
        $attrinfo = D('Attribute')
            ->alias('a')
            ->field('a.attr_id,a.attr_name,a.attr_sel,a.attr_vals,(select group_concat(ga.attr_value) from sp_goods_attr ga where ga.attr_id=a.attr_id and ga.goods_id='.$goods_id.') attr_values')
            ->where(array('a.type_id'=>$type_id))
            ->select();

        //dump($attrinfo);
        echo  json_encode($attrinfo);

    }

    //商品删除
    function delGoods(){
        //接收数据
        $goods_id = I('post.goods_id');
        $d = D('Goods')->delete($goods_id);
        if($d){
            echo json_encode(array('states'=>0,'tip'=>'已经被干掉了哟'));
        }else{
            echo json_encode(array('states'=>1,'tip'=>'很可惜，没删掉呢'));
        }
    }

    //删除相册图片
    function delPics(){
        $pics_id = I('post.pics_id');  //接受pics_id

        //根据$pics_id条件查询图片信息
        $picsinfo =D('GoodsPics')->find($pics_id);
        //删除相册物理图片
        if(file_exists($picsinfo['pics_big'])){unlink($picsinfo['pics_big']);};
        if(file_exists($picsinfo['pics_mid'])){unlink($picsinfo['pics_mid']);};
        if(file_exists($picsinfo['pics_sma'])){unlink($picsinfo['pics_sma']);};

        //然后删除数据记录
        if(D('GoodsPics')->delete($pics_id)){
            //成功
            echo  json_encode(array('status'=>0));
        }else{
            //失败
            echo json_encode(array('status'=>1));
        }
    }

    //相册上传维护方法
    private function deal_pics($goods_id){
        //判断是否有上传图片，有一个也行
        $havePics = false;
        foreach($_FILES['goods_pics']['error'] as $v){
            if($v === 0){
                $havePics = true;
                break;
            }
        }
        //有相册上传才处理
        if($havePics){
            $cfg2 = array(
                'rootPath'   =>   './Public/Uploads/pics/',
            );
            $up2 = new  \Think\Upload($cfg2);
            //相册批量上传处理
            $z2 = $up2->upload(array($_FILES['goods_pics']));

            //制作缩略图  （三张）
            $im2 = new \Think\Image();
            foreach ($z2 as $k=>$v){
                //获得原图路径名
                $yuan_pics = $up2->rootPath.$v['savepath'].$v['savename'];

                //打开原图
                $im2->open($yuan_pics);

                //制作缩略图 三张  800*800  350*350  50*50
                // 同一原图可以同时制作多张缩略图  要从大到小顺序制作
                $im2->thumb(800,800,6);
                $pics_big = $up2->rootPath.$v['savepath'].'big_'.$v['savename'];
                //保存制作好的缩略图
                $im2->save($pics_big);
                //执行三次
                $im2->thumb(350,350,6);
                $pics_mid = $up2->rootPath.$v['savepath'].'mid_'.$v['savename'];
                $im2->save($pics_mid);

                $im2->thumb(50,50,6);
                $pics_sma = $up2->rootPath.$v['savepath'].'sma_'.$v['savename'];
                $im2->save($pics_sma);

                //删除原图'
                unlink($yuan_pics);

                //把缩略图存储到数据库
                $arr = array(
                    'goods_id'=>$goods_id,
                    'pics_big'=>$pics_big,
                    'pics_mid'=>$pics_mid,
                    'pics_sma'=>$pics_sma,
                );
                $c=D('GoodsPics')->add($arr);
            }
        }
    }


    //商品属性维护
    private function deal_attr($goods_id){
        //如果是修改商品，维护属性信息，则要删除旧属性
        D('GoodsAttr')->where(array('goods_id'=>$goods_id))->delete();

        foreach ($_POST['attr_info'] as $k=>$v){
            //$k就是属性ID值
            foreach ($v as $vv){
                if(!empty($vv)){
                    $arr['goods_id'] = $goods_id;
                    $arr['attr_id'] = $k;
                    $arr['attr_value'] = $vv;
                    //D('GoodsAttr')   sp_goods_attr
                    //D('Goodsattr')   sp_goodsattr
                    D('GoodsAttr')->add($arr);
                }
            }
        }
    }


    /*
     * 商品秒杀列表 miaoshalist
     * uodate:2017年7月27日 15:06:26
     */
    function miaoshalist(){
        //获取所有秒杀商品信息
        $info = D('GoodsMiaosha')
            ->alias('gm')
            ->join('__GOODS__ g on gm.goods_id = g.goods_id')
            ->field('gm.*,g.goods_small_logo,g.goods_name')
            ->order('miaosha_id desc')
            ->select();
        //dump($info);
        //把flag的

        $this->assign('info',$info);
        $this->display();
    }



    /*
     * 商品秒杀添加   miaoshaadd
     * update:2017年7月29日 18:44:37
     */
    function miaoshaadd(){
        //初始化redis类
        $redis = new \Redis();
        $redis->connect('192.168.160.129');

        if(IS_AJAX && IS_POST){

            //提交表单
            $data = I('post.');

            //对数据进行处理-->时间戳多了三位000
            $data['start_time'] = substr($data['start_time'],0,10);
            $data['end_time'] = substr($data['end_time'],0,10);

            //对数据进行判断-->商品id是否存在
            $fg = D('Goods')->find($data['goods_id']);
            if($fg){
                //商品存在，继续执行
                //对数据进行判断-->商品库存是否足够
                if($fg['goods_number'] >= $data['goods_number']){
                    //库存足够，继续执行

                    //redis的key
                    $key='goods_id-'.$data['goods_id'].'-to-'.$data['start_time'];
                    $data['redis_key'] = $key;

                    //把秒杀信息存入数据库
                    $a =D('GoodsMiaosha')->add($data);

                    if($a){
                        /*
                         * 这里应该是redis操作
                         * 将数据for循环放入一个list链表内
                         */

                        for($n=1;$n<=$data['goods_number'];$n++){
                            //$redis->lpush('goods_id-'.$data['goods_id'],$n);  //这样命名有bug，每次给这个商品id添加秒杀都跑到这里面来了
                            $redis->lpush($key,$n);  //把开始时间戳也加到后面去
                        }

                        //设置过期时间
                        $redis->EXPIREAT($key,$data['end_time']);

                        //成功
                        echo json_encode(['status'=>200,'tips'=>'添加秒杀数据成功']);
                    }else{
                        //失败
                        echo json_encode(['status'=>201,'tips'=>'未知错误，添加失败']);
                    }

                }else{
                    //库存不足，无法执行
                    echo json_encode(['status'=>201,'tips'=>'商品库存不足']);
                }
            }else{
                //不存在的商品id,返回错误信息
                echo json_encode(['status'=>201,'tips'=>'不存在的商品id']);
            }
        }else{
            //页面展示
            //如果是从商品列表跳转过来应该是有goods_id的
            //获取商品小部分信息并展示

            if(IS_GET){
                $goods_id = I('get.gods_id');
                $info = D('Goods')->find($goods_id);
            }

            $this->assign('info',$info);
            $this->display();
        }
    }

}