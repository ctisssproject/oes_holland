<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Travel_Advert ( $_GET ['advertid'] );
if ($o_table->getNumber () > 0) {
} else {
	echo ('<script type="text/javascript">location=\'advert.php\';</script>');
	exit ( 0 );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
    <script type="text/javascript" src="../ucenter/js/system.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=AdvertModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改广告信息</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>广告说明标题</span></td>
				<td class="right_none"><input id="Vcl_Title" name="Vcl_Title"
					value="<?php
					echo ($o_table->getTitle ())?>" style="width: 300px;"
					type="text" /></td>
			</tr>
			<tr class="bright">
				<td><span>连接</span></td>
				<td class="right_none"><input id="Vcl_Url" name="Vcl_Url"
					value="<?php
					echo ($o_table->getUrl ())?>" style="width: 300px;"
					type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td><span>是否弹出</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_Open" id="Vcl_Open1" value="1" />弹出 <input id="Vcl_Open0"
					class="radio" type="radio" name="Vcl_Open" value="0" />不弹出</td>

			</tr>
			<tr class="dark">
				<td><span>显示顺序</span></td>
				<td class="right_none"><select name="Vcl_Number" id="Vcl_Number"
					class="BigSelect">
				<?php
				$o_temp = new Travel_Advert ();
				$n_count = $o_temp->getAllCount ();
				for($i = 1; $i <= $n_count; $i ++) {
					echo ('<option value="' . $i . '">' . $i . '</option>');
				}
				?>
				</select></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>广告图片</span></td>
				<td class="right_none"><?php
				echo('<img style="width:255px;height:147px" src="'.$o_table->getOnout().'" alt="" />');
				?>				
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>修改图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload" name="Vcl_Upload" type="file" /><br />
					<span class="gray">图片尺寸：225px * 147px</span><br/>
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="systemAdvertAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_AdvertId"
			value="<?php
			echo ($_GET ['advertid'])?>" /></form>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
<?php
echo ('document.getElementById("Vcl_Open' . $o_table->getOpen () . '").checked=true;');
echo ('document.getElementById("Vcl_Number").value="' . $o_table->getNumber () . '";');
?>

</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>