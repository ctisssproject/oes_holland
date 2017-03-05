<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../../netdisk/css/common.css" rel="stylesheet"
	type="text/css" />
<link href="../../netdisk/css/style2.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/list.css" />
<script type="text/javascript" src="../js/student.fun.js"></script>
</head>
<body style="background-image: none; background-color: #ffffff">
<form method="post" id="submit_form"
	action="<?php echo(RELATIVITY_PATH)?>sub/ucenter/include/bn_submit.svr.php?function=StudentSendMail"
	enctype="multipart/form-data" target="ajax_submit_frame_dialog"
	onsubmit="this.submit();parent.parent.parent.Common_OpenLoading()"
	style="width: 100%">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="dialog_title" style="font-family: 微软雅黑;">群发邮件</td>
		<td style="width: 35px">
		<div onmouseover="this.className='dialog_closebutton_over'"
			class="dialog_closebutton" onclick="parent.Common_CloseDialog()"
			onmouseout="this.className='dialog_closebutton'"></div>
		</td>
	</tr>
</table>
<table class="TableBlock" style="width: 100%; margin-top: 15px;">
	<tbody>
		<tr>
			<td class="TableData" nowrap="nowrap" width="60">&nbsp;&nbsp;标题：</td>
			<td class="TableData"><input id="Vcl_Title" name="Vcl_Title"
				size="40" maxlength="30" style="height:18px" class="BigInput" value="" type="text" /> <span class="red">*</span></td>
		</tr>
		<tr>
			<td class="TableData" nowrap="nowrap" width="60">&nbsp;&nbsp;正文：</td>
			<td class="TableData"><textarea id="Vcl_Content" class="BigInput" name="Vcl_Content" cols="50" rows="8"></textarea> <span class="red">*</span></td>
		</tr>
	</tbody>
</table>
<div class="list">
<div class="page dialog">
<div class="subButton2" onclick="parent.Common_CloseDialog()">取消</div>
<div class="subButton"
	onclick="studentSendMailSubmit()">确定</div>
</div>
</div>
<input type="hidden" name="Vcl_Type" value="<?php echo($_GET['type'])?>"/> 
<input type="hidden" name="Vcl_Sleep" value="<?php echo($_GET['sleep'])?>"/> 
</form>
<iframe id="ajax_submit_frame_dialog" name="ajax_submit_frame_dialog" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>