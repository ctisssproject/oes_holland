<?php
require_once 'include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<style type="text/css">
body {
	font-family: 微软雅黑;
	font-size: 14px;
}

.button {
	padding: 3px;
	padding-left: 5px;
	padding-right: 5px;
	position: fixed;
	background-color: #FF6600;
	color: white;
	font-family: 微软雅黑;
	font-size: 12px;
	display: none;
}
</style>
</head>
<body>
<div id="button" class="button">"全选"->"复制"，可黏贴到Word文档</div>
<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
$o_title = new Travel_Title ( $_GET ['id'] );

?>
<div style="font-family: 微软雅黑; font-size: 14px;">
<div
	style="font-size: 20px; font-weight: bold; width: 767px; text-align: center; font-family: 微软雅黑"><?php
	echo ($o_title->getName ())?></div>
<div style="margin-top: 20px;width: 767px; "><?php
echo ($o_title->getExplain ())?></div>
<?php
$o_site = new Travel_Item ();
$o_site->PushWhere ( array ('&&', 'TitleId', '=', $o_title->getTitleId () ) );
$o_site->PushWhere ( array ('&&', 'State', '=', 1 ) );
$o_site->PushOrder ( array ('Number', 'A' ) );
$n_count = $o_site->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$s_timetype = '';
	echo ('<div style="margin-top: 20px; font-size: 16px; font-weight: bold;">' . $o_site->getName ( $i ) . '</div>');
	$o_detail = new Travel_Detail ();
	$o_detail->PushWhere ( array ('&&', 'ItemId', '=', $o_site->getItemId ( $i ) ) );
	$o_detail->PushOrder ( array ('StartHour', 'A' ) );
	$n_count_detail = $o_detail->getAllCount ();
	$number=1;
	for($j = 0; $j < $n_count_detail; $j ++) {
		
		$s_this = getTimeType ( $o_detail->getStartHour ( $j ), $o_detail->getEndHour ( $j ) );
		//为了不重复显示时间类型
		if ($s_this == $s_timetype) {
			$s_this = '';
			$number++;
		} else {
			$s_timetype = $s_this;
			$number=1;
		}
		if ($o_detail->getRegionId ( $j ) == 0) {
			echo ('
			<div style="margin-top: 20px; margin-left: 40px; font-weight: bold;">' . $s_this . '</div>
			<div style="margin-top: 20px; margin-left: 80px;">' . $o_detail->getExplain ( $j ) . '</div>
			');
		} else {
			$o_region = new View_Library_Region ( $o_detail->getRegionId ( $j ) );
			echo ('<div style="margin-top: 20px; margin-left: 40px; font-weight: bold;">' . $s_this . '</div>');
			echo ('<div style="margin-top: 20px; margin-left: 80px; font-size: 16px; font-weight: bold;">'.$number.'.' . $o_region->getCityName () . '-' . $o_region->getName () . '</div>');
			echo ('<div style="margin-top: 10px; margin-left: 100px;">');
			//图片
			$o_photo = new Library_Region_Photo ();
			$o_photo->PushWhere ( array ('&&', 'RegionId', '=', $o_detail->getRegionId ( $j )) );
			$o_photo->PushOrder ( array ('Id', 'A' ) );
			$n_count_photo = $o_photo->getAllCount ();
			$html = '';
			for($k = 0; $k < $n_count_photo; $k ++) {
				echo ('<div style="margin-top:5px;"><img width="657" height="320" src="' . RELATIVITY_PATH . $o_photo->getImage ( $k ) . '"/></div>');
			}
			echo ('<div style="width:657px">' . $o_region->getContent () . '	</div>');
			echo ('
					<div style="margin-top: 5px;"><strong>地址：</strong>' . $o_region->getStreet () . ' ' . $o_region->getAddress () . ', ' . $o_region->getZip () . '</div>
					<div style="margin-top: 5px;"><strong>网址：</strong>' . $o_region->getWeb () . '</div>
					<div style="margin-top: 5px;"><strong>电话：</strong>' . $o_region->getTel () . '</div>
			');
			echo ('<div style="margin-top: 15px;"><strong>相关说明</strong></div>');
			echo ('<div style="margin-top: 5px; margin-left: 20px;">' . $o_detail->getExplain ( $j ) . '</div>');
			echo ('</div>');
		}
	}
}
?>
</div>
</body>
<script>
window.alert("温馨提示：\n\n1. 点击菜单的“文件”->“打印”按钮后，可直接打印\n\n2. 全选“复制”后，可直接“黏贴”到Word文档中编辑")
</script>
</html>