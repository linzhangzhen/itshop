<?php
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

//var_dump($data);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>前台展示</title>
</head>
<body>
<h2>前台数据展示</h2>
<table>
    <tr>
        <td>商品ID</td>
        <td>名称</td>
        <td>价格</td>
        <td>数量</td>
        <td>操作</td>
    </tr>
    <?php
    //遍历$data结果集并且输出
    foreach ($data as $k=>$v){
     echo '<tr>';
     echo  '<td>'.$v['goods_id'].'</td>';
     echo  '<td>'.$v['goods_name'].'</td>';
     echo  '<td>'.$v['goods_price'].'</td>';
     echo  '<td>'.$v['goods_number'].'</td>';
     echo  '<td><a href="http://web.itshop.com/jingtai/goods/'.$v['goods_id'].'_show.html" target="_blank">查看静态页</a></td>';
     echo '</tr>';
    }
    ?>
</table>
</body>
</html>