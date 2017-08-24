<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Skiyo 后台管理工作平台 by Jessica</title>
  <link rel="stylesheet" type="text/css" href="<?php echo C('AD_CSS_URL');?>style.css"/>
  <script type="text/javascript" src="<?php echo C('AD_JS_URL');?>js.js"></script>
  <script type="text/javascript" src="<?php echo C('AD_JS_URL');?>jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="<?php echo C('AD_LY_URL');?>layer.js"></script>

  <script>
      function verify() {
          if($('#checkverify').val() == ''){
              layer.msg('这个验证码看不清？那就换一个');
              $('#verifyImg').attr('src','/index.php/Admin/Manager/verifyImg/'+Math.random());
          }else {
              var code = $('#checkverify').val();
              $.ajax({
                  //Ajax五个值，地址，数据，传值方式，接受数据类型，回调函数
                  url:"/index.php/Admin/Manager/checkVerify",
                  data:{'verify':code},
                  dataType:'json',
                  type:'post',
                  success:function (msg) {
                      console.log(msg);
                      if(msg.states === 1){
                          layer.msg('验证码正确！');
                          //并且把输入框内的验证码文字变成绿色
                          $('#checkverify').attr('style','color:green');
                      }else {
                          layer.msg('验证码错误！');
                          //并且把输入框内的验证码文字变成红色
                          $('#checkverify').attr('style','color:red');
                      }
                  }
              })
          }

      }
      //焦点失去就开始验证
      //如果内容为空就刷新验证码
      //如果有内容就发送ajax到服务器进行验证
      //根据返回的信息弹出 正确/错误


  </script>

</head>
<body>
<div id="top">  </div>
<form id="login" name="login" action="" method="post">
  <div id="center">
    <div id="center_left"></div>
    <div id="center_middle">
      <div class="user">
        <label>用户名：
          <input type="text" name="manager_name" id="user" />
        </label>
      </div>
      <div class="user">
        <label>密　码：
          <input type="password" name="manager_pwd" id="pwd" />
        </label>
      </div>
      <div class="chknumber">
        <label>验证码：
          <input name="manager_verify" onblur="verify()" type="text" id="checkverify" maxlength="4" class="chknumber_input" style="vertical-align: middle" />
        </label>
        <img src="/index.php/Admin/Manager/verifyImg" onclick="this.src='/index.php/Admin/Manager/verifyImg/'+Math.random()" id="verifyImg" style="vertical-align: middle" width="57" height="20"/>
      </div>
    </div>
    <div id="center_middle_right"></div>
    <div id="center_submit">
      <div class="button"> <img src="<?php echo C('AD_IMG_URL');?>dl.gif" width="57" height="20" onclick="form_submit()" > </div>
      <div class="button"> <img src="<?php echo C('AD_IMG_URL');?>cz.gif" width="57" height="20" onclick="form_reset()"> </div>
    </div>
    <div id="center_right" style="color:red;" ><?php echo ((isset($errorlogin) && ($errorlogin !== ""))?($errorlogin):''); ?></div>
  </div>
</form>
<div id="footer"></div>
</body>
</html>