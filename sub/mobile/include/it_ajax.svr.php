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
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$O_Request = new AjaxRequest ( $_GET ['xml'] );
switch ($O_Request->getFunction ()) {
	case 'GetTitle' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	case 'DownTravel' :
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	default :
		break;
}
echo ($S_Request);
exit ( 0 );
function DownTravel($id) {
	global $O_Session;
	global $O_Request;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result=$o_operate->DownTravel ( $O_Session->getUid () ,$id);
	if($b_result==false)
	{
		$O_Request->setFunction ( 'Dialog_Error' );	
		$O_Request->PushParameter ('您的下载过于频繁！<br/>请1分钟后再下载！');
	}else{
		$O_Request->setFunction ( 'Dialog_Success' );	
		$O_Request->PushParameter ('该行程已经下载到您的邮箱！<br/>请查收！');
	}
	
	return $O_Request->getSendXml ();
}
function GetTitle($n_typeid, $n_number) {
	global $O_Request;
	require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
	$o_operate=new Bn_Basic();
	$O_Request->setFunction ( 'extensionCallback' );
	$O_Request->PushParameter ( $n_typeid );
	$o_type=new Travel_Type($n_typeid);
	//读取行程
	$o_travel = new Travel_Title ();
	$o_travel->PushWhere ( array ('&&', 'TypeId', '=', $o_type->getTypeId () ) );
	$o_travel->PushWhere ( array ('&&', 'TitleId', '<>', $o_type->getTitleId () ) );
	$o_travel->PushWhere ( array ('&&', 'State', '=', 1 ) );
	$o_travel->PushOrder ( array ('Date', 'D' ) );
	$o_travel->setStartLine ($n_number); //起始记录
	$o_travel->setCountLine (3);
	$n_countall = $o_travel->getAllCount ();
	$n_count2 = $o_travel->getCount ();
	//循环输出六个行程
	for($j = 0; $j < $n_count2; $j ++) {
		$s_style2 = ' style="margin-right:35px;display:none;"';
		if (($j + 1) % 3 == 0) {
			$s_style2 = ' style="display:none;"';
		}
		$s_html.='
							      	 <div class="mini_box"' . $s_style2 . '>
                            			<a href="content.php?id='.$o_travel->getTitleId($j).'" target="_blank" hidefocus="true"><img alt="" src="' . $o_travel->getPhotoOn ( $j ) . '" /></a>
                                		<div class="explain">
                                			' . $o_travel->getName ( $j ) . '
                                		</div>
                                		<div class="travel_number">
                                		'.$o_operate->TravelNumberFormat($o_travel->getTitleId($j)).'
                                		</div>
                                		<div class="button_1" onclick="window.open (\'content.php?id='.$o_travel->getTitleId($j).'\', \'_blank\')">
                                			详细行程
                                		</div>
                            		</div>
							';
	}
	$O_Request->PushParameter ( $s_html );
	//判断是否后面还有
	$o_travel = new Travel_Title ();
	$o_travel->PushWhere ( array ('&&', 'TypeId', '=', $o_type->getTypeId () ) );
	$o_travel->PushWhere ( array ('&&', 'TitleId', '<>', $o_type->getTitleId () ) );
	$o_travel->PushWhere ( array ('&&', 'State', '=', 1 ) );
	$o_travel->PushOrder ( array ('Date', 'D' ) );
	$o_travel->setStartLine ($n_number+3); //起始记录
	$o_travel->setCountLine (3);
	$n_countall = $o_travel->getAllCount ();
	$n_count2 = $o_travel->getCount ();
	$O_Request->PushParameter ($n_count2);
	return $O_Request->getSendXml ();
}
?>