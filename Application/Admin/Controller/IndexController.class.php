<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;
class IndexController extends AdminController {

    //主页
    public function index(){
        //展示首页面
        $this->display();
    }

    //我来组成头部
    public function top(){
        //当前请求屏蔽跟踪日志
        C('SHOW_PAGE_TRACE',false);
        //展示头部页面
        $this->display();
    }

    //我来组成躯干
    public function center(){
        //当前请求屏蔽跟踪日志
        C('SHOW_PAGE_TRACE',false);
        //展示主要面
        $this->display();
    }

    //我来组成左手--菜单栏
    //获得管理员权限列表
    public function left(){
        //当前请求屏蔽跟踪日志
        C('SHOW_PAGE_TRACE',false);

        //获得当前管理员的session会话信息
        $admin_id = session('admin_id');
        $admin_name = session('admin_name');

        if($admin_name !== 'admin'){
            //普通管理员
            //sp_manager和sp_role做联表查询，获得sp_role表中的role_auth_ids信息

            //这里不用初始化，初始化在父类的构造函数中
            //这里用memcache缓存来获取权限列表
            //判断memcache是否有缓存
            //先看看权限是否已经被更改过
            if(S('auth_change')=='yes'){
                //权限已经更新了
                $auth_change = 'yes';
            }
            //******BUG:缓存里应该根据不同管理员存储不同的数据
            if(!S('auth_info') || $auth_change){
                echo 'byMysql';
                //如果没有就去数据库获取
                $roleinfo = D('Manager')
                    ->alias('m')
                    ->where(array('m.mg_id'=>$admin_id))
                    ->join('__ROLE__ as r on m.role_id=r.role_id')
                    ->field('r.role_auth_ids')
                    ->find();
                $authids = $roleinfo['role_auth_ids'];
                //获得auth权限信息
                $authinfo = D('Auth')->where(array('auth_id'=>array('in',$authids)))->select();

                //然后放到缓存里
                S('auth_info',$authinfo);
            }else{
                echo 'byMemcache';
                //如果有了就取出来直接用
                $authinfo = S('auth_info');
            }

            //dump($authinfo);

            foreach ($authinfo as $k=>$v){
                if($v['auth_pid'] == 0){
                    $authinfoA[] = $v;
                }else{
                    $authinfoB[] = $v;
                }
            }

        }else{
            //超级管理员
            $authinfo = D('Auth')->select();

            foreach ($authinfo as $k=>$v){
                if($v['auth_pid'] == 0){
                    $authinfoA[] = $v;
                }else{
                    $authinfoB[] = $v;
                }
            }
        }

        $this->assign('authinfoA',$authinfoA);
        $this->assign('authinfoB',$authinfoB);
        //展示左侧页面
        $this->display();
    }

    //我来组成右手
    public function right(){
        //获取当前登录角色的信息
        $mana_name = session('admin_name');
        $mana_id = session('admin_id');
        $mainfo = D('Manager')
            ->alias('m')
            ->join('__ROLE__ as r on m.role_id = r.role_id')
            ->where(array('mg_id'=>$mana_id))
            ->find();
        if($mana_name === 'admin'){
            $mainfo['mg_name'] = '超管';
            $mainfo['role_name'] = 'Big Boss';
        }
        $this->assign('mainfo',$mainfo);

        //展示右侧页面
        $this->display();
    }

    //我来组成腿部
    public function down(){
        //当前请求屏蔽跟踪日志
        C('SHOW_PAGE_TRACE',false);
        //展示注脚页面
        $this->display();
    }


}