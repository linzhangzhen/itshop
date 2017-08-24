<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model {

        //给角色更新权限
    function saveAuth($role_id,$auth_id){
    //维护role_auth_ids信息
        $auth_ids =  implode(',',$auth_id);  //array->string

        //维护role_auth_ac信息
        //根据auth_ids查询对应的权限信息，以便获得权限里的‘控制器’和‘操作方法’
        $authinfo = D('Auth')->where(array(
                'auth_level'=>array('gt','0'),
                'auth_id'=>array('in',$auth_ids)
                ))->select();

        $s = array();
        foreach ($authinfo as $k=>$v){
            $s[] = $v['auth_c'].'-'.$v['auth_a'];
        }
        $ac = implode(',',$s);  //array->string

        $arr = array(
            'role_id'=>$role_id,
            'role_auth_ids'=>$auth_ids,
            'role_auth_ac'=>$ac
        );

        return $this->save($arr);

    }
}