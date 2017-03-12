<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Bank_Chapter ( $_GET ['chapterid'] );
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
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/ajax.class.js"></script>
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
			action="include/bn_submit.svr.php?function=CourseSectionAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>添加节内容</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		<div class="subButton" onclick="courseSectionAddSubmit()">提交</div>

		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td><span>显示顺序</span></td>
				<td class="right_none"><select name="Vcl_Number" id="Vcl_Number"
					class="BigSelect">
				<?php
				$o_table = new Bank_Section ();
				$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $_GET['chapterid'] ) );
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
				<td style="width: 100px"><span>节标题</span></td>
				<td class="right_none"><input id="Vcl_Title" name="Vcl_Title"
					value="" style="width: 400px" type="text" /> <span class="red">*</span>
				</td>
			</tr>	
			<tr class="dark">
				<td style="vertical-align: top"><span>节图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload" name="Vcl_Upload" type="file" /> <span
					class="red">*</span><br />
				<span class="gray">推荐尺寸：宽与高的比例为2:1，宽在700像素至800像素之间</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td><span>关键字</span></td>
				<td class="right_none"><input id="Vcl_Key" name="Vcl_Key"
					value="" style="width: 400px" type="text"/> 
					<?php 
						$o_key=new Bank_Section_Key();
						$o_key->PushOrder ( array ('Name', 'A' ) );
						$n_count=$o_key->getAllCount();
						$s_html='';
						for($i=0;$i<$n_count;$i++)
						{
							$s_html.='
							<div class="keybox">
								<div class="name" title="添加" onclick="courseSectionAddKey(this)">'.$o_key->getName($i).'</div>
								<div class="button" title="从库中删除" onclick="courseSectionDeleteKey(this,'.$o_key->getKeyId($i).')">
									×
								</div>
							</div>
							';
						}
						if ($n_count>0)
						{
							echo('<span class="gray">多个关键字之间用  <strong>;</strong> 分开</span>
								<div id="key">
									'.$s_html.'
								</div>
								');
						}else{
							echo(' <span class="gray">多个关键字之间用  <strong>;</strong> 分开</span>');
						}
					?>
					
					</td>
			</tr>	
			<tr class="dark">
				<td><span>单次考题数</span></td>
				<td class="right_none"><input id="Vcl_SubjectSum" name="Vcl_SubjectSum"
					value="" style="width: 50px" type="text" /> 题 <span class="red">*</span>
					<span class="gray">每次答题时的考题数目</span>
				</td>
			</tr>
			<tr class="bright">
				<td><span>正确率</span></td>
				<td class="right_none"><input id="Vcl_Rate" name="Vcl_Rate"
					value="100" style="width: 50px" type="text" /> % <span class="red">*</span>
				</td>
			</tr>
			<tr class="dark">
				<td><span>考试时间</span></td>
				<td class="right_none"><input id="Vcl_Time" name="Vcl_Time"
					value="60" style="width: 50px" type="text" /> 分钟 <span class="red">*</span>
				</td>
			</tr>
			<tr class="bright">
				<td><span>奖励积分</span></td>
				<td class="right_none"><input id="Vcl_Vantage" name="Vcl_Vantage"
					value="" style="width: 50px" type="text" /> 分 <span class="red">*</span>
				</td>
			</tr>		
			<tr class="dark">
				<td style="vertical-align: top;"><span>节学习内容</span></td>
				<td class="right_none"><script id="editor" type="text/plain"><p style="font-family:微软雅黑, simhei;font-size:14px;"></p></script>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="courseSectionAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_ChapterId" id="Vcl_ChapterId" value="<?php echo($_GET['chapterid'])?>" />
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
	var editor = new UE.ui.Editor({ initialFrameWidth:680});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeaveRight,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>