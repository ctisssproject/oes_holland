<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'sub/ucenter/include/it_showpage.class.php';
$o_showpage = new ShowPage ();
if (is_numeric ( $_GET ['page'] )) {
	$o_page = $_GET ['page'];
} else {
	$o_page = 1;
}
if (is_numeric ( $_GET ['state'] )) {
	$s_state = $_GET ['state'];
} else {
	$s_state = - 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript" src="../ucenter/js/goods.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>

<script type="text/javascript">
	 $(window).load(function(){resizeLeave2();parent.parent.Common_CloseDialog();document.getElementById('Vcl_OrderNumber').focus();});
    </script>

</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<div class="list out">
		<div class="title">
		<div>运单号码查询</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td>运单编号</td>
				<td class="right_none">
				<form method="post" id="submit_form"
					action="include/bn_submit.svr.php?function=CourseSubjectAdd"
					enctype="multipart/form-data" target="ajax_submit_frame"
					style="width: 100%" onsubmit="getGoodsByCode();">
				<input id="Vcl_OrderNumber " name="Vcl_OrderNumber" value=""
					style="width: 400px; height: 23px" type="text" /> <span
					class="gray">注：如果为手工输入直接按回车键。</span> <input style="width:0px;height:0px;" type="submit" value="1" />
				</form>
				</td>
			</tr>
		</table>
		<div id="result">	
		</div>
		</div>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>