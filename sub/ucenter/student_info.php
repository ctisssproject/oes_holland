<?php
require_once 'include/it_head.inc.php';
require_once '../release/include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_user = new user ( $_GET ['uid'] );
if ($o_user->getType () > 0) {
} else {
	echo ('<script type="text/javascript">history.go(-1);</script>');
	exit ( 0 );
}
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
<script type="text/javascript" src="js/student.fun.js"></script>

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
		<div class="list out">
		<div class="title"><div>查看学员信息</div>
		<div class="subButton" onclick="goBack()">返回</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>头像</span></td>
				<td class="right_none"><img style="width:65px;height:65px"
					src="<?php
					if ($o_user->getPhoto () == '') {
						echo (RELATIVITY_PATH.'sub/student/images/user_photo.jpg');
					} else {
						echo ($o_user->getPhoto ());
					}
					?>"
					alt="" /></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>用户名</span></td>
				<td class="right_none"><?php echo($o_user->getUserName())?></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>身份</span></td>
				<td class="right_none"><?php 
				if($o_user->getType()==3)
				{
					echo('普通学员');
				}
				if($o_user->getType()==4)
				{
					echo('专家资格 <img src="images/list_expert_icon.png" alt="荷兰旅游专家" align="absmiddle"/>');
				}
				if($o_user->getType()==5)
				{
					echo('本年度专家 <img src="images/list_expert_icon.png" alt="荷兰旅游专家" align="absmiddle"/>');
				}?></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>注册日期</span></td>
				<td class="right_none"><?php echo($o_user->getRegTime())?></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>专家完成度</span></td>
				<td class="right_none">
				<?php 
				$n_width=floor($o_user->getPercent ()*120/100);
				?>
				<div style="border: 1px solid #999999;; width: 120px; height: 16px;">
				<div
					style="background-color: #54C3F1; width: <?php echo($n_width)?>px; height: 16px; position: absolute">
				</div>
				<div style="position: absolute; width: 120px; text-align: center;">
				<?php echo($o_user->getPercent ())?>%</div>
				</div>
				</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>积分</span></td>
				<td class="right_none"><span class="red"><?php echo($o_user->getVantage())?> 分</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>真实姓名</span></td>
				<td class="right_none"><?php echo($o_user->getName())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>英文名</span></td>
				<td class="right_none"><?php echo($o_user->getEnName())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>性别</span></td>
				<td class="right_none"><?php echo($o_user->getSex())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>出生日期</span></td>
				<td class="right_none"><?php echo($o_user->getBirthday())?>&nbsp;</td>
			</tr>			
			<tr class="dark">
				<td style="width: 100px"><span>公司名称</span></td>
				<td class="right_none"><?php echo($o_user->getCompany())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>公司名称（英文）</span></td>
				<td class="right_none"><?php echo($o_user->getEnCompany())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>职务</span></td>
				<td class="right_none"><?php echo($o_user->getJob())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>职务（英文）</span></td>
				<td class="right_none"><?php echo($o_user->getEnJob())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>部门</span></td>
				<td class="right_none"><?php echo($o_user->getDept())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>部门（英文）</span></td>
				<td class="right_none"><?php echo($o_user->getEnDept())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>区号</span></td>
				<td class="right_none"><?php echo($o_user->getAreaNumber())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>直线</span></td>
				<td class="right_none"><?php echo($o_user->getCompanyPhone())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>总机</span></td>
				<td class="right_none"><?php echo($o_user->getTelephone())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>分机</span></td>
				<td class="right_none"><?php echo($o_user->getExtension())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>手机</span></td>
				<td class="right_none"><?php echo($o_user->getPhone())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>地区</span></td>
				<td class="right_none"><?php echo($o_user->getArea())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>省</span></td>
				<td class="right_none"><?php echo($o_user->getProvince())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>市</span></td>
				<td class="right_none"><?php echo($o_user->getCity())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>邮政编码</span></td>
				<td class="right_none"><?php echo($o_user->getPostcode())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>即时通讯</span></td>
				<td class="right_none"><?php echo($o_user->getQQ())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>SKYPE</span></td>
				<td class="right_none"><?php echo($o_user->getSkype())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>地址</span></td>
				<td class="right_none"><?php echo($o_user->getAddress())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>地址（英文）</span></td>
				<td class="right_none"><?php echo($o_user->getEnAddress())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>电邮</span></td>
				<td class="right_none"><?php echo($o_user->getEmail1())?>&nbsp;</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>电邮2</span></td>
				<td class="right_none"><?php echo($o_user->getEmail2())?>&nbsp;</td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>网址</span></td>
				<td class="right_none"><?php echo($o_user->getUrl())?>&nbsp;</td>
			</tr>

		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="goBack()">返回</div>
		</div>
		</div>
		</td>
	</tr>
</table>
</div>
</body>
</html>