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
                                <td width="6%" height="19" valign="bottom"><div align="center"><itype src="<?php echo C('AD_Itype_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品类型 -> 添加类型</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="/index.php/Admin/Type/showlist">返回</a>   &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="role_id" value="<?php echo ($roleinfo["role_id"]); ?>">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">类型名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input id="type_name" type="text" name="type_name" />
                        </div></td>
                    </tr>

                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input id="type_submit" type="button" value="类型添加">
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

    $(function (){
            //给按钮type_submit绑定点击事件
            $('#type_submit').click(function () {
                //收集信息
                //通过ajax与服务器交互
                //根据返回值判断行为

                $.ajax({
                    //ajax五个值  地址，数据，提交方式，接受方式，回调函数
                    url: '/index.php/Admin/Type/tianjia',
                    data: {'type_name': $('#type_name').val(),},
                    type: 'post',
                    dataType: 'json',
                    success: function (msg) {
                        console.log(msg);
                        if (msg.states === 0) {
                            //成功  询问是否跳转到showlist页面
                            //询问框
                            layer.confirm('新增成功，是否继续添加', {
                                btn: ['再j加点','去列表看看'] //按钮
                            }, function(){
                                window.location.href = ('/index.php/Admin/Type/tianjia');
                            }, function(){
                                window.location.href = ('/index.php/Admin/Type/showlist');
                            });
                        } else {
                            layer.msg(msg.tip);
                            window.location.href = "/index.php/Admin/Type/tianjia";
                        }
                    }
                })
            })
    })
</script>