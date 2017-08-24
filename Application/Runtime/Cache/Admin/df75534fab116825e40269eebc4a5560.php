<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <script type="text/javascript" src="<?php echo C('AD_JS_URL');?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo C('AD_LY_URL');?>layer.js"></script>
    <script type="text/javascript" src="/Public/Admin/laydate/laydate.js"></script>
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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 商品秒杀添加</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="/index.php/Admin/Goods/showlist">返回</a>   &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td>
            <form method="post" id="form">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品id：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" id="goods_id_info" name="goods_id" value="<?php echo ((isset($goods_id) && ($goods_id !== ""))?($goods_id):''); ?>" />
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">秒杀开始时间</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <li class="laydate-icon" id="start" style="width:200px; margin-right:10px;list-style: none" ></li>

                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">秒杀结束时间</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <li class="laydate-icon" id="end" style="width:200px;list-style: none"></li>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">价格</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" id="goods_price_info" name="goods_price" />
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">数量</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" id="goods_number_info" name="goods_number" />
                        </div></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input type="button" id="sub_mit" value="添加秒杀">
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
    var start_time = 0;
    var end_time = 0;

    //****************用Ajax实现自动跳转
    //serialize()方法通过序列化表单值，创建 URL 编码文本字符串
    $(function () {
        $('#sub_mit').click(function () {

            var goods_id = $('#goods_id_info').val();
            var goods_number = $('#goods_number_info').val();
            var goods_price = $('#goods_price_info').val();

            //通过ajax与服务器交互
            $.ajax({
                //Ajax五个常用值  地址 数据 提交方式 接收方式 回调函数
                url:'/index.php/Admin/Goods/miaoshaadd',
                data:{'goods_id':goods_id,'goods_price':goods_price,'goods_number':goods_number,'start_time':start_time,'end_time':end_time},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status === 200){
                        //成功  询问是否跳转到showlist页面
                        //询问框
                        layer.confirm('新增成功，是否继续添加', {
                            btn: ['再写点','去列表看看'] //按钮
                        }, function(){
                            window.location.href = ('/index.php/Admin/Goods/miaoshaadd');
                        }, function(){
                            window.location.href = ('/index.php/Admin/Goods/miaoshalist');
                        });
                    }else{
                        //失败 就刷新当前页面
                        layer.msg(msg.tips);
                        window.location.href = ('/index.php/Admin/Goods/miaoshaadd');
                    }
                }
            })
        })
    })


    var start = {
        elem: '#start',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now(), //设定最小日期为当前日期
        max: '2099-06-16 23:59:59', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
            //把这个时间戳返回
            start_time = new Date((datas).replace(new RegExp("-","gm"),"/")).getTime();
        }
    }

    var end = {
        elem: '#end',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now(),
        max: '2099-06-16 23:59:59',
        istime: true,
        istoday: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
            //把这个时间戳返回
            end_time = new Date((datas).replace(new RegExp("-","gm"),"/")).getTime()
        }
    }
    laydate(start);
    laydate(end);
</script>