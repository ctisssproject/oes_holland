<?php
error_reporting(0);
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
function is_mobile() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}
if ($_COOKIE ['SESSIONID'] == null ||  $_GET ['loginout']==1) {
	$o_date = new DateTime ( 'Asia/Chongqing' );
	$n_nowTime = $o_date->format ( 'U' );
	$S_Session_Id = md5 ( $_SERVER ['REMOTE_ADDR'] . $_SERVER ['HTTP_USER_AGENT'] . rand ( 0, 9999 ) . $n_nowTime );
	setcookie ( 'VISITER', '', 0 ,'/','',false,true );
	setcookie ( 'SESSIONID', $S_Session_Id, 0 ,'/','',false,true);
	setcookie ( 'VALIDCODE', '222', 0 ,'/','',false,true);
	//echo ('<script>location=\'index.php?url='.$_GET ['url'].'\'</script>');
	//exit ( 0 );
}
if ($_SERVER['HTTP_HOST']=='www.helanxingcheng.com')//根据不同来源的网址进行跳转
{
	if (isset ( $_GET ['url'])) {
		echo ('<script type="text/javascript">location=\'' . $_GET ['url'] . '\'</script>');
	} else {
		echo ('<script type="text/javascript">location=\'sub/travel/index.php\'</script>');
	}
	exit ( 0 );	
}else{
	if (isset ( $_GET ['url'] )) {
		echo ('<script type="text/javascript">location=\'' . $_GET ['url'] . '\'</script>');
		exit ( 0 );	
	}
	if (is_mobile())
	{
		if (isset ( $_GET ['activation_code'] )) {
			echo ('<script type="text/javascript">location=\'sub/mobile/index.php?activation_code=' . $_GET ['activation_code'] . '\'</script>');
			exit ( 0 );
		}
		echo ('<script type="text/javascript">location=\'sub/mobile/index.php\'</script>');
		exit ( 0 );
	}
}
if (isset ( $_GET ['activation_code'] )) {
	echo ('<script type="text/javascript">location=\'sub/student/index.php?activation_code=' . $_GET ['activation_code'] . '\'</script>');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-登录</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/login.fun.js"></script>
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
		<table class="login" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="left"><iframe marginwidth="0" border="0" scrolling="no"
					frameborder="0" src="roll.php" style="overflow: hidden"></iframe></td>
				<td class="right">
				<form method="post" id="submit_form"
					action="include/bn_submit.svr.php?function=Login"
					enctype="multipart/form-data" target="ajax_submit_frame"
					style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="title1"><img src="images/login_title1.png" alt="" />
								</td>
								<td class="title2">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="jiao"></td>
					</tr>
					<tr>
						<td class="input">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="text"><input id="Vcl_UserName" name="Vcl_UserName"
									type="text" maxlength="50" onfocus="inputOnfocus(this)"
									onmouseover="inputOnfocus(this)"
									onblur="checkInputUserName(this)" /></td>
								<td class="icon">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="input">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="text textpass"><input id="Vcl_Password"
									name="Vcl_Password" type="password" maxlength="50"
									onfocus="inputOnfocus(this)" onmouseover="inputOnfocus(this)"
									onblur="checkInputPassword(this)" /></td>
								<td class="icon pass">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="button">
						<div title="点击登录进入荷兰旅游专家在线培训"
							onclick="document.getElementById('submit_form').onsubmit();"><input
							type="submit" value="" /></div>
						</td>
					</tr>
					<tr>
						<td class="button2">
						<div class="findpass" onclick="goTo('findpassword.php')"
							title="如您忘记密码，请点击进入"></div>
						<div class="reg"
							onclick="goTo('register_1.php?invitation=<?php
							echo ($_GET ['invitation'])?>')"
							title="新用户注册为会员"></div>
						</td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
		</table>
		<table class="app" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="left">
				<?php
				$o_advert = new Advert ();
				$o_advert->PushWhere ( array ('&&', 'State', '=', 1 ) );
				$o_advert->PushOrder ( array ('Number', 'A' ) );
				$o_advert->PushOrder ( array ('AdvertId', 'A' ) );
				$n_count = $o_advert->getAllCount ();
				$n_line = 1;
				$n_sum = 0; //倒数第一行，不要底部边框
				$s_html = '';
				for($i = 0; $i < $n_count; $i ++) {
					$s_class = '';
					$s_java = 'goTo';
					if ($o_advert->getSize ( $i ) == 1) {
						$n_sum ++;
						$s_class = 'app1';
					} else if ($o_advert->getSize ( $i ) == 2) {
						$n_sum = $n_sum + 2;
						$s_class = 'app2';
					} else {
						$n_sum = $n_sum + 3;
						$s_class = 'app3';
					}
					if ($n_sum <= 3) {
						//输出没有底部边框的	
						$s_class = $s_class . ' apptopnone';
					}
					if ($o_advert->getOpen ( $i ) == 1) {
						$s_java = 'goToOpen';
					}
					if ($o_advert->getOnover ( $i ) == '') {
						//输出没有图片替换的
						$s_html .= '<div title="' . $o_advert->getTitle ( $i ) . '" class="' . $s_class . '" style="background-image: url(\'' . $o_advert->getOnout ( $i ) . '\')" onclick="' . $s_java . '(\'' . $o_advert->getUrl ( $i ) . '\')"></div>';
					} else {
						//输出有图片替换的
						$s_html .= '<div title="' . $o_advert->getTitle ( $i ) . '" class="' . $s_class . '"
										style="background-image: url(\'' . $o_advert->getOnout ( $i ) . '\')"
										onclick="' . $s_java . '(\'' . $o_advert->getUrl ( $i ) . '\')"
										onmouseover="changeBackground(this,\'' . $o_advert->getOnover ( $i ) . '\')"
										onmouseout="changeBackground(this,\'' . $o_advert->getOnout ( $i ) . '\')"></div>';
					}
				}
				echo ($s_html);
				?>
				</td>
				<td class="right">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="title1"><img src="images/app_new_title1.png" alt="" />
								</td>
								<td class="title2" title="更多最新资讯" onclick="goToOpen('news.php')">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class="jiao"></td>
					</tr>
					<?php
					$o_new = new News ();
					$o_new->PushWhere ( array ('&&', 'State', '=', 1 ) );
					$o_new->PushOrder ( array ('Date', 'D' ) );
					$o_new->setStartLine ( 0 ); //起始记录
					$o_new->setCountLine ( 4 );
					$n_count = $o_new->getAllCount ();
					$n_count = $o_new->getCount ();
					for($i = 0; $i < $n_count; $i ++) {
						echo ('
						<tr>
							<td class="list" title="' . $o_new->getTitle ( $i ) . '" onclick="goToOpen(\'' . RELATIVITY_PATH . 'news.php?newsid=' . $o_new->getNewsId ( $i ) . '\')">' . $o_showpage->CutStr ( $o_new->getTitle ( $i ), 35 ) . '<br />
							' . $o_new->getDate ( $i ) . '</td>
						</tr>
						');
					}
					?>					
				</table>
				</td>
			</tr>
		</table>
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
if ($_GET ['email'] == "true") {
	echo ('<script type="text/javascript">Dialog_Success("邮箱验证成功，请等待管理员的审核！<br/>审核通过后，会邮件通知您。")</script>');
}
?>
<?php

if ($_GET ['invitation'] != '') {
	echo ('<script type="text/javascript">Dialog_Message("欢迎加入荷兰旅游专家的大家庭！参加在线课程学习并成为荷兰旅游专家，即可税分兑换荷兰好礼！心动不如行动，快快注册加入我们吧！ ")</script>');
}
?>
<?php

if ($_GET ['out'] == 'true') {
	//echo ('<script type="text/javascript">Dialog_Message("您的帐号已登录！为确保帐户安全，请确认是否停在当前页。<br/>点击确认，已登录的帐号将自动下线。<br/>如发现帐户被盗，请尽快修改登录密码！ ")</script>');
}
?>
</body>
</html>

