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
    <title>荷兰旅游专家-新用户注册第一步</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="stylesheet" href="css/login.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    
</head>
<body>
    <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	?>
    <div class="sign_in_box page_1">
        <div class="sign_in_title">
            <h1>会员注册</h1>
            <div class="step_box step">
                <h2>1</h2>
                <div class="bottom_triangle"></div>
            </div>
            <div class="step_box">
                <h2>2</h2>
                <div class="next_triangle"></div>
            </div>
            <div class="step_box">
                <h2>3</h2>
                <div class="next_triangle"></div>
            </div>
        </div>
        <div class="sign_in_agreement">
            荷兰旅游专家认证课程注册协议
        </div>
        <div class="agreement_iframe_div">
            <iframe class="agreement_iframe" src="agreement.php"></iframe>
        </div>
        <div class="bottom_box">
            <h1 onclick="location='login.php'">使用已有账号登陆</h1>
            <div class="agree_but" onclick="location='register_2.php'">
                同意
            </div>
            <div class="disagree_but" onclick="location='index.php'">
                不同意
            </div>
        </div>
    </div>
</body>
</html>