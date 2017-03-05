<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-新用户注册成功</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="stylesheet" href="css/login.css" />
    <link type="text/css" rel="Stylesheet" href="css/style.css" />
</head>
<body>
	<?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	?>
    <div class="sign_in_box page_3">
        <div class="sign_in_title">
            <h1>会员注册</h1>
            <div class="step_box">
                <h2>1</h2>
            </div>
            <div class="step_box">
                <h2>2</h2>
            </div>
            <div class="step_box step">
                <h2>3</h2>
                <div class="bottom_triangle"></div>
            </div>
        </div>
        <div class="succeed_text">
            <h1>恭喜你！注册成功！</h1>
            <h2>请在3天内验证邮箱激活您的账号</h2>
            <h2>否则您需要重新注册</h2>
        </div>
        <div class="verification_email">
            <div class="back_but" onclick="location='index.php'">
                返回首页
            </div>
            <div class="ver_email_but" onclick="window.alert('点击“确定”将进入邮箱！\n如无法显示邮箱登录页面，请到您邮箱的指定页面登录');window.open('<?php echo($_GET ['email']) ?>','_blank')">
                马上验证邮箱
            </div>
        </div>
        <img class="sign_in_img" alt="" src="images/reg-last-img.png" />
    </div>
    <div class="page_bottom">
        <h1>Copyright©2013 Holland.com.cn Allrights reserved<br />荷兰国家旅游会议促进局官方网站 版权所有</h1>
    </div>
</body>
</html>