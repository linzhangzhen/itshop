<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理工作平台</title>
</head>
<script src="<?php echo C('AD_LY_URL');?>layer.js"></script>

<frameset rows="127,*,11" frameborder="no" border="0" framespacing="0">
	<frame src="<?php echo U('top');?>" name="topFrame" scrolling="No"
		noresize="noresize" id="topFrame" />
	<frame src="<?php echo U('center');?>" name="mainFrame" id="mainFrame" />
	<frame src="<?php echo U('down');?>" name="bottomFrame" scrolling="No"
		noresize="noresize" id="bottomFrame" />
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>