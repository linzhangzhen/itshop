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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 会员管理 -> 会员级别添加</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="/index.php/Admin/Member/showlist">返回</a>   &nbsp; </span>
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
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">会员名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="level_name" />
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">会员折扣</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="level_rate" />
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">积分下限</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="jifen_bottom" />
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">积分上限</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="jifen_top" />
                        </div></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input type="button" id="sub_mit" value="添加权限">
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
    //****************用Ajax实现自动跳转
    //serialize()方法通过序列化表单值，创建 URL 编码文本字符串
    $(function () {
        $('#sub_mit').click(function () {
            //loading层
            var index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });

            var data =  $('#form').serialize();
            console.log(data);
            //layer.msg($('#form').serialize());

            //通过ajax与服务器交互
            $.ajax({
                //Ajax五个常用值  地址 数据 提交方式 接收方式 回调函数
                url:'/index.php/Admin/Member/tianjia',
                data:data,
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status === 0){
                        //成功  询问是否跳转到showlist页面
                        //询问框
                        layer.confirm('新增成功，是否继续添加', {
                            btn: ['再写点','去列表看看'] //按钮
                        }, function(){
                            window.location.href = ('/index.php/Admin/Member/tianjia');
                        }, function(){
                            window.location.href = ('/index.php/Admin/Member/showlist');
                        });
                    }else{
                        //失败 就刷新当前页面
                        layer.msg(msg.tips);
                        window.location.href = ('/index.php/Admin/Member/tianjia');
                    }
                }
            })
        })
    })
</script>