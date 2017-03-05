<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="<?php echo(RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript" src="js/admin.fun.js"></script>
<script type="text/javascript">
	 $(window).load(function(){resizeLeave2();parent.parent.Common_CloseDialog()});
    </script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=AdminAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>添加内部用户</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>用户名</span></td>
				<td class="right_none"><input id="Vcl_UserName" name="Vcl_UserName"
					value=""
					type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td><span>姓名</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value=""
					type="text" /></td>
			</tr>
			<tr class="dark">
				<td><span>登录密码</span></td>
				<td class="right_none"><input id="Vcl_Password" name="Vcl_Password"
					value=""
					type="password"/> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td><span>确认密码</span></td>
				<td class="right_none"><input id="Vcl_Password2" name="Vcl_Password3"
					value=""
					type="password" /> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td><span>性别</span></td>
				<td class="right_none"><input id="Vcl_Sex" name="Vcl_Sex"
					value="" type="text" /></td>
			</tr>
			<tr class="bright">
				<td><span>角色</span></td>
				<td class="right_none"><select name="Vcl_Type"
					id="Vcl_Type" class="BigSelect">
					<option value="1" selected="seclected">后台管理</option><option value="2">配送管理</option>
				</select></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="AdminAddSubmit()">提交</div>
		</div>
		</div>
		</form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>