<?php
//生成一个静态文件

$name = '九';
$age = 25;
$sex = '男';
$shenfen = '主角';
ob_start();  //开启php缓存
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>角色资料</title>
</head>
<body>
<h2>角色资料</h2>
<p>名：<?php echo $name; ?></p>
<p>年龄：<?php echo $age; ?></p>
<p>性别：<?php echo $sex; ?></p>
<p>身份：<?php echo $shenfen; ?></p>
</body>
</html>
<?php
$info = ob_get_contents();
file_put_contents('./demo01.html',$info);
?>