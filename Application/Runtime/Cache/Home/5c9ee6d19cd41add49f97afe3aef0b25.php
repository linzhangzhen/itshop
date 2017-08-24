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


<!-- 登录主体部分start -->
<div class="login w990 bc mt10">
	<div class="login_hd">
		<h2>用户登录</h2>
		<b></b>
	</div>
	<div class="login_bd">
		<div class="login_form fl">
			<form action="" method="post" id="login_form">
				<ul>
					<li>
						<label for="">用户名：</label>
						<input type="text" class="txt" name="username" id="username" onblur="check_name(this)" />
					</li>
					<li>
						<label for="">密码：</label>
						<input type="password" class="txt" name="password" onblur="check_pass(this)" id="password"/>
						<a href="">忘记密码?</a>
					</li>
					<li><span style="padding-left: 60px;color: red;font-size: 14px;display: none"><?php echo ((isset($errorinfo) && ($errorinfo !== ""))?($errorinfo):''); ?></span></li>
					<li class="checkcode">
						<label for="">验证码：</label>
						<input type="text"  name="checkcode" onblur="check_verify(this)"  style="margin-top: 7px" maxlength="4" />
						<img  onclick="this.src='/index.php/Home/User/verifyImg/'+Math.random()" src="/index.php/Home/User/verifyImg"  id="verify_img"/>
						<p style="color: red" id="error_tips"></p>
					</li>
					<li>
						<label for="">&nbsp;</label>
						<input type="checkbox" class="chb"  /> 保存登录信息
					</li>
					<li>
						<label for="">&nbsp;</label>
						<input type="button" onclick="login_submit(this)" class="login_btn" />
					</li>
				</ul>
			</form>

			<div class="coagent mt15">
				<dl>
					<dt>使用合作网站登录商城：</dt>
					<dd class="qq"><a href="#" onclick="tanqq(this)"><span></span>QQ</a></dd>
					<dd class="weibo"><a href="#" onclick="tanweibo(this)"><span></span>新浪微博</a></dd>
					<dd class="yi"><a href=""><span></span>网易</a></dd>
					<dd class="renren"><a href=""><span></span>人人</a></dd>
					<dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
					<dd class=""><a href=""><span></span>百度</a></dd>
					<dd class="douban"><a href=""><span></span>豆瓣</a></dd>
				</dl>
			</div>
		</div>

		<div class="guide fl">
			<h3>还不是商城用户</h3>
			<p>现在免费注册成为商城用户，便能立刻享受便宜又放心的购物乐趣，心动不如行动，赶紧加入吧!</p>

			<a href="regist.html" class="reg_btn">免费注册 >></a>
		</div>

	</div>
</div>
<!-- 登录主体部分end -->
<script type="text/javascript">
    //声明几个全局变量做判断用
    var name_c = false;
    var pass_c = false;
    var verify_c = false;


	/*
	 方便显示报错信息的方法
	 tip  string  提示信息
	 id  string   ID
	 re  布尔值  结果
	 */
    function tips(tip,id,re=false) {
        var s = '';
        if(re){
            s += '<p style="color: green">'+tip+'</p>';
        }else {
            s = '<p style="color: red">'+tip+'</p>';
        }
        $('#'+id).next().remove();
        $('#'+id).parent().append(s);
    }

    //Ajax用户名验证
    function check_name(obj) {
        //获取用户名
        var username = obj.value;

        //console.log(username)
        //用户名不为空才发动ajax
        if(name = ''){
            tips('用户名不能为空','username');
        }else{
            //通过ajax与服务器交互
            $.ajax({
                url:'/index.php/Home/User/checkName',
                data:{'username':username},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status === 0){
                        //可以注册
                        tips('用户名正确','username',true);
                        name_c = true;
                    }else {
                        //用户名已经存在
                        tips('用户名不存在','username');
                    }
                }

            })
        }

        //每次更换用户名也要调用一次验证密码
		check_pass($('#password'));
    }

    //ajax验证密码
    function check_pass(obj) {
        var username = $('#username').val();
        var pwd = obj.value;
        //console.log(pwd)
        //如果用户名通过验证就可以进行密码验证
        if(name_c){
            //通过ajax与服务器交互
            $.ajax({
                url:'/index.php/Home/User/checkPwd',
                data:{'username':username,'password':pwd},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    //console.log(msg);
                    if(msg.status == 0){
                        //可以注册
                        tips('密码正确','password',true);
                        pass_c = true;
                    }else {
                        //用户名已经存在
                        tips('密码错误','password');
                    }
                }

            })
        }else {}
        tips('请先输入正确的用户名','password');
    }


    //ajax验证码功能
    function check_verify(obj) {
        var verify = obj.value;
        console.log(verify);
        if(verify == ''){
            //空
            tips('验证码不可为空！','verify_img');
        }else{
            //通过ajax验证
            $.ajax({
                url:'/index.php/Home/User/checkVerify',
                data:{'verify':verify},
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status === 0){
                        tips('验证码正确！','verify_img',true);
                        verify_c = true;
                    }else{
                        tips('验证码错误！','verify_img');
                    }
                }
            })
        }
    }

    //提交登录
    function login_submit(obj) {
        //懒得弄了，直接登录吧
        if(name_c && pass_c && verify_c){
            layer.msg('开始验证！');
            var data = $('#login_form').serialize();
            //var uname = $('#username').val();
            console.log(data);
            $.ajax({
                url:'/index.php/Home/User/login',
                data:data,
                type:'post',
                dataType:'json',
                success:function (msg) {
                    console.log(msg);
                    if(msg.status ===904){
                        //904 带回跳地址的登录成功
                        layer.msg(msg.tips);
                        window.location.href = "/index.php/Home/"+msg.url;
                    }else if(msg.status === 903){
                        //903 被删号
                        layer.msg(msg.tips);
                    }else if(msg.status ===902){
                        //902 被封号
                        layer.msg(msg.tips);
                    }else if(msg.status === 901){
                        //901 被禁言
                        //layer.msg(msg.tips);
                        //还要在页面显示出禁言时间
						var b_time =
                        //自定页
                        layer.open({
                            type: 1,
                            skin: 'layui-layer-demo', //样式类名
                            closeBtn: 0, //不显示关闭按钮
                            anim: 2,
                            shadeClose: true, //开启遮罩关闭
                            content: '您已经进小黑屋啦，结束时间：'+msg.time
                        });
                    }else if(msg.status === 900 ){
                        //900 正常登录
                        layer.msg(msg.tips);
                        window.location.href = "/index.php/Home/Index/index";
                    }else{
                        layer.msg('服务器繁忙，登录失败！');
                    }
                }
            })

        }else{
            //小tips
            layer.tips('请完成以上全部选项', obj, {
                tips: [1, '#3595CC'],
                time: 4000
            });
        }
    }

    //QQ弹窗
	function tanqq(obj) {
        //iframe层
        layer.open({
            type: 2,
            title: 'QQ登录',
            shadeClose: true,
            shade: 0.8,
            area: ['500px', '70%'],
            content: "qqloginshow" //iframe的url
        });
    }

    //QQ弹窗
    function tanweibo(obj) {
        //iframe层
        layer.open({
            type: 2,
            title: '微博登录',
            shadeClose: true,
            shade: 0.8,
            area: ['500px', '70%'],
            content: "weibologinshow" //iframe的url
        });
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