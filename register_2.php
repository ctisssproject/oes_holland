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
<title>荷兰旅游专家-新用户注册第二步</title>
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
				<td class="setp_title">&nbsp;</td>
				<td class="off step_1_off">&nbsp;</td>
				<td class="on step_2_on">&nbsp;</td>
				<td class="auto text"><img src="images/reg_step2_text.png" alt="" />
				</td>
				<td class="off step_3_off">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="jiao">&nbsp;</td>
				<td class="auto">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=Register"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="form">
				<table border="0" cellpadding="0" cellspacing="0" id="form"
					style="width: 600px">
					<tr>
						<td style="width: 270px" colspan="2">
						<div style="float: left">用户名（必须为邮箱）<span>*</span></div>
						<div id="Vcl_UserName_ok" class="input_ok"></div>
						<div id="Vcl_UserName_no" class="input_no"></div>
						</td>
						<td style="width: 60px"></td>
						<td>
						<div style="float: left">性别 <span>*</span></div>
						<div id="Vcl_Sex_ok" class="input_ok mini"></div>
						<div id="Vcl_Sex_no" class="input_no mini"></div>
						</td>
						<td>
						<div style="float: left">生日 <span>*</span></div>
						<div id="Vcl_Birthday_ok" class="input_ok mini"
							style="margin: 0px"></div>
						<div id="Vcl_Birthday_no" class="input_no mini"
							style="margin: 0px"></div>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_UserName" name="Vcl_UserName"
							maxlength="100" type="text" /></td>
						<td></td>
						<td><input id="Vcl_Sex" class="mini" name="Vcl_Sex" maxlength="1"
							type="text" /></td>
						<td><input id="Vcl_Birthday" name="Vcl_Birthday" type="text"
							style="display: none" /> <input id="Vcl_Birthday1"
							style="width: 30px; border-right: 0px; padding-left: 15px; padding-right: 5px"
							name="Vcl_Birthday1" maxlength="4" type="text" /><input
							id="Vcl_Birthday_Text_1" disabled="disabled"
							style="width: 8px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px"
							maxlength="1" type="text" value="-" /><input id="Vcl_Birthday2"
							style="width: 15px; border-left: 0px; border-right: 0px"
							name="Vcl_Birthday2" maxlength="2" type="text" /><input
							id="Vcl_Birthday_Text_2" disabled="disabled"
							style="width: 8px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px"
							maxlength="2" type="text" value="-" /><input id="Vcl_Birthday3"
							style="width: 25px; border-left: 0px;" name="Vcl_Birthday3"
							maxlength="2" type="text" /></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">登录密码（不能少于6位）<span>*</span></div>
						<div id="Vcl_Password_ok" class="input_ok"></div>
						<div id="Vcl_Password_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2" style="width: 270px">
						<div style="float: left">确认密码 <span>*</span></div>
						<div id="Vcl_Password2_ok" class="input_ok"></div>
						<div id="Vcl_Password2_no" class="input_no"></div>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Password" name="Vcl_Password"
							maxlength="50" type="password" onkeyup="passwordSafe();"
							style="margin-bottom: 0px" />
						<div class="passwordstyle" style="">
						<div class="a"></div>
						<div class="b"></div>
						<div class="c"></div>
						<div class="d"></div>
						<div class="e"></div>
						</div>
						<div class="passwordsafe"></div>
						</td>
						<td></td>
						<td colspan="2"><input id="Vcl_Password2" name="Vcl_Password2"
							maxlength="50" type="password" /></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">验证码 <span>*</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:#2A80B9" href="javascript:updateValidCode();">看不清换一张</a></div>
						<div id="Vcl_ValidCode_ok" class="input_ok"></div>
						<div id="Vcl_ValidCode_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2">
						<div style="float: left">邀请码（自动添加）</div>
						<div id="Vcl_Invitation_ok" class="input_ok"></div>
						<div id="Vcl_Invitation_no" class="input_no"></div>
						</td>

					</tr>
					<tr>
						<td colspan="2"><input class="mini" id="Vcl_ValidCode"
							name="Vcl_ValidCode" maxlength="6" type="text"
							style="float: left" />
						<div style="float: right; padding-top: 10px" id="validcode"></div>
						</td>
						<td></td>
						<td colspan="2"><input id="Vcl_Invitation" name="Vcl_Invitation"
							maxlength="15" type="text"
							value="<?php
							echo ($_GET ['invitation'])?>" /></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">真实姓名（请填写中文）<span>*</span></div>
						<div id="Vcl_Name_ok" class="input_ok"></div>
						<div id="Vcl_Name_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2">英文名</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Name" name="Vcl_Name"
							maxlength="10" type="text" /></td>
						<td></td>
						<td colspan="2"><input id="Vcl_EnName" name="Vcl_EnName"
							maxlength="30" type="text" /></td>
					</tr>
					<tr>
						<td colspan="2">						
						<div style="float: left">公司名称（请填写公司全称） <span>*</span></div>
						<div id="Vcl_Company_ok" class="input_ok"></div>
						<div id="Vcl_Company_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2">公司名称（英文）</td>
					</tr>
					<tr>
						<td colspan="2">
						<ul class="alt" id="alt1">
						</ul><input style="position:absolute;" onkeyup="altGet('AltGetCompany','alt1',this)" id="Vcl_Company" name="Vcl_Company"
							maxlength="50" type="text" /></td>
						<td></td>
						<td colspan="2"><input id="Vcl_EnCompany" name="Vcl_EnCompany"
							maxlength="100" type="text" /></td>
					</tr>
					<tr>
						<td style="width: 140px">
						<div style="float: left">职务全称 <span>*</span></div>
						<div id="Vcl_Job_ok" class="input_ok mini"></div>
						<div id="Vcl_Job_no" class="input_no mini"></div>
						</td>
						<td style="width: 130px">职务（英文）</td>
						<td style="width: 60px"></td>
						<td style="width: 140px">
						<div style="float: left">部门 <span>*</span></div>
						<div id="Vcl_Dept_ok" class="input_ok mini"></div>
						<div id="Vcl_Dept_no" class="input_no mini"></div>
						</td>
						<td style="width: 130px">部门（英文）</td>
					</tr>
					<tr>
						<td><input class="mini" id="Vcl_Job" name="Vcl_Job" maxlength="20"
							type="text" /></td>
						<td><input class="mini" id="Vcl_EnJob" name="Vcl_EnJob"
							maxlength="40" type="text" /></td>
						<td></td>
						<td><input class="mini" id="Vcl_Dept" name="Vcl_Dept"
							maxlength="40" type="text" /></td>
						<td><input class="mini" id="Vcl_EnDept" name="Vcl_EnDept"
							maxlength="40" type="text" /></td>
					</tr>
					<tr>
						<td>区号</td>
						<td>直线</td>
						<td></td>
						<td>总机</td>
						<td>分机</td>
					</tr>
					<tr>
						<td><input class="mini" id="Vcl_AreaNumber" name="Vcl_AreaNumber"
							maxlength="10" type="text" /></td>
						<td><input class="mini" id="Vcl_CompanyPhone"
							name="Vcl_CompanyPhone" maxlength="15" type="text" /></td>
						<td></td>
						<td><input class="mini" id="Vcl_Telephone" name="Vcl_Telephone"
							maxlength="15" type="text" /></td>
						<td><input class="mini" id="Vcl_Extension" name="Vcl_Extension"
							maxlength="10" type="text" /></td>
					</tr>
					<tr>
						<td>
						<div style="float: left">手机 <span>*</span></div>
						<div id="Vcl_Phone_ok" class="input_ok mini"></div>
						<div id="Vcl_Phone_no" class="input_no mini"></div>
						</td>
						<td>传真</td>
						<td></td>
						<td>地区</td>
						<td>省</td>
					</tr>
					<tr>
						<td><input class="mini" id="Vcl_Phone" name="Vcl_Phone"
							maxlength="15" type="text" /></td>
						<td><input class="mini" id="Vcl_Fax" name="Vcl_Fax" maxlength="20"
							type="text" /></td>
						<td></td>
						<td><input class="mini" id="Vcl_Area" name="Vcl_Area"
							maxlength="15" type="text" /></td>
						<td><input class="mini" id="Vcl_Province" name="Vcl_Province"
							maxlength="15" type="text" /></td>
					</tr>
					<tr>
						<td>市</td>
						<td>邮政编码</td>
						<td></td>
						<td>即时通讯</td>
						<td>SKYPE</td>
					</tr>
					<tr>
						<td><input class="mini" id="Vcl_City" name="Vcl_City"
							maxlength="15" type="text" /></td>
						<td><input class="mini" id="Vcl_Postcode" name="Vcl_Postcode"
							maxlength="10" type="text" /></td>
						<td></td>
						<td><input id="Vcl_QQ" name="Vcl_QQ" class="mini" maxlength="30"
							type="text" /></td>
						<td><input id="Vcl_Skype" name="Vcl_Skype" class="mini"
							maxlength="30" type="text" /></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">地址 <span>*</span></div>
						<div id="Vcl_Address_ok" class="input_ok"></div>
						<div id="Vcl_Address_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2">地址（英文）</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Address" name="Vcl_Address"
							maxlength="50" type="text" /></td>
						<td></td>
						<td colspan="2"><input id="Vcl_EnAddress" name="Vcl_EnAddress"
							maxlength="100" type="text" /></td>
					</tr>
					<tr>
						<td colspan="2">电邮</td>
						<td></td>
						<td colspan="2">电邮2</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Email1" name="Vcl_Email1"
							maxlength="50" type="text" /></td>
						<td></td>
						<td colspan="2"><input id="Vcl_Email2" name="Vcl_Email2"
							maxlength="50" type="text" /></td>
					</tr>
					<tr>
						<td colspan="2">网址</td>
						<td></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Url" name="Vcl_Url" maxlength="50"
							type="text" /></td>
						<td></td>
						<td colspan="2"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		<table class="button form_button" border="0" cellpadding="0"
			cellspacing="0">
			<tr>
				<td>
				<div class="agree submit" title="提交注册申请" onclick="registerSubmit()"></div>
				</td>
			</tr>
		</table>
		<input type="hidden" name="Vcl_ComeFrom" value="e-learning"/>
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

