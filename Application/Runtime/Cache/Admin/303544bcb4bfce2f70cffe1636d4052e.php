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
  <script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>ueditor/ueditor.config.js"></script>
  <script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>ueditor/ueditor.all.min.js"></script>
  <script type="text/javascript"  src="<?php echo C('PLUGIN_URL');?>ueditor/lang/zh-cn/zh-cn.js"></script>
  <!--引入jQuery-->
  <script type="text/javascript" src="<?php echo C('AD_JS_URL');?>jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="<?php echo C('AD_LY_URL');?>layer.js"></script>
  <script type="text/javascript">
      //页面加载完毕就给span切换标签点击事件
      //当前点击的标签高亮，其他的不变
      //siblings()  获取兄弟节点
      $(function () {
          $('#tabbar-div span').click(function () {
              $(this).attr('class','tab-front').siblings().attr('class','tab-back');

              //标签对应的内容显示   先隐藏所有，再显示选定标签
              //全部隐藏
              $('[id$=-tab-show]').hide();
              var idflag = $(this).attr('id');
              //对应的显示
              $('#'+idflag+'-show').show();
          })
      })
  </script>
</head>

<body>
<style type="text/css">
  #tabbar-div {
    background: #80bdcb none repeat scroll 0 0;
    height: 22px;
    padding-left: 10px;
    padding-top: 1px;
    margin-bottom: 3px;
  }
  #tabbar-div p { margin: 2px 0 0;font-size:12px;
  }
  .tab-front {
    background: #bbdde5 none repeat scroll 0 0;
    border-right: 2px solid #278296;
    cursor: pointer;
    font-weight: bold;
    line-height: 20px;
    padding: 4px 15px 4px 18px;
  }
  .tab-back {
    border-right: 1px solid #fff;
    color: #fff; cursor: pointer;line-height: 20px;
    padding: 4px 15px 4px 18px;
  }
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 修改商品</span></td>
              </tr>
            </table></td>
            <td><div align="right"><span class="STYLE1">
            <a href="<?php echo U('showlist');?>">返回</a>   &nbsp; </span>
              <span class="STYLE1"> &nbsp;</span></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="100">
      <div id="tabbar-div">
        <p>
          <span class="tab-front" id="general-tab">通用信息</span>
          <span class="tab-back" id="detail-tab">详细描述</span>
          <span class="tab-back" id="mix-tab">其他信息</span>
          <span class="tab-back" id="properties-tab">商品属性</span>
          <span class="tab-back" id="gallery-tab">商品相册</span>
          <span class="tab-back" id="linkgoods-tab">关联商品</span>
          <span class="tab-back" id="groupgoods-tab">配件</span>
          <span class="tab-back" id="article-tab">关联文章</span>
        </p>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="goods_id" value="<?php echo ($info["goods_id"]); ?>">
        <table id="general-tab-show" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品名称：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="text" name="goods_name" value="<?php echo ($info["goods_name"]); ?>" />
            </div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">价格：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_price" value="<?php echo ($info["goods_price"]); ?>" /></div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">数量：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_number" value="<?php echo ($info["goods_number"]); ?>" /></div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">重量：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_weight" value="<?php echo ($info["goods_weight"]); ?>" /></div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品Logo图片：</span>
              <img src="<?php echo (substr($info["goods_small_logo"],1)); ?>" alt="不存在的" height="80">
            </div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="file" name="goods_logo" id=""></div></td>

          </tr>
        </table>
        <table id="detail-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">详情描述：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <textarea  rows="5" cols="30" id="goods_introduce" name="goods_introduce"  style="width: 620px;height: 200px"><?php echo ($info["goods_introduce"]); ?></textarea>
            </div></td>
          </tr>
        </table>
        <table id="mix-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">其他信息：</span></div></td>
          </tr>
        </table>


        <table id="properties-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" >
          <tr>
          <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19" ">商品类型：</span></div></td>
          <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="left"><span class="STYLE19" ">
            <select name="type_id" id="type_id" onchange="get_attr_info2()">
              <option value="">-请选择-</option>
              <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>"  <?php if(($info["type_id"]) == $v["type_id"]): ?>selected='selected'<?php endif; ?>><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
            </select></span></div></td>
        </tr>
        </table>

        <table id="gallery-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td colspan="100">
              <ul>
                <?php if(is_array($picsinfo)): foreach($picsinfo as $key=>$v): ?><li style="list-style: none;float: left;"  id="pics_show_<?php echo ($v["pics_id"]); ?>">
                    <!--<img src="<?php echo (substr($v["pics_mid"],1)); ?>" alt="不存在的" width="120"><span style="color:red;cursor: pointer;" onclick="if(confirm('确认要删除该相册吗？')){del_pics(<?php echo ($v["pics_id"]); ?>)}">[-]&nbsp;&nbsp;&nbsp;</span>-->
                    <img src="<?php echo (substr($v["pics_mid"],1)); ?>" alt="" width="135" /><span style='color:red;cursor:pointer;' onclick="if(confirm('确认要删除该相册么？')){del_pics(<?php echo ($v["pics_id"]); ?>)}">[-]</span>
                  </li><?php endforeach; endif; ?>
              </ul>
            </td>
          </tr>
          <tr>
            <td  height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right" ><span class="STYLE19" onclick="add_pics_item(this)">[+]商品相册：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="file" name="goods_pics[]" ></div></td>
          </tr>
        </table>
        <table id="linkgoods-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">关联商品：</span></div></td>
          </tr>
        </table>
        <table id="groupgoods-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">配件：</span></div></td>
          </tr>
        </table>
        <table id="article-tab-show" style="display: none;" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">关联文章：</span></div></td>
          </tr>
        </table>
        <table  width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
          <tr>
            <td colspan="2" bgcolor="#FFFFFF" class="STYLE6" style="text-align: center;"><input type="submit" value="修改"></td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>
<script type="text/javascript">

    function add_pics_item(obj) {
        //[+]号可以对应[+]父级span的'dom对象
        //$()obj:把dom对象转化为jquery对象

        //获得[+]对应的tr
        var addtr =  $(obj).parent().parent().parent();
        var futr = addtr.clone();  //复制一个tr出来

        //制作一个[-]号的span
        var sp = "<span class='STYLE19' onclick='$(this).parent().parent().parent().remove()'>[-]商品相册：</span>";
        //删除futr内部[+]对应的span
        futr.find('span').remove();
        //把[-]的span追加给futr
        futr.find('div[align=right]').append(sp);

        //把futr追加给table
        $('#gallery-tab-show').append(futr);
    }

    //实现单个相册图片的Ajax方式删除
    function del_pics(pics_id) {
        $.ajax({
            url:"<?php echo U('delPics');?>",   //ajax发送目的地址
            data:{'pics_id':pics_id},  //发送数据
            dataType:'json', //需求回访的数据类型
            type:'post',  //发送数据类型
            success:function (msg) {
                if(msg.status===0){
                    //删除成功
                    $('#pics_show_'+pics_id).remove();
                }
            }
        })
    }


</script>

<script type="text/javascript">

  //页面加载完成旧调用一次get_attr_info2
  $(function () {
      get_attr_info2();
  })






    //类型切换获取对应的属性信息(实体或者空壳)
    function get_attr_info2(){
        var goods_id = $('[name=goods_id]').val();  //商品goods_id
        var type_id = $('#type_id').val();   //类型type_id
        console.log(type_id);

        //Ajax去服务器端获得属性信息
        $.ajax({
            url:'/index.php/Admin/Goods/getAttrByType2',
            data:{'goods_id':goods_id,'type_id':type_id},
            dataType:'json',
            type:'post',
            success:function (msg) {
                console.log(msg);
                //遍历msg使得与html标签(tr/td)结合追加给页面
                var s ="";
                $.each(msg,function (n,v) {
                    //先判断当前属性是唯一还是单选的
                    if(v.attr_sel == 'only'){
                        //唯一属性，input输入框
                        s+='<tr><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">'+v.attr_name+'：</span></div></td><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="left">';

                        //判断实体，空壳
                        if(v.attr_values == null){
                            //空壳
                            s +=  '<input type="text" name="attr_info['+v.attr_id+'][]" />';
                        }else {
                            //实体
                            s +=  '<input type="text" name="attr_info['+v.attr_id+'][]" value="'+v.attr_values+'" />';
                        }
                        s+= ' </div></td></tr>';
                    }else{
                        //单选属性 select下拉列表
                        //判断实体空壳
                        if(v.attr_values == null){
                            //空壳
                            s += '<tr><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><e class="STYLE19" onclick="add_attr2(this)">[+]</e><span class="STYLE19">'+v.attr_name+'：</span></div></td><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="left"><select name="attr_info['+v.attr_id+'][]" ><option value="0">-请选择-</option>';
                            //拆分可选值列表
                            var attr_values = v.attr_vals.split(',');   //string->array
                            for(var i=0;i<attr_values.length;i++){
                                s += '<option value="'+attr_values[i]+'">'+attr_values[i]+'</option>';
                            }
                            s += '</select></div></td></tr>';
                        }else{
                            //实体
                            //获取当前设置的属性值，并将其转变为数组
                            var now_values =  v.attr_values.split(',')  //string->array

                            for(var k=0;k<now_values.length;k++){
                                s +=  '<tr><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right">';
                                if(k == 0){
                                    s += '<e class="STYLE19" onclick="add_attr2(this)">[+]</e>';
                                }else{
                                    s += '<e class="STYLE19" onclick="$(this).parent().parent().parent().remove()">[-]</e>';
                                }
                                s +=  '<span class="STYLE19">'+v.attr_name+'：</span></div></td><td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="left">';
                                s +=   '<select name="attr_info['+v.attr_id+'][]" ><option value="0">-请选择-</option>';

                                //拆分可选值列表
                                var xuan_values = v.attr_vals.split(',');  //string->array
                                for(var i=0;i<xuan_values.length;i++){
                                    //设置属性值项目选中
                                    s += '<option  value="'+xuan_values[i]+'" ';
                                    if(now_values[k] == xuan_values[i]){
                                        s += ' selected="selected"';
                                    }
                                    s+=  '>'+xuan_values[i]+'</option>';
                                }
                                s += '</select></div></td></tr>';
                            }
                        }
                    }
                })
                //删除之前旧的tr元素
                $('#properties-tab-show tr:gt(0)').remove();
                $('#properties-tab-show').append(s);

            }
        })
    }

  //*******点[+]增加单选属性表单域
  function add_attr2(obj) {
      //根据obj复制一个tr出来
      //dom对象变为jquery对象：$(dom对象)
      var futr = $(obj).parent().parent().parent().clone();

      //剔除futr内部的e标签
      futr.find('e').remove();
      console.log(futr);
      //制作一个"[-]"号的e标签
      var jiane = '<e class="STYLE19" onclick="$(this).parent().parent().parent().remove()">[-]</e>';

      //追加jiane给futr,具体追加给span前边作为兄弟节点
      futr.find('span').before(jiane);

      //追加futr到当前被点击tr的后边
      $(obj).parent().parent().parent().after(futr);

  }


</script>


<script type="text/javascript">
    var ue=UE.getEditor('goods_introduce',{ toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
        'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
        'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
        'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
        'print', 'preview', 'searchreplace', 'help', 'drafts'
    ]]})
</script>