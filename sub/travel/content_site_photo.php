<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
$o_photo=new Library_Region_Photo();
$o_photo->PushWhere ( array ('&&', 'RegionId', '=',$_GET['id']) );
$o_photo->PushOrder ( array ('Id', 'A' ) );
$n_count=$o_photo->getAllCount();
$html='';
for($i=0;$i<$n_count;$i++)
{
	$html.='<li class="plan"><a href="'.RELATIVITY_PATH.$o_photo->getImage($i).'" target="_blank"><img width="657" height="320" src="'.RELATIVITY_PATH.$o_photo->getImage($i).'"/></a></li>';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
body{font:12px/1805 Arial, Helvetica, sans-serif， "新宋体";}
/* focusbox */
.focusbox{position:relative;overflow:hidden;zoom:1;}
#fullbanner{width:747px;height:330px;margin:auto;position:relative;}
#fullbanner li a{display:block;width:737px;height:320px;overflow:hidden;}
#fullbanner img{margin-left:35px;margin-right:35px;height:320px;}
#fullbanner ul{width:747px;height:330px;}
#fullbanner .wrappic{overflow:visible;position:absolute;}
#fullbanner .next, #fullbanner .prev{position:absolute;margin-top:0px;margin-left:0px;z-index:3;}
#fullbanner .next:hover, #fullbanner .prev:hover{}
#fullbanner .next{margin:-25px 5px 0 0;right:0;}
#fullbanner .mask-left, #fullbanner .mask-right, #fullbanner .plan{background:#fff;padding:0px;z-index:1;position:absolute;top:0;left:0;width:737px;height:320px;overflow:hidden;left:1474px;}
#fullbanner .mask-right, #fullbanner .mask-left{z-index:4;left:-737px;filter:alpha(Opacity=50);opacity:.5;background:#fff;overflow:hidden;}
#fullbanner .mask-right{left:747px;}

.arrow-left,.arrow-right{ background-repeat:no-repeat;}
.arrow-left{ background-image:url('images/site_image_left_off.png');height:320px;width:40px;background-position:center left;}
.arrow-left:hover{background-image:url('images/site_image_left_on.png');}
.arrow-right{background-image:url('images/site_image_right_off.png');height:370px;width:50px;background-position:center left;}
.arrow-right:hover{background-image:url('images/site_image_right_on.png');}
</style>
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery.foucs.js" type="text/javascript"></script>
</head>
<body>

<div class="focusbox">
	<div id="fullbanner">
		<div class="wrappic">
			<ul>
				<?php echo($html)?>
			</ul>
		</div>
		
		<div class="helper">
			<div class="mask-left"></div>
			<div class="mask-right"></div>
			<a href="javascript:void();" hidefocus="true" class="prev arrow-left"></a>
			<a href="javascript:void();" hidefocus="true" class="next arrow-right"></a>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$.foucs({
		direction: 'left'
	});
});
</script>

</body>
</html>