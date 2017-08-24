<?php
namespace Admin\Common;
use Think\Controller;

class AdminController extends  Controller{
    //构造方法
    function __construct(){
        parent::__construct();  //避免覆盖父类构造方法，先将其执行

        //控制管理员越权访问
        $admin_id  = session('admin_id');
        $admin_name = session('admin_name');

        //当前访问的控制器-操作方法
        //MODULE_NAME  分组名
        //CONTROLLER_NAME  控制器名
        //ACTION_NAME  方法名
        $nowAC = CONTROLLER_NAME.'-'.ACTION_NAME;    //Goods-showlist;

        //判断用户是否登录系统
        if(empty($admin_name)){
            //没有登录系统
            $allow_auth = "Manager-login,Manager-verifyImg,Manager-logout,Manager-checkVerify"; //没有登录也可以访问的页面

            //如果用户访问非法权限,就跳转到登录
            if(strpos($allow_auth,$nowAC)===false){
                //redirect只会在右侧窗口出现网页，所以这里用定界符来做
                $js = <<<eof
<script type="text/javascript">
window.top.location.href="/index.php/Admin/Manager/login";
</script>
eof;
                echo  $js;
            }

        }else{
            //获得当前管理员角色的权限信息 sp_manager 与 sp_role表
            $roleinfo = D('Manager')
                ->alias('m')
                ->join('__ROLE__ as r on m.role_id=r.role_id')
                ->field('r.role_auth_ac')
                ->where(array('m.mg_id'=>$admin_id))
                ->find();
            //当前登录管理员拥有的权限
            $have_auth = $roleinfo['role_auth_ac'];

            //系统默认允许访问的权限（无需分配）
            $allow_auth = 'Manager-login,Manager-logout,Manager-verifyImg,Index-top,Index-left,Index-center,Index-down,Index-right,Index-index';

            /*
            * ① 判断当前访问的权限 是否在拥有的权限里边存在
           ② 判断当前访问的权限 是否是默认允许访问的
           ③ 判断当前用户 是否是系统管理员admin
           如果123都为否即为越权访问
           */
            //strpos($s1,$s2) 判断$s2字符串内容在$s1内从左开始第几个位置有出现,返回位置下标,从0开始
            //如果没有出现就返回false
            if(strpos($have_auth,$nowAC)===false &&
                strpos($allow_auth,$nowAC)===false &&
                $admin_name!=='admin'){
                die('无权访问！');
            }
        }



    }
}
