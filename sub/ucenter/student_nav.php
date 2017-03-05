<?php
require_once 'include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<link rel="stylesheet" type="text/css" href="css/nav.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
</head>
<body style="background-image: none">
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav nav_on" onclick="navGoTo('student_wait.php',this)">等待审核</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav" onclick="navGoTo('student_all.php?type=0&sleep=0',this)">旅行社用户
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav" onclick="navGoTo('student_media.php',this)">
		媒体用户</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav" onclick="navGoTo('student_travel.php',this)">
		大众用户</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav" onclick="navGoTo('student_mail.php',this)">
		邮件管理</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav" onclick="navGoTo('student_total.php',this)">数据分析
		</td>
	</tr>
</table>
</body>
</html>
