<?php

namespace  Home\Controller;
use Home\Common\Cart;
use Think\Controller;

//超市控制器
class  ShopController extends Controller{

    //添加商品到购物车
    function addCart(){
        if(IS_AJAX && IS_POST){

          D('Goods')->addCart();

        }
    }

    //购物车信息列表显示
    function flow1(){

        //获取购物车商品信息
        $cart = new \Home\Common\Cart();
        $cartinfo = $cart->getCartInfo();
        //dump($cartinfo);

        //获得购物车商品的图片信息(数据表字段:goods_small_logo)
        //获得购物车商品的goods_id信息,拼装成字符串
        $goods_ids =implode(',',array_keys($cartinfo));

        //通过goods_ids获取商品的小图信息
        $logoinfo = D('Goods')
            ->field('goods_id,goods_small_logo')
            ->select($goods_ids);

        //整合使得$logoinfo的图片信息添加进$cartinfo里去
        foreach ($cartinfo as $k=>$v){
            foreach ($logoinfo as $vv){
                if($k ==$vv['goods_id']){  //购物车信息数组的下标就是商品id
                    //把logo图片添加到$cartinfo数组里
                    $cartinfo[$k]['logo'] = $vv['goods_small_logo'];
                }
            }
        }

        //获得购物车的商品金额
        $number_price = $cart->getNumberPrice();

        $this->assign('cartinfo',$cartinfo);
        $this->assign('number_price',$number_price);
        $this->display();
    }

    //订单准备页
    function flow2(){
        if(IS_POST){

            D('Order')->makeOrder();
            D('Order')->addUserJifen();

            $this->redirect('flow3');

        }else{
            $user_name = session('user_name');

            //判断用户是否有登录
            if(empty($user_name)){
                //没有登录
                //定义回跳地址
                session('back_url','Shop/flow2');

                //跳转到登录页面
                $this->redirect('User/login');
            }else{

           $cartinfo =  D('Goods')->getCartInfo();
                $this->assign('cartinfo',$cartinfo[0]);
                $this->assign('number_price',$cartinfo[1]);

                $this->display();
            }
        }
    }

    //订单完成页面
  function flow3(){
        $this->display();

  }



    //使购物车商品数量发生变化
    function changeNumber(){
        if(IS_AJAX && IS_POST){
            //获得客户端传递过来的goods_id 和 num
            $goods_id = I('post.goods_id');
            $num = I('post.num');

            //使购物车数量发生变化
            $cart = new Cart();
            $xiaoji_price = $cart->changeNumber($num,$goods_id);

            //获得目前商品总价格
            $number_price = $cart->getNumberPrice();

            echo json_encode(array(
                'num'=>$num,
                'goods_id'=>$goods_id,
                'total_price'=>$number_price['price'],
                'xiaoji_price'=>$xiaoji_price
            ));
        }
    }

    //删除购物车商品
    function delGoods(){
        //获取商品id
        $goods_id = I('post.goods_id');

        //删除购物车指定商品
        $cart = new Cart();
        $cart ->del($goods_id);

        //获得删除后的购物车商品总金额
        $number_price = $cart -> getNumberPrice();
        echo json_encode($number_price);
    }




}