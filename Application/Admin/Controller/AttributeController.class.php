<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class AttributeController extends AdminController {

    //属性列表展示
    function showlist(){
        /*        //获得信息并展示出来
                $att = D('Attribute');
                $info = $att
                    ->alias('a')
                    ->join('__TYPE__ t on a.type_id=t.type_id')
                    ->field('a.*,t.type_name')
                    ->select();

                $this->assign('info',$info);*/

        //获取下拉列表展示的“商品类型”信息
        $typeinfo = D('Type')->select();
        $this->assign('typeinfo',$typeinfo);

        $this->display();
    }

    //属性添加
    function tianjia(){
        $attr = D('Attribute');
        if(IS_AJAX && IS_POST){

            //接受新增类型入库
            //create()方法可以触发自动验证执行，如果返回false则说明验证失败
            $data = $attr->create();
            //$data = I('post.');

            if($data){
                //把可选值的“中文逗号转换为”“英文逗号”
                $data['attr_vals'] = str_replace('，',',',$data['attr_vals']);
                if($attr->add($data)){
                    //成功
                    //$this->success('新属性添加成功',U('showlist'),2);
                    echo json_encode(array('status'=>0,'tip'=>'添加成功'));
                }else{
                    //$this->error('新属性添加失败',U('tianjia'),2);
                    echo json_encode(array('status'=>1,'tip'=>'添加成功'));
                }
            }else{
                //验证出现问题，把错误信息传递给模板显示
                //getError()会把验证的错误信息通过关联数组形式返回
                //array('attr)name'=>'属性名称必须设置','type_id'=>'商品类型必须选取')
                //$this->assign('errorinfo',$attr->getError());
                $error = $attr->getError();
                echo json_encode(array('status'=>2,'tip'=>$error));

                //获取可供选择的商品类型信息
             /*   $typeinfo = D('Type')->select();
                $this->assign('typeinfo',$typeinfo);
                $this->display();*/
            }
        }else{
            //获取可供选择的商品类型信息
            $typeinfo = D('Type')->select();
            $this->assign('typeinfo',$typeinfo);

            $this->display();
        }
    }

    //属性修改
    function update(){

        $this->display();
    }

    //根据type_id值获得属性信息
    function getAttrInfoByType(){
        if(IS_AJAX && IS_POST){
            //接收type_id
            $type_id = I('post.type_id');

            //如果type_id为0就获取全部信息

                if(!empty($type_id)){
                    $where = ['a.type_id'=>$type_id];
                }

                $info = D('Attribute')
                    ->alias('a')
                    ->join('__TYPE__ t on a.type_id=t.type_id')
                    ->field('a.*,t.type_name')
                    ->where($where)
                    ->select();
                echo json_encode($info);

        }
    }

    //属性删除
    function delete(){

        if(IS_AJAX && IS_POST){
            //接收数据
            $attr_id = I('post.attr_id');

            $d = D('Attribute')->delete($attr_id);
            if($d){
                echo json_encode(array('states'=>0,'tip'=>'删除成功'));
            }else{
                echo json_encode(array('states'=>1,'tip'=>'删除失败'));
            }
        }

    }

}

