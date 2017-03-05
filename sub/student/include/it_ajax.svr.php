<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
$S_Request = '';
require_once RELATIVITY_PATH . 'include/bn_ajaxrequest.class.php';
$O_Request = new AjaxRequest ( $_GET ['xml'] );
switch ($O_Request->getFunction ()) {
	case 'CheckPasswordOld' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CredentialStyleModify' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	default :
		break;
}
echo ($S_Request);
exit ( 0 );
function CheckPasswordOld($s_password) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$O_Request->setFunction ( 'checkPasswordOldCallback' );	
	if ($o_operate->CheckPasswordOld ( $O_Session->getUid () ,$s_password)) {
		$O_Request->PushParameter ( 'true' );
	} else {
		$O_Request->PushParameter ( 'false' );
	}
	return $O_Request->getSendXml ();
}
function CredentialStyleModify($id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$O_Request->setFunction ( 'credentialStyleModifyCallback' );	
	$o_operate->CredentialStyleModify ( $O_Session->getUid () ,$id);
	return $O_Request->getSendXml ();
}
?>