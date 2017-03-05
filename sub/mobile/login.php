<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>会员登录</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="stylesheet" href="css/login.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="../../js/dialogformobile.fun.js"></script> 
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".email_box input").focus(function () {
                $(".email_box input").css("background-image", "none");
            });
            $(".pas_box input").focus(function () {
                $(".pas_box input").css("background-image", "none");
            });
        });
    </script>
</head>
<body>
<form method="post" id="submit_form"
					action="../../include/bn_submit.svr.php?function=LoginForMobile"
					enctype="multipart/form-data" target="ajax_submit_frame"
					style="width: 100%">	
    <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	?>
    <div class="login_box">
        <div class="login_title">
            <h1>会员登录</h1>
        </div>
        <div class="email_box">
            <span class="icon-mail"></span>
            <input id="Vcl_UserName" name="Vcl_UserName" type="text" />
        </div>
        <div class="pas_box">
            <span class="icon-lock"></span>
            <input id="Vcl_Password" name="Vcl_Password" type="password" />
        </div>
        <div class="login_buutton" onclick="document.getElementById('submit_form').submit();Common_OpenLoading();">
            登录
        </div>
        <div class="more_box">
            <h1 onclick="location='register_1.php'">注册成为会员</h1>
            <h2 onclick="location='findpassword.php'">忘记密码?</h2>
        </div>
    </div>
    <input type="hidden" name="Vcl_Url" value="ucenter.php"/> 
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