<?php
require_once 'include/it_head.inc.php';
if (isset ( $_GET ['activation_code'] )) {
	echo ('<script type="text/javascript">location=\'ucenter.php?activation_code=' . $_GET ['activation_code'] . '\'</script>');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" media="screen and (max-width:374px)" href="css/holland_5.css" />
    <link type="text/css" rel="Stylesheet" media="screen and (min-width:375px)" href="css/holland_6.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript">
        /* window.onload = function () {
            $(".load_img").css("display", "none");
            $(".page_box").css("display", "block");
        } */
        function set_w() {
            var win_w = $(".page_box").width(),
                i_five_w = Math.round(win_w * 0.97 * 0.47),
                five_m_t = (i_five_w - 108) / 2,
                five_bor = i_five_w / 2 + "px",
                five_img_h = i_five_w - 54 + "px"
                i_six_w = Math.round(win_w * 0.94 * 0.23),
                six_m_t = (i_six_w - 60) / 2,
                six_bor = i_six_w / 2 + "px",
                i_six_p = win_w * 0.94 * 0.67 * 0.48,
                six_klm_img_h = i_six_p + 10 + "px";
            if (win_w < 375) {
                $(".but_div , .partner , .login_sign_box , .weixin_weibo_box").css("height", i_five_w);
                $(".lesson_info span , .contact_us span").css("margin-top", five_m_t);
                $(".login_sign_bg , .weixin_weibo_bg").css("border-width", five_bor);
                $(".login_sign_box , .weixin_weibo_box").css("margin-top", -i_five_w);
                $(".login_div , .weibo_div").css({ "width": five_bor, "height": five_bor });
                $(".sign_div , .weixin_div").css({ "width": five_bor, "height": five_bor, "margin-left": five_bor });
                $(".cjj_div img , .air_div img").css("height", five_img_h);
            } else {
                $(".but_div").css("height", i_six_w);
                $(".lesson_info span , .contact_us span").css("margin-top", six_m_t);
                $(".login_sign_bg , .weixin_weibo_bg").css("border-width", six_bor);
                $(".login_sign_box , .weixin_weibo_box").css("margin-top", -i_six_w);
                $(".login_div , .weibo_div").css({ "width": six_bor, "height": six_bor });
                $(".sign_div , .weixin_div").css({ "width": six_bor, "height": six_bor, "margin-left": six_bor });
                $(".klm_img").css("height", six_klm_img_h);
                $(".amsterdam_img , .klm_bottom , .cjj_div , .air_div").css("height", i_six_p);
            }
        }
        $(function () {
            set_w();
        });
        $(window).on('orientationchange', function () {
            location.reload();
        });
    </script>
</head>
<body id="body">
    <div class="load_img" style="display:none">
        <img alt="" class="load_img1" src="images/logo-full.png" />
        <img alt="" class="load_img2" src="images/logo-Alliance-China.png" />
    </div>
    <div class="page_box">
	    <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	    ?>
        <?php 
        //构造首页的滚动画面
        $s_photo = '';
		$s_text = '';
		$o_photo = new FocusPhoto ();
		$o_photo->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_photo->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_photo->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_photo .= '<div class="photo"><img src="'.$o_photo->getPath($i).'" alt=""/></div>';
			$s_text .= '<h2>'.$o_photo->getTitle($i).'</h2>';
		}
        ?>
        <div class="img_box">
            <?php 
            //输出滚动画面图像
            echo($s_photo);
            ?>
        </div>
        <div class="img_bottom_text">
            <div class="img_bottom"></div>
            <div class="text_box">
                <h1>1/10</h1>
                <div class="test_list">
                    <?php 
		            //输出滚动画面图像
		            echo($s_text);
		            ?>
                </div>
            </div>
        </div>
        <div class="botton_box">
            <div onclick="location='chapter.php'" class="but_div lesson_info">
                <span class="icon-notepad"></span>
                <h1>课程介绍</h1>
            </div>
            <div class="but_div">
                <div class="login_sign_bg"></div>
                <div class="login_sign_box">
                    <div class="login_div" onclick="location='login.php'">
                        <h1>登陆</h1>
                    </div>
                    <div class="sign_div" onclick="location='register_1.php'">
                        <h1>注册</h1>
                    </div>
                </div>
            </div>
            <div class="but_div">
                <div class="weixin_weibo_bg"></div>
                <div class="weixin_weibo_box" onclick="window.open('weixin.html','_blank')">
                    <div class="weixin_div">
                        <img alt="" src="images/wechat.png"  />
                    </div>
                    <div class="weibo_div" onclick="window.open('http://weibo.com/nbtc','_blank')">
                        <img alt="" src="images/weibo.png" />
                    </div>
                </div>
            </div>
            <div class="but_div contact_us" onclick="location='contact.php'">
                <span class="icon-mail"></span>
                <h1>联系我们</h1>
            </div>
        </div>
        <?php 
        //显示最新资讯
        echo($o_showpage->getNewsForMobile());
        ?>
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
