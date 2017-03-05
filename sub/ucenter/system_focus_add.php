<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="<?php echo(RELATIVITY_PATH)?>js/jquery.min.js"></script>
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
			action="include/bn_submit.svr.php?function=SystemFocusAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>添加焦点图片</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>图片标题</span></td>
				<td class="right_none"><input id="Vcl_Title" name="Vcl_Title"
					value="" style="width:500px;"
					type="text" /> <span class="gray">建议不要超过40字</span></td>
			</tr>
			<tr class="bright">
				<td><span>显示顺序</span></td>
				<td class="right_none">
				<select name="Vcl_Number" id="Vcl_Number" class="BigSelect">
				<?php 
				$o_table = new FocusPhoto();
				$n_count=$o_table->getAllCount()+1;
				for($i=1;$i<=$n_count;$i++)
				{
					echo('<option value="'.$i.'">'.$i.'</option>');
				}
				?>
				</select>
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align:top"><span>焦点图片</span></td>
				<td class="right_none"><input style="font-size:12px;" id="Vcl_Upload" name="Vcl_Upload" type="file" /> <span class="red">*</span><br/>
				<span class="gray">推荐尺寸：宽度： 710px * 311px</span><br/>
				<span class="gray">文件格式：jpg gif png bmp</span><br/>
						<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="systemFocusAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		</form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>