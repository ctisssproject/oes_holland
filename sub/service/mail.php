<?php
if ($_POST ['password'] != '1qaz2wsx3edc') {
	exit ( 0 );
}
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
define ( 'RELATIVITY_PATH', '../../' );
require_once RELATIVITY_PATH . 'include/db_table.class.php';
if ($_POST ['send'] != '') {
	$o_send = new Mail ($_POST ['send']);
	$o_send->setIsSend(1);
	$o_date = new DateTime ( 'Asia/Chongqing' );
	$o_send->setSendDate($o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' ) . ' ' . $o_date->format ( 'H' ) . ':' . $o_date->format ( 'i' ) . ':' . $o_date->format ( 's' ));
	$o_send->Save();
	$s_html='sended';
} else {
	$o_send = new Mail ();
	$o_send->PushWhere ( array ('&&', 'IsSend', '=', 0 ) ); //查询所有未发送的邮件
	$o_send->PushWhere ( array ('&&', 'ToMail', '<>', '' ) ); //查询所有未发送的邮件
	$o_send->PushOrder ( array ('MailId', 'A' ) );
	$o_send->setStartLine ( 0 ); //起始记录
	$o_send->setCountLine ( 1 );
	$n_count = $o_send->getAllCount ();
	$n_count = $o_send->getCount ();
	if ($n_count > 0) {
		$s_html = rawurlencode ( $o_send->getMailId ( 0 ) ) . '<1>' . rawurlencode ( $o_send->getToMail ( 0 ) ) . '<1>' . rawurlencode ( $o_send->getTitle ( 0 ) ) . '<1>' . rawurlencode ( $o_send->getContent ( 0 )). '<1>' . rawurlencode ( $o_send->getFromMail ( 0 ));
	} else {
		$s_html = '';
	}
}
echo ($s_html)?>
