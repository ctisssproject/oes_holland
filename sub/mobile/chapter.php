<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject() );
$o_user = new User ( $O_Session->getUid () );
if (is_numeric ( $_GET ["chapterid"] )) {
	$n_chapter_id = $_GET ["chapterid"];
}
if (is_numeric ( $_GET ["sectionid"] )) {
	$n_section_id = $_GET ["sectionid"];
}
$b_isuser = $O_Session->Login (); //是否为登录用户
$b_interm = false; //是否为当前学期
$b_ischapter = false; //是否为章的显示
$n_termid = 0; //保存学期编号
if ($n_section_id > 0) {
	$o_section = new Bank_Section ( $n_section_id );
	$o_chapter = new Bank_Chapter ( $o_section->getChapterId () );
	$o_term = new Bank_Term ( $o_chapter->getTermId () );
	if ($o_term->getState () == 1) {
		$b_interm = true;
	}
	$n_termid = $o_chapter->getTermId ();
	$n_chapter_id = $o_chapter->getChapterId ();
} else if ($n_chapter_id > 0) {
	$o_chapter = new Bank_Chapter ( $n_chapter_id );
	if($o_chapter->getState()==2)
	{
		echo ('<script type="text/javascript">location=\'chapter.php\'</script>');	
		exit (0);
	}
	$o_term = new Bank_Term ( $o_chapter->getTermId () );
	if ($o_term->getState () == 1) {
		$b_interm = true;
	}
	$n_termid = $o_chapter->getTermId ();
	$b_ischapter = true;
	if ($_GET ["goon"] == 1) {
		//来自继续学习
		$o_temp = new Bank_Section ();
		$o_temp->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapter_id ) );
		$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_temp->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_temp->getAllCount ();
		$o_study = new User_Study_Chapter ();
		$o_study->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapter_id ) );
		$o_study->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
		$o_study->getAllCount ();
		$a_finish = explode ( "<1>", $o_study->getFinish ( 0 ) );
		for($i = 0; $i < $n_count; $i ++) {
			if (in_array ( $o_temp->getSectionId ( $i ), $a_finish ) == false) {
				$o_section = new Bank_Section ( $o_temp->getSectionId ( $i ) );
				$n_section_id = $o_temp->getSectionId ( $i );
				$b_ischapter = false;
				break;
			}
		}
	}

} else {
	if (is_numeric ( $_GET ["termid"] )) {
		$o_term = new Bank_Term ($_GET ["termid"]);
		$n_termid = $_GET ["termid"];
	} else {
		$o_term = new Bank_Term ();
		$o_term->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_term->getAllCount ();
		$n_termid = $o_term->getTermId ( 0 );
	}
	$o_chapter = new Bank_Chapter ();
	$o_chapter->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
	$o_chapter->PushWhere ( array ('&&', 'State', '=', 1 ) );
	$o_chapter->PushOrder ( array ('Number', 'A' ) );
	$o_chapter->getAllCount ();
	$o_chapter = new Bank_Chapter ( $o_chapter->getChapterId ( 0 ) );
	$b_ischapter = true;
	$b_interm = true;
	$n_chapter_id = $o_chapter->getChapterId ();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-课程学习</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="Stylesheet" href="css/holland_6.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function set_w() {
            var win_w = $(window).width(),
                i_six_w = Math.round(win_w * 0.94 * 0.23),
                six_m_t = (i_six_w - 60) / 2,
                six_bor = i_six_w / 2 + "px",
                i_six_p = win_w * 0.94 * 0.67 * 0.48,
                six_klm_img_h = i_six_p + 10 + "px",
                info_w = (win_w * 0.94) - 45
                h=$(".title").height()+15;
            
            $(".but_div").css("height", i_six_w);
            $(".lesson_info span , .contact_us span").css("margin-top", six_m_t);
            $(".login_sign_bg , .weixin_weibo_bg").css("border-width", six_bor);
            $(".login_sign_box , .weixin_weibo_box").css("margin-top", -i_six_w);
            $(".login_div , .weibo_div").css({ "width": six_bor, "height": six_bor });
            $(".sign_div , .weixin_div").css({ "width": six_bor, "height": six_bor, "margin-left": six_bor });
            $(".klm_img").css("height", six_klm_img_h);
            $(".amsterdam_img , .klm_bottom , .cjj_div , .air_div").css("height", i_six_p);
            $(".course_info").css("width", info_w);
            $(".left_menu").css("top",h);
        }
        $(function () {
            set_w();
        });
        $(window).on('orientationchange', function () {
            location.reload();
        });
        function move_top() {
            $("html, body").scrollTop(0);
        }
        function show_menu() {
            $(".left_menu").animate({ left: "0" }, 500);
        }
        function hide_menu() {
            $(".left_menu").animate({ left: "-85%" }, 500);
        }
        function show_info(a) {
            var dis = $(a).next("ul").css("display");
            if (dis == "none") {
                $(".left_menu ul").slideUp(500);
                $(".list_info").find("span").removeClass("icon-minus");
                $(".list_info").find("span").addClass("icon-plus");
                $(a).next("ul").slideDown(500);
                $(a).find("span").removeClass("icon-plus");
                $(a).find("span").addClass("icon-minus");
            } else {
                $(a).next("ul").slideUp(500);
                $(a).find("span").removeClass("icon-minus");
                $(a).find("span").addClass("icon-plus");
            }
        }
        function show_help() {
            var dis = $(".share_help").css("display");
            if (dis == "none") {
                $(".share_help").slideDown(500);
                $(".share_but").css("background-color", "#ff6f00");
                $(".share_but span").css("color", "#fff");
            } else {
                $(".share_help").slideUp(500);
                $(".share_but").css("background-color", "#ebe9df");
                $(".share_but span").css("color", "#747474");
            }
        }
    </script>
    <script type="text/javascript">
	function startExam()
	{
		<?php 
			$o_termtest = new Bank_Term ();
			$o_termtest->PushWhere ( array ('&&', 'State', '=', 1 ) );
			$o_termtest->getAllCount ();
			$s_enddate = $o_termtest->getEndDate ( 0 );
			$o_date = new DateTime ( 'Asia/Chongqing' );
			$s_datenow=$o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' );
			if ($s_datenow>$s_enddate)
			{
				echo('window.alert("您好！本期“荷兰旅游专家”在线培训课程答题环节已结束。\n您可点击“确认”回到课程页面，继续浏览和了解荷兰旅游资源的相关信息。\n答题环节将于下一期课程重新开放时启用");');
			}else {
				echo('
				if (window.confirm(\'准备好了吗？请点击确认开始答题。\')){location=\'exam.php?sectionid='.$n_section_id.'\'}
				');				
			}
		?>
	}
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
                <span class="icon-menu bg_brown" onclick="show_menu()"></span>
                <h1>培训课程</h1>
            </div>
            <div class="right_triangle"></div>
            <?php 
            if ($b_isuser && $o_user->getType()>=1)
            {
            	?>
            	<h4>欢迎你:<?php
				echo ($o_user->getName ())?>&nbsp;&nbsp;当前积分:<?php echo($o_user->getVantage ())?>分</h4>
            	<?php
            }else{
            	?>
            	<h4>欢迎您来到荷兰旅游专家</h4>
            	<?php
            }
            ?>
            
        </div>
					<?php
					//开始构建导航栏
					$o_nav_chapter = new Bank_Chapter ();
					$o_nav_chapter->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
					$o_nav_chapter->PushWhere ( array ('&&', 'State', '=', 1 ) );
					$o_nav_chapter->PushOrder ( array ('Number', 'A' ) );
					$n_nav_chapter_count = $o_nav_chapter->getAllCount ();
					for($i = 0; $i < $n_nav_chapter_count; $i ++) {
						$s_img = '';
						$s_img2 = '';
						$s_class = '';
						$s_section = '';
						$s_title = '展开';
						$s_style = 'style="display:none"';
						if ($n_chapter_id == $o_nav_chapter->getChapterId ( $i )) {
							$s_img = ' style="color:#FF7000"';
							$s_class = ' class="open"';
							$s_img2 = ' sub';
							$s_title = '收起';
							$s_style = '';
						}
						//开始构建子目录
						$o_nav_section = new Bank_Section ();
						$o_nav_section->PushWhere ( array ('&&', 'ChapterId', '=', $o_nav_chapter->getChapterId ( $i ) ) );
						$o_nav_section->PushWhere ( array ('&&', 'State', '=', 1 ) );
						$o_nav_section->PushOrder ( array ('Number', 'A' ) );
						$n_nav_section_count = $o_nav_section->getAllCount ();
						for($j = 0; $j < $n_nav_section_count; $j ++) {
							$s_class_section = '';
							if ($o_nav_section->getSectionId ( $j ) == $n_section_id) {
								$s_class_section = ' style="color:#FF7000"';
							}
							$s_section .= '
							<li>
		                        <span>●</span>
		                        <h2'.$s_class_section.' onclick="location=\'chapter.php?sectionid=' . $o_nav_section->getSectionId ( $j ) . '\'">' . $o_nav_section->getTitle ( $j ) . '</h2>
                    		</li>
								';
						}
						$s_section = '
						                <ul>
						                    ' . $s_section . '
						                </ul>
							';
						$s_chapter.='
						<div class="row">
			                <div class="list_info" onclick="show_info(this)">
			                    <h1'.$s_img.' onclick="location=\'chapter.php?chapterid='.$o_nav_chapter->getChapterId ( $i ).'\'">'.$o_nav_chapter->getNumber ( $i ).'.' . str_replace( "<br/>","",str_replace( "<br>","",$o_nav_chapter->getName ( $i ))) . '</h1>
			                    <span class="icon-plus"></span>
			                </div>
			                    '.$s_section.'
			            </div>
						';
					}
					?>
<?php
				if ($b_ischapter) {
					echo ('
					        <div class="box course_title_img">
					            <img alt="" src="' . $o_chapter->getPhoto () . '" />
					        </div>
						');
				}
				?>
				<div class="box course_info_box m_t_4 m_b_15">
				<?php
				//如果是章介绍，采用宽版，如果是节学习，采用短板
				if ($b_ischapter) {
					echo ('
					<div class="course_num">'.$o_chapter->getNumber ().'</div>
					<div class="course_info">
							<h1>&nbsp;&nbsp;' . $o_chapter->getName () . '</h1>
							<div class="content">' . $o_showpage->fixMobileContent($o_chapter->getContent ()) . '</div>
							</div>								
						');
				} else {
					echo ('
					<div class="course_num" style="background-color:white"></div>
					<div class="course_info">
							<h1> ' . $o_chapter->getName () . '</h1>
							<div class="content">' . $o_showpage->fixMobileContent($o_section->getContent ()) . '</div>
							</div>								
						');
					//如果是本学期的，显示答题
					if ($b_interm) {
						//本学期，显示答题
						if ($b_isuser && $o_user->getType()>=1) {
							//如果是会员，开始显示答题
							//读取本会员是否通过该该节
							$o_study = new User_Study_Chapter ();
							$o_study->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
							$o_study->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
							$o_study->PushWhere ( array ('&&', 'Finish', 'LIKE', '%<1>' . $o_section->getSectionId () . '<1>%' ) );
							$o_study->PushWhere ( array ('||', 'Percent', '=', 100 ) );
							$o_study->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
							$o_study->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
							if ($o_study->getAllCount () > 0 || $o_user->getType()==5) {
								//已通过
								echo ('
								<div class="row answer_question">
					                <h1>答题</h1>
					                <div class="answer_left_triangle"></div>
					                <div class="answer_text">
					                    <h2>
					                        您已通过本节测试，<br />请前往其他章节学习。
					                    </h2>
					                </div>
					                <span class="icon-done"></span>
					            </div>
								');
							} else {
								//未通过
								//检测本节下是否有题，如果没有题，那么自动变为已完成。
								$o_subject=new Bank_Subject();
								$o_subject->PushWhere ( array ('&&', 'SectionId', '=', $o_section->getSectionId ()) );
								if ($o_subject->getAllCount()==0)
								{
									require_once 'include/bn_operate.class.php';
									$o_operate = new Operate(); 
									echo ('
										<div class="row answer_question">
							                <h1>答题</h1>
							                <div class="answer_left_triangle"></div>
							                <div class="answer_text">
							                    <h2>
							                        您已通过本节测试，<br />请前往其他章节学习。
							                    </h2>
							                </div>
							                <span class="icon-done"></span>
							            </div>
										');
									//记录本节已被用户学习
									//计算完成度
									$o_user_chapter = new User_Study_Chapter (); //查找用户是否做过
									$o_user_chapter->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid() ) );
									$o_user_chapter->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
									if ($o_user_chapter->getAllCount () > 0) {
										//做过
										$s_temp = $o_user_chapter->getFinish ( 0 );
										$o_user_chapter = new User_Study_Chapter ( $o_user_chapter->getStudyId ( 0 ) );
										$o_user_chapter->setFinish ( $s_temp . $o_section->getSectionId () . '<1>' );
									} else {
										//没做过
										$o_user_chapter = new User_Study_Chapter ();
										$o_user_chapter->setUid ( $o_user->getUid() );
										$o_user_chapter->setChapterId ( $o_section->getChapterId () );
										$o_user_chapter->setFinish ( '<1>' . $o_section->getSectionId () . '<1>' );
									}
									$o_user_chapter->save ();
									//查看该章下有多少节
									$o_temp = new Bank_Section ();
									$o_temp->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
									$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
									$n_section_sum = $o_temp->getAllCount ();
									//获取已完成节的个数
									$a_user_complete = explode ( "<1>", $o_user_chapter->getFinish () );
									$a_user_complete = array_slice ( $a_user_complete, 1, count ( $a_user_complete ) - 1 ); //修正一下，去掉第一个
									$a_user_complete = array_slice ( $a_user_complete, 0, count ( $a_user_complete ) - 1 ); //修正一下，去掉最后一个
									//设置百分百
									if (floor ( count ( $a_user_complete ) / $n_section_sum * 100 )>=100)
									{
										$o_user_chapter->setPercent ( 100);
									}else{
										$o_user_chapter->setPercent ( floor ( count ( $a_user_complete ) / $n_section_sum * 100 ) );
									}			
									//添加积分
									$o_user_chapter->setVantage ( $o_user_chapter->getVantage () + $o_section->getVantage () );
									$o_user_chapter->Save ();
									//开始计算积分
									$o_user = new user ( $o_user->getUid() );
									$o_user->setVantage ( $o_user->getVantage () + $o_section->getVantage () );
									$o_user->Save ();
									if($o_section->getVantage ()>0)
									{
										//添加积分记录
										$o_record = new User_Vantage ();
										$o_record->setUid ( $o_user->getUid() );
										$o_record->setInOut ( 1 ); //入库
										$o_record->setDate ( $o_operate->GetDateNow () );
										$o_record->setBalance ( $o_user->getVantage () ); //余额
										$o_record->setExplain ( '完成课程《' . $o_section->getTitle () . '》获得积分' );
										$o_record->setSum ( $o_section->getVantage () );
										$o_record->Save ();
									}
									//计算整体完成度
									$o_term = new Bank_Term ();
									$o_term->PushWhere ( array ('&&', 'State', '=', 1 ) );
									$o_term->getAllCount ();
									$o_chapter = new Bank_Chapter ();
									$o_chapter->PushWhere ( array ('&&', 'State', '=', 1 ) );
									$o_chapter->PushWhere ( array ('&&', 'TermId', '=', $o_term->getTermId ( 0 ) ) );
									$o_chapter->PushOrder ( array ('Number', 'A' ) );
									$n_chapter_count = $o_chapter->getAllCount ();
									$b_complete = true;
									for($i = 0; $i < $n_chapter_count; $i ++) {
										$o_chapter_user = new User_Study_Chapter ();
										$o_chapter_user->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid() ) );
										$o_chapter_user->PushWhere ( array ('&&', 'ChapterId', '=', $o_chapter->getChapterId ( $i ) ) );
										if ($o_chapter_user->getAllCount () > 0) {
											if ($o_chapter_user->getPercent ( 0 ) < 100) {
												$b_complete = false;
												break;
											}
										} else {
											$b_complete = false;
											break;
										}
									}
									if ($b_complete) {
										//获得荷兰旅游专家证书
										$o_user = new user ( $o_user->getUid() );
										//专家奖分
										$o_system = new system (1);
										if ($o_user->getType ()<3)
										{
											//说明是管理员
										}else{
											$o_user->setType ( 5 ); //变为本年度专家
										}
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
								}else{
									echo ('
									<div class="row answer_question" onclick="startExam()">
						                <h1>答题</h1>
						                <div class="answer_left_triangle"></div>
						                <div class="answer_text">
						                    <h2>
						                        点击答题按钮，开始回答问题。<br />
						                        共'.$o_section->getSubjectSum ().'题，答对' . $o_section->getRate () . '%便可完成本节课程。
						                    </h2>
						                </div>
						                <span class="icon-none"></span>
						            </div>						            
									');
								}
							}
						} else {
							//如果不是会员，显示答题，单点击后需要注册
							echo ('
									<div class="row answer_question" onclick="location=\'register_1.php\'">
						                <h1>答题</h1>
						                <div class="answer_left_triangle"></div>
						                <div class="answer_text">
						                    <h2>
						                        点击答题，加入荷兰旅游专家吧。<br/>注册新会员，积分换好礼。
						                    </h2>
						                </div>
						                <span class="icon-none"></span>
						            </div>				            
									
								');
						}
					}
				}
				?>	         

            <div class="share_help">
                <img alt="" src="images/share.png" />
                <div class="bottom_triangle"></div>
            </div>

            <div class="row m_b_8 m_t_8">
                <div class="go_back" onclick="location='ucenter.php'">
                    返回首页
                </div>
                <div class="go_top" onclick="move_top()">
                    <span class="icon-top"></span>
                </div>
                
                <div class="share_but" onclick="show_help()">
                    <span class="icon-share"></span>
                </div>
<?php
				//构建翻页按钮
				//读取证章的节数
				$o_section_temp = new Bank_Section ();
				$o_section_temp->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapter_id ) );
				$o_section_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
				$o_section_temp->PushOrder ( array ('Number', 'A' ) );
				$n_count = $o_section_temp->getAllCount ();
				if ($b_ischapter) {
					if ($n_count > 0) {
						echo ('
						<div class="next_course" onclick="location=\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( 0 ) . '\'">
						下一节
						</div>
					');
					}
				} else {
					if ($o_section->getNumber () == 1 && $n_count > 1) {
						//显示下一节
						echo ('						
						<div class="next_course" onclick="location=\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( 1 ) . '\'">
						下一节
						</div>
						<div class="previous_course" onclick="location=\'chapter.php?chapterid=' . $n_chapter_id . '\'">
						上一节
						</div>
							');
					} else if ($o_section->getNumber () == $n_count && $n_count > 1) {
						echo ('						
						<div class="previous_course" onclick="location=\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $n_count - 2 ) . '\'">
						上一节
						</div>
							');
					} else if ($o_section->getNumber () == 1) {
						echo ('						
						<div class="previous_course" onclick="location=\'chapter.php?chapterid=' . $n_chapter_id . '\'">
							 上一节
						</div>
							');
					} else {
						echo ('						
						<div class="next_course" onclick="location=\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $o_section->getNumber () ) . '\'">
						 下一节
						</div>
						<div class="previous_course" onclick="location=\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $o_section->getNumber () - 2 ) . '\'">
						 上一节
						</div>
							');
					}
				}
				?>
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


    <div class="left_menu">
        <div class="left_menu_title">
            <div class="hide_but" onclick="hide_menu()">
                <span class="icon-back"></span>
            </div>
            <h1><?php
				echo ($o_user->getName ())?></h1>
			<?php 
        	if ($b_isuser && $o_user->getType()>=1) {
        	?>
            <div class="persnol_center_but" onclick="location='ucenter.php'">
                <span class="icon-user"></span>
                <h2>个人中心</h2>
            </div>
            <?php 
        	}else{
        		?>
        	<div class="persnol_center_but" onclick="location='index.php'">
                <span class="icon-user"></span>
                <h2>返回首页</h2>
            </div>
        		<?php
        	}
            ?>
        </div>
        <?php 
        if ($b_isuser && $o_user->getType()>=1) {
        ?>
        <div class="top_triangle menu_tri_position"></div>
        <div class="integral">
            <div class="now_integral">
                <h1>当前积分</h1>
                <h2><?php echo($o_user->getVantage ())?></h2>
            </div>
            <div class="doc_but"  onclick="location='information.php'">
                <span class="icon-doc"></span>
                <h1>获取资料</h1>
            </div>
            <div class="gift_but" onclick="location='prize.php'">
                <span class="icon-gift"></span>
                <h1>兑换奖品</h1>
            </div>
        </div>
        <?php 
        }
        ?>
        <div class="menu_list">
            <div class="row">
                <div class="list_info">
                    <h1>课程目录</h1>
                </div>
            </div> 
            <?php 
            echo($s_chapter);
            ?>           
        </div>
    </div>
<?php echo($s_javascript)?>
</body>
</html>