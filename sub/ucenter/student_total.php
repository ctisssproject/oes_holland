<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
//统计学员总数
$o_table = new User ();
$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
$n_total = $o_table->getAllCount ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/student.fun.js"></script>

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
		<div class="list out">
		<div class="title"><div>用户总数：<?php echo($n_total)?>人</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>旅行社</span></td>
				<td style="width: 100px"><span>总数</span></td>
				<td class="right_none">
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: 480px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; color: #ffffff; text-align: center;">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$n_total = $o_table->getAllCount ();
				echo ($n_total)?> 人
				</div>
				</div>
				</td>
			</tr>
			<tr class="bright">
			    <td>&nbsp;</td>
				<td><span>普通学员</span></td>
				<td class="right_none">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '=', 3 ) );
				$n_temp = $o_table->getAllCount ();
				$n_width=floor($n_temp/$n_total*480);
				$n_precent=floor($n_temp/$n_total*100);
				?>
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; text-align: center;">
				<?php
				echo ($n_temp.' 人 ' .$n_precent.'%')?>
				</div>
				</div>
				</td>
			</tr>
			<tr class="dark">
				<td>&nbsp;</td>
				<td><span>专家</span></td>
				<td class="right_none">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 4 ) );
				$n_temp = $o_table->getAllCount ();
				$n_width=floor($n_temp/$n_total*480);
				$n_precent=floor($n_temp/$n_total*100);
				?>
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; text-align: center;">
				<?php
				echo ($n_temp.' 人 ' .$n_precent.'%')?>
				</div>
				</div>
				</td>
			</tr>
			<tr class="bright">
				<td>&nbsp;</td>
				<td><span>新期专家</span></td>
				<td class="right_none">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '=', 5 ) );
				$n_temp = $o_table->getAllCount ();
				$n_width=floor($n_temp/$n_total*480);
				$n_precent=floor($n_temp/$n_total*100);
				?>
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; text-align: center;">
				<?php
				echo ($n_temp.' 人 ' .$n_precent.'%')?>
				</div>
				</div>
				</td>
			</tr>
			<tr class="dark">
				<td>&nbsp;</td>
				<td><span>睡眠用户</span></td>
				<td class="right_none">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$o_table->PushWhere ( array ('&&', 'IsSleep', '=', 1 ) );
				$n_temp = $o_table->getAllCount ();
				$n_width=floor($n_temp/$n_total*480);
				$n_precent=floor($n_temp/$n_total*100);
				?>
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; text-align: center;">
				<?php
				echo ($n_temp.' 人 ' .$n_precent.'%')?>
				</div>
				</div>
				</td>
			</tr>
			<tr class="bright">
				<td>&nbsp;</td>
				<td><span>完成度小于50%</span></td>
				<td class="right_none">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$o_table->PushWhere ( array ('&&', 'Percent', '<=', 50 ) );
				$n_temp = $o_table->getAllCount ();
				$n_width=floor($n_temp/$n_total*480);
				$n_precent=floor($n_temp/$n_total*100);
				?>
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; text-align: center;">
				<?php
				echo ($n_temp.' 人 ' .$n_precent.'%')?>
				</div>
				</div>
				</td>
			</tr>
			<tr class="dark">
				<td>&nbsp;</td>
				<td><span>完成度大于50%</span></td>
				<td class="right_none">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$o_table->PushWhere ( array ('&&', 'Percent', '>', 50 ) );
				$n_temp = $o_table->getAllCount ();
				$n_width=floor($n_temp/$n_total*480);
				$n_precent=floor($n_temp/$n_total*100);
				?>
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; text-align: center;">
				<?php
				echo ($n_temp.' 人 ' .$n_precent.'%')?>
				</div>
				</div>
				</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>媒体</span></td>
				<td style="width: 100px"><span>总数</span></td>
				<td class="right_none">
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: 480px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; color: #ffffff; text-align: center;">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$n_total = $o_table->getAllCount ();
				echo ($n_total)?> 人
				</div>
				</div>
				</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>大众</span></td>
				<td style="width: 100px"><span>总数</span></td>
				<td class="right_none">
				<div style="width: 480px; height: 16px;">
				<div
					style="background-color: #89D5F5; width: 480px; height: 16px; position: absolute">
				</div>
				<div
					style="position: absolute; width: 480px; color: #ffffff; text-align: center;">
				<?php
				$o_table = new User ();
				$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$n_total = $o_table->getAllCount ();
				echo ($n_total)?> 人
				</div>
				</div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
</table>
</div>
</body>
</html>