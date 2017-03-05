<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
define ( 'RELATIVITY_PATH', '../' ); //定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
$S_Request = '';
require_once RELATIVITY_PATH . 'include/bn_ajaxrequest.class.php';
$O_Request = new AjaxRequest ( $_GET ['xml'] );
switch ($O_Request->getFunction ()) {
	case 'Logout' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CheckUserName' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CheckValidCode' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CheckInvitation' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'DelUpLoadPictureForEditor' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'RefreshPictureListForEditor' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SendMail' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'AltGetCompany' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;		
	default :
		break;
}
echo ($S_Request);
exit ( 0 );

function Logout() {
	global $O_Session;
	global $O_Request;
	require_once RELATIVITY_PATH . 'include/bn_user.class.php';
	$o_user = $O_Session->getUserObject ();
	$o_user->Logout ( $_COOKIE ['SESSIONID'] );
	$O_Request->setFunction ( 'parent.location.reload' );
	return $O_Request->getSendXml ();
}
function DelUpLoadPictureForEditor($n_id) {
	global $O_Session;
	global $O_Request;
	require_once RELATIVITY_PATH . 'include/bn_user.class.php';
	$o_user = $O_Session->getUserObject ();
	$o_user->DelUpLoadPicture ( $n_id );
	$O_Request->setFunction ( 'Editor_SetPhotoFreeSplace' );
	$O_Request->PushParameter ( $o_user->getPhotoFreeSplace () );
	return $O_Request->getSendXml ();
}
function RefreshPictureListForEditor() {
	//刷新文本编辑器的图片列表
	global $O_Session;
	global $O_Request;
	require_once RELATIVITY_PATH . 'include/bn_user.class.php';
	$o_user = $O_Session->getUserObject ();
	$s_photolist = $o_user->getPictrueListForAjax ();
	$O_Request->setFunction ( 'Editor_BulidPhotoList' );
	$O_Request->PushParameter ( $s_photolist );
	return $O_Request->getSendXml ();
}
function CheckUserName($s_username) {
	global $O_Session;
	global $O_Request;
	require_once RELATIVITY_PATH . 'include/bn_user.class.php';
	$o_user = new Single_User ();
	$O_Request->setFunction ( 'checkUserNameCallback' );
	$O_Request->PushParameter ( $o_user->CheckUserName ( $s_username ) );
	return $O_Request->getSendXml ();
}
function CheckValidCode($s_code) {
	global $O_Session;
	global $O_Request;
	$O_Request->setFunction ( 'checkValidCodeCallback' );
	if (strtoupper ( $s_code ) == $_COOKIE ['VALIDCODE']) {
		$O_Request->PushParameter ( 'true' );
	} else {
		$O_Request->PushParameter ( 'false' );
	}
	return $O_Request->getSendXml ();
}
function CheckInvitation($s_code) {
	global $O_Session;
	global $O_Request;
	require_once RELATIVITY_PATH . 'include/db_table.class.php';
	$O_Request->setFunction ( 'checkInvitationCallback' );
	$o_inv = new Invitation ();
	$o_inv->PushWhere ( array ('&&', 'State', '=', 1 ) );
	$o_inv->PushWhere ( array ('&&', 'CodeId', '=', $s_code ) );
	if ($o_inv->getAllCount () > 0) {
		$O_Request->PushParameter ( 'true' );
	} else {
		$O_Request->PushParameter ( 'false' );
	}
	return $O_Request->getSendXml ();
}
function SendMail() {
	global $O_Request;
	$o_send = new Mail ();
	$o_send->PushWhere ( array ('&&', 'IsSend', '=', 2 ) );
	$o_send->PushWhere ( array ('&&', 'ToMail', '<>', '' ) );
	$o_send->PushOrder ( array ('MailId', 'A' ) );
	$o_send->setStartLine ( 0 );
	$o_send->setCountLine ( 1 );
	$n_count = $o_send->getAllCount ();
	$n_count = $o_send->getCount ();
	if ($n_count > 0) {
		//发送邮件
		$o_edm = new Edm ( 1 );
		$jmail = new COM ( 'JMail.Message' );
		$jmail->Charset = "GB2312";
		
		$s_tomail = $o_send->getToMail ( 0 ) . '123456';		
		$temp = explode ( '@126.com', $s_tomail );
		if (count ( $temp ) > 1) {
			$jmail->ContentTransferEncoding = "GB2312"; //如果邮箱为126.com，则加入这个
		}else{
			$jmail->ContentTransferEncoding = "base64";
		}
		$jmail->Encoding = "base64";
		$jmail->ContentType = "text/html";
		$jmail->Silent = true;
		$jmail->Logging = true;
		$s_temp='荷兰国家旅游会议促进局';
		$jmail->FromName = mb_convert_encoding ($s_temp, 'GB2312', 'UTF-8' );
		$s_temp2=$o_send->getFromMail ( 0 );
		$jmail->From = mb_convert_encoding ( $s_temp2, 'GB2312', 'UTF-8' );
		$s_temp3=$o_send->getTitle ( 0 );
		$s_temp3= mb_convert_encoding ( $s_temp3, 'GB2312', 'UTF-8' );
		$jmail->Subject = trim($s_temp3);
		$jmail->AddRecipient ( $o_send->getToMail ( 0 ) );
		$jmail->MailServerUserName = $o_send->getFromMail ( 0 );
		$jmail->MailServerPassword = 'nbtcbeijing2013';
		
		//处理hotmail邮件内容乱码
		$s_tomail = $o_send->getToMail ( 0 ) . '123456';		
		$temp = explode ( '@hotmail.com', $s_tomail );
		if (count ( $temp ) > 1) {
			//如果是hotmail的邮箱，加入编码
			$jmail->Body = mb_convert_encoding ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" /></head><body>' . $o_send->getContent ( 0 ) . '</body></html>', 'GB2312', 'UTF-8' );
		}else{
			$jmail->Body = mb_convert_encoding ( $o_send->getContent ( 0 ), 'GB2312', 'UTF-8' );
		}		
		$jmail->Send ( 'smtp.exmail.qq.com' );
		$jmail->Close ();
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_date = $o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' ) . ' ' . $o_date->format ( 'H' ) . ':' . $o_date->format ( 'i' ) . ':' . $o_date->format ( 's' );
		$s_html = $o_date . '：向用户 ' . $o_send->getToMail ( 0 ) . ' 成功发送一次邮件《' . $o_send->getTitle ( 0 ) . '》<br/>';
		$o_send = new Mail ( $o_send->getMailId ( 0 ) );
		$o_send->setIsSend ( 1 );
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_send->setSendDate ( $o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' ) . ' ' . $o_date->format ( 'H' ) . ':' . $o_date->format ( 'i' ) . ':' . $o_date->format ( 's' ) );
		$o_send->Save ();
		
	} else {
		$s_html = 0;
	}
	$O_Request->setFunction ( 'sendmailCallback' );
	$O_Request->PushParameter ( $s_html );
	return $O_Request->getSendXml ();
}
function AltGetCompany($id,$value) {
	global $O_Session;
	global $O_Request;
	$O_Request->setFunction ( 'altGetCallback');
	$O_Request->PushParameter ( $id );
	$s_html='';
	$o_user=new User();
	$o_user->PushWhere ( array ('&&', 'Type', '>', 2 ) );
	$o_user->PushWhere ( array ('&&', 'Company', 'LIKE', $value . '%' ) );
	$o_user->PushOrder ( array ('Company', 'A' ) );
	$o_user->PushOrder ( array ('Uid', 'D' ) );
	$n_count = $o_user->getAllCount ();
	$n_sum=0;
	$temp='';
	for($i=0;$i<$n_count;$i++)
	{
		if ($n_sum>9)
		{
			break;
		}
		if ($temp==$o_user->getCompany($i))
		{
			continue;
		}else{
			$s_html.='<li onclick="altSet(this)">'.$o_user->getCompany($i).'</li>';
			$temp=$o_user->getCompany($i);
			$n_sum++;
		}		
	}
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
?>