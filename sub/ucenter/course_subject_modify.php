<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Bank_Subject ( $_GET ['subjectid'] );
if ($o_table->getSectionId () >= 1) {
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
			action="include/bn_submit.svr.php?function=CourseSubjectModify"
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
				<td class="right_none"><input id="Vcl_Content" name="Vcl_Content"
					value="<?php
					echo ($o_table->getContent ())?>"
					maxlength="255" style="width: 650px" type="text" /> <span
					class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>正确答案</span></td>
				<td class="right_none">
				<?php
				$a_option = array ('A', 'B', 'C', 'D', 'E', 'F' );
				$a_temp = explode ( "<1>", $o_table->getRightOption () );
				for($i = 0; $i < count ( $a_option ); $i ++) {
					if (in_array ( $a_option [$i], $a_temp )) {
						//正确答案		
						echo ('<input class="checkbox" name="Vcl_Right_' . $a_option [$i] . '" id="Vcl_Right_' . $a_option [$i] . '" type="checkbox" checked="checked"/>&nbsp;' . $a_option [$i] . '&nbsp;&nbsp; ');
					} else {
						echo ('<input class="checkbox" name="Vcl_Right_' . $a_option [$i] . '" id="Vcl_Right_' . $a_option [$i] . '" type="checkbox"/>&nbsp;' . $a_option [$i] . '&nbsp;&nbsp; ');
					}
				}
				?>
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>配图</span></td>
				<td class="right_none"><?php
				echo('<img style="width:122px;height:122px" src="'.$o_table->getPhoto().'" alt="" />');
				?>				
				</td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>修改配图</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload" name="Vcl_Upload" type="file" /><br />
				<span class="gray">推荐尺寸：宽度：640px</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px; vertical-align: top"><span>选项</span></td>
				<td class="right_none">
				<?php
				$o_temp = new Bank_Option ();
				$o_temp->PushWhere ( array ('&&', 'SubjectId', '=', $o_table->getSubjectId () ) );
				$o_temp->PushOrder ( array ('Number', 'A' ) );
				$n_count=$o_temp->getAllCount();
				for($i = 0; $i < count ( $a_option ); $i ++) {
					if ($i==0)
					{
						$s_style='';
					}else{
						$s_style=' style="margin-top: 10px"';
					}
					if ($i<$n_count) {	
						echo ('<div'.$s_style.'>
									'.$a_option [$i].'：<input id="Vcl_Option_'.$a_option [$i].'" name="Vcl_Option_'.$a_option [$i].'" value="'.$o_temp->getText($i).'" maxlength="255" style="width: 600px" type="text" />
							   </div>');
					} else {
						echo ('<div'.$s_style.'>
									'.$a_option [$i].'：<input id="Vcl_Option_'.$a_option [$i].'" name="Vcl_Option_'.$a_option [$i].'" value="" maxlength="255" style="width: 600px" type="text" />
							   </div>');
					}
				}
				?>				
				<div style="margin-top: 10px"><span class="gray">注：请按照顺序填写选项，如果中间有空行，系统将自动舍弃之后的内容。</span></div>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="courseSubjectAddSubmit()">保存</div>
		<?php 
		if ($_GET['search']=='true')
		{
			echo('<div class="subButton2" onclick="parent.parent.window.close()">关闭</div>');
		}else{
			echo('<div class="subButton2" onclick="goBack()">返回</div>');
		}
		?>
		</div>
		</div>
		<input type="hidden" name="Vcl_Search" id="Vcl_Search" value="<?php echo($_GET['search'])?>" />
		<input type="hidden" name="Vcl_SubjectId"
			value="<?php
			echo ($_GET ['subjectid'])?>" /></form>
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