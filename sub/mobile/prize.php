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
    <title>荷兰旅游专家-积分换礼品</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" href="css/holland_6.css" />
    <link type="text/css" rel="Stylesheet" href="css/style.css" />

    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function set_w() {
            var win_w = $(window).width(),
                w = win_w * 0.94 - 104;
                //t_h = $(".title").height(),
                //gift_h = $(".gift_title").height(),
                //h =t_h + gift_h+20;

            $(".list_box_info , .info_bottom").css("width", w);
            //$(".record_info").css("top", h);
        }
        $(function () {
            set_w();
        });
        $(window).on('orientationchange', function () {
            set_w();
        });
        function show_record() {
            var dis = $(".record_info").css("display");
            $(".record_info").slideToggle(500);
            if (dis == "none") {
                $(".record_button").text("收起");
            } else {
                $(".record_button").text("积分记录");
            }
        }
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
                <h1>兑换奖品</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>可用积分: <span><?php echo($o_user->getVantage ())?></span> 分</h2>
            <div class="record_button" onclick="show_record()">
                积分记录
            </div>
        </div>

        <div class="record_info">
			<div class="record_top_triangle"></div>
            <table border="0" cellpadding="0" cellspacing="0" class="row">
                <tr class="row first_tr" style="float:inherit;">
                    <td>日期</td>
                    <td>获得积分</td>
                    <td>使用积分</td>
                    <td>余额</td>
                    <td class="explain" style="text-align:center !important;">说明</td>
                </tr>
            <?php
			$o_record = new User_Vantage ();
			$o_record->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
			$o_record->PushOrder ( array ('Date', 'A' ) );
			$n_count = $o_record->getAllCount ();
			for($i = 0; $i < $n_count; $i ++) {
				$s_class = 'row bg_tr1';
				if (abs ( $i % 2 ) == 0) {
					$s_class = 'row bg_tr2';
				}
				$s_fuhao='<td>+'.$o_record->getSum($i).'</td><td>&nbsp;</td>';
				if ($o_record->getInOut($i)==0)
				{
					$s_fuhao='<td>&nbsp;</td><td>-'.$o_record->getSum($i).'</td>';
				}
				$a_date=explode ( " ",$o_record->getDate($i));
				$s_explain=$o_record->getExplain($i);
				$s_explain=str_replace ( "<br>", "", $s_explain);
				$s_explain=str_replace ( "<br/>", "", $s_explain);
				echo('
				<tr class="'.$s_class.'" style="float:inherit;">
                    <td>'.$a_date[0].'</td>
                    '.$s_fuhao.'
                    <td>'.$o_record->getBalance($i).'</td>
                    <td class="explain">'.$s_explain.'</td>
                </tr>');
			}
			?>	
            </table>
        </div>
			<?php
				$o_prize = new Prize ();
				$o_prize->PushWhere ( array ('&&', 'State', '=', 1 ) );
				$o_prize->PushOrder ( array ('Vantage', 'D' ) );
				$n_count = $o_prize->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					$s_button = '<div class="list_box_but" onclick="location=\'prize_exchange.php?prizeid='.$o_prize->getPrizeId ( $i ).'\'">
							马上兑换
						</div>';
					if ($o_prize->getSum ($i) == 0) {
						$s_button = '<div class="list_box_but over_but">
                   		 兑换结束
                		</div>';
					}
					echo ('
						<div class="list_box">
				            <img alt="" src="' . $o_prize->getPhoto ( $i ) . '" />
				            <div class="list_box_info" style="margin-bottom:25px;">
				                <h1>' . $o_prize->getName ( $i ) . '</h1>
				                <p>' . $o_prize->getExplain ( $i ) . '</p>
				            </div>
				            <div class="info_bottom">
				                <p>所需积分 <span>'.$o_prize->getVantage ( $i ).'</span></p>
				                '.$s_button.'
				            </div>
				        </div>
					');
				}
				?>		
    </div>
</body>
</html>