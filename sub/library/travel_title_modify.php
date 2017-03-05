<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table=new Travel_Title($_GET['titleid']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript" src="js/travel.fun.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_config.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_api.js"></script>
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
			action="include/bn_submit.svr.php?function=TravelTitleModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改行程线路</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		<div class="subButton" onclick="travelTitleAddSubmit()">提交</div>		
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>行程分类</span></td>
				<td class="right_none">
				<select name="Vcl_TypeId" id="Vcl_TypeId" class="BigSelect" style="width:auto">
					<?php 
					$o_temp = new Travel_Type ();
					$o_temp->PushOrder ( array ('TypeId', 'A' ) );
					$n_count=$o_temp->getAllCount();
					for($i=0;$i<$n_count;$i++)
					{
						echo('<option value="'.$o_temp->getTypeId($i).'">'.$o_temp->getName($i).'</option>');				
					}					
					?>
				</select> <span class="red">*</span>
				</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>行程线路名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php echo($o_table->getName())?>" type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>创建日期</span></td>
				<td class="right_none"><input id="Vcl_Date" name="Vcl_Date" value="<?php echo($o_table->getDate())?>"
					maxlength="10" type="text" /> <span class="red">*</span> <span class="gray">(格式：2013-01-01)</span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>缩略图</span></td>
				<td class="right_none"><?php
				echo('<img style="width:122px;height:122px" src="'.$o_table->getPhotoOn().'" alt="" />');
				?>				
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>修改图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload1" name="Vcl_Upload1" type="file" /> <span
					class="red">*</span><br />
				<span class="gray">推荐尺寸：宽度：271px * 271x</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>宣传图</span></td>
				<td class="right_none"><?php
				echo('<img style="width:552px;height:295px" src="'.$o_table->getPhoto().'" alt="" />');
				?>				
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>修改图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload2" name="Vcl_Upload2" type="file" /> <span
					class="red">*</span><br />
				<span class="gray">推荐尺寸：宽度：552px * 295x</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top;"><span>介绍</span></td>
				<td class="right_none"><script id="editor" type="text/plain"><?php echo($o_table->getExplain())?></script>
				</td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<input type="hidden" name="Vcl_TitleId" value="<?php echo($_GET['titleid'])?>"/>
		<div class="subButton" onclick="travelTitleAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value="" />
		</div>
		</div>
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
<?php 
		echo ('document.getElementById("Vcl_TypeId").value='.$o_table->getTypeId().';');
		?>
   //实例化编辑器
	var editor = new UE.ui.Editor({ initialFrameWidth:790});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeaveRight,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>