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
<script type="text/javascript" src="../js/admin.fun.js"></script>
</head>
<body style="background-image: none; background-color: #ffffff">
<form method="post" id="submit_form"
	action="<?php echo(RELATIVITY_PATH)?>sub/ucenter/include/bn_submit.svr.php?function=AdminResetPassword"
	enctype="multipart/form-data" target="ajax_submit_frame_dialog"
	onsubmit="this.submit();parent.parent.parent.Common_OpenLoading()"
	style="width: 100%">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="dialog_title" style="font-family: 微软雅黑;">重置内部用户密码</td>
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
			<td class="TableData" nowrap="nowrap" width="80">&nbsp;&nbsp;新密码</td>
			<td class="TableData"><input id="Vcl_Password" name="Vcl_Password"
				size="20" maxlength="30" style="height:18px" class="BigInput" value="" type="password" /> <span class="red">*</span></td>
		</tr>
		<tr>
			<td class="TableData" nowrap="nowrap" width="80">&nbsp;&nbsp;确认密码</td>
			<td class="TableData"><input id="Vcl_Password2" name="Vcl_Password2"
				size="20" maxlength="30" style="height:18px" class="BigInput" value="" type="password" /> <span class="red">*</span></td>
		</tr>
	</tbody>
</table>
<div class="list">
<div class="page dialog">
<div class="subButton2" onclick="parent.Common_CloseDialog()">取消</div>
<div class="subButton"
	onclick="AdminResetPasswordSubmit()">确定</div>
</div>
</div>
<input type="hidden" name="Vcl_Uid" value="<?php echo($_GET['uid'])?>"/> 
</form>
<iframe id="ajax_submit_frame_dialog" name="ajax_submit_frame_dialog" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>