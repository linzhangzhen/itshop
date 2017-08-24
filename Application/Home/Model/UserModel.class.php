<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {

    //登录时判断用户状态
    function userState($username){
        $f = $this->where(['username'=>$username])->find();
        //不用判断用户名是否存在，因为前面已经用ajax验证过了
        //dump($f);die;

        //先判断是否激活
        if($f['is_active'] == '未激活') {
            //未激活
            echo json_encode(array('status' => 903, 'tips' => '此用户还未激活'));
        }else {

            //然后判断是否有被封号禁言
            if ($f['flag'] == 0) {

                $this->normal_login($f);

            } else if ($f['flag'] == 1) {
                //禁言
                //已经被禁言就找出角色被禁言的时间
                $time = $f['blocked_time'];
                //判断禁言是否到期
                if ($time < time()) {
                    //禁言已到期
                    //调用正常登录的方法
                    $this->normal_login($f);
                } else {
                    //禁言未到期
                    $b_time = date('Y-m-d H:i:s', $time);
                    echo json_encode(array('status' => 901, 'tips' => '您已经进小黑屋啦', 'time' => $b_time));
                }
            } else if ($f['flag'] == 2) {
                //封号
                echo json_encode(array('status' => 902, 'tips' => '您已经被封号啦'));
            } else {
                //删号
                echo json_encode(array('status' => 903, 'tips' => '此用户已经被删号处理'));
            }
        }
    }

    //注册
    function userRegist($data){

        //增加盐值属性
        $data['salt'] = strpos(md5(time()),8,16);
        $data['password'] = md5($data['password'].$data['salt']);
        $data['regist_time'] = time();

        $a = $this->add($data);

        //发送邮件
        if($a){
            $email = $data['email'];
            $e = $this->sendEmail($email,$a);
            //dump($a);

            if($e){
                //把存储的短信session信息清空
                session('data',null);
                echo  json_encode(array('status'=>0,'tips'=>'注册成功,激活邮件已经发送到邮箱'));
            }else{
                echo  json_encode(array('status'=>1,'tips'=>'注册失败,激活邮件发送失败'));
            }
        }else{
            echo  json_encode(array('status'=>1,'tips'=>'服务器繁忙，请稍后再试'));
        }

    }

    //正常用户登录
    function normal_login($f){
        //正常状态  那就可以登录了
        //持久化用户信息  把用户名和id写入session
        session('user_name',$f['username']);
        session('user_id',$f['user_id']);

        //判断是否有回跳地址
        $back_url = session('back_url');

        if(!empty($back_url)){
            session('back_url',null);
            echo  json_encode(array('status'=>904,'tips'=>'登录成功，即将跳转到登录前页面','url'=>$back_url));
        }else{
            echo  json_encode(array('status'=>900,'tips'=>'登录成功，即将跳转到首页'));
        }
    }


    //给新会员发送激活邮箱
    function sendEmail($email,$user_id){
        $emailaddr = $email;

        //制作激活码
        $activecode = substr(md5($emailaddr.time()),-15);
        //把信息存入数据库
        $this->save(['active_code'=>$activecode,'user_email'=>$email,'user_id'=>$user_id]);
        //邮件内容
        $url = "http://web.itshop.com/index.php/Home/User/active/user_id/".$user_id."/active_code/".$activecode;
        $cont = "<p>请点击以下超链接激活账号</p>";
        $cont .= "<p><a href='".$url."'>".$url."</a></p>";

        $a =  sendMail('激活账号邮件',$cont,$emailaddr);

        return $a;

    }

    //QQ会员信息持久化
    function qquserState($openid,$qqinfo){
        $havelogin = $this->where(['openid'=>$openid])->find();
        if($havelogin){
            //登录过。
            //更新数据库用户信息
            $data['username'] = $qqinfo['nickname'];
            $data['last_time'] = time();
            $c = $this->where(['user_id'=>$havelogin['user_id']])->save($data);

            session('user_name',$data['user_name']);
            session('user_id',$havelogin['user_id']);

        }else{
            //没有登录过
            //新增用户信息
            $data['username'] = $qqinfo['nickname'];
            $data['is_active'] = '激活';
            $data['openid'] = $openid;
            $data['last_time'] = time();
            $data['regist_time'] = time();

            $newid = $this->add($data);
            if($newid){
                //持久化信息
                session('user_name',$data['username']);
                session('user_id',$newid);
            }
        }
    }

   /*
    * 微博登录信息持久化
    * @param $weiboinfo 微博信息
    */
    function weiboState($info){
        $havelogin = $this->where(['wb_id'=>$info['id']])->find();
        if($havelogin){
            //登录过。
            //更新数据库用户信息
            $data['username'] = $info['name'];
            $data['last_time'] = time();
            $c = $this->where(['user_id'=>$havelogin['user_id']])->save($data);

            session('user_name',$data['user_name']);
            session('user_id',$havelogin['user_id']);

        }else{
            //没有登录过
            //新增用户信息
            $data['username'] = $info['name'];
            $data['is_active'] = '激活';
            $data['wb_id'] = $info['id'];
            $data['last_time'] = time();
            $data['regist_time'] = time();

            $newid = $this->add($data);
            if($newid){
                //持久化信息
                session('user_name',$data['username']);
                session('user_id',$newid);
            }
        }
    }
}