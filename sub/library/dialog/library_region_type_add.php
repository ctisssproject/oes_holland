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
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css"
	href="../../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../../ucenter/css/list.css" />
<script type="text/javascript" src="../../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/travel.fun.js"></script>
</head>
<body style="background-image: none; background-color: #ffffff">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="dialog_title" style="font-family: 微软雅黑;">添加类型</td>
		<td style="width: 35px">
		<div onmouseover="this.className='dialog_closebutton_over'"
			class="dialog_closebutton" onclick="parent.Common_CloseDialog()"
			onmouseout="this.className='dialog_closebutton'"></div>
		</td>
	</tr>
</table>
<form method="post" id="submit_form"
	action="<?php echo(RELATIVITY_PATH)?>sub/library/include/bn_submit.svr.php?function=RegionTypeAdd"
	enctype="multipart/form-data" target="ajax_submit_frame_dialog"
	onsubmit="this.submit();parent.parent.parent.Common_OpenLoading()"
	style="width: 100%">
<table class="TableBlock" style="width: 100%; margin-top: 15px;">
	<tbody>
		<tr class="dark">
			<td class="TableData" nowrap="nowrap" width="80">&nbsp;&nbsp;类型名称</td>
			<td class="right_none"><input style="border: 1px solid #D9D9D9;	height:20px;padding-left:5px;padding-right:5px;" id="Vcl_Name" name="Vcl_Name"
					value=""
					type="text" style="width:100px"/></td>
		</tr>
	</tbody>
</table>

<div class="list">
<div class="page dialog">
<div class="subButton2" onclick="parent.Common_CloseDialog()">取消</div>
<div class="subButton" onclick="document.getElementById('submit_form').onsubmit()">确定</div>
</div>
</div>
</form>
<iframe id="ajax_submit_frame_dialog" name="ajax_submit_frame_dialog"
	width="0" height="0" marginwidth="0" border="0" frameborder="0"
	src="about:blank"></iframe>
</body>
</html>