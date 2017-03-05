<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new VantagePhoto ( $_GET ['photoid'] );
if ($o_table->getNumber () > 0) {
} else {
	echo ('<script type="text/javascript">location=\'system_vantage.php\';</script>');
	exit ( 0 );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript" src="js/system.fun.js"></script>
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
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=SystemVantageModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改焦点图片</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td><span>显示顺序</span></td>
				<td class="right_none"><select name="Vcl_Number" id="Vcl_Number"
					class="BigSelect">
				<?php
				$o_temp = new VantagePhoto ();
				$n_count = $o_temp->getAllCount ();
				for($i = 1; $i <= $n_count; $i ++) {
					echo ('<option value="' . $i . '">' . $i . '</option>');
				}
				?>
				</select></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>焦点图片</span></td>
				<td class="right_none"><?php
				echo('<img style="width:830px;height:285px" src="'.$o_table->getPath().'" alt="" />');
				?>				
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>修改图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload" name="Vcl_Upload" type="file" /><br />
				<span class="gray">推荐尺寸：宽度： 830px * 285px</span><br/>
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="document.getElementById('submit_form').onsubmit()">保存</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_PhotoId"
			value="<?php
			echo ($_GET ['photoid'])?>" /></form>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
<?php
echo ('document.getElementById("Vcl_Number").value="' . $o_table->getNumber () . '";');
?>

</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>