<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$n_type=$_GET ['type'];
$o_table = new Bank_Term ( $_GET ['type'] );
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
<script type="text/javascript" src="js/student.fun.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_config.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_api.js"></script>
	<script type="text/javascript" src="js/student.fun.js"></script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=StudentSendMail"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>群发邮件</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		<div class="subButton" onclick="studentSendMailSubmit()">提交</div>

		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 80px"><span>邮件标题</span></td>
				<td class="right_none"><input id="Vcl_Title" name="Vcl_Title"
					value="" style="width: 400px;font-size:16px;padding:1px;padding-bottom:6px" type="text" /> <span class="red">*</span> 
				</td>
			</tr>
			<tr class="bright">
				<td style="width: 80px"><span>收件人</span></td>
				<td class="right_none"><input id="Vcl_Receiver" name="Vcl_Receiver"
					value="" style="width: 400px" type="text" /> 多个收件人请用分号隔开
				</td>
			</tr>
			<tr class="dark">
				<td style="width: 80px"><span>收件群组</span></td>
				<td class="right_none">
				<?php 
					if ($_GET['come_from']=='e-learning')
					{
						echo('<input style="width:15px" id="e-learning" name="e-learning" type="checkbox" checked="checked"/> <strong>旅行社组</strong>');
					}else{
						echo('<input style="width:15px" id="e-learning" name="e-learning" type="checkbox" /> <strong>旅行社组</strong>');
					}
					if ($_GET['come_from']=='media')
					{
						echo('&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:15px" id="media" name="media" type="checkbox" checked="checked"/> <strong>媒体组</strong>');
					}else{
						echo('&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:15px" id="media" name="media" type="checkbox" /> <strong>媒体组</strong>');
					}
					if ($_GET['come_from']=='travel')
					{
						echo('&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:15px" id="travel" name="travel" type="checkbox" checked="checked"/> <strong>大众组</strong>');
					}else{
						echo('&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:15px" id="travel" name="travel" type="checkbox" /> <strong>大众组</strong>');
					}
				?>
				</td>
			</tr>

			<tr class="bright">
				<td style="width: 80px;vertical-align: top;"><span>资料附件</span></td>
				<td class="right_none">
					<div>
						<a style="color:green" href="javascript:;" hidefocus="true" onclick="displayRegion(this)">
							添加
						</a>
					</div>
					<div style="display:none" id="region">
					<?php 
						$o_city=new Library_Region();
						$o_city = new Library_City ();
						$o_city->PushOrder ( array ('Name', 'A' ) );
						$n_count=$o_city->getAllCount();
						for($i=0;$i<$n_count;$i++)
						{
							echo('<div style="float:left;padding:5px;">');
							echo('<div style="padding:2px"><strong>'.$o_city->getName($i).'</strong></div>');
							$o_region = new Library_Region (); 
							$o_region->PushWhere ( array ('&&', 'CityId', '=', $o_city->getCityId($i) ) );
							$o_region->PushOrder ( array ('Name', 'A' ) );
							$n_count_region=$o_region->getAllCount();
							for($j=0;$j<$n_count_region;$j++)
							{
								echo('<input name="Vcl_Region_'.$o_region->getRegionId($j).'" style="width:15px" type="checkbox" /> '.$o_region->getName($j).'<br/>');
							}
							echo('</div>');
						}
					?>						
					</div>
				</td>
			</tr>			
			<tr class="dark">
				<td style="vertical-align: top;"><span>邮件内容</span></td>
				<td class="right_none"><script id="editor" type="text/plain"><p style="font-family:微软雅黑, simhei;font-size:14px;"></p></script>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="studentSendMailSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value="" />
		<input type="hidden" name="Vcl_Type" value="<?php echo($_GET['type'])?>"/> 
		<input type="hidden" name="Vcl_Sleep" value="<?php echo($_GET['sleep'])?>"/> 
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
	var editor = new UE.ui.Editor({ initialFrameWidth:675});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeaveRight,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>