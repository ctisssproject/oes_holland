<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table=new Travel_Item($_GET['itemid']);
if ($o_table->getState () < 2) {
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
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript" src="js/travel.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=TravelItemModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改路线分站</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td><span>显示顺序</span></td>
				<td class="right_none"><select name="Vcl_Number" id="Vcl_Number"
					class="BigSelect">
				<?php
				$o_temp = new Travel_Item ();
				$o_temp->PushWhere ( array ('&&', 'TitleId', '=', $o_table->getTitleId()) );
				$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );				
				$n_count = $o_temp->getAllCount () + 1;
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
				<td style="width: 80px"><span>分站名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php echo($o_table->getName())?>" style="width: 200px" type="text" /> <span class="red">*</span>
				<span class="gray">换行符号为: &lt;br/&gt;</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<input type="hidden" name="Vcl_ItemId" id="Vcl_ItemId" value="<?php echo($_GET['itemid'])?>" />
		<input type="hidden" name="Vcl_TitleId" id="Vcl_TitleId" value="<?php echo($o_table->getTitleId())?>" />
		<div class="subButton" onclick="travelItemAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		</form>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
    		<?php
    		echo ('document.getElementById("Vcl_Number").value="' . $o_table->getNumber () . '";');
    		?>
</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>