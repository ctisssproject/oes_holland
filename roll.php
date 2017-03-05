<?php
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$s_photo = '';
$s_text = '';
$o_photo = new FocusPhoto ();
$o_photo->PushWhere ( array ('&&', 'State', '=', 1 ) );
$o_photo->PushOrder ( array ('Number', 'A' ) );
$n_count = $o_photo->getAllCount ();
for($i = 0; $i < $n_count; $i ++) {
	$s_photo .= '<div id="photo'.($i+1).'" style="display: none"><img src="'.$o_photo->getPath($i).'" alt="" style="width: 711px; height: 322px" /></div>';
	$s_text .= '<div id="text'.($i+1).'" style="display: none">'.$o_photo->getTitle($i).'</div>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/roll.css" />
</head>
<body>
<div id="photo">
<?php echo($s_photo)?>
</div>
<div style="position: absolute; top: 287px; width: 100%; width: 711px;">
<div class="prev" onclick="prev()"></div>
<div class="next" onclick="next()">
<div class="count">1 / 3</div>
</div>
<div class="title" style="font-family:微软雅黑;">
<?php echo($s_text)?>
</div>
</div>

<script type="text/javascript" src="js/roll.fun.js"></script>

</body>
</html>
