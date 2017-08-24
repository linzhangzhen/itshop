<?php
//获得全部的商品信息，给每个商品制作一个静态页面

//连接数据库，获得数据
//PHP7.0要用pdo连接数据库

$dbms = 'mysql';
$user = 'root';
$pass = 'root';
$dbname = 'itshop';
$dsn = "$dbms:host=localhost;dbname=$dbname";

$pdo = new PDO($dsn,$user,$pass);

$sql = "select * from sp_goods  order by goods_id desc";
$ret = $pdo->query($sql);

$data=$ret->fetchAll(PDO::FETCH_ASSOC);


//静态化制作
foreach ($data as $k=>$v){
    //拼装图片地址
    $pic = substr($v['goods_small_logo'],1);  //去除路径前面的点  '.'
    $pic = "http://web.itshop.com".$pic;  //完整的路径吗

    ob_start();

    echo <<<EOF
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>静态化展示</title>
</head>
<body>
<h2>静态化页面</h2>
<table>
    <tr>
        <td>商品ID:{$v['goods_id']}</td>
</tr>
        <tr>
        <td>名称:{$v['goods_name']}</td>
        </tr>
        <tr>
        <td>价格:{$v['goods_price']}</td>
        </tr>
        <tr>
        <td>数量:{$v['goods_number']}</td>
        </tr>
        <tr>
        <td>图片:<img src="{$pic}"/></td>
        </tr>
        <tr>
        <td>详情:{$v['goods_introduce']}</td>
    </tr>
</table>
</body>
</html>
EOF;

    //收集php缓冲区信息制作静态页面
    $cont =ob_get_clean();  //收集然后清空关闭缓存区

    file_put_contents('./goods/'.$v['goods_id'].'_show.html',$cont);;
}

echo '制作静态页成功';