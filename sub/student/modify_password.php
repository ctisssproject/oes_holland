<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
$o_user = new User ( $O_Session->getUid () );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-修改登陆密码</title>
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
	echo (RELATIVITY_PATH)?>js/ajax.class.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/dialog.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/submit.fun.js"></script>
<script type="text/javascript" src="js/ajax.fun.js"></script>
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
		echo ($o_showpage->getTop ('title_modifypassword',$o_user))?>
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=ModifyPassword"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
		<table border="0" cellpadding="0" cellspacing="0"
			style="margin-top: 40px">
			<tr>
				<td class="form">
				<table border="0" cellpadding="0" cellspacing="0" id="form"
					style="width: 600px">
					<tr>
						<td style="width: 270px">
						<div style="float: left">原始密码 <span>*</span></div>
						<div id="Vcl_Password_Old_ok" class="input_ok"></div>
						<div id="Vcl_Password_Old_no" class="input_no"></div>
						</td>
						<td style="width: 60px"></td>
						<td style="width: 270px">
						</td>
					</tr>	
					<tr>
						<td>
						<input id="Vcl_Password_Old" name="Vcl_Password_Old"
							maxlength="50" type="password" />
						</td>
						<td>
						</td>
						<td>						
						</td>
					</tr>
					<tr>
						<td>
						<div style="float: left">新密码 <span>*</span></div>
						<div id="Vcl_Password_ok" class="input_ok"></div>
						<div id="Vcl_Password_no" class="input_no"></div></td>
						<td></td>
						<td>
						</td>
					</tr>	
					<tr>
						<td style="height:80px"><input id="Vcl_Password" name="Vcl_Password"
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
						<td></td>
					</tr>
					<tr>
						<td>
						<div style="float: left">确认密码 <span>*</span></div>
						<div id="Vcl_Password2_ok" class="input_ok"></div>
						<div id="Vcl_Password2_no" class="input_no"></div>
						</td>
						<td></td>
						<td>
						</td>
					</tr>					
					<tr>
						<td colspan="2"><input id="Vcl_Password2" name="Vcl_Password2"
							maxlength="50" type="password" /></td>
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
				<div class="dontagree cancel" title="取消" onclick="goTo('index.php')"></div><div class="agree submit" title="提交修改密码申请" onclick="modifyPasswordSubmit()"></div>
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
</body>
</html>