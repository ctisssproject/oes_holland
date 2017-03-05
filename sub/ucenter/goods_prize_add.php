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
			action="include/bn_submit.svr.php?function=GoodsPrizeAdd"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>添加奖品信息</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>奖品名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="" style="width:300px;"
					type="text" /> <span class="red">*</span></td>
			</tr>	
			<tr class="bright">
				<td style="vertical-align:top"><span>奖品说明</span></td>
				<td class="right_none"><textarea id="Vcl_Explain" name="Vcl_Explain" cols="50" rows="4"></textarea> <span class="gray">为了前台页面效果，请不要超过三行。</span></td>
			</tr>		
			<tr class="dark">
				<td style="vertical-align:top"><span>奖品图片</span></td>
				<td class="right_none"><input style="font-size:12px;" id="Vcl_Upload" name="Vcl_Upload" type="file" /> <span class="red">*</span><br/>
				<span class="gray">推荐尺寸：200px * 200px</span><br/>
				<span class="gray">文件格式：jpg gif png bmp</span><br/>
						<span class="gray">文件大小：不能超过 1 MB</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>兑换积分</span></td>
				<td class="right_none"><input id="Vcl_Vantage" name="Vcl_Vantage"
					value="" style="width:40px;"
					type="text" /> <span class="red">*</span> <span class="gray">学员兑换奖品所需积分，请填写整数</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>专家奖品</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_IsExpert" id="Vcl_IsExpert1" value="1" checked="checked"/>是 <input id="Vcl_IsExpert0"
					class="radio" type="radio" name="Vcl_IsExpert" value="0" />否  <span class="red">*</span> &nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">是否只有获得专家称号的学员才可兑换。 </span></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align:top"><span>单项专家</span></td>
				<td class="right_none"><div style="float:left;"><select class="BigSelect" onchange="goodsGetSingleExpert(this)">
				<option value=""></option><?php
				$o_temp = new Bank_Term ();
				$o_temp->PushWhere ( array ('&&', 'State', '<>', 2 ) );
				$o_temp->PushOrder ( array ('Date', 'D' ) );
				$n_count = $o_temp->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					echo ('<option value="' . $o_temp->getTermId ( $i ) . '">' . $o_temp->getName ( $i ) . '</option>');
				}
				?>
				</select></div><div style="float:left;margin-left:10px" id="chapter"></div><div style="float:left;margin-top:5px">&nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">选择单项专家名称后，只有获得该单项专家后才可兑换 </span></div></td>
			</tr>
			<tr class="dark">
				<td><span>库存</span></td>
				<td class="right_none"><input id="Vcl_Sum" name="Vcl_Sum"
					value="0" style="width:40px;"
					type="text" /> <span class="gray">填写库存量，当库存量为0时，学员将不能兑换该奖品，请填写整数</span></td>
			</tr>
			<tr class="bright">
				<td><span>缺货提醒</span></td>
				<td class="right_none"><input id="Vcl_RemSum" name="Vcl_RemSum"
					value="0" style="width:40px;"
					type="text" /> <span class="gray">填写奖品少于多少的值时，发送邮件提醒，填写0时，不提醒，请填写整数</span></td>
			</tr>
			<tr class="dark">
				<td><span>缺货提醒邮箱</span></td>
				<td class="right_none"><input id="Vcl_RemEmail" name="Vcl_RemEmail"
					value="" style="width:200px;"
					type="text" /> <span class="gray">设置缺货提醒的邮箱地址，为空时，不发送提醒</span></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="goodsPrizeAddSubmit()">提交</div>
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