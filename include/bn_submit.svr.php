<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
header('Last-Modified:' . gmdate('D, d M Y H:i:s') . ' GMT');
header('content-type:text/html; charset=utf-8');
define('RELATIVITY_PATH', '../');//定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session();
$S_Function = $_GET['function'];
switch($S_Function)
{
   case 'Login':
      Login();
      break;
   case 'LoginForMobile':
      LoginForMobile();
      break;
   case 'Register':
      Register();
      break;
   case 'RegisterForMobile':
      RegisterForMobile();
      break;
   case 'ValidCode':
      ValidCode();
      break;
   case 'UpLoadPicture':
      UpLoadPicture();
      break;
	case 'UploadTempFile' :
		UploadTempFile ();
		break;
	case 'UploadAffixFile' :
		UploadAffixFile ();
		break;
	case 'FindPassword' :
		FindPassword ();
		break;
	case 'FindPasswordForMobile' :
		FindPasswordForMobile ();
		break;
	case 'ModifyPasswordForMobile' :
		ModifyPasswordForMobile();
		break;
	case 'ModifyPhotoForMobile' :
		ModifyPhotoForMobile();
		break;
	case 'ModifyInfoForMobile' :
		ModifyInfoForMobile();
		break;
   default:
      break;
}
exit();
function UpLoadPicture() {
	$O_Session = new Session();
	require_once RELATIVITY_PATH . 'include/bn_user.class.php';
	$o_user = $O_Session->getUserObject ();
	$o_user->UpLoadPicture ();

}
function ValidCode()
{
	include_once RELATIVITY_PATH . 'include/it_seccode.class.php';
	$code = new seccode ();
	$code->code = $_GET ['parameter'];
	$code->type = 0;
	$code->background = 0;
	$code->adulterate = 1;
	$code->ttf = 1;
	$code->angle = 0;
	$code->color = 1;
	$code->size = 0;
	$code->shadow = 1;
	$code->animator = 0;
	$code->fontpath = RELATIVITY_PATH . 'images/fonts/';
	$code->datapath = RELATIVITY_PATH . 'images/';
	$code->includepath = '';
	$code->display ();
}
function Login()
{
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $s_result=$o_user->Login();
   if($s_result)
   {
   		if ($_POST['Vcl_Url']!='')
   		{
   			echo('<script type="text/javascript" language="javascript">parent.window.open(\''.$_POST['Vcl_Url'].'\',\'_parent\');</script>');
   			return;
   		}
   		if ($o_user->getType()==1)
   		{
   			//管理员
   			echo('<script type="text/javascript" language="javascript">parent.window.open(\''.RELATIVITY_PATH.'sub/ucenter/index.php\',\'_parent\');</script>');
   		} 
   		if ($o_user->getType()==2)
   		{
   			//库管
   			echo('<script type="text/javascript" language="javascript">parent.window.open(\''.RELATIVITY_PATH.'sub/release/index.php\',\'_parent\');</script>');
   		}   
   		if ($o_user->getType()>=3)
   		{
   			//学员
   			echo('<script type="text/javascript" language="javascript">parent.window.open(\''.RELATIVITY_PATH.'sub/student/index.php\',\'_parent\');</script>');
   		}     
   }
   else 
   {
   		echo('<script>parent.Dialog_Error("' . $o_user->getErrorReasion() . '<br/><br/><a style=\"color:#1FAECD\" href=\"findpassword.php\">忘记密码？现在找回？</a>")</script>');
   }
}
function LoginForMobile()
{
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $s_result=$o_user->Login();
   if($s_result)
   {
   		if ($o_user->getType()>=3)
   		{
   			//学员
   			echo('<script type="text/javascript" language="javascript">parent.window.open(\''.RELATIVITY_PATH.'sub/mobile/ucenter.php\',\'_parent\');</script>');
   		}     
   }
   else 
   {
   		echo('<script>parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.Common_CloseDialog();</script>');
   }
}
function Register()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->Register();
   if($b_submit)
   {
   		//分析邮箱
   		$s_mail= explode ( "@", $_POST ['Vcl_UserName'] );
   		$s_mail='http://mail.'.$s_mail[1];
   		if($_POST['Vcl_ComeFrom']=='travel')
   		{
   			echo('<script>parent.location=\'../sub/travel/register_3.php?email='.rawurlencode($s_mail).'\'</script>');
   		}else{
   			echo('<script>parent.location=\'../register_3.php?email='.rawurlencode($s_mail).'\'</script>');
   		}      
   }
   else
   {
      echo('<script>
     			parent.Dialog_Error("' . $o_user->getErrorReasion() . '");parent.Common_CloseDialog();
      		</script>');
   }
}
function RegisterForMobile()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->Register();
   if($b_submit)
   {
   		//分析邮箱
   		$s_mail= explode ( "@", $_POST ['Vcl_UserName'] );
   		$s_mail='http://mail.'.$s_mail[1];
   		echo('<script>parent.location=\''.$_POST ['Vcl_Url'].'register_3.php?email='.rawurlencode($s_mail).'\'</script>');   
   }
   else
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.Common_CloseDialog();
      		</script>');
   }
}
function FindPassword()
{
   global $O_Session;
   //echo('<script>parent.window.alert("用户名密码错误")</script>');
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->FindPassword();
   if($b_submit)
   {
   		//分析邮箱
   		$s_mail= explode ( "@", $_POST ['Vcl_UserName_F'] );
   		$s_mail='http://mail.'.$s_mail[1];
      echo('<script>parent.Dialog_Success("' . $o_user->getErrorReasion() . '",function(){parent.location=\''.$s_mail.'\'})</script>');
   }
   else
   {
      echo('<script>
     			parent.Dialog_Error("' . $o_user->getErrorReasion() . '");
      		</script>');
   }
}
function FindPasswordForMobile()
{
   global $O_Session;
   //echo('<script>parent.window.alert("用户名密码错误")</script>');
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->FindPassword();
   if($b_submit)
   {
   		//分析邮箱
   		$s_mail= explode ( "@", $_POST ['Vcl_UserName_F'] );
   		$s_mail='http://mail.'.$s_mail[1];
      echo('<script>parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.location=\''.$s_mail.'\'</script>');
   }
   else
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.Common_CloseDialog();
      		</script>');
   }
}
function ModifyPasswordForMobile()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->ModifyPassword($O_Session->getUid ());
   if($b_submit)
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.location=\'/sub/mobile/ucenter.php\';
      		</script>');
   }
   else
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");
      		</script>');
   }
}
function ModifyPhotoForMobile()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->ModifyPhoto($O_Session->getUid ());
   if($b_submit)
   {
   		//修改个人信息成功
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.location=\'/sub/mobile/ucenter.php\';
      		</script>');
   }
   else
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");
      		</script>');
   }
}
function UploadTempFile() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_user = $O_Session->getUserObject ();
	$s_result = $o_operate->UploadTempFile ( $O_Session->getUid () );
	if ($o_operate->getResult () == false) {
		echo ('<script type="text/javascript" language="javascript">parent.goLoginPage(\'' . RELATIVITY_PATH . '\')</script>');
	} else if ($s_result == 1) {
		echo ('<script type="text/javascript" language="javascript">parent.parent.uploadTempFileCallback("对不起，<br>已经存在这个文件！")</script>');
	} else if ($s_result == 2) {
		echo ('<script type="text/javascript" language="javascript">parent.parent.uploadTempFileCallback("对不起，您的空间不足！")</script>');
	}else if ($s_result == 3) {
		echo ('<script type="text/javascript" language="javascript">parent.parent.uploadTempFileCallback("对不起<br/>上传文件不能为空！")</script>');
	}else {
		echo ('');
	}
}
function UploadAffixFile() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_result = $o_operate->UploadAffixFile ( $O_Session->getUid () );
	if ($o_operate->getResult () == false) {
		echo ('<script type="text/javascript" language="javascript">parent.goLoginPage(\'' . RELATIVITY_PATH . '\')</script>');
	} else {
		echo ('<script type="text/javascript" language="javascript">parent.uploadAffixSuccessCallback(\''.$s_result.'\')</script>');
	}
}
function ModifyInfoForMobile()
{
   global $O_Session;
   require_once RELATIVITY_PATH . 'include/bn_user.class.php';
   $o_user = new Single_User();
   $b_submit = $o_user->ModifyInfo($O_Session->getUid ());
   if($b_submit)
   {
   		//修改个人信息成功
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");parent.location=\'/sub/mobile/ucenter.php\';
      		</script>');
   }
   else
   {
      echo('<script>
     			parent.window.alert("' . str_replace('<br/>', '\n', $o_user->getErrorReasion()) . '");
      		</script>');
   }
}
?>