<?php
require_once 'include/it_head.inc.php';
if (!isset($_GET['id']))
{
	exit(0);
}
require_once RELATIVITY_PATH.'include/db_view.class.php';
$o_file=new View_Library_Region($_GET['id']);
$file_name = $o_file->getRegionId().'.docx';
$file_dir = RELATIVITY_PATH.'uploaddata/library/region/';
$rename =  rawurlencode($o_file->getCityName().'-'.$o_file->getName().'.docx');
if (!file_exists($file_dir . $file_name)) { //检查文件是否存在
echo "对不起,您要下载的文件不存在";
exit;
} else {
// 一下是php文件下载的重点
Header("Content-type: application/octet-stream");
Header("Accept-Ranges: bytes");
Header("Content-Type: application/force-download");//强制浏览器下载
Header("Content-Disposition: attachment; filename=" . $rename);//重命名文件
Header("Accept-Length: ".filesize($file_dir . $file_name));//文件大小
// 读取文件内容
@readfile($file_dir.$file_name);//加@不输出错误信息
} 
?>