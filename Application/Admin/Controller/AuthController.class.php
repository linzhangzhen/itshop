<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;
class AuthController extends AdminController {

    //列表展示
    function  showlist(){
        //获得权限列表信息
        $info = D('Auth')->select();
        //对$info 进行递归分类排序处理
        $info = generateTree($info);

        $this->assign('info',$info);
        $this->display();
    }

    //添加权限
    function tianjia(){
        $auth = D('Auth');

        if(IS_POST){
            //收集信息
            //dump($_POST);
            $data = I('post.');

            //对auth_level进行特殊维护处理
            //如果父级字段为0就是最上级权限
            $data['auth_level'] = $data['auth_pid'] == '0' ? '0' : '1';

            if($auth->add($data)){
                //存一个口令，如果权限有被更改，获取权限的事件就再取一次
                S('auth_change','yes');

                $this->success('添加权限成功',U('showlist'),2);
            }else{
                $this->error('添加权限失败',U('tianjia'),2);

            }
        }else{
            //展示表单
            //获得可供选取的上级权限，只获取‘顶级’权限即可
            $authinfo = D('auth')->where(array('auth_pid'=>'0'))->select();
            //dump($authinfo);
            $this->assign('authinfo',$authinfo);

            $this->display();
        }
    }

    function ajaxAdd(){
        //接收数据
        $info = I('get.');
        $z = D('Auth')->add($info);
        if($z){
            echo json_encode(array('states'=>0));
        }else{
            echo json_encode(array('states'=>1,'tip'=>'添加失败了呢，再确认一下吧'));
        }

    }

    //权限修改
    function update(){
        $auth = D('Auth');

    }

    //删除权限
    function delete(){
        $auth = D('Auth');

        if(IS_AJAX && IS_POST){
            //接受auth_id
            $auth_id = I('post.auth_id');
            //需要判断，这个权限是否可以被删除
            //如果为父级并且下属还有子权限，则不可以删除
            $pd = $auth->where(array('auth_pid'=>$auth_id))->find();
            if($pd){
                //这个权限还有子权限，还不可以死
                echo json_encode(array('states'=>1,'tip'=>'还有儿子，死不得'));
            }else{
                $d = $auth->delete($auth_id);
                if($d){
                    //成功
                    echo json_encode(array('states'=>0,'tip'=>'删除成功咯'));
                }else{
                    //失败
                    echo json_encode(array('states'=>1,'tip'=>'命真大，删除失败'));
                }
            }

        }
    }

}