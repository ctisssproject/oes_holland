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
	case 'CityDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'HotelDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'RegionDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'RegionPhotoDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelTitleDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelGetNav2' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelGetNav3' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelItemDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelItemSetNumber' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelGetRegion' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelGetHotel' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelDetailDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'TravelTypeDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemAdvertDelete' ://删除资讯
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemAdvertState' ://设置新闻状态
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	default :
		break;
}
echo ($S_Request);
exit ( 0 );

function CityDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CityDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function HotelDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->HotelDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function RegionDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->RegionDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function TravelTitleDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->TravelTitleDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'travelTitleDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function RegionPhotoDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->RegionPhotoDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function TravelGetNav2($n_termid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->TravelGetNav2($O_Session->getType (),$n_termid);
	$O_Request->setFunction ( 'nav1GoToCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function TravelGetNav3($n_chapterid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->TravelGetNav3($O_Session->getType (),$n_chapterid);
	$O_Request->setFunction ( 'nav2GoToCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function TravelItemDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->TravelItemDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'travelItemDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function TravelItemSetNumber($n_chapterid,$n_number) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->TravelItemSetNumber($O_Session->getType (),$n_chapterid,$n_number);
	$O_Request->setFunction ( 'travelItemDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function TravelGetRegion($n_id,$n_typeid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->TravelGetRegion($O_Session->getType (),$n_id,$n_typeid);
	$O_Request->setFunction ( 'travelSelectCityCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function TravelGetHotel($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->TravelGetHotel($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'travelSelectCityForHotelCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function TravelDetailDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->TravelDetailDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'travelDetailDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function TravelTypeDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->TravelTypeDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemAdvertState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->AdvertState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemAdvertDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->AdvertDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
?>