<?php
//require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
//require_once RELATIVITY_PATH . 'include/bn_user.class.php';
require_once RELATIVITY_PATH . 'include/it_basic.class.php';
class ShowPage extends It_Basic {
	private $O_SingleUser;
	private $O_System;
	public function __construct($o_singleUser = NULL) {
		$this->O_SingleUser = $o_singleUser;
		$this->O_System = new System ( 1 );
	}
	public function getLogo($b = 1,$s_logo='') {
		$s_url = 'index.php';
		if ($b == 0) {
			$s_url = RELATIVITY_PATH . 'index.php';
		}
		if ($this->O_SingleUser == null) {
		
		} else {
			if ($this->O_SingleUser->getType () == 1 || $this->O_SingleUser->getType () == 2) {
				$s_button = '<div onclick="location=\'' . RELATIVITY_PATH . 'sub/travel/index.php\'" class="top_nav" style="margin-left:160px">行程网</div><div onclick="location=\'' . RELATIVITY_PATH . 'sub/library/index.php\'" class="top_nav" style="margin-left:220px">资料库</div><div onclick="location=\'' . RELATIVITY_PATH . 'sub/student/index.php\'" class="top_nav" style="margin-left:280px">旅游专家</div><div onclick="location=\'' . RELATIVITY_PATH . 'sub/ucenter/index.php\'" class="top_nav" style="margin-left:350px">专家后台</div>';
			}
		}		
		if ($s_logo=='')
		{
			$s_logo=$this->O_System->getLogo ();
		}
		$s_html = '
		<table class="logo" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="left"><a href="' . $s_url . '" hidefocus="true" title="返回首页"><img
					src="' . $s_logo . '" alt="返回首页" /></a></td>
				<td class="right">' . $s_button . '<img src="' . RELATIVITY_PATH . 'images/lianmeng01.png" alt="" /></td>
			</tr>
		</table>
		';
		return $s_html;
	}
	public function getLogoForMobile($b = 1,$s_logo='') {
		if ($this->O_SingleUser!=null)
		{
			if($this->O_SingleUser->getUid()>0)
			{
				$b = 1;
			}
		}		
		$s_url = 'ucenter.php';
		if ($b == 0) {
			$s_url = 'index.php';
		}
		$s_html = '
		<div class="title">
	        <img alt="" onclick="location=\''.$s_url.'\'" class="title_l" src="images/logo-full.png" />
	        <img alt="" class="title_r" src="images/logo-Alliance-China.png" />
	    </div>
		';
		return $s_html;
	}
	public function getContact() {
		
		return $this->O_System->getContact ();
	}
	public function getTop($s_class, $o_user) {
		if ($o_user->getName () == null & $o_user->getComeFrom()!='travel') {
			$s_html = '
		<table class="my" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="title ' . $s_class . '">&nbsp;</td>
				<td class="title_right right_other">
				<div class="top">
				<div></div>
				</div>
				<div class="down">
				<div class="jiao"></div>
				<div class="text">欢迎您来到荷兰旅游专家</div>
				<div class="reg" title="注册荷兰旅游专家"
					onclick="goTo(\'' . RELATIVITY_PATH . 'register_1.php\')"></div>
				</div>
				</td>
			</tr>
		</table>
		';
		} else {
			$s_button = '<div class="botton" title="去兑换奖品" onclick="goTo(\'' . RELATIVITY_PATH . 'sub/student/prize.php\')">积分换礼品</div>';
			if ($s_class == 'title_prize') {
				$s_button = '<div class="botton" title="查看积分记录" onclick="goTo(\'' . RELATIVITY_PATH . 'sub/student/vantage.php\')">查看积分记录</div>';
			}
			$o_information = new Information ();
			$o_information->PushWhere ( array ('&&', 'State', '=', 1 ) );
			if ($o_information->getAllCount () > 0 && $s_class != 'title_info') {
				$s_button .= '<div class="botton" title="去领取材料" onclick="goTo(\'' . RELATIVITY_PATH . 'sub/student/information.php\')">领取材料</div>';
			}
			$s_html = '
		<table class="my" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="title ' . $s_class . '">&nbsp;</td>
				<td class="title_right right_other">
				<div class="top">
				<div></div>
				<div></div>
				</div>
				<div class="down">
				<div class="jiao"></div>
				<div class="text">欢迎你：' . $o_user->getName () . '&nbsp;&nbsp;&nbsp;&nbsp;
				当前积分：<a id="user_vantage" href="vantage.php" title="查看积分记录">' . $o_user->getVantage () . '</a> 分</div>' . $s_button . '
				<div class="exit" title="退出系统"
					onclick="Dialog_Confirm(\'确定离开荷兰旅游专家在线培训系统吗？\',function(){location=\'' . RELATIVITY_PATH . 'index.php?loginout=1\'})">
				</div>
				<div class="return_ucenter" title="返回个人中心"
					onclick="goTo(\'' . RELATIVITY_PATH . 'sub/student/index.php\')"></div>
				</div>
				</td>
			</tr>
		</table>
		';
		}
		return $s_html;
	}
	public function getFooter() {
		$s_html = '
		<table class="footer" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="weixin"><div><img src="' . RELATIVITY_PATH . 'images/erwei_code2.jpg" alt="微信扫描二维码，关注荷兰国家旅游会议促进局" /></div><div style="display:none"><div class="icon"><img src="' . RELATIVITY_PATH . 'images/weixin_icon.jpg"/></div><div class="button">成为荷兰好友</div></div></td>
				<td class="weibo"><div><a target="_blank" title="点击后关注荷兰国家旅游会议促进局" href="http://e.weibo.com/nbtc"><img src="' . RELATIVITY_PATH . 'images/weibo_icon_big.jpg" alt="点击后关注荷兰国家旅游会议促进局" /></a></div><div><div class="icon"><img src="' . RELATIVITY_PATH . 'images/weibo_icon.jpg"/></div><div class="button"><a href="http://e.weibo.com/nbtc" target="_blank">关注微博</a></div></div></td>
				<td class="text">&nbsp;' . $this->O_System->getCopyright () . '&nbsp;<div></div></td>
			</tr>
		</table>
				<iframe width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="http://www.hollandtravelexpert.com/runemailservice.aspx"></iframe>
		';
		return $s_html;
	}
	public function getFooterForMobile() {
		$s_html = '
		<div class="page_bottom">
            <h1>Copyright©2013 Holland.com.cn Allrights reserved<br />荷兰国家旅游会议促进局官方网站 版权所有</h1>
        </div>
        <iframe width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="http://www.hollandtravelexpert.com/runemailservice.aspx"></iframe>
		';
		return $s_html;
	}
	public function getFirend() {
		$s_html = '
		<table class="firend" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="title"></td>
			</tr>
			<tr>
				<td class="icon"><div class="partner_icon">';
		$o_partners = new Partners ();
		$o_partners->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_partners->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_partners->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<a href="' . $o_partners->getUrl ( $i ) . '" hidefocus="true" target="_blank" title="' . $o_partners->getTitle ( $i ) . '"><img src="' . $o_partners->getIcon ( $i ) . '" alt="' . $o_partners->getTitle ( $i ) . '" /></a>';
		}
		$s_html .= '</div>
					<div class="holland">
						<a class="hollandicon" href="http://cn.holland.com/" hidefocus="true" target="_blank" title="荷兰国家旅游会议促进局">
                        	<img src="' . RELATIVITY_PATH . 'images/holland.jpg" alt="荷兰国家旅游会议促进局" />
                        </a>
					</div>
				</td>
			</tr>
		</table>';
		return $s_html;
	}
	public function getFriendForMobile() {
		$s_html = '
		<div class="cooperative_brand">
            <div class="brand_box">';
		$o_partners = new Partners ();
		$o_partners->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_partners->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_partners->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<img onclick="window.open(\''.$o_partners->getUrl($i).'\',\'_blank\')" src="' . $o_partners->getIcon ( $i ) . '" />';
		}
		$s_html .= '            
			</div>
        </div>';
		return $s_html;
	}
	public function getUcenterNews() {
		$o_new = new News ();
		$o_new->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_new->PushOrder ( array ('Date', 'D' ) );
		$o_new->setStartLine ( 0 ); //起始记录
		$o_new->setCountLine ( 8 );
		$n_count = $o_new->getAllCount ();
		$n_count = $o_new->getCount ();
		$s_newlist1 = '';
		$s_newlist2 = '';
		for($i = 0; $i < $n_count; $i ++) {
			if ($i < 4) {
				$s_newlist1 .= '<div><a href="javascript:;" title="' . $o_new->getTitle ( $i ) . '" onclick="goToOpen(\'' . RELATIVITY_PATH . 'news.php?newsid=' . $o_new->getNewsId ( $i ) . '\')">' . $this->CutStr ( $o_new->getTitle ( $i ), 35 ) . '<span>&nbsp;&nbsp;&nbsp;&nbsp;' . $o_new->getDate ( $i ) . '</span></a></div>';
			} else {
				$s_newlist2 .= '<div><a href="javascript:;" title="' . $o_new->getTitle ( $i ) . '" onclick="goToOpen(\'' . RELATIVITY_PATH . 'news.php?newsid=' . $o_new->getNewsId ( $i ) . '\')">' . $this->CutStr ( $o_new->getTitle ( $i ), 35 ) . '<span>&nbsp;&nbsp;&nbsp;&nbsp;' . $o_new->getDate ( $i ) . '</span></a></div>';
			}
		}
		$s_html = '
                    <table class="ucenter_new" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="title">
                                    <div>
                                    </div>
                                </div>
                                <div class="list">' . $s_newlist1 . '</div>
                                <div class="list">' . $s_newlist2 . '</div>
                                <div class="button">
                                    <div class="text">
                                    </div>
                                    <div class="next" title="更多新闻资讯" onclick="goTo(\'../../news.php\')">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
		';
		return $s_html;
	}
	public function getAdvert() {
		$o_advert = new Advert ();
		$o_advert->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_advert->PushWhere ( array ('&&', 'AdvertId', '<>', 1 ) );
		$o_advert->PushWhere ( array ('&&', 'AdvertId', '<>', 2 ) );
		$o_advert->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_advert->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_advert->getAllCount ();
		$n_line = 1;
		$n_sum = 0; //倒数第一行，不要底部边框
		$s_html = '';
		for($i = 0; $i < $n_count; $i ++) {
			$s_class = '';
			$s_java = 'goTo';
			if ($o_advert->getSize ( $i ) == 1) {
				$n_sum ++;
				$s_class = 'app1';
			} else if ($o_advert->getSize ( $i ) == 2) {
				$n_sum = $n_sum + 2;
				$s_class = 'app2';
			} else {
				$n_sum = $n_sum + 1;
				$s_class = 'app3';
			}
			if ($n_sum <= 4) {
				//输出没有底部边框的					
				$s_class = $s_class . ' apptopnone';
			}
			if (abs ( $n_sum % 4 ) == 0) {
				$s_class = $s_class . ' apprightnone';
			}
			if ($o_advert->getOpen ( $i ) == 1) {
				$s_java = 'goToOpen';
			}
			if ($o_advert->getOnover ( $i ) == '') {
				//输出没有图片替换的
				$s_html .= '<div title="' . $o_advert->getTitle ( $i ) . '" class="' . $s_class . '" style="background-image: url(\'' . $o_advert->getOnout ( $i ) . '\')" onclick="' . $s_java . '(\'' . $o_advert->getUrl ( $i ) . '\')"></div>';
			} else {
				//输出有图片替换的
				$s_html .= '<div title="' . $o_advert->getTitle ( $i ) . '" class="' . $s_class . '"
										style="background-image: url(\'' . $o_advert->getOnout ( $i ) . '\')"
										onclick="' . $s_java . '(\'' . $o_advert->getUrl ( $i ) . '\')"
										onmouseover="changeBackground(this,\'' . $o_advert->getOnover ( $i ) . '\')"
										onmouseout="changeBackground(this,\'' . $o_advert->getOnout ( $i ) . '\')"></div>';
			}
		}
		$s_html = '
                    <table class="app" border="0" cellpadding="0" cellspacing="0" style="margin-top:25px">
                        <tr>
                            <td>
                                ' . $s_html . '
                            </td>
                        </tr>
                    </table>
		';
		return $s_html;
	}
	public function getTerms() {
		$s_html = '
                    <table class="content" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                            <div>                            
							' . $this->O_System->getTerms () . '
                            </div>
                            </td>
                        </tr>
                    </table>
		';
		return $s_html;
	}
	public function getRegSuccessPhoto() {
		return '<img style="width:710px;height:343px" src="' . $this->O_System->getRegSuccessPhoto () . '" alt="" />';
	}
	public function getNewsList() {
		$o_new = new News ();
		$o_new->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_new->PushOrder ( array ('Date', 'D' ) );
		$o_new->PushOrder ( array ('NewsId', 'D' ) );
		$n_count = $o_new->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_title = '<div><a href="news.php?newsid=' . $o_new->getNewsId ( $i ) . '" target="_blank">' . $o_new->getTitle ( $i ) . '</a></div>';
			$s_date = $o_new->getDate ( $i );
			if (($i + 1) < $n_count) {
				while ( $o_new->getDate ( $i ) == $o_new->getDate ( $i + 1 ) ) {
					$i ++;
					$s_title .= '<div><a href="news.php?newsid=' . $o_new->getNewsId ( $i ) . '" target="_blank">' . $o_new->getTitle ( $i ) . '</a></div>';
					if (($i + 1) >= $n_count) {
						break;
					}
				}
			}
			$s_html .= '
									<tr>
                                        <td class="icon">
                                            <div align="center">
                                                ' . $s_date . '</div>
                                        </td>
                                        <td class="title">
                                            ' . $s_title . '
                                        </td>
                                    </tr>
			';
		}
		$s_html = '
					<table class="news" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="left">
                                <table class="list" border="0" cellpadding="0" cellspacing="0">
                                ' . $s_html . '
                                </table>
                            </td>
                            <td class="right">
                                &nbsp;
                            </td>
                        </tr>
                    </table>
		';
		return $s_html;
	}
	public function getNewsListForMobile() {
		$o_new = new News ();
		$o_new->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_new->PushOrder ( array ('Date', 'D' ) );
		$o_new->PushOrder ( array ('NewsId', 'D' ) );
		$n_count = $o_new->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_type='';
			if ($i%2==0)
			{
				$s_type=' bg';
			}
			$s_title = '<div class="news_div'.$s_type.'" onclick="window.open(\'news.php?newsid='.$o_new->getNewsId ( $i ).'\',\'_blank\')"><h1>' . $o_new->getTitle ( $i );
			$s_date = $o_new->getDate ( $i );
			$s_html .= $s_title.'				
	                </h1>
	                <h2>'.$s_date.'</h2>
	            </div>
			';
		}
		$s_html = '
		<div class="news_list_box">
                                ' . $s_html . '

         </div>
		';
		return $s_html;
	}
	public function getNewsForMobile() {
		$o_new = new News ();
		$o_new->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_new->PushOrder ( array ('Date', 'D' ) );
		$o_new->setStartLine ( 0 ); //起始记录
		$o_new->setCountLine ( 4 );
		$n_count = $o_new->getAllCount ();
		$n_count = $o_new->getCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_list.='
				<li class="bg_c1" onclick="location=\'news.php?newsid=' . $o_new->getNewsId ( $i ) . '\'">
                    <span class="icon-news"></span>
                    <div class="message_text">
                        <h1>'.$o_new->getTitle ( $i ).'</h1>
                        <h2>' . $o_new->getDate ( $i ) . '</h2>
                    </div>
                </li>
						';
		}
		$s_html = '
				<div class="new_message">
		            <div class="message_title">
		                <h1>最新资讯</h1>
		                <span class="icon-next" onclick="location=\'news.php\'"></span>
		            </div>
		            <ul>
		                '.$s_list.'
		            </ul>
		        </div>
		';
		return $s_html;
	}
	public function getAdvertForMobile() {
		$s_html = '
		<div class="partner_box">
            <div class="klm_div" onclick="window.open(\'https://www.klm.com/home/cn/cn\',\'_blank\')">
                <img class="klm_img" alt="" src="images/off1.jpg" />
                <div class="klm_bottom">
                    <img class="klm_logo" alt="" src="images/logo-klm.png" />
                    <h1>荷兰皇家航空公司</h1>
                </div>
            </div>
            <div class="cjj_airport_div">
                <div class="partner cjj_div" onclick="window.open(\'http://www.holland.com/cn/tourism.htm\',\'_blank\')">
                    <img alt="" src="images/off2.jpg" />
                    <h1>荷兰国家旅游<br />会议促进局</h1>
                </div>
                <div class="partner air_div" onclick="window.open(\'http://www.schiphol.com\',\'_blank\')">
                    <img alt="" src="images/off3.jpg" />
                    <h1>阿姆斯特丹<br />史基浦机场</h1>
                </div>
                <div class="amsterdam_div" onclick="window.open(\'http://www.iamsterdam.com\',\'_blank\')">
                    <img class="amsterdam_img" alt="" src="images/off5.jpg" />
                    <div class="amsterdam_botttom">
                        <img alt="" src="images/logo-iamsterdam.png" />
                        <h1>阿姆斯特丹市</h1>
                    </div>
                </div>
            </div>
        </div>';
		return $s_html;
	}
	public function getNews($n_newsid) {
		$o_new = new News ( $n_newsid );
		if ($o_new->getState () == 0) {
			return '<script><script type="text/javascript">location=\'' . RELATIVITY_PATH . 'news.php</script></script>';
		}
		//获取上一条新闻的NewsId
		$o_temp = new News ();
		$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_temp->PushWhere ( array ('&&', 'NewsId', '<>', $n_newsid ) );
		$o_temp->PushWhere ( array ('&&', 'Date', '>=', $o_new->getDate () ) );
		$o_temp->PushOrder ( array ('Date', 'A' ) );
		$o_temp->PushOrder ( array ('NewsId', 'A' ) );
		if ($o_temp->getAllCount () > 0) {
			$s_button1 = '<div class="but" align="center" style="font-family:微软雅黑;" onclick="goTo(\'news.php?newsid=' . $o_temp->getNewsId ( 0 ) . '\')">上一条</div>';
		} else {
			$s_button1 = '';
		}
		//获取下一条新闻的NewsId
		$o_temp = new News ();
		$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_temp->PushWhere ( array ('&&', 'NewsId', '<>', $n_newsid ) );
		$o_temp->PushWhere ( array ('&&', 'Date', '<=', $o_new->getDate () ) );
		$o_temp->PushOrder ( array ('Date', 'D' ) );
		$o_temp->PushOrder ( array ('NewsId', 'D' ) );
		if ($o_temp->getAllCount () > 0) {
			$s_button2 = '<div class="but" align="center" style="font-family:微软雅黑;" onclick="goTo(\'news.php?newsid=' . $o_temp->getNewsId ( 0 ) . '\')">下一条</div>';
		} else {
			$s_button2 = '';
		}
		$s_html = '
					  <table class="news_content" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="left">
                            <div class="date" align="center">' . $o_new->getDate () . '</div>                            
                            ' . $s_button2 . '  
                            ' . $s_button1 . '                          
                            <div class="content_title" align="center" style="font-family:微软雅黑;">
                                ' . $o_new->getTitle () . '
                                </div>
                                <div class="content">
                                ' . $o_new->getContent () . '
                                </div>
                            ' . $s_button2 . '
                           ' . $s_button1 . '
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
		';
		return $s_html;
	}
	public function getNewsContentForMobile($n_newsid) {
		$o_new = new News ( $n_newsid );
		if ($o_new->getState () == 0) {
			return '<script><script type="text/javascript">location=\'news.php</script></script>';
		}
		//获取上一条新闻的NewsId
		$o_temp = new News ();
		$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_temp->PushWhere ( array ('&&', 'NewsId', '<>', $n_newsid ) );
		$o_temp->PushWhere ( array ('&&', 'Date', '>=', $o_new->getDate () ) );
		$o_temp->PushOrder ( array ('Date', 'A' ) );
		$o_temp->PushOrder ( array ('NewsId', 'A' ) );
		if ($o_temp->getAllCount () > 0) {
			$s_button1 = '<div class="next_but b_bg" onclick="location=\'news.php?newsid=' . $o_temp->getNewsId ( 0 ) . '\'">上一条</div>';
		} else {
			$s_button1 = '';
		}
		//获取下一条新闻的NewsId
		$o_temp = new News ();
		$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_temp->PushWhere ( array ('&&', 'NewsId', '<>', $n_newsid ) );
		$o_temp->PushWhere ( array ('&&', 'Date', '<=', $o_new->getDate () ) );
		$o_temp->PushOrder ( array ('Date', 'D' ) );
		$o_temp->PushOrder ( array ('NewsId', 'D' ) );
		if ($o_temp->getAllCount () > 0) {
			$s_button2 = '<div class="next_but b_bg" onclick="location=\'news.php?newsid=' . $o_temp->getNewsId ( 0 ) . '\'">下一条</div>';
		} else {
			$s_button2 = '';
		}
		$s_html = '
					<div class="content_box bg">
			            <div class="news_date">
			                <h1>' . $o_new->getDate () . '</h1>
			            </div>
			            <h2>' . $o_new->getTitle () . '</h2>
			            <div class="content">
			                ' . $this->fixMobileContent($o_new->getContent ()) . '
			            </div>
			            <div class="news_button">
			                '.$s_button2.'
			                '.$s_button1.'
			            </div>
			        </div>		
		';
		return $s_html;
	}
}

?>