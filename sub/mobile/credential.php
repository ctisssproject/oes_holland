<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
$b_isuser = $O_Session->Login (); //是否为登录用户

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-证书样式</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" href="css/holland_6.css" />
    <link type="text/css" rel="Stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/register.fun.js"></script>
    <script type="text/javascript" src="../../js/common.fun.js"></script>
	<script type="text/javascript" src="../../js/ajax.class.js"></script>    
    <script type="text/javascript" src="../../js/dialogformobile.fun.js"></script> 
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
                <h1>证书样式</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>选择《荷兰旅游专家》证书样式</h2>
        </div>
			<?php
				$o_prize = new Credential ();
				$o_prize->PushOrder ( array ('CredentialId', 'A' ) );
				$n_count = $o_prize->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					$s_button = '<div class="list_box_but" onclick="credentialStyleModify('.$o_prize->getCredentialId($i).')">
							选择
						</div>';
					if ($o_prize->getCredentialId($i)==$o_user->getCredentialId()) {
						$s_button = '<div class="list_box_but over_but">
                   		 已选择
                		</div>';
					}
					echo ('
						<div class="list_box">
				            <img alt="" src="' . $o_prize->getImage ( $i ) . '" />
				            <div class="list_box_info" style="margin-bottom:25px;">
				                <h1>' . $o_prize->getName ( $i ) . '</h1>
				            </div>
				            <div class="info_bottom">
				                '.$s_button.'
				            </div>
				        </div>
					');
				}
				?>		
    </div>
<div id="master_box_bj" style="position: absolute; background-color: black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box" style="position: absolute; z-index: 2000; left: 0px; top: 0px;display:none"><div><img src="images/loading.gif" alt="" style="width:32px;height:32px"/></div></div>
<div id="master_box_loading" style="position: absolute; background-color: red; z-index: 2001; left: 0px; top: 0px;"></div>
<script type="text/javascript">
<?php 
//判断证书是否已经寄送
$o_send=new Goods_Send();
$o_send->PushWhere ( array ('&&', 'Type', '=', 1 ) );
$o_send->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
$o_send->PushWhere ( array ('&&', 'State', '=', 2 ) );
if ($o_send->getAllCount()==0)
{
	echo('window.alert(\'您的证书已经寄送，不能修改证书样式！\');location=\'ucenter.php\';');
}	
?>
</script>
</body>
</html>