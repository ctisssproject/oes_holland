<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Bank_Section ( $_GET ['sectionid'] );
if ($o_table->getType () < 2) {
} else {
	echo ('<script type="text/javascript">location=\'course_section.php\';</script>');
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
<script type="text/javascript" src="js/course.fun.js"></script>
<script type="text/javascript">
	 $(window).load(function(){resizeLeaveRight();parent.parent.Common_CloseDialog()});
    </script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=CourseSubjectAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>添加新试题</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>题目内容</span></td>
				<td class="right_none"><input id="Vcl_Content" name="Vcl_Content" value=""
					maxlength="255" style="width:650px" type="text" /> <span class="red">*</span></td>
			</tr>	
			<tr class="bright">
				<td style="width: 100px"><span>正确答案</span></td>
				<td class="right_none"><input class="checkbox" name="Vcl_Right_A" id="Vcl_Right_A" type="checkbox"/>&nbsp;A&nbsp;&nbsp;
				<input class="checkbox" name="Vcl_Right_B" id="Vcl_Right_B" type="checkbox"/>&nbsp;B&nbsp;&nbsp;
				<input class="checkbox" name="Vcl_Right_C" id="Vcl_Right_C" type="checkbox"/>&nbsp;C&nbsp;&nbsp;
				<input class="checkbox" name="Vcl_Right_D" id="Vcl_Right_D" type="checkbox"/>&nbsp;D&nbsp;&nbsp;
				<input class="checkbox" name="Vcl_Right_E" id="Vcl_Right_E" type="checkbox"/>&nbsp;E&nbsp;&nbsp;
				<input class="checkbox" name="Vcl_Right_F" id="Vcl_Right_F" type="checkbox"/>&nbsp;F&nbsp;&nbsp;
				</td>
			</tr>	
			<tr class="dark">
				<td style="width: 100px;vertical-align: top"><span>选项</span></td>
				<td class="right_none"><div>A：<input id="Vcl_Option_A" name="Vcl_Option_A" value="" maxlength="255" style="width:600px" type="text" /></div>
				<div style="margin-top:10px">B：<input id="Vcl_Option_B" name="Vcl_Option_B" value="" maxlength="255" style="width:600px" type="text" /></div>
				<div style="margin-top:10px">C：<input id="Vcl_Option_C" name="Vcl_Option_C" value="" maxlength="255" style="width:600px" type="text" /></div>
				<div style="margin-top:10px">D：<input id="Vcl_Option_D" name="Vcl_Option_D" value="" maxlength="255" style="width:600px" type="text" /></div>
				<div style="margin-top:10px">E：<input id="Vcl_Option_E" name="Vcl_Option_E" value="" maxlength="255" style="width:600px" type="text" /></div>
				<div style="margin-top:10px">F：<input id="Vcl_Option_F" name="Vcl_Option_F" value="" maxlength="255" style="width:600px" type="text" /></div>
				<div style="margin-top:10px"><span class="gray">注：请按照顺序填写选项，如果中间有空行，系统将自动舍弃之后的内容。</span></div>
				</td>
			</tr>	
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="courseSubjectAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_SectionId" value="<?php echo($_GET ['sectionid'])?>"/> 
		</form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>