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
require_once RELATIVITY_PATH . 'include/db_view.class.php ';
$S_Filename = '寄送专家证书列表.csv';
OutputList ();

$file_name = 'credential.csv';
$file_dir = RELATIVITY_PATH . '/sub/ucenter/output/';
$rename = rawurlencode ( $S_Filename );
if (! file_exists ( $file_dir . $file_name )) { //检查文件是否存在
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
function OutputList() {
	$fp = fopen ( 'output/credential.csv', 'w' );
	SetTotalInfo ( '发货日期','姓名','地址', '电话', '邮箱', '物品名称', $fp );
	$o_send = new Goods_Send ();
	$o_send->PushWhere ( array ('&&', 'Type', '=', 1 ) );
	$o_send->PushWhere ( array ('&&', 'State', '=', 3 ) );
	$o_send->PushOrder ( array ('Date', 'A' ) );
	$n_count=$o_send->getAllCount();
	for($i=0;$i<$n_count;$i++)
	{
		$o_user=new User($o_send->getUid($i));
		SetTotalInfo ( $o_send->getDate($i),$o_send->getName($i),$o_send->getAddress($i),$o_send->getPhone($i),$o_user->getUserName(),'荷兰旅游专家证书',$fp );
	}
	fclose ( $fp );
}

function SetTotalInfo($var1, $var2, $var3, $var4, $var5, $var6, $file) {
	$a_item = array ();
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var1 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var2 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var3 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var4 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var5 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var6 ) );
	fputcsv ( $file, $a_item );
}
?>