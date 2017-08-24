<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <script type="text/javascript" src="<?php echo C('AD_JS_URL');?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo C('AD_LY_URL');?>layer.js"></script>
    <style type="text/css">
        <!--
        body {
            margin-left: 3px;
            margin-top: 0px;
            margin-right: 3px;
            margin-bottom: 0px;
        }
        .STYLE1 {
            color: #e1e2e3;
            font-size: 12px;
        }
        .STYLE6 {color: #000000; font-size: 12; }
        .STYLE10 {color: #000000; font-size: 12px; }
        .STYLE19 {
            color: #344b50;
            font-size: 12px;
        }
        .STYLE21 {
            font-size: 12px;
            color: #3b6375;
        }
        .STYLE22 {
            font-size: 12px;
            color: #295568;
        }
        a:link{
            color:#e1e2e3; text-decoration:none;
        }
        a:visited{
            color:#e1e2e3; text-decoration:none;
        }
        -->
    </style>
</head>

<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 订单管理 -> 订单详情</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
                            <a href="/index.php/Admin/Order/showlist">返回</a>   &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td>
            <form id="attr_form" >
                <input type="hidden" name="role_id" value="<?php echo ($roleinfo["role_id"]); ?>">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td height="20" bgcolor="#d3eaef" class="STYLE6" colspan="100"><div align="left"><span class="STYLE19">订单基本信息</span></div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">用户名：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["username"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">订单编号：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["order_number"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">订单总金额：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["order_price"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">支付方式：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($paymethods[$orderinfo['order_pay']]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">是否发货：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo['is_send'] == '是'?'<span style="font-weight: bold;color:green">已发货</span>':'<span style="font-weight: bold;color:red">未发货</span>'); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">是否付款：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo['order_status'] == '0'?'<span style="font-weight: bold;color:red">未付款</span>':'<span style="font-weight: bold;color:green">已付款</span>'); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">下单时间：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo (date('Y-m-d H:i:s',$orderinfo["add_time"])); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">发票抬头：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo['order_fapiao_title'] == '0'?'个人':'公司'); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">发票公司：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["order_fapiao_company"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">发票内容：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["order_fapiao_content"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">收货人名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["cgn_name"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">收货地址：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["cgn_address"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">联系电话：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["cgn_tel"]); ?>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">邮编：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <?php echo ($orderinfo["cgn_code"]); ?>
                        </div></td>
                    </tr>
                </table>
                <hr>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">

                    <tr>
                        <td height="20" bgcolor="black" class="STYLE6" colspan="100"><div align="left"><span class="STYLE19" style="color: white">订单基本信息</span></div></td>
                    </tr>
                    <tr>
                        <td width="5%" height="20" bgcolor="#d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品ID</span></div></td>
                        <td width="10%" height="20" bgcolor="#d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品名称</span></div></td>
                        <td width="5%" height="20" bgcolor="#d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品单价</span></div></td>
                        <td width="5%" height="20" bgcolor="#d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">购买数量</span></div></td>
                        <td width="5%" height="20" bgcolor="#d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">小计价格</span></div></td>
                    </tr>
                    <?php if(is_array($goodsinfo)): foreach($goodsinfo as $key=>$v): ?><tr>
                            <td  height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><?php echo ($v["goods_id"]); ?></div></td>
                            <td  height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><?php echo ($v["goods_name"]); ?></div></td>
                            <td  height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><?php echo ($v["goods_price"]); ?></div></td>
                            <td  height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><?php echo ($v["goods_number"]); ?></div></td>
                            <td  height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><?php echo ($v["goods_total_price"]); ?></div></td>
                        </tr><?php endforeach; endif; ?>
                </table>

                <script type="text/javascript" charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
                <script type="text/javascript">
                    var geocoder,map,marker = null;
                    //JQuery自动加载
                    $(function () {
                        var center = new qq.maps.LatLng(39.916527,116.397128);
                        map = new qq.maps.Map(document.getElementById('container'),{
                            center: center,
                            zoom: 15
                        });

                        //调用地址解析类
                        geocoder = new qq.maps.Geocoder({
                            complete : function(result){
                                map.setCenter(result.detail.location);
                                var marker = new qq.maps.Marker({
                                    map:map,
                                    position: result.detail.location
                                });
                                var infoWin = new qq.maps.InfoWindow({
                                    map: map
                                });
                                infoWin.open();
                                //tips  自定义内容
                                infoWin.setContent('<div style="width:200px;padding-top:10px;">'+
                                    '<p>你好</p> '+
                                    '<p><?php echo ($orderinfo["cgn_address"]); ?></p></div>');
                                infoWin.setPosition(marker);

                            }
                        });
                        var address = "<?php echo ($orderinfo["cgn_address"]); ?>";
                        //通过getLocation();方法获取位置信息值
                        geocoder.getLocation(address);




                    });

                </script>

                <table width="100%" border="0" cellpadding="0" cellspacing="1" >
                    <tr>
                        <td colspan="100">
                            <div id="container" style='width:900px; height:440px;margin:auto;'></div>
                        </td>
                    </tr>
                </table>

            </form>
        </td>
    </tr>
</table>
</body>
</html>

<script type="text/javascript">

</script>