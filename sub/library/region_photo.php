<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../../css/common.css" />    
    <link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
    <link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
    <script type="text/javascript" src="js/region.fun.js"></script>

    <script type="text/javascript">
	 $(window).load(function(){resizeLeave2();parent.parent.Common_CloseDialog()});
    </script>

</head>
<body class="iframebody">
    <div align="center">
        <table class="main" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td class="center">
                    <div class="list">
                        <?php echo($o_showpage->RegionPhoto())?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
