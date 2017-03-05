<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-修改个人信息</title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/register.css" />
<link rel="stylesheet" type="text/css" href="css/ucenter.css" />
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/dialog.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/submit.fun.js"></script>
<script type="text/javascript" src="<?php
	echo (RELATIVITY_PATH)?>js/register.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/login.fun.js"></script>
</head>
<body>
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<?php
		echo ($o_showpage->getLogo ());
		echo ($o_showpage->getTop ('title_modifyinfo',$o_user))?>	
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=ModifyInfo"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
		<table border="0" cellpadding="0" cellspacing="0"
			style="margin-top: 40px">
			<tr>
				<td class="form">
				<table border="0" cellpadding="0" cellspacing="0" id="form"
					style="width: 600px">
					<tr>
						<td style="width: 270px" colspan="2">
						<div style="float: left">用户名</div>
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
						<td colspan="2" class="text"><input id="Vcl_Birthday" name="Vcl_Birthday" disabled="disabled" type="text" value="<?php echo($o_user->getUserName())?>"/></td>
						<td></td>
						<td><input id="Vcl_Sex" class="mini" name="Vcl_Sex" maxlength="4"
							type="text" value="<?php echo($o_user->getSex())?>"/></td>
						<td>
						<?php 
						//拆分生日
						$a_birthday=explode ( "-", $o_user->getBirthday() )
						?>
						<input id="Vcl_Birthday" name="Vcl_Birthday" type="text"
							style="display: none" value="<?php echo($o_user->getBirthday())?>"/> <input id="Vcl_Birthday1"
							style="width: 30px; border-right: 0px; padding-left: 15px; padding-right: 5px"
							name="Vcl_Birthday1" maxlength="4" type="text" value="<?php echo($a_birthday[0])?>"/><input
							id="Vcl_Birthday_Text_1" disabled="disabled"
							style="width: 8px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px"
							maxlength="1" type="text" value="-" /><input id="Vcl_Birthday2"
							style="width: 15px; border-left: 0px; border-right: 0px"
							name="Vcl_Birthday2" maxlength="2" type="text" value="<?php echo($a_birthday[1])?>"/><input
							id="Vcl_Birthday_Text_2" disabled="disabled"
							style="width: 8px; padding-left: 0px; padding-right: 0px; border-left: 0px; border-right: 0px"
							maxlength="2" type="text" value="-" /><input id="Vcl_Birthday3"
							style="width: 25px; border-left: 0px;" name="Vcl_Birthday3"
							maxlength="2" type="text" value="<?php echo($a_birthday[2])?>"/></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">真实姓名 <span>*</span></div>
						<div id="Vcl_Name_ok" class="input_ok"></div>
						<div id="Vcl_Name_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2">英文名</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Name" name="Vcl_Name"
							maxlength="10" type="text"  value="<?php echo($o_user->getName())?>"/></td>
						<td></td>
						<td colspan="2"><input id="Vcl_EnName" name="Vcl_EnName"
							maxlength="30" type="text" value="<?php echo($o_user->getEnName())?>"/></td>
					</tr>
					<tr>
						<td colspan="2">
						<div style="float: left">公司名称 <span>*</span></div>
						<div id="Vcl_Company_ok" class="input_ok"></div>
						<div id="Vcl_Company_no" class="input_no"></div>
						</td>
						<td></td>
						<td colspan="2">公司名称（英文）</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Company" name="Vcl_Company"
							maxlength="50" type="text" value="<?php echo($o_user->getCompany())?>"/></td>
						<td></td>
						<td colspan="2"><input id="Vcl_EnCompany" name="Vcl_EnCompany"
							maxlength="100" type="text" value="<?php echo($o_user->getEnCompany())?>"/></td>
					</tr>
					<tr>
						<td style="width: 140px">
						<div style="float: left">职务 <span>*</span></div>
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
							type="text" value="<?php echo($o_user->getJob())?>"/></td>
						<td><input class="mini" id="Vcl_EnJob" name="Vcl_EnJob"
							maxlength="40" type="text" value="<?php echo($o_user->getEnJob())?>"/></td>
						<td></td>
						<td><input class="mini" id="Vcl_Dept" name="Vcl_Dept"
							maxlength="40" type="text" value="<?php echo($o_user->getDept())?>"/></td>
						<td><input class="mini" id="Vcl_EnDept" name="Vcl_EnDept"
							maxlength="40" type="text" value="<?php echo($o_user->getEnDept())?>"/></td>
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
							maxlength="10" type="text" value="<?php echo($o_user->getAreaNumber())?>"/></td>
						<td><input class="mini" id="Vcl_CompanyPhone"
							name="Vcl_CompanyPhone" maxlength="15" type="text" value="<?php echo($o_user->getCompanyPhone())?>"/></td>
						<td></td>
						<td><input class="mini" id="Vcl_Telephone" name="Vcl_Telephone"
							maxlength="15" type="text" value="<?php echo($o_user->getTelephone())?>"/></td>
						<td><input class="mini" id="Vcl_Extension" name="Vcl_Extension"
							maxlength="10" type="text" value="<?php echo($o_user->getExtension())?>"/></td>
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
							maxlength="15" type="text" value="<?php echo($o_user->getPhone())?>"/></td>
						<td><input class="mini" id="Vcl_Fax" name="Vcl_Fax" maxlength="20"
							type="text" value="<?php echo($o_user->getFax())?>"/></td>
						<td></td>
						<td><input class="mini" id="Vcl_Area" name="Vcl_Area"
							maxlength="15" type="text" value="<?php echo($o_user->getArea())?>"/></td>
						<td><input class="mini" id="Vcl_Province" name="Vcl_Province"
							maxlength="15" type="text" value="<?php echo($o_user->getProvince())?>"/></td>
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
							maxlength="15" type="text" value="<?php echo($o_user->getCity())?>"/></td>
						<td><input class="mini" id="Vcl_Postcode" name="Vcl_Postcode"
							maxlength="10" type="text" value="<?php echo($o_user->getPostcode())?>"/></td>
						<td></td>
						<td><input id="Vcl_QQ" name="Vcl_QQ" class="mini" maxlength="30"
							type="text" value="<?php echo($o_user->getQQ())?>"/></td>
						<td><input id="Vcl_Skype" name="Vcl_Skype" class="mini"
							maxlength="30" type="text" value="<?php echo($o_user->getSkype())?>"/></td>
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
							maxlength="50" type="text" value="<?php echo($o_user->getAddress())?>"/></td>
						<td></td>
						<td colspan="2"><input id="Vcl_EnAddress" name="Vcl_EnAddress"
							maxlength="100" type="text" value="<?php echo($o_user->getEnAddress())?>"/></td>
					</tr>
					<tr>
						<td colspan="2">电邮</td>
						<td></td>
						<td colspan="2">电邮2</td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Email1" name="Vcl_Email1"
							maxlength="50" type="text" value="<?php echo($o_user->getEmail1())?>"/></td>
						<td></td>
						<td colspan="2"><input id="Vcl_Email2" name="Vcl_Email2"
							maxlength="50" type="text" value="<?php echo($o_user->getEmail2())?>"/></td>
					</tr>
					<tr>
						<td colspan="2">网址</td>
						<td></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2"><input id="Vcl_Url" name="Vcl_Url" maxlength="50"
							type="text" value="<?php echo($o_user->getUrl())?>"/></td>
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
				<div class="dontagree cancel" title="取消" onclick="goTo('index.php')"></div><div class="agree submit" title="提交修改个人信息申请" onclick="modifyInfoSubmit()"></div>
				</td>
			</tr>
		</table>
		</form>
		
        <?php
								echo ($o_showpage->getUcenterNews ())?> 
		<?php
		echo ($o_showpage->getAdvert ())?>  
		<?php
		echo ($o_showpage->getFirend ())?>                   
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

if ($_GET ['need'] == '1') {
	echo ('<script type="text/javascript">Dialog_Message("开启荷兰旅游专家之旅前<br/><br/>请您完善个人信息！ ")</script>');
}
?>
</body>
</html>