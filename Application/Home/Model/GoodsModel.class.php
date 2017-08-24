<?php
namespace Home\Model;
use Home\Common\Cart;
use Think\Model;
class GoodsModel extends Model {

    //获得商品静态信息
    function getGoodsDetail($goods_id){

        //基本信息
        $goodsinfo = $this->find($goods_id);


        //获得商品的唯一属性sp_goods_attr和sp_attribute联表
        $onlyinfo = D('GoodsAttr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ a on ga.attr_id = a.attr_id')
            ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'only'))
            ->field('a.attr_id,a.attr_name,ga.attr_value')
            ->select();
        //dump($onlyinfo);die;

        //获得商品的单选属性sp_goods_attr 和sp_attribute联表
        $manyinfo = D('GoodsAttr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ a on ga.attr_id = a.attr_id')
            ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'many'))
            ->field('a.attr_id,a.attr_name,group_concat(ga.attr_value) attr_values ')
            ->group('a.attr_id')
            ->select();
        //dump($manyinfo);die;
        foreach ($manyinfo as $k=>$v){
            $manyinfo[$k]['values']=explode(',',$v['attr_values']);  //string->array
        }

        //获取商品的相册信息
        $picsinfo = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();

        return ['goodsinfo'=>$goodsinfo,'onlyinfo'=>$onlyinfo,'manyinfo'=>$manyinfo,'picsinfo'=>$picsinfo];

    }


    /*
     * 获取商品动态信息 配合页面静态化使用
     * return   唯一（单选）属性
     * return  int 库存
     */
function getGoodsDynamic($goods_id){

    //获得商品的单选属性sp_goods_attr 和sp_attribute联表
    $manyinfo = D('GoodsAttr')
        ->alias('ga')
        ->join('__ATTRIBUTE__ a on ga.attr_id = a.attr_id')
        ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'many'))
        ->field('a.attr_id,a.attr_name,group_concat(ga.attr_value) attr_values ')
        ->group('a.attr_id')
        ->select();
    //dump($manyinfo);die;
    foreach ($manyinfo as $k=>$v){
        $manyinfo[$k]['values']=explode(',',$v['attr_values']);  //string->array
    }
    //获得商品库存
    $number = $this->field('goods_number')->find($goods_id);

    //dump($manyinfo);

    //获取会员价格
    $price = $this->getGoodsMP($goods_id);

    //返回数据
    return ['tips'=>'有效数据','many'=>$manyinfo,'number'=>$number['goods_number'],'price'=>$price];
}


    //获取购物车商品信息
    //登录后价格会变化
    function getCartInfo(){

        //获得购物车商品信息列表
        $cart = new Cart();
        $cartinfo = $cart->getCartInfo();  //获得购物车商品信息

        //如果有登录，就要获取会员价格
        if(session('user_id')){

            foreach ($cartinfo as $k => $v){
                $mprice =$this->getGoodsMP($v['goods_id']);
                $cart->changePrice($mprice,$v['goods_id']);
            }
            $cartinfo = $cart->getCartInfo();  //重新获得购物车商品信息
        }

        //获得购物车商品图片信息  goods_small_logo
        //获得购物车goods_id 拼装为字符串
        $goods_ids = implode(',',array_keys($cartinfo));

        //通过$goods_ids获取商品的小图信息
        $logoinfo =$this
            ->field('goods_id,goods_small_logo')
            ->select($goods_ids);

        //整合，使$logoinfo 加入$cartinfo
        foreach($cartinfo as $k => $v){
            foreach ($logoinfo as $vv){
                if($vv['goods_id'] == $k){
                    //把logo图片放入$cartinfo图片
                    $cartinfo[$k]['logo'] = $vv['goods_small_logo'];
                }
            }
        }

        //获得购物车商品金额统计
        $n_p = $cart->getNumberPrice();

        //dump($cartinfo);

        return [$cartinfo,$n_p];
    }


    /*
   * 获得商品对应会员价格
   * 这里有四个表
   * 商品信息 Goods
   * 用户信息 User
   * 会员等级与折扣  MemberLevel
   * 单独设置的会员价格  MemberPrice
   * @return
  */
    function getGoodsMP($goods_id){
        //先取出商品G里的原始价格和默认促销价格
        $goods = $this->find($goods_id);
        //dump($goods);
        $user_id = session('user_id');
        if($user_id){
            //先从用户U取出积分信息
            $userjifen = D('User')->find($user_id)['jifen'];
            //dump($userjifen);
            if($userjifen == 0){
                //如果是0分当然是没有会员等级ML的
                //使用默认促销价
                return $goods['goods_member_price'];

            }else{
                //dump($userjifen);
                //到会员等级表ML查询会员等级
                $minfo = D('MemberLevel')->where(array(
                    'jifen_bottom'=>array('elt',$userjifen),
                    'jifen_top'=>array('egt',$userjifen)
                ))->find();
                //然后去MP表判断是否有为会员等级查询单独的价格
                //同时设有Ggoods_id和MLlevel_id的MPprice信息
                $mprice = D('MemberPrice')->where(array(
                    'goods_id'=>array('eq',$goods_id),
                    'level_id'=>array('eq',$minfo['id'])
                ))->select();
                //如果有为这个会员设置的价格
                if($mprice[0]){
                    //使用特设的会员折扣
                    return  $mprice[0]['price'];

                }else{
                    //使用会员ML的会员等级折扣
                    return $goods['goods_price']*($minfo['level_rate']/1000);
                }
            }
        }else{
            //如果没有用户登录就使用默认的促销价格
            return $goods['goods_member_price'];
        }

    }

    //添加商品到购物车
    function addCart(){
        $goods_id = I('post.goods_id');  //被添加商品的goods_id
        $goods_num = I('post.goods_num')? I('post.goods_num') : 1; //被添加商品的goods_id
        //获得被添加商品的相关信息
        $info = $this->find($goods_id);

        //把被添加的商品组织为array数组形式
        //array('goods_id'=>'商品ID','goods_name'=>'商品名','goods_price'=>'商品单价','goods_buy_number'=>'购买数量','goods_total_price'=>'数量*单价',)
        $mprice = $this->getGoodsMP($goods_id);
        $data['goods_id'] =$info['goods_id'];
        $data['goods_name'] =$info['goods_name'];
        //$data['goods_price'] =$info['goods_price'];
        $data['goods_price'] = $mprice;
        $data['goods_buy_number'] = $goods_num;
        $data['goods_total_price'] = $mprice * $goods_num;

        //给购物车添加商品
        $cart = new Cart();
        $cart->add($data);

        //把更新后的购物车商品数量和总价格获得并返回
        $number_price = $cart->getNumberPrice();

        echo json_encode($number_price);
    }


}