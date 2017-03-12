<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Bank_Term ( $_GET ['termid'] );
if ($o_table->getType () < 2) {
} else {
	echo ('<script type="text/javascript">location=\'course_chapter.php\';</script>');
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
<script type="text/javascript" charset="utf-8"
	src="editor/editor_config.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_api.js"></script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=CourseChapterAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>添加章内容</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		<div class="subButton" onclick="courseChapterAddSubmit()">提交</div>

		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td><span>显示顺序</span></td>
				<td class="right_none"><select name="Vcl_Number" id="Vcl_Number"
					class="BigSelect">
				<?php
				$o_table = new Bank_Chapter ();
				$o_table->PushWhere ( array ('&&', 'TermId', '=', $_GET['termid'] ) );
				$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );				
				$n_count = $o_table->getAllCount () + 1;
				for($i = 1; $i <= $n_count; $i ++) {
					if ($n_count==$i)
					{
						echo ('<option value="' . $i . '" selected="selected">' . $i . '</option>');
					}else{
						echo ('<option value="' . $i . '">' . $i . '</option>');
					}					
				}
				?>
				</select></td>
			</tr>
			<tr class="bright">
				<td style="width: 80px"><span>章标题</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="" style="width: 400px" type="text" /> <span class="red">*</span>
				<span class="gray">换行符号为: &lt;br/&gt;</span></td>
			</tr>
			<?php 
			if ($_GET ['termid']!=8)
			{
				?>
			<tr class="dark">
				<td style="vertical-align: top"><span>完成后图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload1" name="Vcl_Upload1" type="file" /> <span
					class="red">*</span><br />
				<span class="gray">推荐尺寸：宽度： 122px * 122x</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>未完成图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload2" name="Vcl_Upload2" type="file" /> <span
					class="red">*</span><br />
				<span class="gray">推荐尺寸：宽度： 122px * 122x</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>	
				<?php
			}
			?>			
			<tr class="dark">
				<td style="vertical-align: top"><span>章图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload3" name="Vcl_Upload3" type="file" /> <span
					class="red">*</span><br />
				<span class="gray">推荐尺寸：宽与高的比例为2:1，宽在700像素至800像素之间</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td><span>专家重做</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_Restudy" value="1" checked="checked" />是 <input
					class="radio" type="radio" name="Vcl_Restudy" value="0" />否</td>
			</tr>
			<tr class="dark">
				<td><span>单张证书</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_SendCredentials" id="Vcl_SendCredentials1" value="1" />有 <input class="radio"
					type="radio" name="Vcl_SendCredentials" id="Vcl_SendCredentials0" value="0" checked="checked" />无</td>
			</tr>
			<tr class="bright">
				<td><span>证书名称</span></td>
				<td class="right_none"><input id="Vcl_CredentialsName"
					name="Vcl_CredentialsName" value="" style="width: 240px"
					type="text" /> <span class="gray">换行符号为: &lt;br/&gt;</span></td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top;"><span>章介绍</span></td>
				<td class="right_none"><script id="editor" type="text/plain"><p style="font-family:微软雅黑, simhei;font-size:14px;"></p></script>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="courseChapterAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_TermId" id="Vcl_TermId" value="<?php echo($_GET['termid'])?>" />
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value="" /></form>
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
	var editor = new UE.ui.Editor({ initialFrameWidth:790});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeaveRight,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>