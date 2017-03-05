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
<title>荷兰旅游专家-修改头像</title>
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
		echo ($o_showpage->getTop ('title_modifyphoto',$o_user))?>		
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=ModifyPhoto"
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
						<div style="float: left">原始头像</div>
						</td>
						<td style="width: 60px"></td>
						<td style="width: 270px">
						</td>
					</tr>	
					<tr>
						<td class="modify_photo_old">
						<div><img
					src="<?php
					if ($o_user->getPhoto () == '') {
						echo ('images/user_photo.jpg');
					} else {
						echo ($o_user->getPhoto ());
					}
					?>"
					alt="" /></div>
						</td>
						<td>
						</td>
						<td>						
						</td>
					</tr>
					<tr>
						<td>
						<div style="float: left">新头像 <span>*</span></div>
						<div id="Vcl_Password_ok" class="input_ok"></div>
						<div id="Vcl_Password_no" class="input_no"></div></td>
						<td></td>
						<td>
						</td>
					</tr>	
					<tr>
						<td style="height:80px">
						<input style="font-size:12px;margin-bottom:5px" id="Vcl_Upload" name="Vcl_Upload" type="file" />
						<div style="line-height:1.6">头像推荐尺寸：<span>66像素 * 66像素</span><br/>
						文件格式：<span>jpg gif png bmp</span><br/>
						文件大小：<span>不能超过 1 MB</span></div>
						</td>
						<td></td>
						<td></td>
					</tr>					
				</table>
				</td>
			</tr>
		</table>
		<table class="button form_button" border="0" cellpadding="0"
			cellspacing="0">
			<tr>
				<td>
				<div class="dontagree cancel" title="取消" onclick="goTo('index.php')"></div><div class="agree submit" title="提交修改头像申请" onclick="document.getElementById('submit_form').onsubmit()"></div>
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