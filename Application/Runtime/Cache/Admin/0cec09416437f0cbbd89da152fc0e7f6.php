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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 属性管理 -> 属性列表</span></td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="attr_show">
            <input type="hidden" id="chuan_type_id" value="<?php echo ($_GET['type_id']); ?>">
            <tr>
                <td colspan="100" width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="left" >
                    按商品类型显示：
                    <select id="type_id"  onchange="show_attr_info()">
                        <option value="0">-请选择-</option>
                        <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </div></td>
            </tr>
            <tr>
                <td  width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
                    <input type="checkbox" name="checkbox" id="checkbox" />
                </div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">属性ID</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">属性名称</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品类型</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">是否可选</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">录入方式</span></div></td>
                <td width="20%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">可选值列表</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
            </tr>
<!--            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                        <input type="checkbox" name="checkbox1" id="checkbox1" />
                    </div></td>
                    <td height="20" id="attribute_id"  bgcolor="#FFFFFF" class="STYLE19"><div align="center"><span><?php echo ($v["attr_id"]); ?></span></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["attr_name"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["type_name"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['attr_sel']=='only'?'唯一属性':'单选属性'); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['attr_write']=='manual'?'手工':'列表选取'); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["attr_vals"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21">
                        <a  id="delete_attribute"  href="#" style="color:rgb(58,99,117);"><img  src="<?php echo C('AD_IMG_URL');?>del.gif" width="10" height="10" /> 删除 </a>|
                        查看 |
                        <a  href="<?php echo U('update',array('attribute_id'=>$v['attribute_id']));?>" style="color:rgb(58,99,117);"> <img src="<?php echo C('AD_IMG_URL');?>edit.gif" width="10" height="10" />编辑</a></div></td>
                </tr><?php endforeach; endif; ?>-->
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

    var attr_info_cache = new Array();

    //获取ID值更改当前页面信息
    $(function () {
        //获得类型列表传递过来的type_id
        var chuan_type_id = $('#chuan_type_id').val();

        console.log(chuan_type_id);
        //使得商品类型选中该chuan_type_id对应的类型
        $('#type_id').val([chuan_type_id]);

        //使得当前商品类型对应的“属性裂变信息展示”
        show_attr_info();
    })

    //根据下拉菜单变化更换当前页面信息
    function show_attr_info() {
        //①获取当前选中的类型信息
        var type_id = $('#type_id').val();

        //判断attr_info_cache缓存变量是否已经有了需求信息，如果有就直接追加给页面
        if(typeof attr_info_cache[type_id === 'undefined']){

        //②通过ajax去服务器获得type_id对应的属性列表信息
        $.ajax({
            //Ajax五个标签 地址 传值 方式 接收方式 回调函数
            url:'/index.php/Admin/Attribute/getAttrInfoByType',
            data:{'type_id':type_id},
            type:'post',
            async:false,
            dataType:'json',
            success:function (msg) {
                console.log(msg);
                //遍历msg显示在列表中
                var s = "";
                $.each(msg,function(n,v){
                    s += '<tr> <td height="20" bgcolor="#FFFFFF"><div align="center"> <input type="checkbox" name="checkbox2" id="checkbox2" /> </div></td> <td height="20" id="attr_id" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19">';
                    s += v.attr_id;
                    s += '</span></div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">';
                    s += v.attr_name;
                    s += '</div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">';
                    s += v.type_name;
                    s += '</div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">';
                    s += v.attr_sel=='only'?'唯一属性':'单选属性';
                    s += '</div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">';
                    s += v.attr_write=='manual'?'手动输入':'列表选取';
                    s += '</div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">'
                    s += v.attr_vals;
                    s+= '</div></td> <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21"> <a  id="del_attr"  href="#" style="color:rgb(58,99,117);"><img  src="/Public/Admin/images/del.gif" width="10" height="10" /> 删除 </a>|查看 | <a  href="/index.php/Admin/Attribute/upd/type_id/1.html" style="color:rgb(58,99,117);"> <img src="/Public/admin/images/edit.gif" width="10" height="10" />编辑</a></div></td> </tr>';
                });

                //缓存制作好的属性列表信息
                attr_info_cache[type_id] = s;

/*                //把页面已经显示的属性列表删除
                $('#attr_show tr:gt(1)').remove();
                //把设置好的s字符串追加给页面
                $('#attr_show').append(s);*/

            }
        })
        }
             //把页面已经显示的属性列表删除
         $('#attr_show tr:gt(1)').remove();    //attr_show下标大于1的tr
         //把设置好的s字符串追加给页面
         $('#attr_show').append(attr_info_cache[type_id]);

    }



    //****************点击删除
    //用Ajax实现删除效果
    $(function () {
        // 获取delete_attribute标签并绑定click事件
        $('[id$=del_attr]').click(function () {

            //获取当前指向td的attribute_id
            var tr =  $(this).parent().parent().parent()
            var attr_id =  $(this).parent().parent().parent().children('[id$=attr_id]').find('span').html()
            console.log(attr_id);

            //询问框
            layer.confirm('真的要删除吗', {
                btn: ['下定决心','还是算了'] //按钮
            }, function(){
                //通过Ajax与服务器交互
                $.ajax({
                    //Ajax五个标签  地址，数据，提交方式，接收方式，回调函数
                    url:'/index.php/Admin/Attribute/delete',
                    data:{'attr_id':attr_id},
                    type:'post',
                    dataType:'json',
                    success:function (msg) {
                        console.log(msg);
                        if(msg.states ===0){
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