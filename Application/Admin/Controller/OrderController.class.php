<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;

class OrderController extends AdminController {

    //订单列表展示
    function showlist(){
        //获得订单列表信息
        $orderinfo = D('Order')->select();
        $this->assign('orderinfo',$orderinfo);
        //dump($orderinfo);
        //echo '在这停顿！';die;

        $this->display();
    }

    //订单详情展示
    function detail(){
        $order = D('Order');
        //获得订单信息
        $order_id = I('get.order_id');
        $o = $order->getAllById($order_id);

        //dump($o);
        $this->assign('orderinfo',$o['orderinfo']);
        $this->assign('goodsinfo',$o['goodsinfo']);
        $this->assign('paymethods',['0'=>'支付宝','1'=>'微信','2'=>'银行卡']);

        $this->display();

    }


    /*
     * 绑定快递单
     *
     */
    function packageNumber(){
        //接收数据  快递单号和订单号
        $package =  I('post.package_id');
        $order_id = I('post.order_id');
        //取出快递类型
        preg_match_all('/[\x{4e00}-\x{9fa5}a-zA-Z]/u' , $package, $result);
        $packageType = implode('',$result[0]);

        //引入汉字拼音类
        import("ORG.Util.Pinyin");
        $pinyin = new \PinYin();
        $packageTypePinyin = $pinyin->getAllPY($packageType);
        dump($packageTypePinyin);

        //调用借口
        $url='http://www.kuaidi100.com/query?type='.$packageTypePinyin.'&postid='.ltrim($package, $packageType);  //ltrim 移除字符串的指定内容

        //调用curl访问接口获得数据
        $backinfo = curl_link($url);

        dump($backinfo);


    }
}
