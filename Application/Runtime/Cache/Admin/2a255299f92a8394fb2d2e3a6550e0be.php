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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 属性管理 -> 属性添加</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="/index.php/Admin/Attribute/showlist">返回</a>   &nbsp; </span>
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
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="attr_name" />
                            <span id="attr_name" style="color:red"><?php echo ((isset($errorinfo["attr_name"]) && ($errorinfo["attr_name"] !== ""))?($errorinfo["attr_name"]):'*'); ?></span>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">所属商品类型：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <select name="type_id" >
                                <option name="" value="0">-请选择-</option>
                                <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option  value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                            </select>
                            <span id="type_id" style="color:red"><?php echo ((isset($errorinfo["type_id"]) && ($errorinfo["type_id"] !== ""))?($errorinfo["type_id"]):'*'); ?></span>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性是否可选：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="radio" name="attr_sel" value="only" checked="checked" > 唯一属性
                            <input type="radio" name="attr_sel" value="many"  > 单一属性
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性值录入方式：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="radio" name="attr_write" value="manual" checked="checked" > 手工录入
                            <input type="radio" name="attr_write" value="list"  > 从下边列表选取
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">可选值列表：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <textarea name="attr_vals" style="width: 400px;height: 100px"></textarea>
                            <span>多个可选值通过“<font color="red">逗号</font>”连接</span>
                        </div></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
                    <tr>
                        <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
                            <input id="attr_submit" type="button" value="添加属性">
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
    //****************用Ajax实现添加并且自动跳转
    //serialize()方法通过序列化表单值，创建 URL 编码文本字符串
    $(function () {
        $('#attr_submit').click(function () {
            //获取attr_form表单的信息
            //var data = new FormData($('#attr_form')[0]);
            var data = $('#attr_form').serialize();
            console.log(data);

            $('#type_id').html('');
            $('#attr_name').html('');

            //通过ajax与服务器交互
            $.ajax({
                //ajax常用五个值 地址 数据 提交方式 接收方式 回调函数
                url:'/index.php/Admin/Attribute/tianjia',
                data:data,
                type:'post',
                //contentType: false,
                //processData: false,
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if (msg.status === 2) {
                        //错误信息是数组，需要遍历
                        var error = msg.tip;
                    console.log(error);
                        $.each(error,function (n,v) {
                            $('#'+n).html(v);
                        })

                    } else {
                        if (msg.status === 0) {
                            //成功  询问是否跳转到showlist页面
                            //询问框
                            layer.confirm('新增成功，是否继续添加', {
                                btn: ['再加点', '去列表看看'] //按钮
                            }, function () {
                                window.location.href = ('/index.php/Admin/Attribute/tianjia');
                            }, function () {
                                window.location.href = ('/index.php/Admin/Attribute/showlist');
                            });
                        } else {
                            layer.msg(msg.tip);
                            window.location.href = "/index.php/Admin/Attribute/tianjia";
                        }
                    }
                }
            })


        })
    })


</script>