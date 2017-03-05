<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Information ( $_GET ['informationid'] );
if ($o_table->getState () > -1) {

} else {
	echo ('<script type="text/javascript">location=\'goods_information.php\';</script>');
	exit ( 0 );
}
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
<script type="text/javascript" src="<?php echo(RELATIVITY_PATH)?>js/ajax.class.js"></script>
<script type="text/javascript" src="js/goods.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=GoodsInformationModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>修改材料信息</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>材料名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php echo($o_table->getName ())?>" style="width:300px;"
					type="text" /> <span class="red">*</span></td>
			</tr>	
			<tr class="bright">
				<td style="vertical-align:top"><span>材料说明</span></td>
				<td class="right_none"><textarea id="Vcl_Explain" name="Vcl_Explain" cols="50" rows="4"><?php
					$s_content = $o_table->getExplain ();
					$s_content = str_replace ( "<br/>", "\n", $s_content );
					$s_content = str_replace ( '&nbsp;', ' ', $s_content );
					echo ($s_content)?></textarea> <span class="gray">为了前台页面效果，请不要超过三行。</span></td>
			</tr>	
			<tr class="dark">
				<td style="width: 100px"><span>领用数量</span></td>
				<td class="right_none"><input id="Vcl_Sum" name="Vcl_Sum"
					value="<?php echo($o_table->getSum ())?>" style="width:40px;"
					type="text" /> <span class="red">*</span> <span class="gray">允许学员领用的数量，请填写大于0 的正整数。</span></td>
			</tr>		
			<tr class="bright">
				<td style="vertical-align: top"><span>材料图片</span></td>
				<td class="right_none"><img style="width: 200px; height: 200px"
					src="<?php
					echo ($o_table->getPhoto ())?>" alt="" /></td>
			</tr>	
			<tr class="dark">
				<td style="vertical-align:top"><span>修改图片</span></td>
				<td class="right_none"><input style="font-size:12px;" id="Vcl_Upload" name="Vcl_Upload" type="file" /> <span class="red">*</span><br/>
				<span class="gray">推荐尺寸：200px * 200px</span><br/>
				<span class="gray">文件格式：jpg gif png bmp</span><br/>
						<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="goodsInformationAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_InformationId"
			value="<?php
			echo ($_GET ['informationid'])?>" />
		</form>
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>