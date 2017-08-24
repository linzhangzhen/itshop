<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {

    //用户禁言方法
    function userBlocked(array $data){
        //先判断禁言时间是否为默认值，如果为默认值则是封号处理
        if($data['time'] == 'feng'){
            //封号
            $blockedState = $this->where(['user_id'=>$data['user_id']])->save(['flag'=>2]);
            if($blockedState){
                //封号成功
                echo  json_encode(['status'=>0,'tip'=>'已经封号！']);
            }else{
                echo  json_encode(['status'=>1,'tip'=>'封号失败！']);
            }
        }else{
            //禁言
            $user = D('User')->find($data['user_id']);
            //先判断是否已经被禁言，如果已经被禁言就在原来的基础上+ 否则改成禁言状态然后加上时间戳
            if($user['flag']=='1'){
                //已经被禁言
                $user['blocked_time'] = $user['blocked_time']+(86400*$data['time']);
            }else{
                //非禁言状态,先把状态改成禁言
                $user['blocked_time'] =  time()+(86400*$data['time']);
            }
                //echo  json_encode(['status'=>2,'tip'=>'哦！在这停顿！']);die;
            //然后更新数据表的信息
            $blockedState = $this->where(['user_id'=>$data['user_id']])->save(['flag'=>'1','blocked_time'=>$user['blocked_time']]);

            //最后返回操作信息
            if($blockedState){
                echo  json_encode(['status'=>0,'tip'=>'禁言成功！']);
            }else{
                echo  json_encode(['status'=>1,'tip'=>'禁言失败！']);
            }
        }
    }


    //导出数据方法


}