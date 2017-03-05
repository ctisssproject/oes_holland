<?php
define ( 'RELATIVITY_PATH', '../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-登录</title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript">
var n_number=0
var n_holland_handle1=0
var n_holland_handle2=0
function hollandSendmail()
{
	window.clearInterval(n_holland_handle1);
	window.clearInterval(n_holland_handle2);
	$('#holland_state').html('等待发送邮件.....')
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SendMail');
    o_ajax_request.setPage('../../include/it_ajax.svr.php');
    o_ajax_request.SendRequest()    
    n_holland_handle1=setInterval(hollandSendmail,10000)
	}
	
function sendmailCallback(str)
{
	window.clearInterval(n_holland_handle1);
	window.clearInterval(n_holland_handle2);
	if(str==0 ||str=='0')
	{
		$('#holland_state').html('目前没有可发送的邮件！')
		n_holland_handle2=setInterval(hollandSendmail,2000)
	}else{
		n_number=n_number+1
		$('#holland_state').html('发送邮件成功，共成功发送 '+n_number+' 次邮件！')
		$('#holland_result').html(str+$('#holland_result').html())
		n_holland_handle2=setInterval(hollandSendmail,2000)
	}
}
function hollandRemind()
{
	document.getElementById('holland_remind').src="http://www.hollandtravelexpert.com/sub/service/remind.php"
	}
setInterval(hollandRemind,100000)
setTimeout('hollandSendmail()',2000)
</script>
</head>
<body style="background-image:none">

<div align="center" style="font-size:14px;">荷兰旅游专家后台服务</div><br/>
<iframe id="holland_remind" name="holland_remind" width="100%"
	height="40" marginwidth="0" border="0" frameborder="0" src="http://www.hollandtravelexpert.com/sub/service/remind.php"></iframe>
<div id="holland_state">等待发送邮件.....</div><br/>
<a href="javascript:;" onclick="$('#holland_result').html('');" style="color:blue">清空状态列表</a>
<br/>
<br/>
<div id="holland_result" style="height:200px; width:100%; overflow:scroll;color:red;border:1px solid #000000;"></div>
</body>
</html>
