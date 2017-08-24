<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class TypeController extends AdminController {

    //类型展示
    function showlist(){
        $info = D('Type')->select();

        $this->assign('info',$info);


        $this->display();
    }

    //类型添加
    function tianjia(){
        $type = D('Type');
        if(IS_AJAX && IS_POST){
            //接受新增类型入库
            $type_name = I('post.type_name');
            if($type->add(array('type_name'=>$type_name))){
                //成功
                // $this->success('新类型添加成功',U('showlist'),2);
                echo json_encode(array('states'=>0,'tip'=>'添加类型成功，即将跳转到列表页'));
            }else{
                echo json_encode(array('states'=>1,'tip'=>'添加类型失败，请重新输入'));
            }
        }else{
            $this->display();
        }
    }

    //类型修改
    function update(){

        $this->display();
    }

    //类型删除
    function deltype(){
        if(IS_AJX && IS_POST){
            $type_id = I('post.type_id');
            //接收数据，删除，返回，一气呵成！
            //其实应该还有一层判断，如果这个类型下面还有属性的话不可以删除
            $f = D('Attribute')->where(array('type_id'=>$type_id))->find();
            if($f){
                //还有属性，不能删
                echo json_encode(array('states'=>2,'tip'=>'还有子属性，不可删除'));
            }else{
                //没有子属性就不客气了
                $d = D('Type')->delete($type_id);
                if($d){
                    echo json_encode(array('states'=>0,'tip'=>'删除成功'));
                }else{
                    echo json_encode(array('states'=>1,'tip'=>'删除失败'));
                }
            }
        }
    }

}

