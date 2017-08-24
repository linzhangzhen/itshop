<?php

namespace Home\Common;


/*
购物车类
实现对购物车里边商品的添加、删除操作

购物车信息转化为二维数组的效果如下：
array(
商品id1=>array('goods_id'=>'商品id','goods_name'=>'名称',
'goods_price'=>'单价','goods_buy_number'=>'购买数量','goods_total_price'=>数量*单价),
商品id2=>array('goods_id'=>'商品id','goods_name'=>'名称',
'goods_price'=>'单价','goods_buy_number'=>'购买数量','goods_total_price'=>数量*单价),
商品id3=>array('goods_id'=>'商品id','goods_name'=>'名称',
'goods_price'=>'单价','goods_buy_number'=>'购买数量','goods_total_price'=>数量*单价),
以此类推)
 */

class Cart{
    //购物车的一个属性，用于存放商品信息
    var $cartInfo = array();

    function __construct(){
        $this->loadData();
    }

//***取得购物车里已经存放的商品信息该方法在构造函数里被调用
    function loadData(){
        if(isset($_COOKIE['cart'])){
            //将序列化内容里边特殊字符转义的反斜线去掉
            $cart = str_replace('\\','',$_COOKIE['cart']);
            //取得购物车里边已经存放的商品信息，并反序列化
            $this->cartInfo = unserialize($cart);
        }
    }

    /*
    将商品添加到购物车里边
    @param $goods = array('goods_id'=>'商品id','goods_name'=>'名称',
    'goods_price'=>'单价','goods_buy_number'=>'购买数量','goods_total_price'=>数量*单价);
     */
    function add($data){
        $goods_id = $data['goods_id'];
        //对重复购买的商品要判断(还要判断当前购物车是否为空，即是否第一次添加商品)
        if(!empty($this->cartInfo) && array_key_exists($goods_id,$this->cartInfo)){
            //购买重复商品的时候
            //数量增加
            $this->cartInfo[$goods_id]['goods_buy_number'] +=$data['goods_buy_number'];
            //单件商品的小计下个增加  单件小计价格= 单价*数量
            $this->cartInfo[$goods_id]['goods_total_price'] = $this->cartInfo[$goods_id]['goods_price']*$this->cartInfo[$goods_id]['goods_buy_number'];
        }else{
            //购买新商品
            $this->cartInfo[$goods_id] = $data;
        }
        $this->saveData();   //将刷新的数据重新存入cookie
    }

    //删除购物车里指定id的商品
    function del($goods_id){
        if(array_key_exists($goods_id,$this->cartInfo)){
            unset($this->cartInfo[$goods_id]);
        }
        $this->saveData();  //将刷新后的数据重新存入cookie
    }

    //清空购物车
    function delall(){
        unset($this->cartInfo);
        $this->saveData();  //将刷新后的数据重新存入cookie
        if(empty($this->cartInfo)){
            return true;
        }
    }


    /*
     *商品数量发生变化执行的步骤
     @param $goods_number 商品修改后的数量
    @param $goods_id     被修改的商品的id
    */
    function changeNumber($goods_number,$goods_id){

        //修改商品的数量
        $this->cartInfo[$goods_id]['goods_buy_number'] = $goods_number;
        //修改商品的小计价格
        $this->cartInfo[$goods_id]['goods_total_price'] = $goods_number*$this->cartInfo[$goods_id]['goods_price'];

        $this->saveData();  //将刷新的数据重新存入cookie

        return $this->cartInfo[$goods_id]['goods_total_price'];
    }

    /*
  *商品价格发生变化执行的步骤
  @param $goods_price 商品修改后的价格
 @param $goods_id     被修改的商品的id
 */
    function changePrice($goods_price,$goods_id){

        //修改商品的价格
        $this->cartInfo[$goods_id]['goods_price'] = $goods_price;
        //修改商品的小计价格
        $this->cartInfo[$goods_id]['goods_total_price'] = $goods_price*$this->cartInfo[$goods_id]['goods_buy_number'];

        $this->saveData();  //将刷新的数据重新存入cookie

        return $this->cartInfo[$goods_id]['goods_total_price'];
    }


    //获得购物车商品数量和总价格
    function getNumberPrice(){
    $number = 0;  //商品数量
        $price =0;  //商品总价格

        foreach ($this->cartInfo as $_k=>$_v){
            $number  += $_v['goods_buy_number'];  //每个商品数量
            $price  +=  $_v['goods_total_price'];  //每个商品小计价格
        }
        $arr['number'] =$number;
        $arr['price'] = $price;

        return $arr;
    }

    //获取购物车信息
    function getCartInfo(){
        return $this->cartInfo;
    }

    //保存购物车信息
    function saveData(){
        $data = serialize($this->cartInfo);
        setcookie('cart',$data,time()+3600,'/');
    }




}