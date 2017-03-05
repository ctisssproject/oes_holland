<?php
define ( 'RELATIVITY_PATH', '../../' );
$O_Session='';
require_once RELATIVITY_PATH . 'sub/ucenter/include/it_head.inc.php';
require_once RELATIVITY_PATH . 'sub/ucenter/include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_showpage.class.php';
$o_tree= new ShowPage ($O_Session->getUserObject ());
if (is_numeric ( $_GET ['folderid'] )) {
	$n_folder = $_GET ['folderid'];
} else {
	$n_folder = 0;
}
$o_folder=new Netdisk_Folder($n_folder);
if ($o_folder->getFolderName()==FALSE)
{
	$s_up_button='';
}else{
	$s_up_button='<td>
                	<div class="up" onclick="goUp('.$o_folder->getParentId().')">
                	</div>
            	</td>';
}
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
            <?php echo($s_up_button)?>
            <td>
                <div class="upload" onclick="uploadMoreFile(<?php echo($n_folder)?>)">
                </div>
            </td>
            <td>
                <div class="folder" onclick="FolderNew(<?php echo($n_folder)?>)">
                </div>
            </td>
            <td>
                <div class="copy" onclick="document.getElementById('filelist').contentWindow.copyAndMoveAll('copy')">
                </div>
            </td>
            <td>
                <div class="move" onclick="document.getElementById('filelist').contentWindow.copyAndMoveAll('move')">
                </div>
            </td>
            <td>
                <div class="delete" onclick="document.getElementById('filelist').contentWindow.deleteAll('move')">
                </div>
            </td>
            <td style="width:90%; text-align:right; font-family:宋体;">
            可用空间  <?php echo($o_tree->getFreeSpace())?> | 总空间 <?php echo($o_tree->getTotalSpace())?>&nbsp;&nbsp;
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" class="folder_title">
        <tr>
            <td style="width:20px;padding-left:7px"><input id="Checkbox1" type="checkbox" onclick="document.getElementById('filelist').contentWindow.selectAll(this)"/></td>
            <td>
                <img src="images/icon_sort.png" align="absmiddle" alt=""/>&nbsp;&nbsp;文件名
            </td>
            <td style="width:90px">
               大小
            </td>
            <td style="width:90px">
                上传日期
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" id="center" style="width: 100%">
        <tr>
            <td>
                <iframe id="filelist" src="filelist.php?folderid=<?php echo($n_folder);?>" marginwidth="0" marginheight="0" frameborder="0" framespacing="0"
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