<?php
namespace Home\Controller;
use Common\Common\oAuth;
use Common\Common\SaeTClientV2;
use Think\Controller;
class UserController extends Controller {

    //登录
    public function login(){
        layout(false);  //不使用默认布局
        //如果传来的数据有回跳地址就将其写在session里
        if($b_url = I('get.backurl')){
            //传过来的是 C_A格式，要转换成C/A格式
            $b_url = str_replace('_','/',$b_url);
            session('back_url',$b_url);
        }

        //Ajax登录
        $user = D('User');
        if(IS_AJAX && IS_POST){
            //接收数据
            $username = I('post.username');
            //dump($username);
            $user->userState($username);

        }else{
            //登录页面
            $this->display();
        }
    }

    //退出登录
    function logout(){
        //清除session 跳转到login
        session(null);
        $this->redirect('User/login');
    }

    //注册
    public function regist(){
        layout(false);  //不使用默认布局

        if(IS_AJAX && IS_POST){
            $data = I('post.');

            D('User')->userRegist($data);

        }else{

            //注册页面
            $this->display();
        }
    }

    //用户名验证功能
    function checkName(){

        if(IS_AJAX && IS_POST){
            //接收数据
            $username = I('post.username');

            //通过正则表达式判断用户名是邮箱还是手机号
            $pretel ='/^1[34578]\d{9}$/';
            $premail ='/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/';
            if(preg_match($premail,$username)){
                //邮箱
                $where = array('user_email'=>$username);
            }else if(preg_match($pretel,$username)){
                //手机号
                $where = array('user_tel'=>$username);
            }else{
                //用户名
                $where = array('username'=>$username);
            }
            $f = D('User')->where($where)->find();
            //返回结果
            if($f){
                //用户名存在
                echo json_encode(array('status'=>0));
            }else{
                //用户不存在
                echo json_encode(array('status'=>1));
            }
        }

    }

    //密码验证
    function checkPwd(){
        $username = I('post.username');
        $pwd = I('post.password');

        $f = D('User')->where(array('username'=>$username))->find();
        $d_salt = $f['salt'];

        $pwd = md5($pwd.$d_salt);

        //返回结果
        if($f['password'] == $pwd){
            echo json_encode(array('status'=>0));
        }else{
            echo json_encode(array('status'=>$pwd));
        }

    }

    //验证码功能
    function verifyImg(){
        $cfg = array(
            'fontSize'  =>  20,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  150,               // 验证码图片宽度
            'length'    =>  1,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );

        $vry = new \Think\Verify($cfg);
        $vry->entry();
    }

    //校验验证码
    function checkVerify(){
        $c = I('post.verify');
        $vry = new\Think\Verify();
        if($vry->check($c)){
            echo json_encode(array('status'=>0));
        }else{
            echo json_encode(array('status'=>1));
        }


    }

    //短信发送
    function sendCont(){
        if(IS_AJAX ){
            //接收数据
            //手机号
            $tel=I('post.tel');

            //验证码
            $data['code'] =  mt_rand(1000,9999);
            //限制时间
            $data['limittime'] = 5;
            //当前时间
            $data['nowtime'] = time();

            //把$data 存入session
            session('data',$data);

            //发送短信
            $s = sendTelSMS($tel,[$data['code'],$data['limittime']]);

            if($s){
                echo json_encode(['status'=>0]);
            }else{
                echo json_encode(['status'=>1]);
            }
        }
    }

    //短信验证
    function checkTelVerify(){

        if(IS_AJAX){
            //获取数据
            $telcode = I('post.telcode');

            //获取session中的$data
            $data = session('data');
            //$data['code']  验证码
            //$data['limittime']  限制时间
            //$data['nowtime']  短信发送时间

            //把时限转换为s单位
            $limittime = $data['limittime']*60;
            $nowtime = time();

            if($nowtime - $data['nowtime'] > $limittime){
                //超时
                echo json_encode(['ststus'=>1,'tips'=>'验证码已经过期！']);
            }elseif ($telcode != $data['code']){
                //验证码不正确
                echo json_encode(['ststus'=>1,'tips'=>'验证码不正确！']);
            }else{
                //正确
                echo json_encode(['ststus'=>0,'tips'=>'验证成功！']);
            }


        }
    }

    //邮箱激活
    function active(){
        //获取user_id和active_code
        $data = I('get.');
        //获取同时拥有这两条属性的字段
        $f = D('User')->find($data);
        //dump($f);
        //如果有就激活成功
        if($f){
            //判断是否超时
            if(time()-$f['regist_time'] > 7200){

                $this->success('账号激活过期',U('regist'));
            }else{

                $data['is_active'] = '激活';
                D("User")->save($data);

                $this->success('账号激活成功',U('login'));
            }
        }else{
            $this->success('账号激活失败',U('regist'));
        }

    }

    //QQ登录
    function qqloginshow(){
        require_once ('./Application/Common/Plugin/qq/API/qqConnectAPI.php');

        //QC在公共区域,（根空间）
        $qc = new \QC();
        $qc->qq_login();
    }

    //qq登录回调处理
    function callback(){

        require_once ('./Application/Common/Plugin/qq/API/qqConnectAPI.php');
        $qc = new \QC();
        $acs = $qc->qq_callback();
        $oid = $qc->get_openid();
        $qc = new \QC($acs,$oid);
        $uinfo = $qc->get_user_info();

        //QQ登录用户信息持久化
        D('User')->qquserState($oid,$uinfo);

        $this->success('登录成功，即将跳转到首页',U('/'));
        echo  <<<EOF
<script type="text/javascript">
window.opener.location.href = "/";
window.close();
</script>
EOF;
    }

    //微博登录
    function weibologinshow(){
        //include(".\Application\Common\Common\oAuth.php");
        //实例化auth类并传递数值
        $oauth = new oAuth(C('WB_AKEY'),C('WB_SKEY'));
        //   $oauth = new \oAuth();
        $code_url =$oauth->getAuthorizeURL(C('SITE').C('WB_CALLBACK_URL'));
        

        //dump($code_url);
        echo  <<<EOF
<script type="text/javascript">
window.location.href="$code_url";
</script>
EOF;
    }




}