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
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 商品秒杀列表</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
              <a href="<?php echo U('miaoshaadd');?>"><img src="<?php echo C('AD_IMG_URL');?>add.gif" width="10" height="10" /> 添加</a>   &nbsp;
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
                <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">秒杀ID</span></div></td>
                <td width="3%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品ID</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品名</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">Logo</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">秒杀价格</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">数量</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">开始时间</span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">结束时间</span></div></td>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">状态</span></div></td>
                <td width="14%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
            </tr>
            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                        <input type="checkbox" name="checkbox1" id="checkbox1" />
                    </div></td>
                    <td height="20" id="miaosha_id" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["miaosha_id"]); ?></div></td>
                    <td height="20" id="goods_id" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["goods_id"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["goods_name"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><img src="<?php echo (substr($v["goods_small_logo"],1)); ?>" alt="不存在的" width="130" height="130"></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["goods_price"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["goods_number"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo (date('Y-m-d H:i:s',$v["start_time"])); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo (date('Y-m-d H:i:s',$v["end_time"])); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v["miaosha_flag"]); ?></div></td>
                    <td height="20" bgcolor="#FFFFFF">
                        <div align="center">
              <span class="STYLE21">
           <a  id="del_goods"  href="#" style="color:rgb(58,99,117);"><img src="<?php echo C('AD_IMG_URL');?>del.gif" width="10" height="10" /> 删除 |</a>
            <a href="<?php echo U('upd',array('miaosha_id'=>$v['miaosha_id']));?>" style="color:rgb(58,99,117);">编辑</a>
                | 查看<img src="<?php echo C('AD_IMG_URL');?>edit.gif" width="10" height="10" />
          </span>
                        </div>
                    </td>
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

    //用Ajax删除页面上是商品信息
    $(function () {
        //找到id=del_role标签（因为一个页面只能有一个ID，所以通过属性来选择而不是ID选择器）
        $('[id$=del_goods]').click(function () {

            //找到这个a标签的父级的父级的父级的父级下第二个子元素的html值
            var now_tr =  $(this).parent().parent().parent().parent()   //为什么要取这个呢？ 方便后面删除tr
            var goods_id = now_tr.children('[id$=goods_id]').children().html()
            console.log(goods_id);


            //通过Ajax与服务器交互
            $.ajax({
                //Ajax五个常用值 地址  数据 传递方式 接收方式 回调函数
                url:'/index.php/Admin/Goods/delGoods',
                data:{'goods_id':goods_id},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    if(msg.states === 0){
                        //成功,同时删除掉当前角色的tr标签
                        layer.msg(msg.tip);
                        now_tr.remove();
                    }else{
                        //失败
                        layer.msg(msg.tip);
                    }
                }
            })
        })
    })

</script>