<?php
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_system = new System ( 1 );
$o_system->setLogo(Ailter($o_system->getLogo()));
$o_system->setRegSuccessPhoto(Ailter($o_system->getRegSuccessPhoto()));
$o_system->setHost('http://chutao.zicp.net:59321/oes_germany_meeting_online/');//修正网址
$o_system->Save();
echo('更正系统设置成功！<br/><br/>');
//修正焦点图片地址
$o_photo = new FocusPhoto ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new FocusPhoto ($o_photo->getPhotoId($i));
	$o_photo2->setPath(Ailter($o_photo2->getPath()));
	$o_photo2->Save();
}
echo('更正焦点图片地址成功！<br/><br/>');
//修正新闻图片地址
$o_photo = new News ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new News ($o_photo->getNewsId($i));
	$o_photo2->setContent(Ailter($o_photo2->getContent()));
	$o_photo2->Save();
}
echo('更正新闻图片地址成功！<br/><br/>');
//修正广告图片地址
$o_photo = new Advert ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Advert ($o_photo->getAdvertId($i));
	$o_photo2->setOnover(Ailter($o_photo2->getOnover()));
	$o_photo2->setOnout(Ailter($o_photo2->getOnout()));
	$o_photo2->Save();
}
echo('更正广告图片地址成功！<br/><br/>');
//修正网盘文件地址
$o_photo = new Netdisk_File ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Netdisk_File ($o_photo->getFileId($i));
	$o_photo2->setPath(Ailter($o_photo2->getPath()));
	$o_photo2->Save();
}
echo('更正网盘文件地址成功！<br/><br/>');
//修正领取资料图片地址
$o_photo = new Information ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Information ($o_photo->getInformationId($i));
	$o_photo2->setPhoto(Ailter($o_photo2->getPhoto()));
	$o_photo2->Save();
}
echo('更正领取资料图片地址成功！<br/><br/>');
//修正章图片和内容图片地址
$o_photo = new Bank_Chapter ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Bank_Chapter ($o_photo->getChapterId($i));
	$o_photo2->setPhoto(Ailter($o_photo2->getPhoto()));
	$o_photo2->setPhotoOff(Ailter($o_photo2->getPhotoOff()));
	$o_photo2->setPhotoOn(Ailter($o_photo2->getPhotoOn()));
	$o_photo2->setContent(Ailter($o_photo2->getContent()));
	$o_photo2->Save();
}
echo('更正章图片和内容图片地址成功！<br/><br/>');
//修节内容图片地址
$o_photo = new Bank_Section ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Bank_Section ($o_photo->getSectionId($i));
	$o_photo2->setContent(Ailter($o_photo2->getContent()));
	$o_photo2->Save();
}
echo('更正节内容图片地址成功！<br/><br/>');
//修正奖品图片地址
$o_photo = new Prize ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Prize ($o_photo->getPrizeId($i));
	$o_photo2->setPhoto(Ailter($o_photo2->getPhoto()));
	$o_photo2->Save();
}
echo('更正奖品图片地址成功！<br/><br/>');
//修正合作伙伴图片地址
$o_photo = new Partners ();
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$o_photo2 = new Partners ($o_photo->getPartnerId($i));
	$o_photo2->setIcon(Ailter($o_photo2->getIcon()));
	$o_photo2->Save();
}
echo('更正合作伙伴图片地址成功！<br/><br/>');
function Ailter($s_str)
{
	return str_replace (  "/uploaddata", "/oes_germany_meeting_online/uploaddata", $s_str );
}


?>