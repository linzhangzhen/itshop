<?php

namespace  Home\Controller;
use Think\Controller;

//订单控制器
class  OrderController extends Controller{

    //列表展示
    function showlist(){
        //先判断是否有登录，如果没有登录就跳转到登录页面
        $user_id = session('user_id');

        if($user_id){
            //有用户ID就继续执行

            //调用Order模型的方法
            $orderinfo =  D('Order')->getAllOrder($user_id);
            $this->assign('orderinfo',$orderinfo);
            $this->assign('payinfo',['0'=>'支付宝','1'=>'微信','2'=>'银联卡']);

            //dump($orderinfo);
            $this->display();

        }else{
            //没有用户登录就跳转到登录页面
            //定义回跳地址
            session('back_url','Order/showlist');

            //跳转到登录页面
            $this->redirect('User/login');
        }
    }


    //订单详情
    function detail(){
        //获取订单ID
        $order_id = I('get.order_id');

        //调用方法
        $info = D('Order')->getOneOrder($order_id);
        //dump(($info));

        $this->assign('orderinfo',$info['order']);
        $this->assign('goodsinfo',$info['ordergoods']);

        $this->display();
    }
}