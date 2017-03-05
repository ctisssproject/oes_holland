<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-联系我们<</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" href="css/holland_6.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>

    <script type="text/javascript">
        function set_w() {
            var win_w = $(".page_box").width(),
                
            i_six_w = Math.round(win_w * 0.94 * 0.23),
                six_m_t = (i_six_w - 60) / 2,
                six_bor = i_six_w / 2 + "px",
                i_six_p = win_w * 0.94 * 0.67 * 0.48,
                six_klm_img_h = i_six_p + 10 + "px";
            
                $(".but_div").css("height", i_six_w);
                $(".lesson_info span , .contact_us span").css("margin-top", six_m_t);
                $(".login_sign_bg , .weixin_weibo_bg").css("border-width", six_bor);
                $(".login_sign_box , .weixin_weibo_box").css("margin-top", -i_six_w);
                $(".login_div , .weibo_div").css({ "width": six_bor, "height": six_bor });
                $(".sign_div , .weixin_div").css({ "width": six_bor, "height": six_bor, "margin-left": six_bor });
                $(".klm_img").css("height", six_klm_img_h);
                $(".amsterdam_img , .klm_bottom , .cjj_div , .air_div").css("height", i_six_p);
        }
        $(function () {
            set_w();
        });
        $(window).on('orientationchange', function () {
            location.reload();
        });
    </script>
</head>
<body>
    <div class="page_box">
	    <?php 
	    //显示顶部
	    
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	    ?>
        <div class="news_list_title">
            <div class="list_title_icon">
                <span class="icon-mail"></span>
                <h1>联系我们</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>欢迎您来到荷兰旅游专家</h2>
        </div>
        <div class="contact_box_info">
            <div class="content"><?php echo($o_showpage->getContact())?></div>
        </div>
        <?php 
        //显示广告
        echo($o_showpage->getAdvertForMobile());
        ?>
        <?php 
        //显示合作伙伴
        echo($o_showpage->getFriendForMobile());
        ?>
        <?php 
        //显示合作伙伴
        echo($o_showpage->getFooterForMobile());
        ?>
    </div>

<script type="text/javascript" src="slick/slick.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.img_box').slick({
            //dots: true,
            infinite: true,
            speed: 500,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 4000
        });
    });
</script>
<?php
if ($_GET ['email'] == "true") {
	echo ('<script type="text/javascript">window.alert("邮箱验证成功，请等待管理员的审核！\n审核通过后，会邮件通知您。")</script>');
}
?>
<?php

if ($_GET ['invitation'] != '') {
	echo ('<script type="text/javascript">window.alert("欢迎加入荷兰旅游专家的大家庭！参加在线课程学习并成为荷兰旅游专家，即可税分兑换荷兰好礼！心动不如行动，快快注册加入我们吧！ ")</script>');
}
?>
<?php

if ($_GET ['out'] == 'true') {
	//echo ('<script type="text/javascript">Dialog_Message("您的帐号已登录！为确保帐户安全，请确认是否停在当前页。<br/>点击确认，已登录的帐号将自动下线。<br/>如发现帐户被盗，请尽快修改登录密码！ ")</script>');
}
?>
</body>
</html>
