<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
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

    <script type="text/javascript" src="<?php echo C('AD_JS_URL');?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo C('AD_LY_URL');?>layer.js"></script>

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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 权限管理 -> 管理员添加</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
                            <a href="/index.php/Admin/Manager/showlist">返回</a>
                            &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td>
            <form action="" method="post" >
                <input type="hidden" name="mg_id" value="<?php echo ($mginfo["mg_id"]); ?>">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">管理员名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="auth_name" id="mg_name" />
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">角色：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <select name="role_id" id="role_id">
                                <option value="0">-请选择-</option>
                                <?php if(is_array($roleinfo)): foreach($roleinfo as $key=>$v): ?><option value="<?php echo ($v["role_id"]); ?>"><?php echo ($v["role_name"]); ?></option><?php endforeach; endif; ?>
                            </select>
                            <span id="tipss" style="display: none;color: red">请选择角色</span>
                        </div></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input type="button" value="添加管理员" id="mg_submit">
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
    $(function () {
        //给按钮mg_submit绑定点击事件
        $('#mg_submit').click(function () {
            //收集信息
            //通过ajax与服务器交互
            //根据返回值判断行为

            $.ajax({
                //ajax五个值  地址，数据，提交方式，接受方式，回调函数
                url: '/index.php/Admin/Manager/tianjia',
                data: {'mg_name': $('#mg_name').val(),'role_id':$('#role_id').val()},
                type: 'post',
                dataType: 'json',
                success: function (msg) {
                    console.log(msg);
                    if(msg.states === 2){
                            layer.msg(msg.tip);
                            $('#tipss').show();
                    }else {
                        if (msg.states === 0) {
                            layer.msg(msg.tip);
                            window.location.href = "/index.php/Admin/Manager/showlist";
                        } else {
                            layer.msg(msg.tip);
                            window.location.href = "/index.php/Admin/Manager/tianjia";
                        }
                    }
                }
            })
        })
    })
</script>