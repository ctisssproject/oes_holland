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
			$s_html = '<script type="text/javascript">Dialog_Success("恭喜：邮箱邮件成功！<br/>点击确认，即可开启荷兰旅游专家在线学习之旅！")</script>';
		} else {
			echo ('<script type="text/javascript">location=\'' . RELATIVITY_PATH . 'index.php?email=true\'</script>');
			exit ( 0 );
		}
	}
}
//验证是否要审核
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
//验证个人资料是否齐全
if($o_user->getName()=="")
{
	echo ('<script type="text/javascript">location=\'modify_info.php?need=1\'</script>');
	exit ( 0 );	
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
<title>荷兰旅游专家-个人中心</title>
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
</head>
<body>
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<?php
		echo ($o_showpage->getLogo ())?>
		<table class="my" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="title">&nbsp;</td>
				<td class="title_right">
				<div class="top">
				<div></div>
				<div></div>
				</div>
				<div class="down">
				<div class="jiao"></div>
				<div class="text">欢迎你：<?php
				echo ($o_user->getName ())?>&nbsp;&nbsp;&nbsp;&nbsp;
				</div> 
				<div class="exit" title="退出系统"
					onclick="Dialog_Confirm('确定离开荷兰旅游专家在线培训系统吗？',function(){location='../../index.php?loginout=1'})">
				</div>
				<div class="modify_password" title="修改登录密码"
					onclick="goTo('modify_password.php')"></div>
				</div>

				</td>
			</tr>
			<tr>
				<td class="reginfo">
				<div class="bj">
				<div><span>当前注册：</span><br />
				<?php
				//读取当前用户数
				$o_user_count = new User ();
				$o_user_count->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				echo ($o_user_count->getAllCount ());
				?> 人<br />
				<span>专家称号：</span><br />
				<?php
				//读取专家称号人数
				$o_user_count = new User ();
				$o_user_count->PushWhere ( array ('&&', 'Type', '>=', 4 ) );
				echo ($o_user_count->getAllCount ());
				?> 人<br />
				<span>我的排名：</span><br />第&nbsp;<?php
				//如果我是专家，就排名第一位，如果不是排名专家数加一 
				if ($o_user->getType () >= 4) {
					echo (1);
				} else {
					echo ($o_user_count->getAllCount () + 1);
				}
				?>&nbsp;位</div>
				<div style="display:none" class="down"
					onclick="Dialog_Iframe('dialog/invitation_firend.php',252,260)"
					title="给好友发送邀请函"></div>
				</div>
				</td>
				<td class="icon">
				<div style="float: left; width: 108px">
				<div class="_1" onclick="goTo('modify_photo.php')" title="修改头像"></div>
				<div class="_2"><img
					src="<?php
					if ($o_user->getPhoto () == '') {
						echo ('images/user_photo.jpg');
					} else {
						echo ($o_user->getPhoto ());
					}
					?>"
					alt="" /></div>
				<div class="_6" title="修改个人信息" onclick="goTo('modify_info.php')"></div>
				</div>
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
					if (strlen ( $n_temp ) == 1) {
						$s_number = '<img src="images/number_white/point.png" alt="" /><img src="images/number_white/0.png" alt="" /><img src="images/number_white/' . $n_temp . '.png" alt="" />';
					}
					if (strlen ( $n_temp ) == 2) {
						$s_number = '<img src="images/number_white/point.png" alt="" /><img src="images/number_white/' . substr ( $n_temp, 0, 1 ) . '.png" alt="" /><img src="images/number_white/' . substr ( $n_temp, 1, 1 ) . '.png" alt="" />';
					}
					//计算进度条
					$n_width = floor ( 307 * $n_percent / 100 );
					//计算显示按钮
					$s_onover = 'onmouseover="courseJiaoOn(this)" onmouseout="courseJiaoOff(this)"';
					$s_jiao = '<div class="jiao"></div>';
					$s_info_icon="开始学习";
					$s_photo = $o_chapter->getPhotoOff ( $i );
					$s_info_bj='start';
					$s_color="start_c";
					if ($n_percent >= 100) {
						$s_area = ''; //继续学习与开始学习的区别
						$s_button = ' title="点击后复习" onclick="goTo(\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '\')"';
						$s_onover = 'onmouseover="courseButtonOn(this)" onmouseout="courseButtonOff(this)"';
						$s_jiao = ''; //不显示三角
						$s_photo = $o_chapter->getPhotoOn ( $i ); //点亮图片
						$s_info_icon="复习本章";
						$s_info_bj='fuxi';
						$s_color="fuxi_c";
					} else if ($n_percent == 0) {
						$s_area = ''; //继续学习与开始学习的区别
						$s_button = ' title="点击后开始学习" onclick="goTo(\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '\')"';
					} else {
						$s_color="goon_c";
						$s_info_bj='goon';
						$s_info_icon="继续学习";
						$s_area = '2'; //继续学习与开始学习的区别
						$s_button = ' title="点击后继续学习" onclick="goTo(\'chapter.php?chapterid=' . $o_chapter->getChapterId ( $i ) . '&goon=1\')"';
					}
					//当时第三个的时候 没有右边距离
					if (abs ( ($i+1) % 3 )==0)
					{
						$s_class.=' noneright';
					}
					
					$s_chapter .= '
								<div class="' . $s_class . '" align="center"'.$s_button.'>
                                    <div class="chapter_number">' . $s_number . '</div>
                                    <div class="chapter_title">' . $o_chapter->getName ( $i ) . '</div>
                                    <div class="chapter_icon"><img src="' . $s_photo . '" alt="" /></div>
                                    <div class="chapter_info">
                                    	<div class="chapter_info_icon '.$s_info_bj.'">'.$s_info_icon.'</div>
                                    	<div class="chapter_info_text">
                                    		已获积分：' . $n_vantage . '<br />
                                            	已完成：' . $n_percent . '%</div>
                                       
                                    </div>
                                    <div class="chapter_roll"><div class="chapter_center '.$s_color.'" style="width:' . $n_width . 'px"></div></div>
                                </div>
					';
				
				}
				//开始补齐课程
				$n_loop = 3 - abs ( $n_chapter_count % 3 );
				if ($n_loop == 3) {
					$n_loop = 0;
				}
				for($i = 0; $i < $n_loop; $i ++) {
					if (($i+1)==$n_loop)
					{
						$s_chapter .= '
                                <div class="none noneright">
                                </div>
					';
					}else{
						$s_chapter .= '
                                <div class="none">
                                </div>
					';
					}
					
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
										<script>Dialog_Success("恭喜您，您已通过所有课程学习，获得了“荷兰旅游专家”证书！特奖励' . $o_system->getReward () . '积分！<br/>点击“确定”填写证书寄送地址！",function(){successExam(1)});</script>
										';
				}
				if ($o_user->getType () == 5 ||$n_total>=100) {
					//完成，显示证书
					$o_credential=new Credential($o_user->getCredentialId ());
					echo ('	<div class="_4_ok" title="更改证书样式" style="background-image: url(\''.$o_credential->getIcon().'\');"  align="center" onclick="Dialog_Iframe(\'dialog/send_credential.php\',252,385)">
									<div class="text">
										' . $o_user->getName () . '
									</div>
								</div>');
					$o_user->setPercent ( 100 );
				} else {
					$o_user->setPercent ( $n_total );
					echo ('	<div class="_4 __' . $n_class . '">
								<div class="top"></div>
								<div class="text"><span>-完成度-</span><br />
								' . $n_total . '%</div>
							</div>');
				}
				$o_user->Save ();
				//动态显示积分，如果没有单项专家，就显示积分
									//动态显示单项专家
					if ($n_chapter_single_count > 2) {
						//使用宽屏
						$s_class = ' big';
					} else {
						//使用窄屏幕
						$s_class = '';
					}
					for($i = 0; $i < $n_chapter_single_count; $i ++) {
						if ($i > 3) {
							break;
						}
						$s_ok = '';
						$n_percent = 0;
						$o_study = new User_Study_Chapter ();
						$o_study->PushWhere ( array ('&&', 'ChapterId', '=', $o_chapter_single->getChapterId ( $i ) ) );
						$o_study->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
						if ($o_study->getAllCount () > 0) {
							$n_percent = $o_study->getPercent ( 0 );
						}
						$n_height = floor ( 30 * $n_percent / 100 );
						if ($n_percent >= 100) {
							//变成黄色
							$s_ok = 'ok';
						}
						$n_top = 30 - $n_height;
						$s_icon .= '<div>
                                  		<div class="icon">
                                        	<div class="text' . $s_ok . '" align="center">
                                            	' . $n_percent . '%
                                            </div>
                                            <div class="zhezhao">
                                            </div>
                                            <div class="bj' . $s_ok . '" style="margin-top: ' . $n_top . 'px; height: ' . $n_height . 'px">
                                            </div>
                                        </div>
                                        <div class="name">
                                        	' . $o_chapter_single->getCredentialsName ( $i ) . '
                                        </div>
                                   </div>';
					
					}
					//添加展开单项专家
					$s_add = '';
					if ($n_chapter_single_count > 4) {
						$s_add .= '<div class="_5 add big" id="single_add"><div class="down">';
						for($i = 4; $i < $n_chapter_single_count; $i ++) {
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
								$s_ok = 'ok';
							}
							$n_height = floor ( 30 * $n_percent / 100 );
							$n_top = 30 - $n_height;
							$s_add .= '<div>
                                  		<div class="icon">
                                        	<div class="text' . $s_ok . '" align="center">
                                            	' . $n_percent . '%
                                            </div>
                                            <div class="zhezhao">
                                            </div>
                                            <div class="bj' . $s_ok . '" style="margin-top: ' . $n_top . 'px; height: ' . $n_height . 'px">
                                            </div>
                                        </div>
                                        <div class="name">
                                        	' . $o_chapter_single->getCredentialsName ( $i ) . '
                                        </div>
                                   </div>';
						}
						$s_add .= '</div></div><div class="_5mouse" onmouseover="$(\'#single_add\').slideToggle();" onmouseout="$(\'#single_add\').slideToggle();"></div>';
					}
					echo ('<div style="float: left;">
                                    <div class="_5' . $s_class . '" align="center">
                                        <div class="top">
                                            <div class="text">
                                            </div>
                                            <div class="jiao">
                                            </div>
                                        </div>
                                        <div class="down" align="left">
                                        ' . $s_icon . '
                                        </div>
                                    </div>
                                    ' . $s_add . '
                          </div>');
					//三种情况，积分一位，积分两位，积分三位
					$n_vantage = $o_user->getVantage ();
					if (strlen ( $n_vantage ) == 1) {
						$s_img = '<img src="images/fen_' . $n_vantage . '.png" alt="点击查看积分记录" />';
					}
					if (strlen ( $n_vantage ) == 2) {
						$s_img = '<img src="images/fen_' . substr ( $n_vantage, 0, 1 ) . '.png" alt="点击查看积分记录" /><img src="images/fen_' . substr ( $n_vantage, 1, 1 ) . '.png" alt="点击查看积分记录" />';
					}
					if (strlen ( $n_vantage ) == 3) {
						$s_img = '<img src="images/fen_' . substr ( $n_vantage, 0, 1 ) . '.png" alt="点击查看积分记录" /><img src="images/fen_' . substr ( $n_vantage, 1, 1 ) . '.png" alt="点击查看积分记录" /><img src="images/fen_' . substr ( $n_vantage, 2, 1 ) . '.png" alt="点击查看积分记录" />';
					}
					echo ('
						<div class="_3">
							<div class="top">
								<div class="text"></div>
								<div class="jiao"></div>
							</div>
							<div class="center" title="点击查看积分记录" onclick="goTo(\'vantage.php\')">' . $s_img . '</div>
						</div>
					');	
					$o_information=new Information();
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
					}
				
				?>	
				
				</td>
			</tr>
		</table>
		<div class="ucneter_prize"><div title="点击去兑换奖品" onclick="goTo('prize.php')"></div></div>
		<div class="ucneter_banner"><div>共<?php echo($n_chapter_count)?>章，全部完成后方可获得“荷兰旅游专家”证书及领取礼品</div></div>
		<table class="course" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="right"><?php
				echo ($s_chapter)?></td>
			</tr>
		</table>
		
        <?php
								echo ($o_showpage->getUcenterNews ())?> 
		<?php
		echo ($o_showpage->getAdvert ())?>  
		<?php
		echo ($o_showpage->getFirend ())?>                   
		<?php
		echo ($o_showpage->getFooter ())?>
		
		
		</td>
	</tr>
</table>
</div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
<?php
echo ($s_html)?>
<?php 
echo($s_javascript);
?>
</body>
</html>