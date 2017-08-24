<?php

//对String内容进行防止XSS攻击
function fangXSS($string){
    require_once './Application/Common/Plugin/htmlpurifier/HTMLPurifier.auto.php';  //生成配置对象

    // 导入Vendor类库包 Library/Vendor/htmlpurifier/HTMLPurifier.php
//    import('Vendor.htmlpurifier.HTMLPurifier.php');

    //生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();

    //以下就是配置
    $cfg->set('Core.Encoding','Utf-8');

    //设置允许使用的HTML标签
    $cfg->set('HTML.Allowed','div,b,strong,i,em,a[href|tittle],ul,ol,li,br,span[style],img[width|height|alt|src]');

    //设置允许出现的CSS样式属性
    $cfg->set('CSS.AllowedProperties','font,font-size,font-weight,font=style,font-family,text-decoration,padding-left,color,background-color,text-align');

    //设置a标签上是否允许使用target-'_blank'
    $cfg->set('HTML.TargetBlank',TRUE);

    //使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);

    //过滤字符串
    return $obj->purify($string);

}

//**************递归方式获取上下级权限信息*****************
function generateTree($data){
    $items = array();
    foreach ($data as $v){
        $items[$v['auth_id']] = $v;
    }
    $tree = array();
    foreach ($items as $k=>$item){
        if(isset($items[$item['auth_pid']])){
            $items[$item['auth_pid']]['son'][] = &$items[$k];
        }else{
            $tree[] = &$items[$k];
        }
    }
    return getTreeData($tree);
}

function getTreeData($tree,$level=0){
    static  $arr = array();
    foreach ($tree as $t){
        $tmp = $t;
        unset($tmp['son']);
        $tmp['level'] = $level;
        $arr[] = $tmp;
        if(isset($t['son'])){
            getTreeData($t['son'],$level+1);
        }
    }
    return $arr;
}
//*************递归方式获取上下级权限信息**********//


//发送短信验证码
function sendTelSMS($to,$datas,$tempId='1'){

    // 初始化REST SDK
    global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;

    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8aaf07085d106c7f015d3c6a6722123f';

    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= '7216a90480e644279f03e1504ac65a7a';

    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8aaf07085d106c7f015d3c6a68a51246';

    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='app.cloopen.com';


    //请求端口，生产环境和沙盒环境一致
    $serverPort='8883';

    //REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';

    include_once ('./Application/Common/Plugin/sms/CCPRestSmsSDK.php');


    $rest = new REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    //echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
    if($result == NULL ) {
        //echo "result error!";
        //break;
        return false;
    }
    if($result->statusCode!=0) {
        // echo "error code :" . $result->statusCode . "<br>";
        //echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
        return false;
    }else{
        //echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
        $smsmessage = $result->TemplateSMS;
        //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
        //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        //TODO 添加成功处理逻辑
        return true;
    }



}


//发送邮件
function sendMail($title, $msghtml, $sendAddress) {
    //$title = '你好';
    // $sendAddress = '437299679@qq.com';
    //$msghtml = '我是lzz';
//引入发送类phpmailer.php
    include_once ('./Application/Common/Plugin/mail/class.smtp.php');
    include_once ('./Application/Common/Plugin/mail/class.phpmailer.php');
//实列化对象
    $mail = new PHPMailer();
    /*服务器相关信息*/
    $mail->IsSMTP(); //设置使用SMTP服务器发送
    $mail->SMTPAuth = true; //开启SMTP认证
    $mail->Host = 'smtp.163.com'; //设置 SMTP 服务器,自己注册邮箱服务器地址
    $mail->Username = '13388227234'; //发信人的邮箱用户名
    $mail->Password = '123qq123'; //发信人的邮箱密码
    /*内容信息*/
    $mail->IsHTML(true); //指定邮件内容格式为：html
    $mail->CharSet = "UTF-8"; //编码
    $mail->From = '13388227234@163.com'; //发件人完整的邮箱名称
    $mail->FromName = "php_lzz"; //发信人署名
    $mail->Subject = $title; //信的标题
    $mail->MsgHTML($msghtml); //发信主体内容
// $mail->AddAttachment("fish.jpg");      //附件
    /*发送邮件*/
    $mail->AddAddress($sendAddress); //收件人地址
//使用send函数进行发送
    if ($mail->Send()) {
//发送成功返回真
        return true;
// echo '您的邮件已经发送成功！！！';
    } else {
        return $mail->ErrorInfo; //如果发送失败，则返回错误提示
    }

}

//curl类
function curl_link($url, $https = true, $method = 'get', $data = null) {
    //初始化curl会话
    $ch = curl_init($url);
    //为curl并行处理设置一个选项
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($https === true) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    //执行curl会话
    $str = curl_exec($ch);

    //关闭curl会话
    curl_close($ch);

    return $str;

}