<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class RoleController extends AdminController {

    //角色列表展示
    function  showlist(){
        //获得角色列表信息
        $info = D('Role')->select();
        $this->assign('info',$info);

        $this->display();
    }

    //权限分配
    function distribute(){
        $role = D('Role');
        if(IS_AJAX && IS_POST){
            $role_id = session('role_id');
            //判断form表单的role_id隐藏域信息有没有被篡改
            if($role_id != I('post.role_id')){
                //$this->error('参数错误，请联系管理员',U('showlist'),2);
                echo json_encode(array('states'=>1,'tip'=>'参数错误，请联系管理员'));
            }

            //收集表单信息入库
            $z = $role->saveAuth(I('post.role_id'),I('post.auth_id'));  //给角色更新权限

            if($z){
                session('role_id',null);
                //$this->success('权限分配成功',U('showlist'),2);
                echo json_encode(array('states'=>0,'tip'=>'权限分配成功！即将跳转到列表页面'));
            }else{
                //$this->error('权限分配失败',U('distribute',array('role_id'=>$_POST['role_id'])),2);
                echo json_encode(array('states'=>1,'tip'=>'权限分配失败！请重新输入'));
            }

        }else{
            //获得role_id并获得该角色的详细信息
            $role_id = I('get.role_id');
            $roleinfo = D('Role')->find($role_id);
            $this->assign('roleinfo',$roleinfo);

            //把被分配权限角色的role_id存入session
            session('role_id',$role_id);

            //把可用于分配的所有权限信息获取并展示
            //分别获取父子权限
//            $authinfoA = D('Auth')->where(array('auth_level'=>'0'))->select();
//            $authinfoB = D('Auth')->where(array('auth_level'=>'1'))->select();
            $authinfo = D('Auth')->select();
            foreach ($authinfo as $k=>$v){
                if($v['auth_pid']==0){
                    $authinfoA[] = $v;
                }else{
                    $authinfoB[] = $v;
                }
            }

            $this->assign('authinfoA',$authinfoA);
            $this->assign('authinfoB',$authinfoB);

            $this->display();
        }


    }

    //添加角色
    function  tianjia(){
        $role = D('Role');
        if(IS_POST){
            $role_name = I('post.role_name');
            $role_id = $role->add(['role_name'=>$role_name]);
            //如果添加成功就会返回一个主键id
            if($role_id){
                //把这个主键id存入session
                session('role_id',$role_id);
                //添加成功，跳转到分配权限页面,通过ajax
                echo json_encode(array('states'=>0,'tip'=>'添加角色成功，即将跳转到分配权限页面','role_id'=>$role_id));
            }else{
                //添加失败，返回本来页面,通过ajax
                echo json_encode(array('states'=>1,'tip'=>'添加角色失败，请重新输入'));
            }
        }else{
            $this->display();
        }
    }

    //角色删除
    function delRole(){
        //获取ID
        $role_id = I('post.role_id');

        $d = D('Role')->delete($role_id);
        if($d){
            echo json_encode(array('states'=>0,'tip'=>'已经被干掉了哟'));
        }else{
            echo json_encode(array('states'=>1,'tip'=>'很可惜，没删掉呢'));
        }
    }
}
