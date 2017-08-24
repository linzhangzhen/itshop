<?php
return array(
    //'配置项'=>'配置值'

    //设置页面底部跟踪日志
    'SHOW_PAGE_TRACE' => true,

    //设置模块组，只有这其中的才会被判断
    'MODULE_ALLOW_LIST'=> array('Home','Admin','Public','Wechat'),
    'DEFAULT_MODULE'   => 'Home',


    //对模板中访问的静态资源文件’路径‘进行配置
    //前台
    'CSS_URL'  => '/Public/Home/style/',
    'JS_URL'  => '/Public/Home/js/',
    'IMG_URL'  => '/Public/Home/images/',
    //后台
    'AD_CSS_URL'  => '/Public/Admin/css/',
    'AD_JS_URL'  => '/Public/Admin/js/',
    'AD_IMG_URL'  => '/Public/Admin/images/',
    'AD_LY_URL' => '/Public/Admin/layer/',

    //为引入Plugin插件静态文件设置访问目录
    'PLUGIN_URL' => '/Application/Common/Plugin/',

    //微博配置
    'WB_AKEY' =>'169234025',
    'WB_SKEY'  =>  '972eebbdf1dad073a7e4d2ecf1b1cc12',
    'WB_CALLBACK_URL' => 'http://web.itshop.com/index.php/Home/API/weiboCallback',


    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'itshop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀

    //'REDIS_HOST'=>'192.168.160.129',

);