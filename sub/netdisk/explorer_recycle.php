<?php
define ( 'RELATIVITY_PATH', '../../' );
$O_Session='';
require_once RELATIVITY_PATH . 'sub/ucenter/include/it_head.inc.php';
require_once RELATIVITY_PATH . 'sub/ucenter/include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="css/style2.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/common.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../js/jquery/jquery.min.js"></script>

<script type="text/javascript" src="js/control.fun.js"></script>
<script type="text/javascript" src="js/ajax.fun.js"></script>
<script type="text/javascript" src="js/folder_operate.js"></script>
<script type="text/javascript" src="js/file_operate.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="js/dialog.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>

</head>
<body class="bodycolor" style="padding:0px; margin:0px">
    <table border="0" cellpadding="0" cellspacing="0" class="folder_top">
        <tr>
            <td>
                <div class="delete" onclick="document.getElementById('filelist').contentWindow.realDeleteAll()">
                </div>
            </td>
            <td>
                <div class="clear" onclick="document.getElementById('filelist').contentWindow.clearAll()">
                </div>
            </td>
            <td style="width:98%; text-align:right; font-family:宋体">
            
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" class="folder_title">
        <tr>
            <td style="width:20px;padding-left:7px">
                <input id="Checkbox1" type="checkbox" onclick="document.getElementById('filelist').contentWindow.selectAll(this)"/>
            </td>
            <td>
                <img src="images/icon_sort.png" align="absmiddle" alt=""/>&nbsp;&nbsp;文件名
            </td>
            <td style="width:90px">
               大小
            </td>
            <td style="width:90px">
                上传日期
            </td>
            <td style="width:90px">
                删除日期
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" id="center" style="width: 100%">
        <tr>
            <td>
                <iframe id="filelist" src="filelist_recycle.php" marginwidth="0" marginheight="0" frameborder="0" framespacing="0"
                    border="0" allowtransparency="true"></iframe>
            </td>
        </tr>
    </table>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: -500px;">
</div>
    <script type="text/javascript">
    resizeLayout()
     $(window).resize(function(){resizeLayout();});
    </script>

</body>
</html>