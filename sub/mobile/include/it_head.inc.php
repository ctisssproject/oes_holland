<?php
error_reporting(0);
define ( 'RELATIVITY_PATH', '../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
if (isset ( $_COOKIE ['SESSIONID'] )) {

} else {
	echo ('<script>location=\''.RELATIVITY_PATH.'index.php\'+\'?url=\'+document.location</script>');
	exit ( 0 );
}
?>