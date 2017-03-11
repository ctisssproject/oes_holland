<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject() );
$o_user = new User ( $O_Session->getUid () );
//验证个人资料是否齐全
if($o_user->getName()=="" && $O_Session->Login () == true && $o_user->getType()>2)
{
	echo ('<script type="text/javascript">location=\'modify_info.php?need=1\'</script>');
	exit ( 0 );	
}
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
<title>荷兰旅游专家-课程学习</title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/ucenter.css" />
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/dialog.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/login.fun.js"></script>
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
			if (strtotime($s_datenow)>strtotime($s_enddate))
			{
				echo('Dialog_Confirm("您好！本期“荷兰旅游专家”在线培训课程答题环节已结束。<br/>您可点击“确认”回到课程页面，继续浏览和了解荷兰旅游资源的相关信息。<br/>答题环节将于下一期课程重新开放时启用");');
			}else {
				echo('Dialog_Confirm("准备好了吗？请点击确认开始答题。",function(){
		    setTimeout(\'$("#start").slideToggle(function(){$("#exam").slideToggle("slow")});document.getElementById("exam").getElementsByTagName("iframe")[0].src="exam.php?sectionid='.$n_section_id.'";\',300);
			})');				
			}
		?>
	}
	</script>
</head>
<body>
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<?php
		if ($b_isuser) {
			echo ($o_showpage->getLogo ());
		} else {
			echo ($o_showpage->getLogo ( 0 ));
		}
		echo ($o_showpage->getTop ( 'title_chapter', $o_user ))?>
		<table class="chapter" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="left">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="top">课程目录</td>
					</tr>
				</table>
					<?php
					//开始构建导航栏
					$o_nav_chapter = new Bank_Chapter ();
					$o_nav_chapter->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
					$o_nav_chapter->PushWhere ( array ('&&', 'State', '=', 1 ) );
					$o_nav_chapter->PushOrder ( array ('Number', 'A' ) );
					$n_nav_chapter_count = $o_nav_chapter->getAllCount ();
					for($i = 0; $i < $n_nav_chapter_count; $i ++) {
						$s_img = 'gray';
						$s_img2 = '';
						$s_class = '';
						$s_section = '';
						$s_title = '展开';
						$s_style = 'style="display:none"';
						if ($n_chapter_id == $o_nav_chapter->getChapterId ( $i )) {
							$s_img = 'yellow';
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
								$s_class_section = ' class="on"';
							}
							$s_section .= '
									<div' . $s_class_section . '><a href="chapter.php?sectionid=' . $o_nav_section->getSectionId ( $j ) . '">' . $o_nav_section->getTitle ( $j ) . '</a></div>
								';
						}
						$s_section = '
							<div id="chapter_' . $o_nav_chapter->getChapterId ( $i ) . '" ' . $s_style . '>
							<table border="0" cellpadding="0" cellspacing="0">
									<tr>
                                        <td class="section">
                                            ' . $s_section . '                                    
                                        </td>
                                    </tr>
                            </table>
                            </div>
							';
						if (strlen ( $o_nav_chapter->getNumber ( $i ) ) == 1) {
							$img = '<img src="images/number_' . $s_img . '/' . $o_nav_chapter->getNumber ( $i ) . '.png" alt="" />';
						} else {
							$img = '<img src="images/number_' . $s_img . '/' . substr ( $o_nav_chapter->getNumber ( $i ), 0, 1 ) . '.png" alt="" /><img src="images/number_' . $s_img . '/' . substr ( $o_nav_chapter->getNumber ( $i ), 1, 1 ) . '.png" alt="" />';
						}
						echo ('
						<table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              	<td' . $s_class . ' onclick="goTo(\'chapter.php?chapterid=' . $o_nav_chapter->getChapterId ( $i ) . '\')">
                                	<div class="number">
                                		' . $img . '
                                	</div>
                                	<div class="text">
                                         	' . $o_nav_chapter->getName ( $i ) . '
                                    </div>
                                    <div onclick="navShowSection(this,' . $o_nav_chapter->getChapterId ( $i ) . ')" onmouseout="parentNode.onclick=function(){goTo(\'chapter.php?chapterid=' . $o_nav_chapter->getChapterId ( $i ) . '\')}" class="add' . $s_img2 . '" title="' . $s_title . '"></div>
                                </td>
                           </tr>
                         </table>  
                           ' . $s_section . '
						');
					}
					?>
				</td>

				<td class="right">
				<?php
				if ($b_ischapter) {
					//构造数字
					if (strlen ( $o_chapter->getNumber () ) == 1) {
						$img = '<img src="images/number_yellow/' . $o_chapter->getNumber () . '.png" alt="" />';
					} else {
						$img = '<img src="images/number_yellow/' . substr ( $o_chapter->getNumber (), 0, 1 ) . '.png" alt="" /><img src="images/number_yellow/' . substr ( $o_chapter->getNumber (), 1, 1 ) . '.png" alt="" />';
					}
					echo ('
						<div>
							<div class="title">
								<div class="icon" align="center">
									' . $img . '
								</div>
							<div class="text">' . $o_chapter->getName () . '</div>
						</div>
						<div class="img">
							<img src="' . $o_chapter->getPhoto () . '" alt="" /></div>
						</div>
						');
				}
				?>
				<?php
				//如果是章介绍，采用宽版，如果是节学习，采用短板
				if ($b_ischapter) {
					echo ('<div class="content">
							' . $o_chapter->getContent () . '
							</div>								
						');
				} else {
					echo ('<div class="content section">
							' . $o_section->getContent () . '
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
								<div style="margin-top:50px;"></div>
								<div class="exam_ok" id="success">
									<div class="icon"></div>
									<div class="jiao"></div>
									<div class="text" align="center">你已经通过本节测试，请进入其它章节学习。</div>
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
										<div style="margin-top:50px;"></div>
										<div class="exam_ok" id="success">
											<div class="icon"></div>
											<div class="jiao"></div>
											<div class="text" align="center">你已经通过本节测试，请进入其它章节学习。</div>
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
										<script>Dialog_Success("恭喜您，您已通过所有课程学习，获得了“荷兰旅游专家”证书！特奖励' . $o_system->getReward () . '积分！<br/>点击“确定”填写证书寄送地址！",function(){successExam(1)});</script>
										';
									}
								}else{
									/*echo ('
									<div style="margin-top:50px;"></div>
									<div class="exam_ok" id="success" style="display: none">
										<div class="icon"></div>
										<div class="jiao"></div>
										<div class="text" align="center">您已通过本节测试，请点击下一节，进入新章节学习。</div>
									</div>
									<div class="exam_no" id="start">
										<div class="icon" title="开始答题" onclick="startExam()">
											<div class="jiao2"></div>
										</div>
										<div class="text">点击答题按钮，开始回答问题。<br />
											共 ' . $o_section->getSubjectSum () . ' 题，答对 ' . $o_section->getRate () . '% 便可完成本节课程。
										</div>
										<div class="icon2"></div>
										<div class="jiao"></div>
										<div class="text2">未通过测试，<br />
											可继续答题。
										</div>
									</div>
									<div id="exam" style="display: none">
										<iframe marginwidth="0" border="0" scrolling="no" frameborder="0" src="" style="overflow: hidden; width: 640px; height: 500px">
										</iframe>
									</div>
									');*/
								}
							}
						} else {
							//如果不是会员，显示答题，单点击后需要注册
							/*echo ('
									<div style="margin-top:50px;"></div>
									<div class="exam_no" id="start">
										<div class="icon" title="开始答题" onclick="startExamGuest()">
											<div class="jiao2"></div>
										</div>
										<div class="text">点击答题，加入荷兰旅游专家吧。<br/>注册新会员，积分换好礼。<br />
											</div>
											<div class="icon2">
											</div>
										<div class="jiao">
										</div>
										<div class="text2">未通过测试，<br />
											可继续答题。
										</div>
									</div>
								');*/
						}
					}
				}
				
				?>		
				<div class="share">
				<div class="button" align="center" title="将当前页面分享给好友"
					onclick="Dialog_Iframe('dialog/share_firend.php?chapterid=<?php echo($n_chapter_id)?>',254,230)">分享</div>
				<div class="sina" title="分享到新浪微博"
					onclick="sinaWeibo('我参加了荷兰旅游局《荷兰旅游专家》培训课程，完成课程即可兑换丰富的荷兰特色好礼和实用手册等等。心动不如行动，快快加入课程学习，成为荷兰旅游专家中的一员吧！','http://www.hollandtravelexpert.com','http://www.hollandtravelexpert.com/images/logo.png')">
				</div>
				<div class="qqweibo" title="分享到腾讯微博"
					onclick="qqWeibo('我参加了荷兰旅游局《荷兰旅游专家》培训课程，完成课程即可兑换丰富的荷兰特色好礼和实用手册等等。心动不如行动，快快加入课程学习，成为荷兰旅游专家中的一员吧！','http://www.hollandtravelexpert.com','http://www.hollandtravelexpert.com/images/logo.png')">
				</div>
				<div class="qqzone" title="分享到QQ空间"
					onclick="qqZone('我参加了荷兰旅游局《荷兰旅游专家》培训课程，完成课程即可兑换丰富的荷兰特色好礼和实用手册等等。心动不如行动，快快加入课程学习，成为荷兰旅游专家中的一员吧！','http://www.hollandtravelexpert.com','http://www.hollandtravelexpert.com/images/logo.png')">
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
						<div class="next">
							<div class="_1" title="进入下一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( 0 ) . '\')"></div>
							<div class="_2" title="进入下一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( 0 ) . '\')"></div>
						</div>
					');
					}
				} else {
					if ($o_section->getNumber () == 1 && $n_count > 1) {
						//显示下一节
						echo ('						
						<div class="next">
							<div class="_1" title="进入下一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( 1 ) . '\')"></div>
							<div class="_2" title="进入下一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( 1 ) . '\')"></div>
						</div>
						<div class="prev">
							<div class="_1" title="返回上一节课程" onclick="goTo(\'chapter.php?chapterid=' . $n_chapter_id . '\')"></div>
							<div class="_2" title="返回上一节课程" onclick="goTo(\'chapter.php?chapterid=' . $n_chapter_id . '\')"></div>
						</div>
							');
					} else if ($o_section->getNumber () == $n_count && $n_count > 1) {
						echo ('						
						<div class="prev">
							<div class="_1" title="返回上一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $n_count - 2 ) . '\')"></div>
							<div class="_2" title="返回上一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $n_count - 2 ) . '\')"></div>
						</div>
							');
					} else if ($o_section->getNumber () == 1) {
						echo ('						
						<div class="prev">
							<div class="_1" title="返回上一节课程" onclick="goTo(\'chapter.php?chapterid=' . $n_chapter_id . '\')"></div>
							<div class="_2" title="返回上一节课程" onclick="goTo(\'chapter.php?chapterid=' . $n_chapter_id . '\')"></div>
						</div>
							');
					} else {
						echo ('						
						<div class="next">
							<div class="_1" title="进入下一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $o_section->getNumber () ) . '\')"></div>
							<div class="_2" title="进入下一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $o_section->getNumber () ) . '\')"></div>
						</div>
						<div class="prev">
							<div class="_1" title="返回上一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $o_section->getNumber () - 2 ) . '\')"></div>
							<div class="_2" title="返回上一节课程" onclick="goTo(\'chapter.php?sectionid=' . $o_section_temp->getSectionId ( $o_section->getNumber () - 2 ) . '\')"></div>
						</div>
							');
					}
				}
				?>
				</div>
				</td>
			</tr>
		</table>
		<?php
		echo ($o_showpage->getUcenterNews ());
		echo ($o_showpage->getAdvert ());
		echo ($o_showpage->getFirend ());
		echo ($o_showpage->getFooter ())?>
		</td>
	</tr>
</table>
</div>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
<?php echo($s_javascript)?>
</body>
</html>