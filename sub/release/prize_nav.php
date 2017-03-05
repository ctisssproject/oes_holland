<?php
require_once 'include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/nav.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
</head>
<body style="background-image: none">
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav nav_on" onclick="navGoTo('prize_list.php?state=2',this)">等待发货</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="nav" onclick="navGoTo('prize_list.php?state=3',this)">
		完成发货</td>
	</tr>
</table>
</body>
</html>
