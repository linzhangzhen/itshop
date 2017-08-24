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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 订单管理 -> 订单列表</span></td>
                            </tr>
                        </table>
                        </td>
                        <td>
                            <div align="right"><span class="STYLE1">
                            <button id="exportorder">订单导出</button>
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
                <td i width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">订单ID</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">订单编号</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">总金额</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">是否付款</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">是否发货</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">下单时间</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
            </tr>
            <?php if(is_array($orderinfo)): foreach($orderinfo as $key=>$v): ?><tr>
                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                        <input type="checkbox" name="checkbox1" id="checkbox1" />
                    </div></td>
                    <td id="order_id" height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["order_id"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><a
                            href="<?php echo U('detail',array('order_id'=>$v['order_id']));?>" style="color:blue;"><?php echo ($v["order_number"]); ?></a></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["order_price"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['order_status']=='0'?'<span style="font-weight: bold;color:red">未付款</span>':'<span style="font-weight: bold;color:green">已付款</span>'); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['is_send']=='是'?'<span style="font-weight: bold;color:green">已发货</span>':'<span style="font-weight: bold;color:red">未发货</span>'); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo (date('Y-m-d H:i:s',$v["add_time"])); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF">
                        <div align="center">
                            <span class="STYLE21">
                        <a id="del_order" href="#" style="color:rgb(58,99,117);" ><img src="<?php echo C('AD_IMG_URL');?>del.gif" width="10" height="10" /> 删除</a> |
                                <a href="#" onclick="bind_express(<?php echo ($v["order_id"]); ?>)" style="color:rgb(58,99,117);"> 绑定快递| <img src="<?php echo C('AD_IMG_URL');?>edit.gif" width="10" height="10" /></a>
                                <a href="<?php echo U('detail',array('order_id'=>$v['order_id']));?>" style="color:rgb(58,99,117);">详情</a></span></div></td>
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

    //订单导出
    $('#exportorder').click(function (){
        layer.msg('订单导出');
        $.ajax({
            url:"<?php echo U('exportorder');?>",
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

    //绑定快递
    function bind_express(obj) {

//prompt层
        layer.prompt({title: '请输入快递公司和快递单号，并确认', formType: 3}, function(val, index){
                //点确定执行的内容
                layer.msg(val),
                    //通过ajax与服务器交互
                    $.ajax({
                        url:'/index.php/Admin/Order/packageNumber',
                        data:{'package_id':val,'order_id':obj},
                        type:'post',
                        dataType:'json',
                        success:function (msg) {
                            console.log(msg);
                        }
                    });

                layer.close(index)
            },
        );
    }

</script>