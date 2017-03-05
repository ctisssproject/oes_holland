<?php
require_once 'include/it_head.inc.php';
require_once '../release/include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_table = new Goods_Send ( $_GET ['id'] );
if ($o_table->getUid () > 0) {
} else {
	echo ('<script type="text/javascript">location=\'goods_credential.php\';</script>');
	exit ( 0 );
}
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
<script type="text/javascript" src="js/goods.fun.js"></script>

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
		<div class="title"><div>证书发货信息</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>申请时间</span></td>
				<td class="right_none"><?php echo($o_table->getDate())?></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>收件人</span></td>
				<td class="right_none"><?php echo($o_table->getName())?></td>
			</tr>	
			<tr class="dark">
				<td style="width: 100px"><span>收件地址</span></td>
				<td class="right_none"><?php echo($o_table->getAddress())?></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>邮编</span></td>
				<td class="right_none"><?php echo($o_table->getPostcode())?></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>联系电话</span></td>
				<td class="right_none"><?php echo($o_table->getPhone())?></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>快递公司</span></td>
				<td class="right_none">
				<?php echo($o_table->getLogistic())?>				
				</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>运单号</span></td>
				<td class="right_none"><?php echo($o_table->getOrderNumber())?></td>
			</tr>	
			<tr class="bright">
				<td style="width: 100px"><span>发货时间</span></td>
				<td class="right_none"><?php echo($o_table->getSendDate())?></td>
			</tr>	
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="openPrint(<?php echo($_GET ['id'] )?>)">打印</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">

</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
	<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>