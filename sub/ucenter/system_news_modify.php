<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new News ( $_GET ['newsid'] );
if (strlen($o_table->getTitle()) > 0) {
} else {
	echo ('<script type="text/javascript">location=\'system_news.php\';</script>');
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
<script type="text/javascript" charset="utf-8" src="editor/editor_config.js"></script>
<script type="text/javascript" charset="utf-8" src="editor/editor_api.js"></script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=SystemNewsModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改最新资讯</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>发布日期</span></td>
				<td class="right_none"><input id="Vcl_Date" name="Vcl_Date" value="<?php 
				echo($o_table->getDate())
				?>"
					maxlength="10" type="text" /> <span class="red">*</span> <span class="gray">(格式：2013-01-01)</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>资讯标题</span></td>
				<td class="right_none"><input id="Vcl_Title" name="Vcl_Title"
					value="<?php 
				echo($o_table->getTitle())
				?>" style="width: 400px" type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px; vertical-align: top;"> <span>资讯正文</span></td>
				<td class="right_none">
				<script id="editor" type="text/plain"><?php 
				echo($o_table->getContent())
				?></script>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="systemNewsAddSubmit()">保存</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value=""/> 
		<input type="hidden" name="Vcl_NewsId" id="Vcl_NewsId" value="<?php echo($o_table->getNewsId())?>"/> 
		</form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>

<script type="text/javascript">

   //实例化编辑器
	var editor = new UE.ui.Editor({ initialFrameWidth:651});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeave2,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>