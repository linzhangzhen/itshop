<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>京西商城</title>
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>header.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>login.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>footer.css" type="text/css">

    <script type="text/javascript" src="<?php echo C('JS_URL');?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo C('JS_URL');?>header.js"></script>
    <script type="text/javascript" src="<?php echo C('JS_URL');?>index.js"></script>
    <script type="text/javascript" src="/Public/Home/layer/layer.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <?php if(!empty($_SESSION['user_name'])): ?><ul>
                    <li>您好，<span style="font-size: 20px;color: blue;" ><?php echo (session('user_name')); ?></span>欢迎来到京西！[<a href=<?php echo U('User/logout');?>>退出登录</a>] </li>
                    <li class="line">|</li>
                    <li>我的订单</li>
                    <li class="line">|</li>
                    <li>客户服务</li>
                </ul>
                <?php else: ?>
                <ul>
                    <li>您好，欢迎来到京西！[<a href="<?php echo U('User/login');?>">登录</a>] [<a href="<?php echo U('User/regist');?>">免费注册</a>] </li>
                    <li class="line">|</li>
                    <li>我的订单</li>
                    <li class="line">|</li>
                    <li>客户服务</li>
                </ul><?php endif; ?>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="index.html"><img src="<?php echo C('IMG_URL');?>logo.png" alt="京西商城"></a></h2>

        <!--控制器为shop的情况下就显示下面的div-->
        <?php if((CONTROLLER_NAME) == "Shop"): ?><div class="flow fr <?php echo (ACTION_NAME); ?>">
                <ul>
                    <li <?php if((ACTION_NAME) == "flow1"): ?>class="cur"<?php endif; ?> >1.我的购物车</li>
                    <li <?php if((ACTION_NAME) == "flow2"): ?>class="cur"<?php endif; ?> >2.填写核对订单信息</li>
                    <li <?php if((ACTION_NAME) == "flow3"): ?>class="cur"<?php endif; ?>>3.成功提交订单</li>
                </ul>
            </div><?php endif; ?>
    </div>
</div>
<!-- 页面头部 end -->

<!-- 主体部分start -->

<link rel="stylesheet" href="<?php echo C('CSS_URL');?>base.css" type="text/css">
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>global.css" type="text/css">
<link rel="stylesheet" href="<?php echo C('CSS_URL');?>login.css" type="text/css">


<!-- 注册主体部分start -->
<div class="login w990 bc mt10 regist">
	<div class="login_hd">
		<h2>用户注册</h2>
		<b></b>
	</div>
	<div class="login_bd">
		<div class="login_form fl">
			<form action="" method="post" id="regist_form">
				<ul>
					<li>
						<label for="">用户名：</label>
						<input type="text" class="txt" name="username" onblur="check_name(this)"  id="username" />
						<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
					</li>
					<li>
						<label for="">密码：</label>
						<input type="password" class="txt" name="password" onblur="check_pass(this)" id="password" />
						<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
					</li>
					<li>
						<label for="">确认密码：</label>
						<input type="password" class="txt" name="password2" onblur="check_pass2(this)" id="password2" />
						<p> 请再次输入密码</p>
					</li>
					<li>
						<label for="">邮箱：</label>
						<input type="text" class="txt" name="email"  id="user_email" />
						<p> 输入邮箱</p>
					</li>
					<li>
						<label for="">手机号：</label>
						<input type="text"  name="user_tel"  style="margin-top: 7px" maxlength="11" />
						<input type="button" onclick="send_telverify(this)" id="s_verify" value="发送验证码">
						<p>手机号</p>
					</li>
					<li class="checkcode">
						<label for="">手机号验证码：</label>
						<input type="text"  name="checkcode" onblur="check_telverify(this)"  style="margin-top: 7px" maxlength="4"  id="telverify"/>
						<p style="color: red"></p>
					</li>
					<li class="checkcode">
						<label for="">验证码：</label>
						<input type="text"  name="checkcode" onblur="check_verify(this)"  style="margin-top: 7px" maxlength="4" />
						<img  onclick="this.src='/index.php/Home/User/verifyImg/'+Math.random()" src="/index.php/Home/User/verifyImg"  id="verify_img"/>
						<p style="color: red"></p>
					</li>
					<li>
						<label for="">&nbsp;</label>
						<input type="checkbox" class="chb" checked="checked" id="check_xieyi" /> 我已阅读并同意《用户注册协议》
					</li>
					<li>
						<label for="">&nbsp;</label>
						<input type="button"  class="login_btn"  onclick="f_submit(this)" id="form_submit"/>
					</li>
				</ul>
			</form>


		</div>

		<div class="mobile fl">
			<h3>手机快速注册</h3>
			<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
			<p><strong>1069099988</strong></p>
		</div>

	</div>
</div>
<!-- 注册主体部分end -->

<script type="text/javascript">
    //定义一个全局变量，每验证成功一个就true一个 全true时就可以点击注册了
    var name_c = false;
    var pass_c = false;
    var pass2_c = false;
    var verify_c = false;
    //var telverify_c = false;

	/*
	 方便显示报错信息的方法
	 tip  string  提示信息
	 id  string   ID
	 re  布尔值  结果
	 */
    function tips(tip,id,re=false) {
        var s = '';
        if(re){
            s += '<p style="color: green" id="'+id+'_r">'+tip+'</p>';
        }else {
            s = '<p style="color: red" id="'+id+'_r">'+tip+'</p>';
        }
        $('#'+id).next().remove();
        $('#'+id).parent().append(s);
    }


    //ajax各种验证

    //ajax验证用户名是否正确
    function check_name(obj) {
        var name = obj.value
        //console.log(name);
        //先判断是否为空
        if(name === ''){
            //如果为空就在提示栏显示
            //先删除下一个兄弟节点，然后加上一个新的
			/*    var s = '<p style="color: red">用户名不可为空！</p>';
			 $('#username').next().remove();
			 $('#username').parent().append(s);*/
            tips('用户名不可为空！','username');
        }else{
            // 格式 用正则表达式
            var  zz = /^[\u4e00-\u9fa5_a-zA-Z0-9]{3,20}$/gi;
            var  re = zz.test(name);
            //console.log(re);
            if(re === false){
                tips('用户名格式不正确，请输入3-20位中文、字母、数字和下划线','username');
                name_c = false;
            }else{
                //通过ajax与服务器交互验证
                $.ajax({
                    url:'/index.php/Home/User/checkName',
                    data:{'username':name},
                    type:'post',
                    dataType:'json',
                    success:function (msg) {
                        //console.log(msg);
                        if(msg.status === 1){
                            //可以注册
                            tips('恭喜你，该用户名可用','username',true);
                            name_c = true;
                        }else {
                            //用户名已经存在
                            tips('很遗憾，该用户名已被注册啦','username');
                            name_c = false;
                        }
                    }
                })
            }
        }
    }

    //JS验证密码输入与格式
    function check_pass(obj) {
        var pass = obj.value
        //console.log(pass);
        if(pass == ''){
            tips('密码不可为空','password');
            pass_c = false;
        }else{
            // 格式 用正则表达式
            var  zz = /^[a-zA-Z0-9]{6,20}$/gi;
            var  re = zz.test(pass);
            //console.log(re);
            if(re == false){
                tips('密码格式不正确，请输入6-20位字母、数字和符号的组合','password');
                pass_c = false;
            }else{
                //正确
                tips('密码可用','password',true);
                pass_c = true;
            }
        }
    }

    //JS验证密码确认
    function check_pass2(obj) {
        var pass1 = $('#password').val();
        var pass2 = obj.value;
        //console.log(pass1);
        //console.log(pass2);
        if(pass2 == ''){
            //空
            tips('确认密码也不可为空','password2');
            pass2_c = false;
        }else {
            if(pass1 == pass2){
                //一致
                tips('两次输入的密码一致','password2',true);
                pass2_c = true;
            }else{
                //不一致
                tips('两次输入的密码不一致','password2');
                pass2_c = false;
            }
        }




    }

    //验证码功能
    function check_verify(obj) {
        var verify = obj.value;
        //console.log(verify);
        if(verify == ''){
            //空
            tips('验证码不可为空！','verify_img');
            verify_c = false;
        }else{
            //通过ajax验证
            $.ajax({
                url:'/index.php/Home/User/checkVerify',
                data:{'verify':verify},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    //console.log(msg);
                    if(msg.status === 0){
                        tips('验证码正确！','verify_img',true);
                        verify_c = true;
                    }else{
                        tips('验证码错误！','verify_img');
                        verify_c = false;
                    }
                }
            })
        }

    }

    //发送手机验证码功能
    function send_telverify(obj) {
        //获取手机号码
        var tel = $('[name=user_tel]').val();

        //layer.msg('测试');
        $.ajax({
            url:'/index.php/Home/User/sendCont',
            data:{'tel':tel},
            dataType:'json',
            type:'post',
            success:function (msg) {
                //console.log(msg);
                if(msg.status === 0){
                    layer.msg('成功');
                    tips('短信发送成功！','s_verify',true);
                }else{
                    tips('短信发送失败！','s_verify');
                }
            }
        });
    }

    //验证手机验证码功能
    function check_telverify(obj) {
        layer.msg('测试！');
        var telcode = obj.value;
        //console.log(verify);
        if(telcode == ''){
            //空
            tips('验证码不可为空！','verify_img');
            telverify_c = false;
        }else{
            //通过ajax验证
            $.ajax({
                url:'/index.php/Home/User/checkTelVerify',
                data:{'telcode':telcode},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status === 0){
                        tips(msg.tips,'telverify',true);
                        telverify_c = true;
                    }else{
                        tips(msg.tips,'telverify');
                        telverify_c = false;
                    }
                }
            })
        }

    }

    //注册提交功能
    function f_submit(obj) {
        //console.log(name_c);
        if( name_c === true && pass_c === true && pass2_c === true && verify_c === true){
            //layer.msg('通过全部验证！')

            //收集表单数据与服务器交互
            var data = $('#regist_form').serialize();
            //console.log(data);

            $.ajax({
                url:'/index.php/Home/User/regist',
                data:data,
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status == 0){
                        //成功
                        layer.msg(msg.tips);
                        //跳转到登录页
                        window.location.href="/index.php/Home/User/login"
                    }else {
                        //失败
                        layer.msg(msg.tips);
                    }
                }
            })

        }else {
            layer.msg('请你认真完成全部选项')
        }
    }


</script>

<!-- 主体部分end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="<?php echo C('IMG_URL');?>xin.png" alt="" /></a>
        <a href=""><img src="<?php echo C('IMG_URL');?>kexin.jpg" alt="" /></a>
        <a href=""><img src="<?php echo C('IMG_URL');?>police.jpg" alt="" /></a>
        <a href=""><img src="<?php echo C('IMG_URL');?>beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->

</body>
</html>