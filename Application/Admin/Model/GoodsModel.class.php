<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model {

        //分页获得全部数据
    public function getAllGoods(){
        $count      = $this->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $info = $this->order('goods_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        //返回分页字符串和数据
        return ['page'=>$show,'info'=>$info];

    }


    //商品维护会员价格
    function deal_price($data,$goods_id){
        $mp = D('MemberPrice');
        //dump($data);die;
        //循环写入数据库
        foreach ($data['price'] as $k => $v){
            $price = (float)$v;
            if($price == 0) continue;
            $mp->add(array(
                'goods_id'=>$goods_id,
                'level_id'=>$k,
                'price'=>$v
            ));
        }
    }


    //商品logo图片上传处理
    function deal_logo($data,$goods_id = 0){
        //如果$goods_id为0  表示新增商品处理
        //如果$goods_id非0  表示修改商品处理
        if ($data['error'] === 0) {
            //修改商品时要先把原先的logo物理图片删除
            if($goods_id!=0){
                $goodsinfo =  $this->find($goods_id);
                if(file_exists($goodsinfo['goods_big_logo'])){
                    unlink($goodsinfo['goods_big_logo']);
                }
                if(file_exists($goodsinfo['goods_small_logo'])){
                    unlink($goodsinfo['goods_small_logo']);
                }
            }

            //上传正常
            $cfg = array(
                'rootPath' => './Public/Uploads/logo/',  //保存根路径
            );
            $up = new\Think\Upload($cfg);
            //uploadOne方法会返回一系列上传信息  包括附件存储的名字和地址信息
            $z = $up->uploadOne($_FILES['goods_logo']);

            //把上传好的附件(路径名)存储到数据库
            //./Public/Uploads/logo/ +（时间文件夹+） 文件名
            $_POST['goods_big_logo'] = $up->rootPath . $z['savepath'] . $z['savename'];

            //② 制作缩略图
            $im = new \Think\Image();  //实例化制作图片类
            $im->open($_POST['goods_big_logo']);   //打开需要被制作缩略图的原图
            $im->thumb(130, 130, 6);   //制作缩略图，严格缩放大小为130*130   6(严格缩放)

            //将制作好的图片存入数据库
            //放在和大图一个文件夹下并在文件头写入一个small_
            $smallPathName = $up->rootPath . $z['savepath'] . 'small_' . $z['savename'];
            $im->save($smallPathName);

            //将缩略图（存储地址信息）保存到数据库
            $_POST['goods_small_logo'] = $smallPathName;
        }
    }



}