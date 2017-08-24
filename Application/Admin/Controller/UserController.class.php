<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

//用户操作表
class UserController extends AdminController {

    //用户列表
    function showlist(){

        $userinfo = D('User')->select();
        //遍历userinfo 把状态值换成对应的状态
        foreach ($userinfo as  $k => $v){
            if($v['flag'] == '0'){
                $userinfo[$k]['flag'] = '正常';
            }else if($v['flag'] == '1'){
                $userinfo[$k]['flag'] = '禁言';
            }else if($v['flag'] == '2'){
                $userinfo[$k]['flag'] = '封号';
            }else{
                $userinfo[$k]['flag'] = '删号';
            }
        }
        //dump($userinfo);
        $this->assign('userinfo',$userinfo);

        $this->display();
    }

    //用户禁言操作
    function blocked(){

        //操作Model类中的禁言方法
        $userBlockState = D('User')->userBlocked(I('post.'));

    }



    /**
     * 导出用户
     * author Fox
     */
    public function  exportUser(){
        $userData = D('user')->select();
//        var_dump($userData);exit();
        $this->export_execl($userData);
    }
    /**
     * 导出类
     * author Fox
     */
    public function export_execl($data){
        try{

            //设置php运行时间
            set_time_limit(0);
            /**
             * 大数据导出①
             * 设置php可使用内存
             * ini_set("memory_limit", "1024M");
             */

            Vendor('PHPExcel.PHPExcel');
            Vendor('PHPExcel.PHPExcel.Writer.Excel2007');
            $objExcel  = new \PHPExcel();
            $objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
            $objProps  = $objExcel->getProperties();
            $objProps->setCreator("tpshop");
            $objProps->setTitle("tpshop用户表");
            $objExcel->setActiveSheetIndex(0);
            $objActSheet = $objExcel->getActiveSheet();
            $objActSheet->getColumnDimension('A')->setWidth(20);
            $objActSheet->getColumnDimension('B')->setWidth(20);
            $objActSheet->getColumnDimension('C')->setWidth(20);
            $objActSheet->getColumnDimension('D')->setWidth(20);
            $objActSheet->getColumnDimension('E')->setWidth(20);
            $objActSheet->getColumnDimension('F')->setWidth(20);
            $objActSheet->setCellValue('A1', '用户ID');
            $objActSheet->setCellValue('B1', '用户名');
            $objActSheet->setCellValue('C1', '邮箱');
            $objActSheet->setCellValue('D1', '性别');
            $objActSheet->setCellValue('E1', 'QQ');
            $objActSheet->setCellValue('F1', '手机号');
            foreach ($data as $key => $value) {
                $i = $key + 2;
                $objActSheet->setCellValue('A' . $i, $value['user_id']);
                $objActSheet->setCellValue('B' . $i, $value['username']);
                $objActSheet->setCellValue('C' . $i, $value['user_email']);
                $objActSheet->setCellValue('D' . $i, $value['user_sex'] == '1' ? '男' : '女');
                $objActSheet->setCellValue('E' . $i, $value['user_qq']);
                $objActSheet->setCellValue('F' . $i, $value['user_tel']);
            }
            $dir = './Public/Execl/';
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $fileName = $dir . date("Y-m", time()) . '_tpshopUser.xlsx';
            $objWriter->save($fileName);
            exit(json_encode(['status' => 0, 'tip' => '导出成功']));
        } catch (Exception $e) {
            exit(json_encode(['status' => 0, 'tip' => $e->getMessage()]));
        }
    }

    /**
     * 大数据导出
     * @param $data
     * author Fox
     */
    public  function export_execl2($data){
        header("Pragma:public");
        header("Expires:0");
        header("Content-Type: text/csv");
        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Disposition:attachment; filename =表格名称_".date('Ymd h:i:s').".xls");
        header("Content-Transfer-Encoding:binary");
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');
        // 输出Excel列名信息
        foreach($date[0] as $key=>$value){
            $head[] = iconv('utf-8', 'gbk', $key);//头信息
        }
        // 将数据通过fputcsv写到文件句柄
        //fputcsv($fp, $head);
        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;
        // 逐行取出数据，不浪费内存
        $count = count($data);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            foreach ($data[$t] as $i => $v) {
                if($i == 'add_time') {
                    $row[$i] = iconv('utf-8', 'gbk', date('Y-m-d H:i:s',$v));
                }else{
                    $row[$i] = iconv('utf-8', 'gbk', $v);
                }
            }
            fputcsv($fp, $row);
            unset($row);
        }
    }


}

