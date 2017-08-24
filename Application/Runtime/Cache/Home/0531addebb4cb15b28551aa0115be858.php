<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>京西商城</title>
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>header.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>login.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>footer.css" type="text/css">

    <script type="text/javascript" src="<?php echo C('JS_URL');?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo C('JS_URL');?>header.js"></script>
    <script type="text/javascript" src="<?php echo C('JS_URL');?>index.js"></script>
    <script type="text/javascript" src="/Public/Home/layer/layer.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <?php if(!empty($_SESSION['user_name'])): ?><ul>
                    <li>您好，<span style="font-size: 20px;color: blue;" ><?php echo (session('user_name')); ?></span>欢迎来到京西！[<a href=<?php echo U('User/logout');?>>退出登录</a>] </li>
                    <li class="line">|</li>
                    <li>我的订单</li>
                    <li class="line">|</li>
                    <li>客户服务</li>
                </ul>
                <?php else: ?>
                <ul>
                    <li>您好，欢迎来到京西！[<a href="<?php echo U('User/login');?>">登录</a>] [<a href="<?php echo U('User/regist');?>">免费注册</a>] </li>
                    <li class="line">|</li>
                    <li>我的订单</li>
                    <li class="line">|</li>
                    <li>客户服务</li>
                </ul><?php endif; ?>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="index.html"><img src="<?php echo C('IMG_URL');?>logo.png" alt="京西商城"></a></h2>

        <!--控制器为shop的情况下就显示下面的div-->
        <?php if((CONTROLLER_NAME) == "Shop"): ?><div class="flow fr <?php echo (ACTION_NAME); ?>">
                <ul>
                    <li <?php if((ACTION_NAME) == "flow1"): ?>class="cur"<?php endif; ?> >1.我的购物车</li>
                    <li <?php if((ACTION_NAME) == "flow2"): ?>class="cur"<?php endif; ?> >2.填写核对订单信息</li>
                    <li <?php if((ACTION_NAME) == "flow3"): ?>class="cur"<?php endif; ?>>3.成功提交订单</li>
                </ul>
            </div><?php endif; ?>
    </div>
</div>
<!-- 页面头部 end -->

<!-- 主体部分start -->



<title>订单列表页面</title>
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>base.css" type="text/css">
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>global.css" type="text/css">
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>header.css" type="text/css">
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>cart.css" type="text/css">
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>footer.css" type="text/css">

<script type="text/javascript" src="<?php echo C('JS_URL');?>jquery-1.8.3.min.js"></script>


<div style="clear:both;"></div>


<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
    <h2><span>我的订单</span></h2>
    <table>

        <?php if(is_array($orderinfo)): foreach($orderinfo as $k=>$v): ?><tbody>
            <tr>
                <td class="col2"> <p>订单ID</p> <p><?php echo ($v['order_info']['order_number']); ?></p> </td>
                <td class="col2"> <p>订单价格</p> <p><?php echo ($v['order_info']['order_price']); ?></p> </td>
                <td class="col2"> <p>是否付款</p> <p><?php echo ($v['order_info']['order_status'] == '0'?'<span style="font-weight: bold;color:red">未付款</span>':'<span style="font-weight: bold;color:green">已付款</span>'); ?></p> </td>
                <td class="col2"> <p>是否发货</p> <p><?php echo ($v['order_info']['is_send'] == '是'?'<span style="font-weight: bold;color:green">已发货</span>':'<span style="font-weight: bold;color:red">未发货</span>'); ?></p> </td>
            </tr>
            <tr>
                <td class="col2"> <p>购买时间</p> <p><?php echo (date('Y-m-d H:i:s',$v['order_info']['add_time'])); ?></p> </td>
                <td class="col2"> <p>订单价格</p> <p><?php echo ($v['order_info']['order_price']); ?></p> </td>
                <td class="col2"> <p>支付方式</p> <p><?php echo ($v['order_info']['order_pay']); ?></p> </td>
                <td class="col2"> <button><a href="<?php echo U('Order/detail',array('order_id'=>$k));?>">查看详情</a></button> </td>

            </tr>
            <?php if(is_array($v['goods_info'])): foreach($v['goods_info'] as $kk=>$vv): ?><tr>
                    <td class="col1"><img src="<?php echo (substr($vv['goods_small_logo'],1)); ?>" alt="暂无图片" />  <strong><?php echo ($vv['goods_name']); ?></strong></td>
                    <td class="col2"> <p>商品价格</p> <p><?php echo ($vv['goods_price']); ?></p> </td>
                    <td class="col2"> <p>购买数量</p> <p><?php echo ($vv['goods_number']); ?></p> </td>
                    <td class="col2"> <p>小计价格</p> <p><?php echo ($vv['goods_total_price']); ?></p> </td>
                </tr><?php endforeach; endif; ?>
                <tr>
                    <td>
                        <input type="text" style="width: 600px"  readonly="readonly">

                    </td>
                </tr>
            </tbody><?php endforeach; endif; ?>
        <tfoot>
        <tr>
            <td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo ($number_price["price"]); ?></span></strong></td>
        </tr>
        </tfoot>
    </table>
    <div class="cart_btn w990 bc mt10">
        <a href="" class="continue">继续购物</a>
        <a href="<?php echo U('flow2');?>" class="checkout"></a>
    </div>
</div>
<!-- 主体部分 end -->




<!-- 主体部分end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="<?php echo C('IMG_URL');?>xin.png" alt="" /></a>
        <a href=""><img src="<?php echo C('IMG_URL');?>kexin.jpg" alt="" /></a>
        <a href=""><img src="<?php echo C('IMG_URL');?>police.jpg" alt="" /></a>
        <a href=""><img src="<?php echo C('IMG_URL');?>beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->

</body>
</html>