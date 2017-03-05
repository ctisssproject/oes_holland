<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
//验证个人资料是否齐全
if($o_user->getName()=="" && $o_user->getType()>2)
{
	echo ('<script type="text/javascript">location=\'modify_info.php?need=1\'</script>');
	exit ( 0 );	
}
$b_isuser = $O_Session->Login (); //是否为登录用户
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-领取材料</title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
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
		if ($b_isuser) {
			echo ($o_showpage->getLogo ());
		} else {
			echo ($o_showpage->getLogo ( 0 ));
		}
		echo ($o_showpage->getTop ( 'title_info', $o_user ))?>
		<table class="prize" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>				
				<?php
				$o_prize = new Information ();
				$o_prize->PushWhere ( array ('&&', 'State', '=', 1 ) );
				$o_prize->PushOrder ( array ('InformationId', 'D' ) );
				$n_count = $o_prize->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					$s_id = '';
					if ($i == 0) {
						$s_id = ' id="info" name="info"';
					}
					echo ('
					<div class="prize_box"' . $s_id . '>
						<div>
							<img src="' . $o_prize->getPhoto ( $i ) . '" alt="" />
						</div>
						<div class="prize_name">
							' . $o_prize->getName ( $i ) . '
						</div>
						<div class="prize_explain">
							' . $o_prize->getExplain ( $i ) . '
						</div>
						<div class="prize_but">
							<div class="right" align="center" title="点击领取资料" onclick="Dialog_Iframe(\'dialog/information_use.php?informationid=' . $o_prize->getInformationId ( $i ) . '\',252,420)">
								领取资料
							</div>
						</div>
					</div>
					');
				}
				?>				
			</td>
			</tr>
		</table>		
		<?php
		echo ($o_showpage->getUcenterNews ());
		echo ($o_showpage->getAdvert ());
		echo ($o_showpage->getFirend ());
		echo ($o_showpage->getFooter ())?>
		</td>
	</tr>
</table>
</div>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
</body>
</html>