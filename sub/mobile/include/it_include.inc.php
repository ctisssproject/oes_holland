<?php
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false) //如果没有注册，跳转到首页
{
	echo ('<script type="text/javascript">parent.location=\'index.php?out=true\'</script>');
	echo ('<script type="text/javascript">location=\'index.php?out=true\'</script>');	
	exit (0);
}
/*if ($O_Session->getType () < 3) //如果不是学员
{
	echo ('<script type="text/javascript">parent.location=\''.RELATIVITY_PATH.'index.php\'</script>');
	echo ('<script type="text/javascript">location=\''.RELATIVITY_PATH.'index.php\'</script>');	
	exit (0);
}*/
?>