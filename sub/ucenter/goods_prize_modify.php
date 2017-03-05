<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table = new Prize ( $_GET ['prizeid'] );
if ($o_table->getState () >-1) {
} else {
	echo ('<script type="text/javascript">location=\'goods_prize.php\';</script>');
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
			action="include/bn_submit.svr.php?function=GoodsPrizeModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改奖品信息</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>奖品名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php
					echo ($o_table->getName ())?>"
					style="width: 300px;" type="text" /> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>奖品说明</span></td>
				<td class="right_none"><textarea id="Vcl_Explain" name="Vcl_Explain"
					cols="50" rows="4"><?php
					$s_content = $o_table->getExplain ();
					$s_content = str_replace ( "<br/>", "\n", $s_content );
					$s_content = str_replace ( '&nbsp;', ' ', $s_content );
					echo ($s_content)?></textarea><span class="gray">为了前台页面效果，请不要超过三行。</span></td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>奖品图片</span></td>
				<td class="right_none"><img style="width: 200px; height: 200px"
					src="<?php
					echo ($o_table->getPhoto ())?>" alt="" /></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top"><span>修改图片</span></td>
				<td class="right_none"><input style="font-size: 12px;"
					id="Vcl_Upload" name="Vcl_Upload" type="file" /> <span class="red">*</span><br />
				<span class="gray">推荐尺寸：200px * 200px</span><br />
				<span class="gray">文件格式：jpg gif png bmp</span><br />
				<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>兑换积分</span></td>
				<td class="right_none"><input id="Vcl_Vantage" name="Vcl_Vantage"
					value="<?php echo ($o_table->getVantage ())?>"
					style="width: 300px;" type="text" /> <span class="red">*</span> <span
					class="gray">学员兑换奖品所需积分，请填写整数</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>专家奖品</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_IsExpert" id="Vcl_IsExpert1" value="1" />是 <input
					id="Vcl_IsExpert0" class="radio" type="radio" name="Vcl_IsExpert"
					value="0" />否 <span class="red">*</span> &nbsp;&nbsp;&nbsp;&nbsp;<span
					class="gray">是否只有获得专家称号的学员才可兑换。 </span></td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top"><span>单项专家</span></td>
				<td class="right_none">
				<div style="float: left;"><select class="BigSelect"
					onchange="goodsGetSingleExpert(this)">
					<option value=""></option><?php
					$n_termid = '';
					if ($o_table->getChapterId () > 0) {
						$o_temp2 = new Bank_Chapter ( $o_table->getChapterId () );
						$n_termid=$o_temp2->getTermId ();
						$o_temp3 = new Bank_Chapter ();
						$o_temp3->PushWhere ( array ('&&', 'TermId', '=', $o_temp2->getTermId () ) );
						$o_temp3->PushWhere ( array ('&&', 'SendCredentials', '=', 1 ) );
						$o_temp3->PushWhere ( array ('&&', 'State', '<>', 2 ) );
						$o_temp3->PushOrder ( array ('Number', 'A' ) );
						$n_count = $o_temp3->getAllCount ();
						$s_html = '<select name="Vcl_ChapterId" id="Vcl_ChapterId" class="BigSelect">
						<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
						for($i = 0; $i < $n_count; $i ++) {
							if ($o_temp3->getChapterId ( $i ) == $o_temp2->getChapterId ()) {
								$s_html .= '<option value="' . $o_temp3->getChapterId ( $i ) . '" selected="selected">' . $o_temp3->getCredentialsName ( $i ) . '</option>';
							} else {
								$s_html .= '<option value="' . $o_temp3->getChapterId ( $i ) . '">' . $o_temp3->getCredentialsName ( $i ) . '</option>';
							}
						}
						$s_html .= '</select>';
					}
					$o_temp = new Bank_Term ();
					$o_temp->PushWhere ( array ('&&', 'State', '<>', 2 ) );
					$o_temp->PushOrder ( array ('Date', 'D' ) );
					$n_count = $o_temp->getAllCount ();
					for($i = 0; $i < $n_count; $i ++) {
						if ($o_temp->getTermId ( $i ) == $n_termid) {
							echo ('<option value="' . $o_temp->getTermId ( $i ) . '" selected="selected">' . $o_temp->getName ( $i ) . '</option>');
						} else {
							echo ('<option value="' . $o_temp->getTermId ( $i ) . '">' . $o_temp->getName ( $i ) . '</option>');
						}
					}
					?>
				</select></div>
				<div style="float: left; margin-left: 10px" id="chapter"><?php
				echo ($s_html)?></div>
				<div style="float: left; margin-top: 5px">&nbsp;&nbsp;&nbsp;&nbsp;<span
					class="gray">选择单项专家名称后，只有获得该单项专家后才可兑换 </span></div>
				</td>
			</tr>
			<tr class="bright">
				<td><span>库存</span></td>
				<td class="right_none"><input id="Vcl_Sum" name="Vcl_Sum"
					value="<?php echo ($o_table->getSum ())?>" style="width:40px;"
					type="text" /> <span class="gray">填写库存量，当库存量为0时，学员将不能兑换该奖品，请填写整数</span></td>
			</tr>
			<tr class="dark">
				<td><span>缺货提醒</span></td>
				<td class="right_none"><input id="Vcl_RemSum" name="Vcl_RemSum"
					value="<?php echo ($o_table->getRemSum ())?>" style="width:40px;"
					type="text" /> <span class="gray">填写奖品少于多少的值时，发送邮件提醒，填写0时，不提醒，请填写整数</span></td>
			</tr>
			<tr class="bright">
				<td><span>缺货提醒邮箱</span></td>
				<td class="right_none"><input id="Vcl_RemEmail" name="Vcl_RemEmail"
					value="<?php echo ($o_table->getRemEmail ())?>" style="width:200px;"
					type="text" /> <span class="gray">设置缺货提醒的邮箱地址，为空时，不发送提醒</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="goodsPrizeAddSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_PrizeId"
			value="<?php
			echo ($_GET ['prizeid'])?>" /></form>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
<?php
echo ('document.getElementById("Vcl_IsExpert' . $o_table->getIsExpert () . '").checked=true;');
?>

</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>