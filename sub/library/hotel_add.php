<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript" src="<?php echo(RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript" src="js/hotel.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=HotelAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>添加酒店信息</div>
		<div class="subButton" onclick="hotelAddSubmit()">提交</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>酒店名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value=""
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>所在城市</span></td>
				<td class="right_none">
				<select name="Vcl_CityId" id="Vcl_CityId" class="BigSelect" style="width:auto">
					<?php 
					$o_temp = new Library_City ();
					$o_temp->PushOrder ( array ('Name', 'A' ) );
					$n_count=$o_temp->getAllCount();
					for($i=0;$i<$n_count;$i++)
					{
						if ($i==0)
						{
							echo('<option value="'.$o_temp->getCityId($i).'" selected="seclected">'.$o_temp->getName($i).'</option>');
						}else{
							echo('<option value="'.$o_temp->getCityId($i).'">'.$o_temp->getName($i).'</option>');
						}						
					}					
					?>
				</select> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>价格</span></td>
				<td class="right_none">$ <input id="Vcl_Price" name="Vcl_Price"
					value=""
					type="text" style="width:50px"/> / 天 <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top;"><span>酒店介绍</span></td>
				<td class="right_none"><script id="editor" type="text/plain"><p style="font-family:微软雅黑, simhei;font-size:14px;"></p></script></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="hotelAddSubmit()">提交</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value="" /></form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
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