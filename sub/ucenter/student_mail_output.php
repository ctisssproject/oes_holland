<?php
define ( 'RELATIVITY_PATH', '../../' ); //定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false) //如果没有注册，跳转到首页
{
	echo ('非法操作');
	exit ( 0 );
}
if ($O_Session->getType () != 1) //如果不是系统管理员
{
	echo ('非法操作');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php ';
$S_Filename = '收件人列表.csv';
$o_mailrecord=new MailRecord($_GET ['id']);
$file_name = $o_mailrecord->getCsv();
$file_dir = RELATIVITY_PATH . '/sub/ucenter/output/';
$rename = rawurlencode ( $S_Filename );
if (! file_exists ( $file_dir . $file_name )) { //检查文件是否存在
	header ( 'Cache-Control: no-cache' );
	header ( 'Pragma: no-cache' );
	header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
	header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
	header ( 'content-type:text/html; charset=utf-8' );
	echo "对不起,您要下载的文件不存在";
	exit ();
} else {
	// 一下是php文件下载的重点
	Header ( "Content-type: application/octet-stream" );
	Header ( "Accept-Ranges: bytes" );
	Header ( "Content-Type: application/force-download" ); //强制浏览器下载
	Header ( "Content-Disposition: attachment; filename=" . $rename ); //重命名文件
	Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) ); //文件大小
	// 读取文件内容
	@readfile ( $file_dir . $file_name ); //加@不输出错误信息
}
?>