<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
if (is_numeric ( $_GET ['page'] )) {
	$o_page = $_GET ['page'];
} else {
	$o_page = 1;
}
if (is_numeric ( $_GET ['sectionid'] )) {
	$s_sectionid = $_GET ['sectionid'] ;
} else {
	$s_sectionid =0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/common.css" />    
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/list.css" />
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
	<script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
    <script type="text/javascript" src="js/common.fun.js"></script>
    <script type="text/javascript" src="js/course.fun.js"></script>

    <script type="text/javascript">
	 $(window).load(function(){resizeLeaveRight();parent.parent.Common_CloseDialog()});
    </script>

</head>
<body class="iframebody">
    <div align="center">
        <table class="main" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td class="center">
                    <div class="list">
                        <?php echo($o_showpage->CourseSubjectList($o_page,$s_sectionid))?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>
