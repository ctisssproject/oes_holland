<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
//验证个人资料是否齐全
if($o_user->getName()=="" && $o_user->getType()>2)
{
	//echo ('<script type="text/javascript">location=\'modify_info.php?need=1\'</script>');
	//exit ( 0 );	
}
$b_isuser = $O_Session->Login (); //是否为登录用户
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>荷兰旅游专家-领取材料</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" href="css/holland_6.css" />
    <link type="text/css" rel="Stylesheet" href="css/style.css" />

    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript">
    function set_w() {
        var win_w = $(window).width(),
            w = win_w * 0.94 - 104;

        $(".list_box_info , .info_bottom").css("width", w);
    }
    $(function () {
        set_w();
    });
    $(window).on('orientationchange', function () {
        set_w();
    });
    </script>
</head>
<body>
    <div class="page_box">
        <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile());
		?>
        <div class="gift_title">
            <div class="title_icon">
                <span class="icon-back bg_brown" onclick="location='ucenter.php'"></span>
                <h1>领取资料</h1>
            </div>            
        </div>
				<?php
				$o_prize = new Information ();
				$o_prize->PushWhere ( array ('&&', 'State', '=', 1 ) );
				$o_prize->PushOrder ( array ('InformationId', 'D' ) );
				$n_count = $o_prize->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					echo ('
		<div class="list_box">
            <img alt="" src="' . $o_prize->getPhoto ( $i ) . '" />
            <div class="list_box_info">
                <h1>' . $o_prize->getName ( $i ) . '</h1>
                <p>' . $o_prize->getExplain ( $i ) . '</p>
            </div>
            <div class="info_bottom">
                <div class="list_box_but"  onclick="location=\'information_use.php?informationid='.$o_prize->getInformationId ( $i ).'\'">
                    领取资料
                </div>
            </div>
        </div>
					');
				}
				?>	
        
    </div>
</body>
</html>