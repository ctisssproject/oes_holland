<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
//验证是否是激活邮箱用户
if (isset ( $_GET ['activation_code'] )) {
	//开始激活邮箱
	$s_html = '';
	$o_user = new User ();
	$o_user->PushWhere ( array ('&&', 'ActivationCode', '=', $_GET ['activation_code'] ) );
	if ($o_user->getAllCount () > 0) {
		
		//邮箱激活成功，开始使用
		$o_user = new User ( $o_user->getUid ( 0 ) );
		$o_user->setActivationCode ( '' ); //激活邮箱只能一次，所以为了不让学员二次激活，清掉激活码。
		$o_user->Save ();
		//如果审核为已审核，那么自动登录。
		if ($o_user->getChecked () == 1) {
			//自动登录
			$n_uid = $o_user->getUid ();
			require_once RELATIVITY_PATH . 'include/bn_user.class.php';
			$o_user = new Single_User ();
			$o_user->AutoLogin ( $n_uid );
			$s_html = '<script type="text/javascript">window.alert("恭喜：邮箱邮件成功！\n点击确认，即可开启荷兰旅游专家在线学习之旅！")</script>';
		} else {
			echo ('<script type="text/javascript">location=\'index.php?email=true\'</script>');
			exit ( 0 );
		}
	}
}
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
//验证个人资料是否齐全
if($o_user->getName()=="")
{
	//echo ('<script type="text/javascript">location=\'modify_info.php?need=1\'</script>');
	//exit ( 0 );	
}
//读取单项专家列表
$o_term = new Bank_Term ();
$o_term->PushWhere ( array ('&&', 'State', '=', 1 ) );
$o_term->getAllCount ();
$o_chapter_single = new Bank_Chapter ();
$o_chapter_single->PushWhere ( array ('&&', 'State', '=', 1 ) );
$o_chapter_single->PushWhere ( array ('&&', 'TermId', '=', $o_term->getTermId ( 0 ) ) );
$o_chapter_single->PushWhere ( array ('&&', 'SendCredentials', '=', 1 ) );
$o_chapter_single->PushOrder ( array ('Number', 'A' ) );
$n_chapter_single_count = $o_chapter_single->getAllCount ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-个人中心</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" media="screen and (max-width:374px)" href="css/holland_5.css" />
    <link type="text/css" rel="Stylesheet" media="screen and (min-width:375px)" href="css/holland_6.css" />
    <link type="text/css" rel="Stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>

    <script type="text/javascript" src="js/jquery.circliful.min.js"></script>
    <script type="text/javascript">
        function set_w() {
            var win_w = $(window).width(),
                w = win_w * 0.94,
                div_w = w - 76,
                five_w = w - 130,
                six_w = w - 140;
            if (win_w < 374) {
                $(".persnol_title h3").css("width", five_w);
                $(".lesson_content").css("width", five_w);
            } else {
                $(".persnol_title h3").css("width", six_w);
                $(".lesson_content").css("width", six_w);
            }
            $(".experts_info").css("width", div_w);

            //真对广告的
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
            set_w();
        });
        $(document).ready(function () {
            $('#myStat').circliful();
        });
    </script>
</head>
<body>
    <div class="page_box">
        <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile());
		?>
        <div class="persnol_title">
            <div class="title_icon">
                <span class="icon-user"></span>
                <h1 style="width:auto">个人中心</h1>
            </div>
            <div class="right_triangle"></div>
            <div class="per_num">
                <h1>当前注册:</h1>
                <h2><?php
				//读取当前用户数
				$o_user_count = new User ();
				$o_user_count->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				echo ($o_user_count->getAllCount ());
				?>人</h2>
            </div>
            <div class="per_num">
                <h1>专家称号:</h1>
                <h2><?php
				//读取当前用户数
				$o_user_count = new User ();
				$o_user_count->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				echo ($o_user_count->getAllCount ());
				?>人</h2>
            </div>
            <div class="per_num">
                <h1>我的排名:</h1>
                <h2><?php
				//如果我是专家，就排名第一位，如果不是排名专家数加一 
				if ($o_user->getType () >= 4) {
					echo (1);
				} else {
					echo ($o_user_count->getAllCount () + 1);
				}
				?>位</h2>
            </div>
        </div>
        <div class="persnol_box">
            <div class="persnol_name">
                <h1><?php
				echo ($o_user->getName ())?></h1>
                <div class="log_out">
                    <span class="icon-logout"></span>
                    <h2 onclick="if (window.confirm('确定离开荷兰旅游专家在线培训系统吗？')){location='../../index.php?loginout=1'}">退出</h2>
                </div>
            </div>
        </div>
        <div class="top_triangle top_tri_position"></div>
        <div class="persnol_info">
            <div class="row">
                <div class="persnol_photo" onclick="location='modify_photo.php'">
                    <img alt="" src="<?php
					if ($o_user->getPhoto () == '') {
						echo ('images/user_photo.jpg');
					} else {
						echo ($o_user->getPhoto ());
					}
					?>" />
                </div>
                <div class="persnol_info_but">
                    <div class="info_but" onclick="location='modify_info.php'">
                        <span class="icon-idcard"></span>
                        <h1>个人信息</h1>
                    </div>
                    <div class="info_but m_t_4" onclick="location='modify_password.php'">
                        <span class="icon-lock"></span>
                        <h1>修改密码</h1>
                    </div>
                </div>
                <div class="percent_box" onclick="location='send_credential.php'">
				<?php
				//计算完成度,和所有章图标的显示
				//1.读取所有章节个数
				$s_chapter = '';
				$o_chapter = new Bank_Chapter ();
				$o_chapter->PushWhere ( array ('&&', 'State', '=', 1 ) );
				$o_chapter->PushWhere ( array ('&&', 'TermId', '=', $o_term->getTermId ( 0 ) ) );
				$o_chapter->PushOrder ( array ('Number', 'A' ) );
				$n_chapter_count = $o_chapter->getAllCount ();
				//2.计算每个章的百分比
				$n_total = 0;
				$n_single = round ( 100 / $n_chapter_count, 2 );
				//3.循环读取用户做过的章节个
				for($i = 0; $i < $n_chapter_count; $i ++) {
					$n_vantage = 0;
					$n_percent = 0;
					$s_class = 'icon';
					$o_study = new User_Study_Chapter ();
					$o_study->PushWhere ( array ('&&', 'ChapterId', '=', $o_chapter->getChapterId ( $i ) ) );
					$o_study->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
					if ($o_study->getAllCount () > 0) {
						//做过
						$n_vantage = $o_study->getVantage ( 0 );
						$n_percent = $o_study->getPercent ( 0 );
						if ($o_study->getPercent ( 0 ) >= 100) {
							//完成
							$s_class.= ' complete';
							$n_total = $n_total + $n_single;
						} else {
							//未完成
							$a = $o_study->getPercent ( 0 );
							$a = $o_study->getPercent ( 0 ) / 100;
							$a = $n_single * $o_study->getPercent ( 0 ) / 100;
							$n_total = $n_total + ($n_single * $o_study->getPercent ( 0 ) / 100);
						}
					} else {
						//没做过，但是已经是专家，说明这个是后加的，那么也显示完成
						if ($o_user->getType () == 5) {
							$n_vantage = 0;
							$n_percent = 100;
							$s_class .= ' complete';
						} else if ($o_user->getType () == 4) {
							//说明是新开学，已经是上届专家，有免做权
							if ($o_chapter->getRestudy ($i) == 0) {
								//不需要再做
								//加分
								$o_temp=new Bank_Section();
								$o_temp->PushWhere ( array ('&&', 'ChapterId', '=', $o_chapter->getChapterId ( $i ) ) );
								$o_temp->PushWhere ( array ('&&', 'State', '=', 1) );
								$n_temp_count=$o_temp->getAllCount();
								$n_temp_vantage=0;
								for($j=0;$j<$n_temp_count;$j++)
								{
									$n_temp_vantage=$n_temp_vantage+$o_temp->getVantage($j);
								}
								$o_user->setVantage ( $o_user->getVantage () + $n_temp_vantage );
								$o_user->Save ();
								//填写积分记录
								//添加积分记录
								$o_record = new User_Vantage ();
								$o_record->setUid ( $o_user->getUid() );
								$o_record->setInOut ( 1 ); //入库
								$o_record->setDate ( $o_showpage->GetDateNow () );
								$o_record->setBalance ( $o_user->getVantage () ); //余额
								$o_record->setExplain ( '新学年，上届专家免做章节《' . $o_chapter->getName ( $i ) . '》，直接送积分' );
								$o_record->setSum ( $n_temp_vantage );
								$o_record->Save ();
								//建立已做章节记录
								$o_temp=new User_Study_Chapter();
								$o_temp->setUid($o_user->getUid() );
								$o_temp->setChapterId($o_chapter->getChapterId ( $i ));
								$o_temp->setPercent(100);
								$o_temp->setVantage($n_temp_vantage);
								$o_temp->Save();
								$n_vantage = 0;
								$n_percent = 100;
								$s_class .= ' complete';
								$n_total = $n_total + $n_single;
							}
						}
					
					//没做过
					}
					//计算数字图片图标
					$n_temp = $i + 1;
					$s_jiao = '<div class="jiao"></div>';
					$s_info_icon="开始学习";
					$s_photo = $o_chapter->getPhotoOff ( $i );
					$s_info_bj='inporcess';
					$s_color="start_c";
					$s_wanchengdu='完成:'.$n_percent.'%';
					if ($n_percent >= 100) {
						$s_area = ''; //继续学习与开始学习的区别
						$s_button = ' title="点击后复习" onclick="goTo(\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '\')"';
						$s_onover = 'onmouseover="courseButtonOn(this)" onmouseout="courseButtonOff(this)"';
						$s_jiao = ''; //不显示三角
						$s_photo = $o_chapter->getPhotoOn ( $i ); //点亮图片
						$s_info_icon="复习本章";
						$s_info_bj='';
						$s_color="fuxi_c";
						$s_wanchengdu='<span>已完成</span>';
					} else if ($n_percent == 0) {
						$s_area = ''; //继续学习与开始学习的区别
						$s_button = ' title="点击后开始学习" onclick="goTo(\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '\')"';
					} else {
						$s_color="goon_c";
						$s_info_icon="继续学习";
						$s_area = '2'; //继续学习与开始学习的区别
						$s_button = ' title="点击后继续学习" onclick="goTo(\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '&goon=1\')"';
					}					
					$s_chapter .= '
		<div class="lesson_box '.$s_info_bj.'" onclick="location=\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '\'">
            <div class="lesson_num">'.$n_temp.'</div>
            <div class="lesson_img">
                <img alt="" src="'.$s_photo.'" />
            </div>
            <div class="lesson_content">
                <h1>'.$o_chapter->getName ( $i ).'</h1>
                <div class="lesson_m_bottom"></div><!-- 下边两个元素是绝对定位的，此DIV是撑高度使用 -->
                <h2>已获积分:'.$n_vantage.' &nbsp; '.$s_wanchengdu.'</h2>
                <div class="lesson_progress">
                    <div class="progress_div" style="width:'.$n_percent.'%;"></div><!-- 直接控制progress_div的宽度百分比就可以控制进度条 -->
                </div>
            </div>
        </div>
					';
				
				}
				
				//4.根据完成结果出图
				$n_class = '0';
				$n_total = ceil ( $n_total );
				if ($n_total > 0) {
					$n_total2 = $n_total;
					while ( abs ( $n_total2 % 5 ) > 0 ) {
						$n_total2 = $n_total2 + 1;
					}
					$n_class = $n_total2;
				}
				if ($n_total>=100 && $o_user->getType ()>=3 && $o_user->getType ()<5)
				{					
					$o_user->setType (5);
					//
													//计算整体完成度
									require_once 'include/bn_operate.class.php';
									$o_operate = new Operate(); 
									
										//获得荷兰旅游专家证书
										//专家奖分
										$o_system = new system (1);
										$o_user->setVantage ( $o_user->getVantage () + $o_system->getReward () );
										$o_user->setTerm ( 0 ); //学期有效期重新计算
										$o_user->Save ();
										//添加积分记录
										$o_record = new User_Vantage ();
										$o_record->setUid ( $o_user->getUid() );
										$o_record->setInOut ( 1 ); //入库
										$o_record->setDate ( $o_operate->GetDateNow () );
										$o_record->setBalance ( $o_user->getVantage () ); //余额
										$o_record->setExplain ( '获得《荷兰旅游专家》奖励积分' );
										$o_record->setSum ( $o_system->getReward () );
										$o_record->Save ();										
										$o_operate->SendCongratulate($o_user->getUid());
										$s_javascript='
										<script>window.alert("恭喜您，您已通过所有课程学习\n获得了“荷兰旅游专家”证书！\n特奖励' . $o_system->getReward () . '积分！\n点击“确定”填写证书寄送地址！");location="sent_credential.php"</script>
										';
				}
				if ($o_user->getType () == 5 ||$n_total>=100) {
					//完成，显示证书
					$o_credential=new Credential($o_user->getCredentialId ());
					$o_user->setPercent ( 100 );
					$n_total=100;
				} else {
					$o_user->setPercent ( $n_total );
					/*echo ('	<div class="_4 __' . $n_class . '">
								<div class="top"></div>
								<div class="text"><span>-完成度-</span><br />
								' . $n_total . '%</div>
							</div>');*/
				}
				$o_user->Save ();
					//三种情况，积分一位，积分两位，积分三位
					$n_vantage = $o_user->getVantage ();
					/*if (strlen ( $n_vantage ) == 1) {
						$s_img = '<img src="images/fen_' . $n_vantage . '.png" alt="点击查看积分记录" />';
					}
					if (strlen ( $n_vantage ) == 2) {
						$s_img = '<img src="images/fen_' . substr ( $n_vantage, 0, 1 ) . '.png" alt="点击查看积分记录" /><img src="images/fen_' . substr ( $n_vantage, 1, 1 ) . '.png" alt="点击查看积分记录" />';
					}
					if (strlen ( $n_vantage ) == 3) {
						$s_img = '<img src="images/fen_' . substr ( $n_vantage, 0, 1 ) . '.png" alt="点击查看积分记录" /><img src="images/fen_' . substr ( $n_vantage, 1, 1 ) . '.png" alt="点击查看积分记录" /><img src="images/fen_' . substr ( $n_vantage, 2, 1 ) . '.png" alt="点击查看积分记录" />';
					}*/
					/*echo ('
						<div class="_3">
							<div class="top">
								<div class="text"></div>
								<div class="jiao"></div>
							</div>
							<div class="center" title="点击查看积分记录" onclick="goTo(\'vantage.php\')">' . $s_img . '</div>
						</div>
					');	*/
					/*$o_information=new Information();
					$o_information->PushWhere ( array ('&&', 'State', '=', 1 ) );
					if ($o_information->getAllCount()>0)
					{
						echo ('
						<div class="_8">
							<div class="top" title="点击去兑换奖品" onclick="goTo(\'prize.php\')">
							</div>
							<div class="down" title="去领取材料" onclick="goTo(\'' . RELATIVITY_PATH . 'sub/student/information.php\')">
							</div>
							
						</div>
							');
						//echo('<div class="botton" title="去领取材料" onclick="goTo(\'' . RELATIVITY_PATH . 'sub/student/information.php\')">领取材料</div>');
					}*/
				
				?>	
                    <h1 style="t">完成度</h1>
                    <div class="partner_div">
                        <!-- data-dimension控制div的宽高  data-percent需要的百分比 data-text中心的文字显示  data-fontsize文字大小  data-width线条宽度 -->
                        <div id="myStat" data-dimension="40" data-text="<?php echo($n_total)?>%" data-percent="<?php echo($n_total)?>" data-width="1" data-fontsize="10" data-border="inline" data-fgcolor="#ff6100" data-bgcolor="#ebe9df" data-fill="#fff"></div>
                    </div>
                </div>
                <div class="integral_box">
                    <h1>当前积分</h1>
                    <h2><?php echo($n_vantage)?></h2>
                </div>
                <div class="persnol_blue_but">
                    <div class="blue_but" onclick="location='prize.php'">
                        <span class="icon-gift"></span>
                        <h1>兑换奖品</h1>
                    </div>
                    <div class="blue_but m_t_8" onclick="location='information.php'">
                        <span class="icon-doc"></span>
                        <h1>领取资料</h1>
                    </div>
                </div>
            </div>
                <?php 
                if ($n_chapter_single_count>0)
                {
                	echo('
             <div class="row m_t_8" style="display:block">
                <div class="experts">
                    <h1>单项专家</h1>
                </div>
                	<div class="experts_info">');
	                for($i = 0; $i < $n_chapter_single_count; $i ++) {
							$s_ok = '';
							$n_percent = 0;
							$o_study = new User_Study_Chapter ();
							$o_study->PushWhere ( array ('&&', 'ChapterId', '=', $o_chapter_single->getChapterId ( $i ) ) );
							$o_study->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
							if ($o_study->getAllCount () > 0) {
								$n_percent = $o_study->getPercent ( 0 );
							}
							if ($n_percent >= 100) {
								//变成黄色
								$s_ok = 'complete';
								$s_top='op_10';
							}
							if ($n_percent < 100)
							{
								$s_top='op_6';
							}
							if ($n_percent < 60)
							{
								$s_top='op_3';
							}
							$s_icon .= '<div class="row">
					                        <span class="icon-master '.$s_top.'"></span><!-- op_1到op_10控制图标透明度 -->
					                        <h1>'.str_replace( "<br/>","",$o_chapter_single->getCredentialsName ( $i )).'</h1>
					                        <h2 class="'.$s_ok.'">'.$n_percent.'%</h2><!-- 类complete控制100%的文字颜色 -->
					                    </div>';
						
					}
					echo($s_icon);
                	echo('</div>
                	</div>
                	');
                }
                ?>
            
        </div>
        <div class="gift_box" onclick="location='prize.php'">
            <img alt="" src="images/img.png" />
        </div>
        <div class="persnol_title">
            <div class="title_icon">
                <span class="icon-notepad bg_brown"></span>
                <h1>课程学习</h1>
            </div>
            <div class="right_triangle"></div>
            <h3>共<?php echo($n_chapter_count)?>章，全部完成即可获得“荷兰旅游专家”证书及领取礼品</h3>
        </div>
        <?php 
        echo($s_chapter);
        ?>
        <div style="height:5px;overflow:inherit">
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
<?php
echo ($s_html)?>
<?php 
echo($s_javascript);
?>
</body>
</html>
