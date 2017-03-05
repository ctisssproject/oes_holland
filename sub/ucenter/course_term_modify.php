<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Bank_Term ( $_GET ['termid'] );
if ($o_table->getType () < 2) {
} else {
	echo ('<script type="text/javascript">location=\'course_term.php\';</script>');
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
			action="include/bn_submit.svr.php?function=CourseTermModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>添加新学期</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">			
			<tr class="dark">
				<td style="width: 100px"><span>新学期名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php echo($o_table->getName());?>" type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>创建日期</span></td>
				<td class="right_none"><input id="Vcl_Date" name="Vcl_Date" value="<?php echo($o_table->getDate());?>"
					maxlength="10" type="text" /> <span class="red">*</span> <span class="gray">(格式：2013-01-01)</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>结束日期</span></td>
				<td class="right_none"><input id="Vcl_EndDate" name="Vcl_EndDate" value="<?php echo($o_table->getEndDate());?>"
					maxlength="10" type="text" /> <span class="red">*</span> <span class="gray">注：在此日期之后学员将不可答题。(格式必须为：2013-01-01)</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>学期说明</span></td>
				<td class="right_none"><input id="Vcl_Explain" name="Vcl_Explain"
					value="<?php echo($o_table->getExplain());?>" style="width:300px" type="text" /></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="courseTermAddSubmit()">保存</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_TermId" value="<?php echo($_GET['termid'])?>"/> 
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