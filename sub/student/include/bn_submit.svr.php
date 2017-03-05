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
   case 'InvitationFirend':
      InvitationFirend();//邀请好友
      break;
   case 'SendCredential':
      SendCredential();//邀请好友
      break;
   case 'SendCredentialForMobile':
      SendCredentialForMobile();//邀请好友
      break;
   case 'PrizeExchange':
      PrizeExchange();//邀请好友
      break;
   case 'PrizeExchangeForMobile':
      PrizeExchangeForMobile();//邀请好友
      break;
   case 'InformationUseForMobile':
      InformationUseForMobile();//邀请好友
      break;
   case 'ShareFirend':
      ShareFirend();//邀请好友
      break;
   case 'ModifyInfo':
      ModifyInfo();//修改个人信息
      break;
   case 'ModifyPassword':
      ModifyPassword();//修改登陆密码
      break;
   case 'ModifyPhoto':
      ModifyPhoto();//修改头像
      break;
   case 'ExamSubmit':
      ExamSubmit();//修改头像
      break;
   case 'ExamSubmitForMobile':
      ExamSubmitForMobile();//修改头像
      break;
   case 'InformationUse':
      InformationUse();//修改头像
      break;
   default:
      break;
}
exit();
function InvitationFirend()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->InvitationFirend($O_Session->getUid ()))
   {
      echo('<script>parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '")</script>');//成功
   }
   else
   {   	
      echo('<script>parent.parent.Dialog_Error("' . $o_operate->getErrorReasion() . '")</script>');//错误
   }
}
function ShareFirend()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->ShareFirend($O_Session->getUid ()))
   {
      echo('<script>parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '")</script>');//成功
   }
   else
   {   	
      echo('<script>parent.parent.Dialog_Error("' . $o_operate->getErrorReasion() . '")</script>');//错误
   }
}
function SendCredential()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->SendCredential($O_Session->getUid ()))
   {
      echo('<script>parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '")</script>');//成功
   }
   else
   {   	
      echo('<script>parent.parent.Dialog_Error("' . $o_operate->getErrorReasion() . '")</script>');//错误
   }
}
function SendCredentialForMobile()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->SendCredential($O_Session->getUid ()))
   {
      echo('<script>
      	parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/ucenter.php\';
      	</script>');//成功
   }
   else
   {   	
      echo('<script>
      	parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/ucenter.php\';
      	</script>');//错误
   }
}
function PrizeExchange()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->PrizeExchange($O_Session->getUid ()))
   {
      echo('<script>parent.parent.$("#user_vantage").html("'.$_POST['Vcl_PrizeId'].'");parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '");</script>');//成功
   }
   else
   {   	
      echo('<script>parent.parent.Dialog_Error("' . $o_operate->getErrorReasion() . '")</script>');//错误
   }
}
function PrizeExchangeForMobile()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->PrizeExchange($O_Session->getUid ()))
   {
      echo('<script>
      	parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/prize.php\';
      	</script>');//成功
   }
   else
   {   	
      echo('<script>
      	parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/prize.php\';
      	</script>');//错误
   }
}
function InformationUse()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->InformationUse($O_Session->getUid ()))
   {
      echo('<script>parent.parent.Dialog_Success("' . $o_operate->getErrorReasion() . '");</script>');//成功
   }
   else
   {   	
      echo('<script>parent.parent.Dialog_Error("' . $o_operate->getErrorReasion() . '")</script>');//错误
   }
}
function InformationUseForMobile()
{
   global $O_Session;
   require_once 'bn_operate.class.php';
   $o_operate = new Operate();   
   if($o_operate->InformationUse($O_Session->getUid ()))
   {
      echo('<script>
      	parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/information.php\';
      	</script>');//成功
   }
   else
   {   	
      echo('<script>
      	parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/information.php\';
      	</script>');//错误
   }
}
function ModifyPassword()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->ModifyPassword($O_Session->getUid ());
   if($b_submit)
   {
   		//修改个人信息成功
   		if ($_POST['Vcl_ComeFrom']=='travel')
   		{
   			echo('<script>
     			parent.Dialog_Success("' . $o_user->getErrorReasion() . '",function(){parent.location=\'/sub/travel/index.php\'});
      		</script>');
   		}else
   		{
      echo('<script>
     			parent.Dialog_Success("' . $o_user->getErrorReasion() . '",function(){parent.location=\'/sub/student/index.php\'});
      		</script>');
   		}
   }
   else
   {
      echo('<script>
     			parent.Dialog_Error("' . $o_user->getErrorReasion() . '");
      		</script>');
   }
}
function ModifyInfo()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->ModifyInfo($O_Session->getUid ());
   if($b_submit)
   {
   		//修改个人信息成功
      echo('<script>
     			parent.Dialog_Success("' . $o_user->getErrorReasion() . '",function(){parent.location=\'/sub/student/index.php\'});
      		</script>');
   }
   else
   {
      echo('<script>
     			parent.Dialog_Error("' . $o_user->getErrorReasion() . '");
      		</script>');
   }
}
function ModifyPhoto()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->ModifyPhoto($O_Session->getUid ());
   if($b_submit)
   {
   		//修改个人信息成功
      echo('<script>
     			parent.Dialog_Success("' . $o_user->getErrorReasion() . '",function(){parent.location=\'/sub/student/index.php\'});
      		</script>');
   }
   else
   {
      echo('<script>
     			parent.Dialog_Error("' . $o_user->getErrorReasion() . '");
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
function ExamSubmitForMobile()
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
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\'/sub/mobile/credential.php\';
      		</script>');
   		}else{
   			echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\''.$_POST['Vcl_BackUrl'].'\';
      		</script>');
   		}
      
   }
   else
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_operate->getErrorReasion()) . '");parent.location=\''.$_POST['Vcl_BackUrl'].'\';
      		</script>');
   }
}
?>