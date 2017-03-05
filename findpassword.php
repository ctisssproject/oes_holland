<?php
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-找回密码</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/register.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/register.fun.js"></script>
<script type="text/javascript" src="js/ajax.class.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/dialog.fun.js"></script>

</head>
<body>
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
                    <?php
																				echo ($o_showpage->getLogo ())?>
                    <table class="reg_title" border="0" cellpadding="0"
			cellspacing="0">
			<tr>
				<td class="setp_title findpasswordtitle">&nbsp;</td>
				<td class="auto text"><img src="images/findpassword_text.png" alt="" />
				</td>
			</tr>
		</table>
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=FindPassword"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="form">
				<table border="0" cellpadding="0" cellspacing="0" id="form"
					style="width: 600px; margin-top: 30px">
					<tr>
						<td style="width: 270px" colspan="2">
						<div style="float: left">用户名（必须为邮箱）<span>*</span></div>
						<div id="Vcl_UserName_F_ok" class="input_ok"></div>
						<div id="Vcl_UserName_F_no" class="input_no"></div>
						</td>
						<td style="width: 60px"></td>
						<td style="width: 270px" colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_UserName_F" name="Vcl_UserName_F"
							maxlength="100" type="text" /></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">真实姓名 <span>*</span></div>
						<div id="Vcl_Name_ok" class="input_ok"></div>
						<div id="Vcl_Name_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Name" name="Vcl_Name"
							maxlength="10" type="text" /></td>
						<td></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td>
						<div style="float: left">手机 <span>*</span></div>
						<div id="Vcl_TelePhone_ok" class="input_ok"></div>
						<div id="Vcl_TelePhone_no" class="input_no"></div>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><input id="Vcl_TelePhone" name="Vcl_TelePhone" maxlength="15"
							type="text" /></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">验证码 <span>*</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:#2A80B9" href="javascript:updateValidCode();">看不清换一张</a></div>
						<div id="Vcl_ValidCode_ok" class="input_ok"></div>
						<div id="Vcl_ValidCode_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2"></td>

					</tr>
					<tr>
						<td colspan="2"><input class="mini" id="Vcl_ValidCode"
							name="Vcl_ValidCode" maxlength="6" type="text"
							style="float: left" />
						<div style="float: right; padding-top: 10px" id="validcode"></div>
						</td>
						<td></td>
						<td colspan="2"></td>
					</tr>

				</table>
				</td>
			</tr>
		</table>
		<table class="button form_button" border="0" cellpadding="0"
			cellspacing="0" style="margin-top:20px;">
			<tr>
				<td>
				<div class="dontagree cancel" title="取消" onclick="goTo('index.php')"></div>
				<div class="agree submit" title="提交找回密码申请"
					onclick="findPasswordSubmit()"></div>
				</td>
			</tr>
		</table>
		</form>
                    <?php
																				echo ($o_showpage->getFooter ())?>
                </td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
<?php
if ($_GET ['invitation'] != '') {
	echo ('<script type="text/javascript">checkInvitation(document.getElementById(\'Vcl_Invitation\'))</script>');
}
?>
<script type="text/javascript">
updateValidCode()
</script>
</body>
</html>

