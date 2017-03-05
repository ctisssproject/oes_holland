<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
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
			action="include/bn_submit.svr.php?function=SystemTermsModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改注册条款</div>
		<div class="subButton" onclick="window.open('../../register_1.php','_blank')">预览</div>
		<div class="subButton" onclick="document.getElementById('Vcl_Content').value=UE.getEditor('editor').getContent();document.getElementById('submit_form').onsubmit();">保存</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px; vertical-align: top;"><span>条款正文</span></td>
				<td class="right_none">
				<script id="editor" type="text/plain"><?php 
				$o_system=new System(1);
				echo($o_system->getTerms());
				?></script>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="document.getElementById('Vcl_Content').value=UE.getEditor('editor').getContent();document.getElementById('submit_form').onsubmit();">保存</div>
		<div class="subButton" onclick="window.open('../../register_1.php','_blank')">预览</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value=""/> 
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
	var editor = new UE.ui.Editor({ initialFrameWidth:725});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeave2,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>