<?php
require_once 'include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/common.css" rel="stylesheet" type="text/css" />
</head>
<frameset id="mainFrameset" cols="0,*" rows="*">
<frame src="course_nav.php" frameBorder="0" style="border: 1px solid #E5E5E5;">
<frame src="<?php echo($_GET['url'])?>" frameBorder="0" style="border: 1px solid #E5E5E5;overflow:hidden" scrolling="no">
<NOFRAMES></NOFRAMES></frameset>
</html>