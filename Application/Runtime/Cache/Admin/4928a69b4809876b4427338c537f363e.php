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
        .STYLE6 {color: #000000; font-size: 12px; }
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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 权限管理 -> 权限列表</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
              <a href="<?php echo U('tianjia');?>"><img src="<?php echo C('AD_IMG_URL');?>add.gif" width="10" height="10" /> 添加</a>   &nbsp;
              </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
            <tr>
                <td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
                    <input type="checkbox" name="checkbox" id="checkbox" />
                </div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">权限ID</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="left"><span class="STYLE10">权限内容</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">父级权限id</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">控制器c</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">方法a</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
            </tr>
            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                        <input type="checkbox" name="checkbox1" id="checkbox1" />
                    </div></td>
                    <td height="20" id="auth_id"  bgcolor="#FFFFFF" class="STYLE19"><div align="center"><span><?php echo ($v["auth_id"]); ?></span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><?php echo str_repeat('-',$v['level']*4); echo ($v["auth_name"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["auth_pid"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["auth_c"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["auth_a"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21">
                        <a  id="delete_auth"  href="#" style="color:rgb(58,99,117);"><img  src="<?php echo C('AD_IMG_URL');?>del.gif" width="10" height="10" /> 删除 </a>|
                        查看 |
                        <a  href="<?php echo U('update',array('auth_id'=>$v['auth_id']));?>" style="color:rgb(58,99,117);"> <img src="<?php echo C('AD_IMG_URL');?>edit.gif" width="10" height="10" />编辑</a></div></td>
                </tr><?php endforeach; endif; ?>
        </table></td>
    </tr>
    <tr>
        <td height="30">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%"><div align="left"><span class="STYLE22"><?php echo ($page); ?></span></div></td>
                    <td width="0%"><table width="312" border="0" align="right" cellpadding="0" cellspacing="0"></td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table >
</body >
<script type="text/javascript" src="<?php echo C('AD_JS_URL');?>jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo C('AD_LY_URL');?>layer.js"></script>
<script type="text/javascript">
    //用Ajax实现删除效果
    $(function () {

        // 获取delete_auth标签并绑定click事件
        $('[id$=delete_auth]').click(function () {
            layer.msg('测试！');
            //获取当前指向td的auth_id
            var tr =  $(this).parent().parent().parent()
            var auth_id =  $(this).parent().parent().parent().children('[id$=auth_id]').find('span').html()
            console.log(auth_id);

            //询问框
            layer.confirm('真的要删除吗', {
                btn: ['下定决心','还是算了'] //按钮
            }, function(){
                //通过Ajax与服务器交互
                $.ajax({
                    //Ajax五个标签  地址，数据，提交方式，接收方式，回调函数
                    url:'/index.php/Admin/Auth/delete',
                    data:{'auth_id':auth_id},
                    type:'post',
                    dataType:'json',
                    success:function (msg) {
                        console.log(msg);
                        if(msg.c ===0){
                            layer.msg(msg.tip);
                            //同时也要删除当前这个td
                            tr.remove();
                        }else {
                            layer.msg(msg.tip);
                        }
                    }
                })
            }, function(){
                layer.msg('明智的选择');
            });


        })
    });

</script>



</html>