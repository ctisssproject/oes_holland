<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_type=new Travel_Type($_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />
 <link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript" src="<?php echo(RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/ajax.class.js"></script>
<script type="text/javascript" src="js/travel.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=TravelTypeModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
			<div class="title">
				<div>编辑分类</div>
				<div class="subButton2" onclick="goBack()">返回</div>
		<div class="subButton" onclick="travelTypeAddSubmit()">保存</div>
		<div class="subButton" onclick="location.reload()">刷新</div> 
			</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>顺序</span></td>
				<td class="right_none"><select name="Vcl_Number" id="Vcl_Number"
					class="BigSelect">
				<?php
				$o_temp = new Travel_Type ();
				$o_temp->PushWhere ( array ('&&', 'Delete', '=', 0) );			
				$n_count = $o_temp->getAllCount ();
				for($i = 1; $i <= $n_count; $i ++) {
					echo ('<option value="' . $i . '">' . $i . '</option>');				
				}
				?>
				</select></td>
			</tr>		
			<tr class="bright">
				<td style="width: 100px"><span>分类名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php echo($o_type->getName())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>公开</span></td>
				<td class="right_none"><select name="Vcl_State" id="Vcl_State"
					class="BigSelect">
					<option value="0">否</option>
					<option value="1">是</option>
					</select></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>宣传图片</span></td>
				<td class="right_none"><?php
				if($o_type->getPhoto()=='')
				{
					echo('<span style="color:red">未上传</span>');
				}else{
					echo('<img style="width:560px;height:245px" src="'.$o_type->getPhoto().'" alt="" />');
				}
				
				?>				
				</td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>上传图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload" name="Vcl_Upload" type="file" /> <span
					class="red"></span><br />
				<span class="gray">推荐尺寸：宽度：915px * 398x</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>选择推荐行程</span></td>
				<td class="right_none"><select name="Vcl_TitleId" id="Vcl_TitleId"
					class="BigSelect"><option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php
				$o_temp = new Travel_Title ();
				$o_temp->PushWhere ( array ('&&', 'TypeId', '=', $o_type->getTypeId()) );	
				$o_temp->PushOrder ( array ('Name', 'A' ) );		
				$n_count = $o_temp->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					echo ('<option value="' . $o_temp->getTitleId($i) . '">' . $o_temp->getName($i) . '</option>');				
				}
				?>
				</select></td>
			</tr>		
		</table>
		<div class="page" style="padding-left: 120px">
			<div class="subButton" onclick="travelTypeAddSubmit()">保存</div>
			<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_TypeId" value="<?php echo($o_type->getTypeId())?>"/></form>
		</td>
	</tr>
</table>
</div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<script type="text/javascript">
    		<?php
    		echo ('document.getElementById("Vcl_Number").value="' . $o_type->getNumber () . '";');
    		echo ('document.getElementById("Vcl_TitleId").value="' . $o_type->getTitleId () . '";');
    		echo ('document.getElementById("Vcl_State").value="' . $o_type->getState () . '";');
    		?>
</script>
</body>
</html>