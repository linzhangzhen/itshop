<?php

namespace  Home\Controller;
use Think\Controller;
use Common\Common\oAuth;
use Common\Common\saeTCLientV2;

//订单控制器
class  APIController extends Controller{

    //curl连借口
    function  gettianqi(){
        //$url = 'http://api.map.baidu.com/telematics/v3/weather?location=成都&output=json&ak=5slgyqGDENN7Sy7pw29IUvrZ';  //APP已被禁用
        $url = 'http://php.weather.sina.com.cn/iframe/index/w_cl.php?code=js&day=0&city=&dfc=1&charset=utf-8';  //有效
        //$url = 'http://ditu.amap.com/service/regeo?longitude=121.04925573429551&latitude=31.315590522490712';
        //$url = 'http://dict.qq.com/dict?q=词语';

        $ret = curl_link($url);

        $arr = json_decode($ret,true);


        dump($ret);
    }




    //微博连接回调
    function weiboCallback(){

        $o = new oAuth(C('WB_AKEY'),C('WB_SKEY'));
        //dump($_REQUEST);

        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] =  C('WB_CALLBACK_URL');
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;
            } catch (OAuthException $e) {
            }
        }

        if ($token) {
            $_SESSION['token'] = $token;
            setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
            $c = new saeTCLientV2(C('WB_AKEY'),C('WB_SKEY'),$token['access_token']);
            $ms  = $c->home_timeline(); // done
            $uid_get = $c->get_uid();
            $uid = $uid_get['uid'];
            $user_info = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

            //调用微博登录方法
            D('User')->weiboState($user_info);

            //dump($ms);
            dump($user_info);

            $this->success('成功','/');
        } else {
            $this->error('失败','/');
        }
    }
}
