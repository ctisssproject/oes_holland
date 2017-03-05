<?php
//define ( 'RELATIVITY_PATH', '../../' );
require_once '../../sub/ucenter/include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="css/common.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../js/jquery.min.js"></script>

    <script type="text/javascript" src="js/common.fun.js"></script>

    <script type="text/javascript">
	 resizeLeave();

	 $(window).resize(function(){resizeLeave();});
    </script>
</head>
<frameset id="mainFrameset" cols="180,*" rows="*"><frame
src="navigation.php" 
frameBorder="0" style="border: 1px solid #E5E5E5;"><frame 
src="explorer.php" 
frameBorder="0" style="border: 1px solid #E5E5E5;"><NOFRAMES></NOFRAMES></frameset>
</html>