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
                                <td width="6%" height="19" valign="bottom"><div align="center"><itype src="<?php echo C('AD_Itype_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 商品类型</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
              <a href="<?php echo U('tianjia');?>"><itype src="<?php echo C('AD_Itype_URL');?>add.gif" width="10" height="10" /> 添加</a>   &nbsp;
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
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">类型ID</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">名称</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
            </tr>
            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                        <input type="checkbox" name="checkbox1" id="checkbox1" />
                    </div></td>
                    <td id="type_id" height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["type_id"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["type_name"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE21">
                        <a href="<?php echo U('attribute/showlist',array('type_id'=>$v['type_id']));?>" style="color:rgb(58,99,117);" >属性列表</a>
                        <a id="del_type" href="#" style="color:rgb(58,99,117);" >
                            <itype src="<?php echo C('AD_Itype_URL');?>del.gif" width="10" height="10" /> 删除 |</a>
                        查看 | <itype src="<?php echo C('AD_Itype_URL');?>edit.gif" width="10" height="10" /> <a
                            href="<?php echo U('upd',array('type_id'=>$v['type_id']));?>" style="color:rgb(58,99,117);">编辑</a></span></div></td>
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

    //****************点击删除
    //用Ajax实现删除效果
    $(function () {
        // 获取delete_typeibute标签并绑定click事件
        $('[id$=del_type]').click(function () {

            //获取当前指向td的typeibute_id
            var now_tr =  $(this).parent().parent().parent().parent()
            var type_id =  now_tr.children('[id$=type_id]').children().html()
            console.log(type_id);

            //询问框
            layer.confirm('真的要删除吗', {
                btn: ['下定决心','还是算了'] //按钮
            }, function(){
                //通过Ajax与服务器交互
                $.ajax({
                    //Ajax五个标签  地址，数据，提交方式，接收方式，回调函数
                    url:'/index.php/Admin/Type/deltype',
                    data:{'type_id':type_id},
                    type:'post',
                    dataType:'json',
                    success:function (msg) {
                        console.log(msg);
                        if(msg.states ===0){
                            layer.msg(msg.tip);
                            //同时也要删除当前这个td
                            now_tr.remove();
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