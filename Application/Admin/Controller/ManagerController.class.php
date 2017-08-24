<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class ManagerController extends AdminController {

    //登录
    public function login(){
        if(IS_POST){
            //验证码校验
            $code = I('post.manager_verify');
            if($code !==  session('verify')){
                //输入框的验证码和session中的不一致，返回错误信息
                $this->assign('errorlogin','验证码错误！');
            }else{
                //清空session中的验证码信息
                session('verify',null);
                //验证码通过则校验用户名和密码
                $name = I('post.manager_name');
                $pwd =md5( I('post.manager_pwd'));
                //根据name和pwd去数据库查询对应的管理员信息
                //返回  array  \  null
                $info = D('Manager')->where(array('mg_name'=>$name,'mg_pwd'=>$pwd))->find();
                if($info){
                    //用户名密码正确
                    //把管理员信息写入session
                    //把登录时间写入数据库
                    $login_time['mg_time'] = time();
                    D('Manager')->where(array('mg_name'=>$name))->save($login_time);
                    session('admin_id',$info['mg_id']);
                    session('admin_name',$info['mg_name']);
                    $this->redirect('Index/index');  //跳转到主页
                }else{
                    //用户名/密码错误，返回错误信息
                    $this->assign('errorlogin','用户名密码错误！');
                }

            }
        }

        //登录页面
        $this->display();
    }

    //退出登录
    function logout(){
        session(null);  //清空session

        $this->redirect('Manager/login');//跳转到登录页面
    }

    //校验验证码
    function checkVerify(){
        $c = I('post.verify');
        $vry = new\Think\Verify();
        if($vry->check($c)){
            session('verify',$c);
            echo json_encode(array('states'=>1));
        }else{
            echo json_encode(array('states'=>0));
        }


    }

    //验证码操作
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

    //管理员列表
    function showlist(){

        //要联表操作，因为要获得role表的role_name信息
    $info = D('Manager')
        ->alias('m')
        ->join('__ROLE__ as r on m.role_id=r.role_id')
        ->field('m.*,r.role_name')
    ->select();
    $this->assign('info',$info);

    $this->display();

    }

    //添加管理员
    function tianjia(){
        if(IS_AJAX && IS_POST){
            //接收数据
            if(I('post.role_id') == 0){
                //说明没有选择角色
                echo json_encode(array('states'=>2,'tip'=>'请选择角色'));
            }else{
                $a = D('Manager')->add(I('post.'));
                if($a){
                echo json_encode(array('states'=>0,'tip'=>'添加管理员成功'));
                }else{
                echo json_encode(array('states'=>1,'tip'=>'添加管理员失败'));
                }
            }
        }else{
            //获取角色信息放在下拉框里
            $roleinfo = D('Role')->select();
            $this->assign('roleinfo',$roleinfo);

            $this->display();
        }
    }

    //删除管理员
    function delMg(){
        //获取数据
        $mg_id = I('post.mg_id');
        $d = D('Manager')->delete($mg_id);
        if($d){
            echo json_encode(array('states'=>0,'tip'=>'删除成功'));
        }else{
            echo json_encode(array('states'=>1,'tip'=>'删除失败'));
        }
    }
}