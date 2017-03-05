<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false) //如果没有注册，跳转到首页
{
	echo ('<script type="text/javascript">parent.parent.location=\'' . RELATIVITY_PATH . 'index.php?out=true\';</script>');
	echo ('<script type="text/javascript">parent.location=\'' . RELATIVITY_PATH . 'index.php?out=true\';</script>');
	echo ('<script type="text/javascript">location=\'' . RELATIVITY_PATH . 'index.php?out=true\';</script>');
	exit ( 0 );
}
if ($O_Session->getType () != 1 && $O_Session->getType () != 2) //如果不是系统管理员
{
	echo ('<script type="text/javascript">parent.parent.location=\'' . RELATIVITY_PATH . 'index.php\';</script>');
	echo ('<script type="text/javascript">parent.location=\'' . RELATIVITY_PATH . 'index.php\';</script>');
	echo ('<script type="text/javascript">location=\'' . RELATIVITY_PATH . 'index.php\';</script>');
	exit ( 0 );
}
$o_send = new Goods_Send ( $_GET ['id'] );
$o_user=new User($o_send->getUid());
//构建目的地
$s_mudidi='';
if ($o_user->getProvince()=='')
{
	if($o_user->getCity()=='')
	{
		//都没有，就读取地址的前三个字
		$s_mudidi=$o_send->getAddress();
		$s_mudidi=substr($s_mudidi, 0,9);
	}else{
		$s_mudidi=$o_user->getCity();
	}
}else{
	$s_mudidi=$o_user->getProvince();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
        div
        {
        	position: absolute;
        	top:0px;
        	left:0px;
            font-family:楷体_GB2312,楷体; 
        	font-size: 18px;
        	vertical-align:top;
        	text-align:left;
        }
    </style>
</head>
<body>
<div style="top:27px;left:90px;"></div>
<div style="top:27px;left:247px;">北京安贞</div>
<div style="top:58px;left:60px;">荷兰旅游会议促进局北京代表处</div>
<div style="top:96px;left:18px;width:330px;vertical-align:top;line-height:32px"></div>
<div style="left:258px;top:141px;font-size: 16px;"></div>
<div style="left:50px;top:150px;">010-64974968</div>
<div style="left:232px;top:171px;"></div>
<div style="left:450px;top:23px;width:100px"><?php echo($o_send->getName())?></div>
<div style="top:23px;left:607px;width:100px"><?php echo($s_mudidi)?></div>
<div style="top:54px;left:420px;width:330px"><?php echo($o_user->getCompany())?>-<?php echo($o_user->getDept())?></div>
<div style="top:82px;left:368px;width:330px;vertical-align:top;line-height:32px">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($o_send->getAddress())?> </div>
<div style="left:400px;top:146px;width:200px"><?php echo($o_send->getPhone())?></div>
<script type="text/javascript">
window.onbeforeunload = function () {
	window.open('/sub/ucenter/goods_send_print_credential.php?id=<?php echo($_GET ['id'])?>','newwindow','height=400,width=500');
    return '如果需要打印证书，请点击“留在此页上”,您需要打印的证书模板名称为“<?php 
    $o_user=new View_User_Credential($o_send->getUid());    
    echo($o_user->getCredentialName())?>”';
}
window.print();
//function openPrintInfo(id)  
//{  
	//window.open('/oes/sub/ucenter/goods_send_print_credential.php?id='+id,'newwindow','height=400,width=500'); 
	//window.alert();
     
//}

</script>
</body>
</html>
