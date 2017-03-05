<?php
require_once 'include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰旅游专家后台管理系统</title>
        <link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/common.css" />

    <script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
    <script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="js/common.fun.js"></script>

</head>
<body>
 <div align="center">
        <table class="main" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width: 986px;">
            <tr>
                <td class="center" style="padding-bottom:16px;">                    
                    <iframe marginwidth="0" border="0" frameborder="0" src="course_search_modify_main.php?url=<?php echo(rawurlencode($_GET['url']))?>" style="height: 1500px;
                        margin-top:16px;width: 100%"></iframe>
                </td>
            </tr>
        </table>
    </div>
   <div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: -500px;">
</div>
</body>
</html>
