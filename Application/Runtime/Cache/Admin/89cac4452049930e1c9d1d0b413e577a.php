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
    <script>
        //用ajax进行添加操作
        $(function () {
            //给sub_mit绑定onclick事件
            $('#sub_mit').click(function () {
                //先搞个加载效果
                var loads =   layer.load(1, {
                    shade: [0.1, '#fff'] //0.1透明度的白色背景
                });


              //先获取数据
                var data = new Array();
                //把所有被选中的checked标签内容放入data这个数组
                $('input:checkbox').each(function () {
                    if($(this).attr('checked')){
                        data.push($(this).val());
                    }
                })


                //使用Ajax操作
                $.ajax({
                    //Ajax五个值  地址 数据 提交方式 接受方式 回调函数
                    url:'/index.php/Admin/Role/distribute',
                    data:{'role_id':$('#role_id').val(),'auth_id':data},
                    type:'post',
                    dataType:'json',
                    success:function (msg) {
                        loads = null;
                            console.log(msg);
                            if(msg.states === 0){
                            layer.msg(msg.tip);
                                window.location.href = "/index.php/Admin/Role/showlist";
                            }else {
                            layer.msg(msg.tip);
                                window.location.herf('/index.php/Admin/Role/distribute');

                            }

                    }
                })

            })
        })

    </script>

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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 角色管理 -> 权限分配</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="/index.php/Admin/Role/showlist">返回</a>   &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="role_id" value="<?php echo ($roleinfo["role_id"]); ?>">
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6" colspan="2"><div align="left" >当前正在给<span class="STYLE19" style="font-size: 20px;color: #00a2d4;">【<?php echo ($roleinfo["role_name"]); ?>】</span>分配权限</div></td>
                        </div></td>
                    </tr>
                    <?php if(is_array($authinfoA)): foreach($authinfoA as $key=>$v): ?><tr>
                            <td height="20" bgcolor="#FFFFFF" class="STYLE6" width="15%">
                                <div align="right">
                                <span class="STYLE19">
                                    <input  type="checkbox" name="auth_id[]" value="<?php echo ($v["auth_id"]); ?>"
                                    <?php if(in_array(($v["auth_id"]), is_array($roleinfo["role_auth_ids"])?$roleinfo["role_auth_ids"]:explode(',',$roleinfo["role_auth_ids"]))): ?>checked='true'<?php endif; ?> ><?php echo ($v["auth_name"]); ?>
                                </span>
                                </div>
                            </td>
                            <td height="20" bgcolor="#FFFFFF" class="STYLE19">
                                <div align="left">
                                    <?php if(is_array($authinfoB)): foreach($authinfoB as $key=>$vv): if(($vv["auth_pid"]) == $v["auth_id"]): ?><div style="width: 100px;float: left;margin-left: 30px">
                                                <input type="checkbox" name="auth_id[]" value="<?php echo ($vv["auth_id"]); ?>"
                                                <?php if(in_array(($vv["auth_id"]), is_array($roleinfo["role_auth_ids"])?$roleinfo["role_auth_ids"]:explode(',',$roleinfo["role_auth_ids"]))): ?>checked='true'<?php endif; ?> ><?php echo ($vv["auth_name"]); ?>
                                            </div><?php endif; endforeach; endif; ?>
                                </div>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input type="button" id="sub_mit" value="分配权限">
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
</body>
</html>