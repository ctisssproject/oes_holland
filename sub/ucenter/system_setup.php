<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_system=new System(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
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
			action="include/bn_submit.svr.php?function=SystemSetupModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title"><div>系统参数设置</div></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>审核注册申请</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_RegCheck" id="Vcl_RegCheck1" value="1" />是 <input id="Vcl_RegCheck0"
					class="radio" type="radio" name="Vcl_RegCheck" value="0" />否&nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">用户注册成功后，是否需要通过审核才可登录。  </span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>邀请奖分</span></td>
				<td class="right_none"><input id="Vcl_Invitation" name="Vcl_Invitation" maxlength="3"
					value="<?php
					echo ($o_system->getInvitation ())?>" style="width: 50px;"
					type="text" /> 分 <span class="red">*</span> <span class="gray">邀请其他学员所奖励的分数，请填写整数。  </span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>邀请次数</span></td>
				<td class="right_none"><input id="Vcl_InvitationSum" name="Vcl_InvitationSum" maxlength="3"
					value="<?php
					echo ($o_system->getInvitationSum ())?>" style="width: 50px;"
					type="text" /> 次 <span class="red">*</span> <span class="gray">每个学员每天可以邀请好友的次数。  </span></td>
			</tr>	
			<tr class="bright">
				<td style="width: 100px"><span>证书有效期</span></td>
				<td class="right_none"><input id="Vcl_Term" name="Vcl_Term" maxlength="3"
					value="<?php
					echo ($o_system->getTerm ())?>" style="width: 50px;"
					type="text" /> 学期 <span class="red">*</span> <span class="gray">获得荷兰旅游专家证书的有效期，按学期计算，证书到期后，自动变为普通学员。  </span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>新学期提醒</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_NewtermRemind" id="Vcl_NewtermRemind1" value="1" />是 <input id="Vcl_NewtermRemind0"
					class="radio" type="radio" name="Vcl_NewtermRemind" value="0" />否 &nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">新学期发布后，是否以邮件的方式提醒所有学员。  </span></td>
			</tr>	
			<tr class="bright">
				<td style="width: 100px"><span>睡眠户提醒</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_SleepRemind" id="Vcl_SleepRemind1" value="1" />是 <input id="Vcl_SleepRemind0"
					class="radio" type="radio" name="Vcl_SleepRemind" value="0" />否 &nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">是否系统自动提醒睡眠户来学习。  </span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>睡眠时间</span></td>
				<td class="right_none"><input id="Vcl_IsSleep" name="Vcl_IsSleep" maxlength="4"
					value="<?php
					echo ($o_system->getIsSleep ())?>" style="width: 50px;"
					type="text" /> 天 <span class="red">*</span> <span class="gray">设置学员多少天未登录系统，就视为睡眠用户。 </span></td>
			</tr>	
						
			<tr class="bright">
				<td style="width: 100px"><span>专家奖分</span></td>
				<td class="right_none"><input id="Vcl_Reward" name="Vcl_Reward" maxlength="4"
					value="<?php
					echo ($o_system->getReward ())?>" style="width: 50px;"
					type="text" /> 分 <span class="red">*</span> <span class="gray">每学期获得专家后，所奖励的分数。 </span></td>
			</tr>	
			<tr class="dark">
				<td style="width: 100px"><span>奖品寄送审核</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_PrizeCheck" id="Vcl_PrizeCheck1" value="1" />是 <input id="Vcl_PrizeCheck0"
					class="radio" type="radio" name="Vcl_PrizeCheck" value="0" />否 &nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">寄送奖品前，是否需要管理员审核。  </span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>资料寄送审核</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_InformationCheck" id="Vcl_InformationCheck1" value="1" />是 <input id="Vcl_InformationCheck0"
					class="radio" type="radio" name="Vcl_InformationCheck" value="0" />否 &nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">寄送材料前，是否需要管理员审核。  </span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>证书寄送审核</span></td>
				<td class="right_none"><input class="radio" type="radio"
					name="Vcl_CredentialCheck" id="Vcl_CredentialCheck1" value="1" />是 <input id="Vcl_CredentialCheck0"
					class="radio" type="radio" name="Vcl_CredentialCheck" value="0" />否 &nbsp;&nbsp;&nbsp;&nbsp;<span class="gray">寄送证书前，是否需要管理员审核。  </span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>本站网址</span></td>
				<td class="right_none"><input id="Vcl_Host" name="Vcl_Host" maxlength="100"
					value="<?php
					echo ($o_system->getHost ())?>" style="width: 300px;"
					type="text" /> <span class="red">*</span> <span class="gray">请不要轻易修改。 </span></td>
			</tr>	
			<tr class="dark">
				<td style="width: 100px"><span>版权说明</span></td>
				<td class="right_none"><input id="Vcl_Copyright" name="Vcl_Copyright" maxlength="200"
					value="<?php
					echo ($o_system->getCopyright ())?>" style="width: 500px;"
					type="text" /> <span class="red">*</span> <span class="gray">网址底部版权信息。 </span></td>
			</tr>		
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="systemSetupSubmit()">保存</div>
		</div>
		</div>
		</form>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
<?php
echo ('document.getElementById("Vcl_RegCheck' . $o_system->getRegCheck () . '").checked=true;');
echo ('document.getElementById("Vcl_SleepRemind' . $o_system->getSleepRemind () . '").checked=true;');
echo ('document.getElementById("Vcl_NewtermRemind' . $o_system->getNewtermRemind () . '").checked=true;');
echo ('document.getElementById("Vcl_PrizeCheck' . $o_system->getPrizeCheck () . '").checked=true;');
echo ('document.getElementById("Vcl_InformationCheck' . $o_system->getInformationCheck () . '").checked=true;');
echo ('document.getElementById("Vcl_CredentialCheck' . $o_system->getCredentialCheck () . '").checked=true;');
?>

</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
	<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>