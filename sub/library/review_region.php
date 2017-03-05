<?php
require_once 'include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
    <style type="text/css">
		.button
        {
        	padding:3px;
        	padding-left:5px;
        	padding-right:5px;
        	position:fixed;
        	background-color:#FF6600;
        	color:white;
        	font-family:微软雅黑;
        	font-size:12px;
        }
	body {
	font-family: 微软雅黑;
	font-size: 14px;
}
    </style>
</head>
<body>
<div id="button" class="button">"全选"->"复制"，可黏贴到Word文档</div>
<?php 
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
			$o_region = new View_Library_Region ( $_GET['id']);
			echo ('<div style="font-size: 20px;text-align: center;  font-weight: bold;">' . $o_region->getCityName () . '-' . $o_region->getName () . '</div>');
			echo ('<div style="margin-top: 10px; ">');
			//图片
			$o_photo = new Library_Region_Photo ();
			$o_photo->PushWhere ( array ('&&', 'RegionId', '=', $_GET['id']) );
			$o_photo->PushOrder ( array ('Id', 'A' ) );
			$n_count_photo = $o_photo->getAllCount ();
			$html = '';
			for($k = 0; $k < $n_count_photo; $k ++) {
				echo ('<div style="margin-top:5px;text-align: center;"><img width="657" height="320" src="' .RELATIVITY_PATH.$o_photo->getImage ( $k ) . '"/></div>');
			}
			echo ('<div>' . $o_region->getContent () . '	</div>');
			echo ('
					<div style="margin-top: 5px;"><strong>地址：</strong>' . $o_region->getStreet () . ' ' . $o_region->getAddress () . ', ' . $o_region->getZip () . '</div>
					<div style="margin-top: 5px;"><strong>网址：</strong>' . $o_region->getWeb () . '</div>
					<div style="margin-top: 5px;"><strong>电话：</strong>' . $o_region->getTel () . '</div>
			');
?>
</body>

</html>