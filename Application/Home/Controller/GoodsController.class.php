<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {

    //商品列表页
    public function showlist(){
        //获得商品列表信息
        $goodsinfo = D('Goods')
            ->order('goods_id desc')
            ->field('goods_id,goods_name,goods_price,goods_small_logo,goods_member_price')
            ->select();
        $this->assign('goodsinfo',$goodsinfo);

        //载入模板
        $this->display();
    }

    //商品详情页
    public function detail(){
        //接收ID并获取商品详情
        $goods_id = I('get.goods_id');
        //静态页地址
        $path = './Html/Goods/'.date('Y-m',time());
        $uri = $path.'/goods_'.$goods_id.'.html';
        $href =   <<< EOF
<script type="text/javascript">
window.location.href="http://web.itshop.com"+"$uri";
</script>
EOF;
        //判断这个静态页地址是否已经存在
        if(is_dir($path)){
            //就继续判断有没有对应的静态页
            if (is_file($uri)){
                //dump($uri);die;
                //存在 就直接跳转到对应的静态页
                echo $href;
            }else{
                //如果没有就创建一个
                $this->create_html($goods_id,$uri);
                echo $href;
            }
        }else{
            //如果没有就创建一个地址 然后做个静态页
            //linux需权限
            mkdir($path,0777,true);
            $this->create_html($goods_id,$uri);
            echo $href;
        }
    }


    /*
     * 秒杀商品列表 miaoshalist
     * date 2017年7月28日 07:25:55
     */
    function miaoshalist(){
        //获取数据
        $info = D('GoodsMiaosha')
            ->alias('gm')
            ->join('__GOODS__ g on gm.goods_id = g.goods_id')
            ->field('gm.*,g.goods_name,g.goods_small_logo')
            ->order('miaosha_id desc')
            ->select();

        //dump($info);

        $info['over_time']=$info['start_time']-time();   //✖ 每一个都该有倒计时 应该循环
        //视图渲染展示
        $this->assign('miaoshainfo',$info);
        $this->display();
    }

    /*
     * 秒杀商品详情 miaoshadetail
     * update：2017年7月29日 19:08:05
     */
    function miaoshadetail(){

        if(IS_AJAX){

            //秒杀id
            $miaosha_id = I('post.miaosha_id');
            //秒杀信息
            $GM = D('GoodsMiaosha');
            $miaosha_info = $GM->find($miaosha_id);

            //实例化redis类
            $redis = new \Redis();
            $redis->connect('192.168.160.129');

            //dump(time());
            //先判断秒杀时间是否结束
            if($miaosha_info['end_time']-time() > 0){
                //判断商品是否售罄
                if($redis->lpop($miaosha_info['redis_key'])){
                    //能走到这里说明已经秒杀成功，但是还是要判断这个用户是不是已经买过了
                    $hash_key = 'miaosha_id-'.$miaosha_id;

                    $user_id = session('user_id');
                    if(!$redis->hGet($hash_key,$user_id)){
                        //没有就可以买
                        /*
                         * 将用户信息装入一个redis 接下来要完成的逻辑
                         * 1 用户不能在此抢购此商品
                         * 2 用户须得15分钟内完成付款
                         * 用哈希表来写，把用户id和用户付款期限写入
                         */
                        $user_time = time()+ 60*15;
                        $redis->hSet($hash_key,$user_id,$user_time);

                        echo json_encode(['status'=>200,'tips'=>'秒杀成功，请在15分钟内付款']);
                    }else{
                        //已经买过了
                        echo json_encode(['status'=>201,'tips'=>'请勿重复秒杀']);
                    }
                }else{
                    //货品售罄 这里应该对数据库也进行修改
                    $miaosha_info['flag'] = '已结束';
                    $miaosha_info['goods_number'] = 0 ;
                    $GM->save($miaosha_info);
                    echo json_encode(['status'=>201,'tips'=>'货品售罄']);
                }
            }else{
                //秒杀过期  也改对数据库进行修改;
                $miaosha_info['flag'] = '已结束';
                $GM->save($miaosha_info);
                echo json_encode(['status'=>201,'tips'=>'秒杀时间已过！']);
            }
        }else{

            //首先是展示数据
            $miaosha_id = I('get.miaosha_id');
            //基本信息

            $miaoshainfo = D('GoodsMiaosha')->find($miaosha_id);
            $goods_id = $miaoshainfo['goods_id'];

            $miaoshainfo['over_time']= $miaoshainfo['start_time']-time();
            $miaoshainfo['cont_time']= $miaoshainfo['end_time']-$miaoshainfo['start_time'];

            $goodsinfo = D('Goods')->getGoodsDetail($goods_id); //静态数据

            $this->assign('goodsinfo',$goodsinfo['goodsinfo']);
            $this->assign('onlyinfo',$goodsinfo['onlyinfo']);
            $this->assign('manyinfo',$goodsinfo['manyinfo']);
            $this->assign('picsinfo',$goodsinfo['picsinfo']);
            $this->assign('miaoshainfo',$miaoshainfo);

            //dump($goodsinfo);;
            //展示 :: 这里也应该使用静态页化
            $this->display();

        }
    }

    /*
    * 生成商品对应静态页
    * @goods_id    商品id
    * fetch()  获取模板信息，不输出
    */
    function create_html($goods_id,$uri){
        //商品信息
        $goodsinfo = D('Goods')->getGoodsDetail($goods_id); //静态数据

        $this->assign('goodsinfo',$goodsinfo['goodsinfo']);
        $this->assign('onlyinfo',$goodsinfo['onlyinfo']);
        $this->assign('manyinfo',$goodsinfo['manyinfo']);
        $this->assign('picsinfo',$goodsinfo['picsinfo']);

        //if($id!=0){
        $ret = $this->fetch();
        file_put_contents($uri,$ret);

        //echo '生成静态页面';

        //第一次生成也要展示一次，
        //$this->display();
    }

    /*
     * 获取商品动态信息
     * @return  array
     * @ 会员价格
     * @ 库存，唯一属性
     */
    function getGoodsDynamic(){
        if(IS_AJAX){
            $goods_id = I('post.goods_id');
            $dynamicinfo = D('Goods')->getGoodsDynamic($goods_id);//动态数据

            //echo json_encode(['status'=>200,'data'=>$dynamicinfo]);
            echo json_encode($dynamicinfo);
        }else{
            echo json_encode(['tips'=>'连接服务器都失败了']);
        }
    }
}