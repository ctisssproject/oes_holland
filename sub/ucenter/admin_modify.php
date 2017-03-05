<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_user = new user ( $_GET ['uid'] );
if ($o_user->getType () > 0) {
} else {
	echo ('<script type="text/javascript">location=\'admin_list.php\';</script>');
	exit ( 0 );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
<script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=AdminModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>修改内部用户信息</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>用户名</span></td>
				<td class="right_none"><input id="Vcl_UserName" name="Vcl_UserName"
					value="<?php
					echo ($o_user->getUserName ());
					?>"
					type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td><span>姓名</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php
					echo ($o_user->getName ());
					?>"
					type="text" /></td>
			</tr>
			<tr class="dark">
				<td><span>性别</span></td>
				<td class="right_none"><input id="Vcl_Sex" name="Vcl_Sex"
					value="<?php
					echo ($o_user->getSex ());
					?>" type="text" /></td>
			</tr>
			<tr class="bright">
				<td><span>角色</span></td>
				<td class="right_none"><select name="Vcl_Type"
					id="Vcl_Type" class="BigSelect">
					<?php
					if ($o_user->getType () == 1) {
						echo ('<option value="1" selected="seclected">后台管理</option><option value="2">配送管理</option>');
					} else {
						echo ('<option value="1">后台管理</option><option value="2" selected="seclected">配送管理</option>');
					}
					?>
				</select></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="AdminModifySubmit()">保存</div>
		<div class="subButton" onclick="Dialog_Iframe('dialog/admin_resetpassword.php?uid=<?php echo($_GET['uid'])?>',300,170,'',this)">重置密码</div>
		<div class="subButton2" onclick="history.go(-1)">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Uid" value="<?php echo($_GET['uid'])?>"/> 
		</form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
	<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>