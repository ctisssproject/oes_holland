<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
$o_user = new User ( $O_Session->getUid () );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-修改头像</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="stylesheet" href="css/login.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/register.fun.js"></script>
    <script type="text/javascript" src="../../js/common.fun.js"></script>
    <script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../../js/dialogformobile.fun.js"></script> 
</head>
<body style="background-image:none;">
<form method="post" id="submit_form"
			action="../../include/bn_submit.svr.php?function=ModifyPhotoForMobile"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%">
	<?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =1,$s_logo=''));
	?>
    <div style="margin-top:0px;" class="forgot_pass_box" id="form">
        <div class="forgot_pass_title">
            <div class="pass_title_icon" style="width:130px;">
                <span class="icon-back bg_brown" style="width:40px;" onclick="location='<?php echo($_SERVER['HTTP_REFERER'])?>'"></span>
                <h1 style="margin-left:10px;">编辑头像</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>请填选择上传头像</h2>
        </div>
        <div class="forgot_pass_info">
            <div class="info_box">
                <div class="account_email">
                    <h1>原始头像</h1>
                    <h1><img style="float:left;width:66px;height:66px"
					src="<?php
					if ($o_user->getPhoto () == '') {
						echo ('images/user_photo.jpg');
					} else {
						echo ($o_user->getPhoto ());
					}
					?>"
					alt="" /></h1>
                </div>
            <div class="account_pas">
                <h1>新头像</h1>
                <div class="input_box pas">
                    <input style="font-size:12px;margin-bottom:5px" id="Vcl_Upload" name="Vcl_Upload" type="file" />
                </div>
            </div>
            <div class="submit_box">                
                <div class="submit_but" onclick="Common_CloseDialog();document.getElementById('submit_form').submit()">
                    提交
                </div>
            </div>
            </div>
        </div>
    </div>
</form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj"
	style="position: absolute; background-color: black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;display:none"><div><img src="images/loading.gif" alt="" style="width:32px;height:32px"/></div></div>
<div id="master_box_loading"
	style="position: absolute; background-color: red; z-index: 2001; left: 0px; top: 0px;"></div>
</body>
</html>

