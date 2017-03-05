<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../../netdisk/css/common.css" rel="stylesheet"
	type="text/css" />
<link href="../../netdisk/css/style2.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/list.css" />
<script type="text/javascript" src="../../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/course.fun.js"></script>
</head>
<body style="background-image: none; background-color: #ffffff">
<form method="post" id="submit_form"
	action="<?php
	echo (RELATIVITY_PATH)?>sub/ucenter/include/bn_submit.svr.php?function=CourseSectionCopy"
	enctype="multipart/form-data" target="ajax_submit_frame_dialog"
	onsubmit="this.submit();parent.parent.parent.Common_OpenLoading()"
	style="width: 100%">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="dialog_title" style="font-family: 微软雅黑;">复制到...</td>
		<td style="width: 35px">
		<div onmouseover="this.className='dialog_closebutton_over'"
			class="dialog_closebutton" onclick="parent.Common_CloseDialog()"
			onmouseout="this.className='dialog_closebutton'"></div>
		</td>
	</tr>
</table>
<table class="TableBlock" style="width: 100%; margin-top: 15px;">
	<tbody>
		<tr>
			<td class="TableData" nowrap="nowrap" width="80">&nbsp;&nbsp;目标学期</td>
			<td class="TableData"><select name="Vcl_TermId" id="Vcl_TermId"
				class="BigSelect" onchange="courseGetChapter(this)">
	<option value=""></option>			
	<?php
				require_once RELATIVITY_PATH . 'include/db_table.class.php';
				$o_temp = new Bank_Term ();
				$o_temp->PushWhere ( array ('&&', 'State', '<>', 2 ) );
				$o_temp->PushOrder ( array ('Date', 'D' ) );
				$n_count = $o_temp->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					echo ('<option value="' . $o_temp->getTermId ( $i ) . '">' . $o_temp->getName ( $i ) . '</option>');
				}
				?>
				</select></td>
		</tr>
		<tr>
			<td class="TableData" nowrap="nowrap" width="80">&nbsp;&nbsp;目标章</td>
			<td class="TableData"><div id="chapter"><select name="Vcl_ChapterId" id="Vcl_ChapterId"
				class="BigSelect"><option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				</select></div></td>
		</tr>
	</tbody>
</table>
<div class="list">
<div class="page dialog">
<div class="subButton2" onclick="parent.Common_CloseDialog()">取消</div>
<div class="subButton"
	onclick="courseSectionMoveAndCopySubmit()">确定</div>
</div>
</div>
<input type="hidden" name="Vcl_SectionId"
	value="<?php
	echo ($_GET ['sectionid'])?>" />
<input type="hidden" name="Vcl_Search"
	value="<?php
	echo ($_GET ['search'])?>" /></form>
<iframe id="ajax_submit_frame_dialog" name="ajax_submit_frame_dialog"
	width="0" height="0" marginwidth="0" border="0" frameborder="0"
	src="about:blank"></iframe>
</body>
</html>