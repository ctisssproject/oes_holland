<?php
define ( 'RELATIVITY_PATH', '../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
function getTimeType($start,$end)
        {
        	if (intval($end)<=9)
        	{
        		return '早餐：';
        	}
        	if (intval($start)>=20)
        	{
        		return '晚上：';
        	}
        	if (intval($start)>=18)
        	{
        		return '晚餐：';
        	}
        	if (intval($start)>=14)
        	{
        		return '下午：';
        	}
        	if (intval($start)>=12)
        	{
        		return '午餐：';
        	}
        	if (intval($start)>=9)
        	{
        		return '上午：';
        	}
        	return'&nbsp;';
        }
		function getTimeType2($start,$end)
        {
        	if (intval($end)<=9)
        	{
        		return '早餐：';
        	}
        	if (intval($start)>=9&& intval($end)<=12)
        	{
        		return '上午：';
        	}
        	if (intval($start)>=12&& intval($end)<=14)
        	{
        		return '午餐：';
        	}
        	if (intval($start)>=14&& intval($end)<=18)
        	{
        		return '下午：';
        	}
        	if (intval($start)>=18&& intval($end)<=20)
        	{
        		return '晚餐：';
        	}
        	if (intval($start)>=20)
        	{
        		return '晚上：';
        	}
        	return'&nbsp;';
        }
	function isMobile()
	{
		$http_user_agent = isset ( $_SERVER ['HTTP_USER_AGENT'] ) ? strtolower ( $_SERVER ['HTTP_USER_AGENT'] ) : '';
		$http_accept = isset ( $_SERVER ['HTTP_ACCEPT'] ) ? strtolower ( $_SERVER ['HTTP_ACCEPT'] ) : '';
		$pos_hua = strpos ( $http_user_agent, 'mobi' );
		$pos_a_wap = strpos ( $http_accept, 'wap' );
		$pos_a_wml = strpos ( $http_accept, 'wml' );
		
		if ($pos_hua !== FALSE) {
			return true;
		} elseif ($pos_a_wap !== FALSE) {
			return true;
		} elseif ($pos_a_wml !== FALSE) {
			return true;
		} else {
			return false;
		}
		
	}
?>