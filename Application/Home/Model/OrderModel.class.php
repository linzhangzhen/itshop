<?php
namespace Home\Model;
use Home\Common\Cart;
use Think\Model;
class OrderModel extends Model {


    function makeOrder(){
        //收集信息形成订单记录
        //dump($_POST);
        //生成订单信息，对两个表 sp_order / sp_order_goods进行数据维护
        //维护订单信息 sp_order
        $cart = new Cart();
        $number_price = $cart->getNumberPrice();

        $data = I('post.');
        $data['user_id']  =  session('user_id');
        $data['order_number'] = "itcast-shop-".date('YmdHis')."-".mt_rand(1000,9999);
        $data['order_price'] = $number_price['price'];
        $data['add_time']  = $data['upd_time']  = time();
        $order_id  =  $this->add($data);  //在数据库写入订单记录



        //维护订单关联的商品信息 sp_order_goods
        //获取购物车信息
        $cartinfo = $cart->getCartInfo();
        $data2 = array();
        foreach ($cartinfo as $k=> $v ){
            $data2['order_id']  =$order_id;
            $data2['goods_id']  = $k;
            $data2['goods_price']  = $v['goods_price'];
            $data2['goods_number'] = $v['goods_buy_number'];
            $data2['goods_total_price'] = $v['goods_total_price'];


            //给sp_order_goods表形成记录
            D('OrderGoods')->add($data2);
        }
        //清除购物车信息
        $cart->delall();
        //dump($cartinfo);
    }

    //用户积分增加
    function addUserJifen($order_id){
        //获得用户ID
        $user_id = session('user_id');
        //用户信息
        $userinfo = D('User')->find($user_id);
        //订单信息
        $orderinfo = $this->find($order_id);
        //用户当前积分=以前积分+订单价格
        $userinfo['jifen'] = $userinfo['jifen']+$orderinfo['order_price'];
        //入库
        $s = D('User')->save($userinfo);
        if($s){
            //成功

        }else{
            //失败

        }

    }

    /*
     *获取用户全部订单信息
     * @param $user_id  用户ID
     * table  Order 订单表
     * table  OrderGoods  订单-商品表
     * table  Goods  商品表
    */
    function getAllOrder($user_id){
        //根据用户ID去表里找到信息
        $orderinfo =$this
            ->alias('o')
            ->join('__ORDER_GOODS__  og on o.order_id=og.order_id')
            ->field('o.order_id,o.order_number,o.order_price,o.order_pay,o.is_send,o.order_status,o.add_time,og.*')
            ->where(['o.user_id'=>$user_id])
            ->select();

        //为了减少数据库的搜索量，在这里再查找商品信息
        foreach ($orderinfo as $k=> $v){
        $goodsinfo = D('OrderGoods')
            ->alias('og')
            ->join('__GOODS__ g on og.goods_id = g.goods_id')
            ->field('g.goods_name,g.goods_small_logo')
            ->where(['g.goods_id'=>$v['goods_id']])
            ->find();
        $orderinfo[$k]['goods_info'] = $goodsinfo;
        }

        //把支付方法循环修改掉
        foreach ($orderinfo as $k => $v){
            if($v['order_pay'] == '0'){
                $orderinfo[$k]['order_pay']='支付宝';
            }else if($v['order_pay'] == '1'){
                $orderinfo[$k]['order_pay'] = '微信';
            }else{
                $orderinfo[$k]['order_pay'] = '银联卡';
            }
        }

        //要循环一下，把所有相同order_id的数据放入同一个数组内
       foreach ($orderinfo as $k => $v){

            $orderinfo2[$v['order_id']]['order_info'] = $v;
            $orderinfo2[$v['order_id']]['goods_info'][$v['goods_id']]['goods_small_logo'] = $v['goods_info']['goods_small_logo'];
            $orderinfo2[$v['order_id']]['goods_info'][$v['goods_id']]['goods_name'] = $v['goods_info']['goods_name'];
            $orderinfo2[$v['order_id']]['goods_info'][$v['goods_id']]['goods_price'] = $v['goods_price'];
            $orderinfo2[$v['order_id']]['goods_info'][$v['goods_id']]['goods_number'] = $v['goods_number'];
            $orderinfo2[$v['order_id']]['goods_info'][$v['goods_id']]['goods_total_price'] = $v['goods_total_price'];
           array_splice($orderinfo2[$v['order_id']]['order_info'],-6);
        }
        //dump($orderinfo);
        //dump($orderinfo2);

        return $orderinfo2;
    }

    /*
 *获取单个订单全部信息
 * @param $user_id  用户ID
 * table  Order 订单表
 * table  OrderGoods  订单-商品表
 * table  Goods  商品表
*/
    function getOneOrder($order_id){

        //订单信息
        $order = $this->find($order_id);

        //订单-商品信息
        $ordergoods =D('OrderGoods')
            ->where(['order_id'=>$order_id])
            ->select();

        //查找商品信息
        foreach ($ordergoods as $k=> $v){
            $goods = D('Goods')
                ->where(['goods_id'=>$v['goods_id']])
                ->find();

            foreach ($goods as $kk=>$vv)
            $ordergoods[$k][$kk]=$vv;
        }


        //把支付方法循环修改掉
            if($order['order_pay'] == '0'){
                $order['order_pay']='支付宝';
            }else if($order['order_pay'] == '1'){
                $order['order_pay'] = '微信';
            }else{
                $order['order_pay'] = '银联卡';
            }

        //dump($order);

        return ['order'=>$order,'ordergoods'=>$ordergoods];
    }
}