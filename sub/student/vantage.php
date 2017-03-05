<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-积分记录</title>
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
		echo ($o_showpage->getLogo ());
		echo ($o_showpage->getTop ( 'title_record', $o_user ))?>
		<table class="record" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="left">
				<div class="top"></div>
				<div class="down" align="center"><?php echo($o_user->getVantage())?>分</div>
				</td>
				<td class="right"><iframe marginwidth="0" border="0" scrolling="no"
					frameborder="0" src="vantage_roll.php" style="overflow: hidden"></iframe></td>
			</tr>
		</table>
		<div class="record_jiao"></div>
		<table class="record_list" border="0" cellpadding="0" cellspacing="0">
			<tr class="title">
				<td style="width: 142px">日期</td>
				<td style="width: 80px">得到积分</td>
				<td style="width: 80px">使用积分</td>
				<td style="width: 80px">余额</td>
				<td>说明</td>
			</tr>
			<?php
			$o_record = new User_Vantage ();
			$o_record->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
			$o_record->PushOrder ( array ('Date', 'A' ) );
			$n_count = $o_record->getAllCount ();
			for($i = 0; $i < $n_count; $i ++) {
				$s_class = 'bright';
				if (abs ( $i % 2 ) == 0) {
					$s_class = 'dark';
				}
				$s_fuhao='<td>+'.$o_record->getSum($i).'</td><td>&nbsp;</td>';
				if ($o_record->getInOut($i)==0)
				{
					$s_fuhao='<td>&nbsp;</td><td>-'.$o_record->getSum($i).'</td>';
				}
				$a_date=explode ( " ",$o_record->getDate($i));
				$s_explain=$o_record->getExplain($i);
				$s_explain=str_replace ( "<br>", "", $s_explain);
				$s_explain=str_replace ( "<br/>", "", $s_explain);
				echo('
						<tr class="'.$s_class.'">
							<td>'.$a_date[0].'</td>
							'.$s_fuhao.'
							<td>'.$o_record->getBalance($i).'</td>
							<td class="rightnone">'.$s_explain.'</td>
						</tr>');
			}
			?>			
			<tr>
				<td style="height: 10px"></td>
				<td style="height: 10px"></td>
				<td style="height: 10px"></td>
				<td style="height: 10px"></td>
				<td style="height: 10px"></td>
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