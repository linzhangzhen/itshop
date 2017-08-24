<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class MemberController extends AdminController {

    //列表展示
    function showlist(){
        //获取数据 展示
        $info = D('MemberLevel')->select();

        $this->assign('info',$info);

        $this->display();

    }

    //会员添加
    function tianjia(){

        if(IS_AJAX && IS_POST){
            //接收传值
            $data = I('post.');

            $a = D('MemberLevel')->add($data);

            if($a){
                //成功
                echo json_encode(['status'=>0]);
            }else{
                //失败
                echo  json_encode(['status'=>1,'tips'=>'添加失败！']);
            }

        }else{
            $this->display();
        }
    }

    //会员级别修改
    function updlevel(){

        if(IS_AJAX && IS_POST){
            //接收传值
            $data = I('post.');
            $s = D('MemberLevel')->save($data);
            //dump($s);die;
            if($s){
                //成功
                echo  json_encode(['status'=>0,'tips'=>'修改成功']);
            }else{
                //失败
                echo  json_encode(['status'=>1,'tips'=>'修改失败']);
            }

        }else{
            //接收ID并展示
            $id = I('get.id');
            $info = D('MemberLevel')->find($id);
            $this->assign('info',$info);

            $this->display();
        }
    }


}
