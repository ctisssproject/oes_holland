<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
</head>
<body style="background-image:none">
<div>
	<div align="center" style="font-size:14px;">
		荷兰旅游专家后台服务
	</div>
	<br/>
	<iframe id="holland_remind" name="holland_remind" width="100%" height="40" marginwidth="0" border="0" frameborder="0" src="http://www.hollandtravelexpert.com/sub/service/remind.php">
	</iframe>
	<div id="holland_state">
		等待发送邮件.....
	</div>
	<iframe id="holland_mail" name="holland_mail" width="0" height="0" marginwidth="0" border="0" frameborder="0" src="http://www.hollandtravelexpert.com/sub/service/sendmail.aspx">
	</iframe>
	<br/>
	<a href="javascript:;" onclick="$('#holland_result').html('');" style="color:blue">
		清空状态列表
	</a>
	<br/>
	<br/>
	<div id="holland_result" style="height:200px; width:100%; overflow:scroll;color:red;border:1px solid #000000;"></div>
</div>
<div>
	<div align="center" style="font-size:14px;">
		德国魅力达人后台服务
	</div>
	<br/>
	<iframe id="german_remind" name="german_remind" width="100%" height="40" marginwidth="0" border="0" frameborder="0" src="http://www.germany-travelexperts.com/sub/service/remind.php">
	</iframe>
	<div id="german_state">
		等待发送邮件.....
	</div>
	<iframe id="german_mail" name="german_mail" width="0" height="0" marginwidth="0" border="0" frameborder="0" src="http://www.germany-travelexperts.com/sub/service/sendmail.aspx">
	</iframe>
	<br/>
	<a href="javascript:;" onclick="$('#german_result').html('');" style="color:blue">
		清空状态列表
	</a>
	<br/>
	<br/>
	<div id="german_result" style="height:200px; width:100%; overflow:scroll;color:red;border:1px solid #000000;"></div>
</div>
<iframe id="xwfyfz" style="overflow:hidden" width="100%" height="100" marginwidth="0" border="0" frameborder="0" scrolling="no" src="http://www.xwkjg.com/sub/service/system.php"></iframe>
<script type="text/javascript">
var n_holland_handle1=0
var n_holland_handle2=0
function hollandSendMail()
{
	window.clearInterval(n_holland_handle1);
	window.clearInterval(n_holland_handle2);
	$('#holland_state').html('等待发送邮件.....')
    document.getElementById('holland_mail').src="http://www.hollandtravelexpert.com/sub/service/sendmail.aspx"
    n_holland_handle1=setInterval(hollandSendMail,10000)
	}
function hollandSendMailCallback(str)
{
	window.clearInterval(n_holland_handle1);
	window.clearInterval(n_holland_handle2);
	if(str=='')
	{
		$('#holland_state').html('目前没有可发送的邮件！')
		n_holland_handle2=setInterval(hollandSendMail,2000)
	}else{
		$('#holland_state').html('发送邮件成功！')
		$('#holland_result').html(str+'<br/>'+$('#holland_result').html())
		n_holland_handle2=setInterval(hollandSendMail,2000)
	}
	}
function hollandRemind()
{
	document.getElementById('holland_remind').src="http://www.hollandtravelexpert.com/sub/service/remind.php"
	}
setInterval(hollandRemind,100000)
////////////////////////////////////////////////////////
var n_german_handle1=0
var n_german_handle2=0
function germanSendMail()
{
	window.clearInterval(n_german_handle1);
	window.clearInterval(n_german_handle2);
	$('#german_state').html('等待发送邮件.....')
    document.getElementById('german_mail').src="http://www.germang-travelexperts.com/sub/service/sendmail.aspx"
    n_german_handle1=setInterval(germanSendMail,10000)
	}
function germanSendMailCallback(str)
{
	window.clearInterval(n_german_handle1);
	window.clearInterval(n_german_handle2);
	if(str=='')
	{
		$('#german_state').html('目前没有可发送的邮件！')
		n_german_handle2=setInterval(germanSendMail,2000)
	}else{
		$('#german_state').html('发送邮件成功！')
		$('#german_result').html(str+'<br/>'+$('#german_result').html())
		n_german_handle2=setInterval(germanSendMail,2000)
	}
	}
function germanRemind()
{
	document.getElementById('german_remind').src="http://www.germany-travelexperts.com/sub/service/remind.php"
	}
setInterval(germanRemind,100000)
function xwfyfz()
{
	document.getElementById('xwfyfz').src="http://www.xwkjg.com/sub/service/system.php"
	}
setInterval(xwfyfz,120000)
</script>
</body>
</html>
