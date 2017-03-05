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
            font-family:方正大黑简体,黑体,楷体; 
        	font-size: 43px;
        	vertical-align:top;
        	text-align:center;
        }
    </style>
</head>
<body>
<div style="top:287px;left:245px;width:135px;"><?php echo($o_send->getName())?></div>
<script type="text/javascript">
window.print();
</script>
</body>
</html>
