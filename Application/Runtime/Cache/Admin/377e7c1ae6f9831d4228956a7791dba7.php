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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 用户管理 -> 用户列表</span></td>
                            </tr>
                        </table>
                        </td>
                        <td>
                            <div align="right"><span class="STYLE1">
                            <button id="exportUser">用户导出</button>
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
                <td i width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">角色ID</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">名称</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">邮箱</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">状态</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
            </tr>
            <?php if(is_array($userinfo)): foreach($userinfo as $key=>$v): ?><tr>
                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                        <input type="checkbox" name="checkbox1" id="checkbox1" />
                    </div></td>
                    <td id="user_id" height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["user_id"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["username"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["user_email"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["flag"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF">
                        <div align="center">
                            <span class="STYLE21">
                        <a href="#" style="color:rgb(58,99,117);"  id="blocked">禁言</a>
                        <a id="del_user" href="#" style="color:rgb(58,99,117);" ><img src="<?php echo C('AD_IMG_URL');?>del.gif" width="10" height="10" /> 封号</a> |
                        查看 | <img src="<?php echo C('AD_IMG_URL');?>edit.gif" width="10" height="10" /> <a
                                    href="<?php echo U('upd',array('user_id'=>$v['user_id']));?>" style="color:rgb(58,99,117);">解除禁言</a></span></div></td>
                </tr><?php endforeach; endif; ?>
        </table></td>
    </tr>
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="33%"><div align="left"><span class="STYLE22"><?php echo ($page); ?></span></div></td>
                <td width="0%"><table width="312" border="0" align="right" cellpadding="0" cellspacing="0">

                    </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
</body>
</html>
<script type="text/javascript">

    //禁言操作
    $(function () {
        $('[id$=blocked]').click(function () {

            //找到这个a标签的父级的父级的父级的父级下第二个子元素的html值
            var now_tr =  $(this).parent().parent().parent().parent();  //为什么要取这个呢？ 方便后面操作tr
            var user_id = now_tr.children('[id$=user_id]').children().html()
            console.log(user_id);

            //询问框  是否禁言
            layer.confirm('真的要口球这个用户？', {
                btn: ['是的(确信)','且慢(容我三思)'] //按钮
            }, function(){
                //左选项执行的函数
                //询问框  塞多久呢
                layer.confirm('塞他多久呢？', {
                    btn: ['随便几天意思一下','塞到死啊！'] //按钮
                }, function(){
                    //按天塞
                    //prompt层
                    layer.prompt({title: '输入任何口令，并确认', formType: 2}, function(text, index){
                        layer.msg('该用户将被禁言'+text+'天')
                        layer.close(index);
                        blocked(user_id,text);
                    });
                }, function(){
                    //封号
                    blocked(user_id);
                });

            }, function(){
                //右选项执行的函数
                layer.msg('不塞了');
            });
        })

        //用户导出
        $('#exportUser').click(function (){
            layer.msg('用户导出');
            $.ajax({
                url:"<?php echo U('exportUser');?>",
                data:'',
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.status==0){
                        layer.msg(msg.tip);
                    }else if(msg.status == 0){
                        layer.msg(msg.tip);
                    }
                }
            })
        })


    })

    //Ajax禁言函数
    function blocked(id,time='feng'){
        $.ajax({
            url:'/index.php/Admin/User/blocked',
            data:{'user_id':id,'time':time},
            type:'post',
            dataType:'json',
            success:function (msg) {
                console.log(msg);
            }
        })
    }



</script>