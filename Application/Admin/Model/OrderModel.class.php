<?php
namespace Admin\Model;
use Think\Model;
class OrderModel extends Model {

    //根据订单ID获得全部数据
    function getAllById($id){
        //获得订单信息
        //(join联表sp_user获得订单会员名称)
        //(join联表sp_consignee,获得订单对应的收货人信息)
        $orderinfo = D('Order')
            ->alias('o')
            ->join('__USER__ u on o.user_id = u.user_id')
            ->join('__CONSIGNEE__ c on o.cgn_id = c.cgn_id')
            ->field('o.*,u.username,c.*')
            ->find($id);

        //获得订单关联的商品信息
        //（join联表sp_goods获得商品名称）
        $goodsinfo = D('OrderGoods')
            ->alias('og')
            ->join('__GOODS__ g on og.goods_id = g.goods_id')
            ->field('og.*,g.goods_name')
            ->where(['og.order_id'=>$id])
            ->select();

        //返回数据
        return ['orderinfo'=>$orderinfo,'goodsinfo'=>$goodsinfo];
    }


}