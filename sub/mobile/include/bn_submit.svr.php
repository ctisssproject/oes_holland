<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
header('Last-Modified:' . gmdate('D, d M Y H:i:s') . ' GMT');
header('content-type:text/html; charset=utf-8');
define('RELATIVITY_PATH', '../../../');//定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session();
$S_Function = $_GET['function'];
switch($S_Function)
{
   case 'DownloadTravel':
      DownloadTravel();
      break;
   default:
      break;
}
exit();
function DownloadTravel($id) {
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result=$o_operate->DownloadTravelForVisitor ();
	if($b_result==false)
	{
		echo('<script>parent.parent.Dialog_Error("您的下载过于频繁！<br/>请1分钟后再下载！")</script>');//错误
	}else{
		echo('<script>
     			parent.parent.Dialog_Success("该行程已经下载到您的邮箱！<br/>请查收！");
      		</script>');
	}
}
function ExamSubmit()
{
   sleep(1);
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->ExamSubmit($O_Session->getUid ()))
   {
   		if($o_operate->getResult())
   		{
   			echo('<script>
     			parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '",function(){parent.parent.successExam(1)});
      		</script>');
   		}else{
   			echo('<script>
     			parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '",function(){parent.parent.successExam()});
      		</script>');
   		}
      
   }
   else
   {
      echo('<script>
     			parent.parent.Dialog_Message("' . $o_operate->getErrorReasion() . '",function(){parent.parent.stopExam()});
      		</script>');
   }
}
?>