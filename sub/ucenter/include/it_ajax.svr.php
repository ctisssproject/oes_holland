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
	case 'AdminState' ://改变管理员状态
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'AdminDelete' ://删除管理员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'StudentDelete' ://删除学员信息
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'StudentAllow' ://批准注册申请
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemNewsDelete' ://删除资讯
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemNewsState' ://设置新闻状态
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
	case 'SystemPartnersDelete' ://删除资讯
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemPartnersState' ://设置新闻状态
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemFocusDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemFocusState' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemVantageDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'SystemVantageState' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseGetNav2' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseGetNav3' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseTermDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseChapterDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseChangeType' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseTermPublish' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseChapterSetNumber' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSectionSetNumber' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSectionDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSectionDeleteForSearch' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSectionDeleteKey' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseGetChapter' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSubjectDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSubjectDeleteForSearch' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseGetSection' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsCredentialCheck' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsCredentialDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsInformationUseDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsPrizeExchangeCheck' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsGetSingleExpert' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsPrizeDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsPrizeState' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsInformationDelete' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'GoodsInformationState' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'CourseSearchSubmit' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );		
		break;
	default :
		break;
}
echo ($S_Request);
exit ( 0 );

function AdminState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->AdminState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function AdminDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->AdminDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function StudentDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->StudentDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function StudentAllow($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->StudentAllow($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemNewsDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemNewsDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemNewsState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemNewsState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemAdvertDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemAdvertDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemAdvertState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemAdvertState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemPartnersDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemPartnersDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemPartnersState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemPartnersState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemFocusDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemFocusDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemFocusState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemFocusState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemVantageDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemVantageDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function SystemVantageState($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->SystemVantageState($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function CourseGetNav2($n_termid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->CourseGetNav2($O_Session->getType (),$n_termid);
	$O_Request->setFunction ( 'nav1GoToCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function CourseGetNav3($n_chapterid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->CourseGetNav3($O_Session->getType (),$n_chapterid);
	$O_Request->setFunction ( 'nav2GoToCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function CourseTermDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->courseTermDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'courseTermDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function CourseChapterDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->courseChapterDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'courseChapterDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function CourseTermPublish($n_uid,$n_start) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseTermPublish($O_Session->getType (),$n_uid,$n_start);
	$O_Request->setFunction ( 'courseTermPublishCallback' );	
	$O_Request->PushParameter ($n_uid);
	$O_Request->PushParameter ($o_operate->N_UserCount);
	$O_Request->PushParameter ($o_operate->N_Start);
	return $O_Request->getSendXml ();
}
function CourseChapterSetNumber($n_chapterid,$n_number) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseChapterSetNumber($O_Session->getType (),$n_chapterid,$n_number);
	$O_Request->setFunction ( 'courseChapterDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function CourseSectionSetNumber($n_sectionid,$n_number) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSectionSetNumber($O_Session->getType (),$n_sectionid,$n_number);
	$O_Request->setFunction ( 'courseChapterDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function CourseSectionDelete($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->courseSectionDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'courseChapterDeleteCallback' );	
	return $O_Request->getSendXml ();
}
function CourseSectionDeleteForSearch($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->courseSectionDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'courseChapterDeleteCallback' );	
	$O_Request->PushParameter ( 'false');	
	return $O_Request->getSendXml ();
}
function CourseSubjectDeleteForSearch($n_uid) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSubjectDelete($O_Session->getType (),$n_uid);
	$O_Request->setFunction ( 'eval' );	
	return $O_Request->getSendXml ();
}
function CourseGetChapter($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->courseGetChapter($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'courseGetChapterCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function CourseGetSection($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->CourseGetSection($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'courseGetSectionCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function CourseSubjectDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSubjectDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsCredentialCheck($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsCredentialCheck($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsCredentialDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsCredentialDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsInformationUseDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsInformationUseDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsPrizeExchangeCheck($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsPrizeExchangeCheck($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsGetSingleExpert($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->GoodsGetSingleExpert($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'foodGetSingleExpertCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function GoodsPrizeDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsPrizeDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsPrizeState($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsPrizeState($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsInformationDelete($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsInformationDelete($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function GoodsInformationState($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->GoodsInformationState($O_Session->getType (),$n_id);
	$O_Request->setFunction ( 'location.reload' );	
	return $O_Request->getSendXml ();
}
function CourseSectionDeleteKey($n_id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSectionDeleteKey($O_Session->getType (),$n_id);
	return $O_Request->getSendXml ();
}
function CourseSearchSubmit($s_text,$s_key,$s_termid,$s_chapterid,$s_display) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->CourseSearchSubmit($O_Session->getType (),$s_text,$s_key,$s_termid,$s_chapterid,$s_display);
	$O_Request->setFunction ( 'courseSearchSubmitCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
function CourseChangeType($id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$s_html=$o_operate->CourseChangeType($O_Session->getType (),$id);
	$O_Request->setFunction ( 'courseChangeTypeCallback' );	
	$O_Request->PushParameter ($s_html);
	return $O_Request->getSendXml ();
}
?>