<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/it_systext.class.php';
class Bn_Basic {
	protected $B_Operate = false;
	protected $S_ErrorReasion; //出错提示
	protected $B_Success = true;
	protected $S_Content = '';
	protected $S_Title = '';
	protected $N_Uid;
	protected $N_Type;
	protected $S_UserName;
	protected $N_RoleId;
	protected $S_UserPhoto;
	protected $Result;
	protected $S_EdmContent;
	protected $S_EdmTitle;
	protected $S_EdmEmail;
	protected $N_EdmUid = 0;
	protected $S_EdmName = '';
	protected $S_FromEmail='';
	protected $S_ReturnContent='';
	protected function setEdmName($s_str) {
		$this->S_EdmName = $s_str;
	}
	protected function setEdmFromMail($s_str) {
		$this->S_FromEmail = $s_str;
	}
	protected function setEdmContent($s_str) {
		$this->S_ReturnContent=$s_str;
		$this->S_EdmContent = $s_str . $this->S_EdmContent;		
	}
	public function getContent() {
		return $this->S_ReturnContent;
	}
	protected function setEdmEmail($s_str) {
		$this->S_EdmEmail = $s_str;
	}
	protected function setEdmTitle($s_str) {
		$this->S_EdmTitle = $s_str;
	}
	protected function setEdmUser($n_uid) {
		$this->N_EdmUid = $n_uid;
	}
	protected function SendEdm($n_id=0) {
		if ($n_id==0)
		{
			$n_id=rand ( 1, 5 );
		}	
		$o_system = new System ( 1 );
		$o_edm = new Edm ();
		$o_edm->PushWhere ( array ('&&', 'EdmId', '=', $n_id ) );
		$o_edm->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_edm->getAllCount ();
		$s_html = $o_edm->getHtml ( 0 );
		
		//构建标题		
		if ($this->N_EdmUid > 0) {
			$o_user = new user ( $this->N_EdmUid );
			//说明是注册用户，将显示积分
			$s_sex = '';
			if ($o_user->getSex () == '男') {
				$s_sex = '先生';
			} else {
				$s_sex = '女士';
			}
			$this->S_EdmContent = '尊敬的' . $o_user->getName () . $s_sex . $this->S_EdmContent;
			$s_title = '您好：' . $o_user->getName () . '&nbsp;&nbsp;&nbsp;&nbsp;当前积分：' . $o_user->getVantage () . '分';
		} else {
			//说明不是注册用户。只显示姓名
			$s_title = '您好：' . $this->S_EdmName . '&nbsp;&nbsp;&nbsp;&nbsp;“荷兰旅游专家”欢迎您';
			$this->S_EdmContent = '尊敬的用户' . $this->S_EdmName . $this->S_EdmContent;
			;
		}
		$s_html = str_replace ( "<URL/>", $o_system->getHost (), $s_html ); //替换网址
		$s_html = str_replace ( "<URLTRAVEL/>", $o_system->getTravelHost (), $s_html ); //替换网址
		$s_html = str_replace ( "<DATE/>", $this->GetDate (), $s_html ); //替换日期
		$s_html = str_replace ( "<EDMID/>", $o_edm->getEdmId ( 0 ), $s_html ); //替换Id
		$s_html = str_replace ( "<CONTENT/>", $this->S_EdmContent, $s_html ); //替换内容
		$s_html = str_replace ( "<TITLE/>", $s_title, $s_html ); //替换标题	
		//发送邮件
		if ($this->N_EdmUid > 0) {
			$this->JmailSendEmail ( $o_user->getUserName (), $this->S_EdmTitle, $s_html,$this->S_FromEmail );
		} else {
			$this->JmailSendEmail ( $this->S_EdmEmail, $this->S_EdmTitle, $s_html,$this->S_FromEmail);
		}
		$this->S_EdmContent='';
	}
	public function JmailSendEmail($mail, $title, $content,$from) {
		//发送邮件
		$o_email = new Mail ();
		$o_email->setToMail ( $mail );
		$o_email->setTitle ( $title );
		$o_email->setContent ( $content );
		$o_email->setSendDate ( '1979-1-1' );
		$o_email->setFromMail ( $from);
		$o_email->setIsSend(0);		
		$o_email->Save ();
		//用jmail发送邮件
		/*$jmail = new COM ( 'JMail.Message' );		
		$jmail->charset = "GB2312";
		$jmail->ContentType = "text/html";
		$jmail->silent = 'true';		
		$jmail->From = 'service@hollandtravelexpert.com'; //发信人地址，也就是您的邮箱地址
		$jmail->FromName = iconv ( 'UTF-8', 'GB2312', '荷兰国家旅游会议促进局' ); //发信人名字，建议填写您的邮箱地址
		$jmail->AddRecipient ( $mail ); //收信人地址 
		//AddRecipient('xxx@xxx.com'); 可以添加很多的 群发.
		$jmail->Subject = iconv ( 'UTF-8', 'GB2312', $title ); //邮件标题
		//$jmail->Body = $content; //邮件内容
		$jmail->Body = iconv ( 'UTF-8', 'GB2312', $content );
		$jmail->MailServerUserName = 'service@hollandtravelexpert.com'; //如xxx@xxx.com，一般为您的邮件地址
		$jmail->MailServerPassword = 'nbtcbeijing2013'; //您的邮箱登陆密码
		$jmail->Send ( 'smtp.exmail.qq.com' ); //mail.my-1.cn为我们的邮局SMTP地址，需要进行身份认证	*/
	}
	public function SendEmailReg($n_uid, $s_username) { //注册
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰旅游专家在线培训课程注册邮箱激活' );
		$this->setEdmFromMail('registration@hollandtravelexpert.com');
		$this->setEdmContent ( '：<br/>
							欢迎加入荷兰旅游专家的大家庭！<br/><br/>
							请点击以下链接验证邮箱并激活帐号，马上开始荷兰旅游专家在线培训课程的学习吧：<br/>
							<a style="color:#FF7000" href="' . $o_system->getHost () . 'index.php?activation_code=' . md5 ( 'welcome ' . $s_username . ' to 荷兰旅游促进局' ) . '" target="_blank">' . $o_system->getHost () . 'index.php?activation_code=' . md5 ( 'welcome ' . $s_username . ' to 荷兰旅游促进局' ) . '</a><br/>
							如无法点击，请复制链接至浏览器地址栏进行查看。<br/><br/>
							请在3天内验证邮箱激活您的帐号，3天后则需重新注册！<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailFindPassword($n_uid, $s_password) { //找回密码
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰旅游专家在线培训课程密码找回' );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmContent ( '：<br/>
							您的密码成功找回，新密码为：' . $s_password . '<br/>
							请点击以下链接进入“荷兰旅游专家”网站及时修改密码。<br/>
							<a style="color:#FF7000" href="' . $o_system->getHost () . '" target="_blank">' . $o_system->getHost () . '</a><br/>
							如果无法点击，请复制连接地址到浏览器的地址栏查看。<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailInvFirend($n_uid, $s_name, $s_email, $n_code) //邀请好友
{
		$this->S_EdmContent = '';
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_user = new User ( $n_uid );
		$o_system = new System ( 1 );
		$this->setEdmName ( $s_name );
		$this->setEdmEmail ( $s_email );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '您的好友' . $o_user->getName () . '邀请您参加“荷兰旅游专家”在线培训课程' );
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您的好友 “' . $o_user->getName () . '” 邀请您加入由荷兰国家旅游局举办的 “荷兰旅游专家” 在线培训课程。和您的好友一起携手走进荷兰吧！<br/>
						点击下面链接即可进入“荷兰旅游专家”网站进行注册。<br/>	
						<a style="color:#FF7000" href="' . $o_system->getHost () . 'index.php?invitation=' . $n_code . '" target="_blank">' . $o_system->getHost () . 'index.php?invitation=' . $n_code . '</a><br/>
						如无法点击，请复制链接至浏览器的地址栏查看。<br/><br/>
						<strong>荷兰旅游专家在线培训课程轻松学</strong><br/>
						“荷兰旅游专家”在线培训课程于2013年7月初再次面向全国旅游从业人员免费开放。培训课程分为基础课程和提高课程两部分，课程编排融合了视频、图片和风趣的文字，大大增加了学习的趣味性和互动性。新增的提高课程专门为已经获得往期“荷兰旅游专家”证书的同业人员准备，一站式介绍最新的荷兰景点、活动、航班、主题线路等信息。通过轻松的学习，您将在最短的时间了解荷兰最精彩的详尽目的地旅游资源，掌握相关荷兰旅游产品卖点、操作技巧以及实用资讯。从而提升对荷兰旅行线路的设计、操作能力，并有效地为游客提供专业化、合理化的建议。<br/><br/>
						<strong>“荷兰旅游专家”在线培训课程五重礼</strong><br/>
						凡通过本期学习，即可获得“荷兰旅游专家”称号和由荷兰国家旅游局颁发的“荷兰旅游专家”证书，以及多重厚礼：<br/><br/>
						1、获得“荷兰旅游专家”证书并列入“荷兰旅游专家”名单。<br/>
						2、获得第一手荷兰旅游信息，产品卖点，培养专业技能。<br/>
						3、向荷兰旅游局免费索取荷兰地图、荷兰同业手册、荷兰团队导游手册、荷兰自由行手册，及用于门店展示的荷兰百宝箱等。<br/>
						4、积分换礼：通过课程的“荷兰旅游专家”可用答题积分兑换荷兰特色礼品，包括：新版荷兰双肩背包、新版桌摆画《向日葵》和《戴珍珠耳环的少女》、新版荷兰旅行百变围巾等。<br/>
						5、成绩优异者将有机会免费参加荷兰实地考察团。<br/><br/>
						随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
						荷兰国家旅游会议促进局<br/>
						（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailShareFirend($n_uid, $s_name, $s_email, $s_url, $n_chapterid) //分享给好友
{
		$this->S_EdmContent = '';
		$o_chapter = new Bank_Chapter ( $n_chapterid );
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_user = new User ( $n_uid );
		$o_system = new System ( 1 );
		$this->setEdmName ( $s_name );
		$this->setEdmEmail ( $s_email );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '您的好友' . $o_user->getName () . '与您分享了“荷兰旅游专家”在线培训课程' );
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您的好友 “' . $o_user->getName () . '” 希望与您分享“荷兰旅游专家”《' . $o_chapter->getName () . '》章节内容，快来点击以下链接看看吧！<br/><br/>
						<a style="color:#FF7000" href="' . $s_url . '" target="_blank">' . $s_url . '</a><br/>
						如果无法点击，请复制链接至浏览器的地址栏进行查看。<br/><br/>
						<strong>荷兰旅游专家在线培训课程轻松学</strong><br/>
						“荷兰旅游专家”在线培训课程于2013年7月初再次面向全国旅游从业人员免费开放。培训课程分为基础课程和提高课程两部分，课程编排融合了视频、图片和风趣的文字，大大增加了学习的趣味性和互动性。新增的提高课程专门为已经获得往期“荷兰旅游专家”证书的同业人员准备，一站式介绍最新的荷兰景点、活动、航班、主题线路等信息。通过轻松的学习，您将在最短的时间了解荷兰最精彩的详尽目的地旅游资源，掌握相关荷兰旅游产品卖点、操作技巧以及实用资讯。从而提升对荷兰旅行线路的设计、操作能力，并有效地为游客提供专业化、合理化的建议。<br/><br/>
						<strong>“荷兰旅游专家”在线培训课程五重礼</strong><br/>
						凡通过本期学习，即可获得“荷兰旅游专家”称号和由荷兰国家旅游局颁发的“荷兰旅游专家”证书，以及多重厚礼：<br/><br/>
						1、获得“荷兰旅游专家”证书并列入“荷兰旅游专家”名单。<br/>
						2、获得第一手荷兰旅游信息，产品卖点，培养专业技能。<br/>
						3、向荷兰旅游局免费索取荷兰地图、荷兰同业手册、荷兰团队导游手册、荷兰自由行手册，及用于门店展示的荷兰百宝箱等。<br/>
						4、积分换礼：通过课程的“荷兰旅游专家”可用答题积分兑换荷兰特色礼品，包括：新版荷兰双肩背包、新版桌摆画《向日葵》和《戴珍珠耳环的少女》、新版荷兰旅行百变围巾等。<br/>
						5、成绩优异者将有机会免费参加荷兰实地考察团。<br/><br/>
						随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
						荷兰国家旅游会议促进局<br/>
						（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailStudentAllow($n_uid) { //用户审核
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰旅游专家在线培训课程注册审核已通过' );
		$this->setEdmFromMail('registration@hollandtravelexpert.com');
		$this->setEdmContent ( ':<br/>
							恭喜您！您的荷兰旅游专家在线培训课程学习申请已经通过。<br/><br/>
							点击下面链接，马上开始课程的学习吧：<br/>
							<a style="color:#FF7000" href="' . $o_system->getHost () . 'index.php?activation_code=' . md5 ( 'welcome ' . $_POST ['Vcl_UserName'] . ' to 荷兰旅游促进局' ) . '" target="_blank">' . $o_system->getHost () . 'index.php?activation_code=' . md5 ( 'welcome ' . $_POST ['Vcl_UserName'] . ' to 荷兰旅游促进局' ) . '</a><br/>
							如果无法点击，请复制连接地址到浏览器的地址栏查看。<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailRemTerm($n_uid, $o_system) { //新学期提醒
		$this->S_EdmContent = '';
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$this->setEdmUser ( $n_uid );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '参加“荷兰旅游专家”' . $o_date->format ( 'Y' ) . '年度提高课程，赢取更多荷兰丰厚奖品！' );
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							'.$o_date->format ( 'Y' ).'荷兰旅游专家免费在线培训课程正式开课了！这个盛夏，请“荷”我们一起走进荷兰！<br/>
							为了方便小伙伴们学习，'.$o_date->format ( 'Y' ).'季特别增加了手机版学习课程！无论何时何地，只需使用手机浏览器登陆：<a style="color:#FF7000" href="' . $o_system->getHost () . '" target="_blank">' . $o_system->getHost () . '</a>，即可开始轻松学习！关注荷兰旅游会议促进局官方微信账号，荷兰活动一手掌握。
							<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailSendInfo($n_uid, $s_1, $s_2, $s_3, $s_4, $s_5, $s_6) { //资料寄送
		$this->S_EdmContent = '';
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰旅游宣传资料已寄出，请您届时查收' );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您申请的荷兰旅游宣传资料已于' . $this->GetDateNow () . '经' . $s_1 . '（<a href="http://www.qfkd.com.cn" tagert="_blank">http://www.qfkd.com.cn</a>）寄出，运单号：' . $s_2 . ' 请届时查收！<br/><br/>
							邮寄地址如下：<br/>
							收件人：' . $s_3 . '<br/>
							地址：' . $s_4 . '<br/>
							邮编：' . $s_5 . '<br/>
							手机：' . $s_6 . '<br/><br/>
							感谢您对“荷兰旅游专家”在线培训课程的大力支持！ 期待您参与荷兰国家旅游局举办的更多精彩活动！荷兰再相聚！<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailSendPrize($n_uid, $s_1, $s_2, $s_3, $s_4, $s_5, $s_6) { //奖品寄送
		$this->S_EdmContent = '';
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '“' . $o_date->format ( 'Y' ) . '荷兰旅游专家礼品”已寄出，请您届时查收' );
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您的积分兑换礼品已于' . $this->GetDateNow () . '经' . $s_1 . '（<a href="http://www.qfkd.com.cn" tagert="_blank">http://www.qfkd.com.cn</a>）寄出，运单号：' . $s_2 . ' 请届时查收！<br/><br/>
							邮寄地址如下：<br/>
							收件人：' . $s_3 . '<br/>
							地址：' . $s_4 . '<br/>
							邮编：' . $s_5 . '<br/>
							手机：' . $s_6 . '<br/><br/>
							感谢您对“荷兰旅游专家”在线培训课程的大力支持！ 期待您参与荷兰国家旅游局举办的更多精彩活动！荷兰再相聚！<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailSendCredential($n_uid, $s_1, $s_2, $s_3, $s_4, $s_5, $s_6) { //奖品寄送
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '“荷兰旅游专家”证书已寄出，请您届时查收' );
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您的“荷兰旅游专家”证书已于' . $this->GetDateNow () . '经' . $s_1 . '（<a href="http://www.qfkd.com.cn" tagert="_blank">http://www.qfkd.com.cn</a>）寄出，运单号：' . $s_2 . ' 请届时查收！<br/><br/>
							邮寄地址如下：<br/>
							收件人：' . $s_3 . '<br/>
							地址：' . $s_4 . '<br/>
							邮编：' . $s_5 . '<br/>
							手机：' . $s_6 . '<br/><br/>
							感谢您对“荷兰旅游专家”在线培训课程的大力支持！ 期待您参与荷兰国家旅游局举办的更多精彩活动！荷兰再相聚！<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailRemSleep($n_uid, $o_system, $n_percent, $n_user) { //睡眠户提醒
		
		//检查是否学期结束，如果结束，就不提醒了
		$o_termtest = new Bank_Term ();
		$o_termtest->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_termtest->getAllCount ();
		$s_enddate = $o_termtest->getEndDate ( 0 );
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$s_datenow=$o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' );
		if (strtotime($s_datenow)>strtotime($s_enddate))
		{
			return;
		}
		
		$this->S_EdmContent = '';
		$this->setEdmUser ( $n_uid );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '快快完成“荷兰旅游专家”微信版在线培训课程，赢取丰厚荷兰礼品！' );
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您已经有' . $o_system->getIsSleep () . '天没有进行“荷兰旅游专家”微信版在线培训课程的学习了，目前还有 ' . (100 - $n_percent) . '% 的章节没有完成。马上点击下面链接，继续学习吧。<br/><br/>
							目前已有' . $n_user . '位学员完成学习并获得了“荷兰旅游专家”证书，快快迎头赶上吧！<br/><br/>
							<a style="color:#FF7000" href="' . $o_system->getHost () . '" target="_blank">' . $o_system->getHost () . '</a><br/>
							如果无法点击，请复制链接至浏览器的地址栏进行查看。<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendCongratulate($n_uid) { //睡眠户提醒
		$this->S_EdmContent = '';
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$this->setEdmUser ( $n_uid );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmTitle ( '恭喜您通过在线课程学习，成为“荷兰旅游专家”' );
		$this->setEdmContent ( ':<br/><br/>
							恭喜您！您已成功获得' . $o_date->format ( 'Y' ) . '年度“荷兰旅游专家”证书。<br/><br/>
							我们将在本期课程结束后（11月30日前），为您寄出“荷兰旅游专家”证书及积分兑换礼品。请在个人资料中，确认您的姓名（必须为中文姓名）、邮寄地址、邮编、邮箱和手机号码是否正确，以便成功递送。如果' . $o_date->format ( 'Y' ) . '年12月未收到“荷兰旅游专家”证书和所兑换的奖品，请联系荷兰国家旅游局微信公众账号、新浪微博@荷兰旅游专家，或发邮件至    service@hollandtravelexpert.com<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>
							' );
		$this->SendEdm ();
	}
	public function SendEmailSend($n_uid, $s_title, $s_text, $s_1, $s_2, $s_3, $s_4, $s_5, $s_6) { //奖品寄送
		$this->S_EdmContent = '';
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( $s_title );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmContent ( ':<br/>
							您好！<br/><br/>
							您的' . $s_text . '已于' . $this->GetDateNow () . '经' . $s_1 . '（<a href="http://www.qfkd.com.cn" tagert="_blank">http://www.qfkd.com.cn</a>）寄出，运单号：' . $s_2 . ' 请届时查收！<br/><br/>
							邮寄地址如下：<br/>
							收件人：' . $s_3 . '<br/>
							地址：' . $s_4 . '<br/>
							邮编：' . $s_5 . '<br/>
							手机：' . $s_6 . '<br/><br/>
							感谢您对“荷兰旅游专家”在线培训课程的大力支持！ 期待您参与荷兰国家旅游局举办的更多精彩活动！荷兰再相聚！<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm ();
	}
	public function SendEmailRegForTravel($n_uid, $s_username) { //注册
		
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰行程网注册邮箱激活' );
		$this->setEdmFromMail('registration@hollandtravelexpert.com');
		$this->setEdmContent ( '：<br/><br/>
							欢迎加入荷兰行程网的大家庭！<br/><br/>
							请点击以下链接验证邮箱并激活帐号，马上开始荷兰行程网：<br/>
							<a style="color:#FF7000" href="' . $o_system->getTravelHost () . 'sub/travel/index.php?activation_code=' . md5 ( 'welcome ' . $s_username . ' to 荷兰旅游促进局' ) . '" target="_blank">' . $o_system->getTravelHost () . '/sub/travel/index.php?activation_code=' . md5 ( 'welcome ' . $s_username . ' to 荷兰旅游促进局' ) . '</a><br/>
							如无法点击，请复制链接至浏览器地址栏进行查看。<br/><br/>
							请在3天内验证邮箱激活您的帐号，3天后则需重新注册！<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm (10);
	}
	public function SendEmailFindPasswordForTravel($n_uid, $s_password) { //找回密码
		
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰行程网密码找回' );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmContent ( '：<br/><br/>
							您的密码成功找回，新密码为：' . $s_password . '<br/>
							请点击以下链接进入“荷兰行程网”及时修改密码。<br/>
							<a style="color:#FF7000" href="' . $o_system->getTravelHost () . '" target="_blank">' . $o_system->getTravelHost () . '</a><br/>
							如果无法点击，请复制连接地址到浏览器的地址栏查看。<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$this->SendEdm (10);
	}
	public function SendEmailDownLoadTravel($n_uid,$id,$mail) { //找回密码
		//读取行程
		$o_title=new Travel_Title($id);
		$this->S_EdmEmail=$mail;
		$this->S_EdmContent = '';
		$o_system = new System ( 1 );
		$this->setEdmUser ( $n_uid );
		$this->setEdmTitle ( '荷兰行程网《'.$o_title->getName().'》' );
		$this->setEdmFromMail('service@hollandtravelexpert.com');
		$this->setEdmContent ( '：<br/><br/>							
							请点击以下链接查看或打印您下载的行程。<br/>
							<a style="color:#FF7000" href="' . $o_system->getTravelHost () . 'sub/travel/download_travel.php?id='.$id.'" target="_blank">' . $o_system->getTravelHost () . 'sub/travel/download_travel.php?id='.$id.'</a><br/>
							如果无法点击，请复制连接地址到浏览器的地址栏查看。<br/><br/>
							随时了解荷兰最新资讯，请关注荷兰国家旅游局微信公众账号、荷兰旅游专家微博。<br/><br/>
							荷兰国家旅游会议促进局<br/>
							（邮件为系统自动生成，请勿回复。）<br/>' );
		$o_title->setDownload($o_title->getDownload()+1);//下载次数+1
		$o_title->Save();
		$this->SendEdm (10);
	}
	public function getErrorReasion() {
		return $this->S_ErrorReasion;
	}
	public function getRandString($StrLen = 8) {
		for($i = 1; $i <= $StrLen; $i ++) {
			$nRandom = mt_rand ( 1, 30 );
			@$String .= chr ( mt_rand ( 97, 122 ) );
			/*if ($nRandom <= 10) {
				//大写  
				
			} else {
				//小写  		
				@$String .= chr ( mt_rand ( 97, 122 ) );
			}*/
		}
		return $String;
	}
	protected function RemoveArrayRepeatValue($a_arr) {
		$tempArray = array ();
		foreach ( $a_arr as $one ) {
			$tempArray [$one] = true;
		
		}
		$arr = array_keys ( $tempArray );
		return $arr;
	}
	public function getSuccess() {
		return $this->B_Success;
	}
	protected function fileext($filename) {
		return strtolower ( trim ( substr ( strrchr ( $filename, '.' ), 1 ) ) );
	}
	public function getIPLoc_sina($queryIP) {
		$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=' . $queryIP;
		$ch = curl_init ( $url );
		curl_setopt ( $ch, CURLOPT_ENCODING, 'utf8' );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true ); // 获取数据返回 
		$location = curl_exec ( $ch );
		$location = json_decode ( $location );
		curl_close ( $ch );
		$loc = "";
		if ($location === FALSE)
			return "";
		if (empty ( $location->desc )) {
			$loc = $location->city;
			$full_loc = $location->province . $location->city . $location->district . $location->isp;
		} else {
			$loc = $location->desc;
		}
		return $loc;
	}
	public function FileSize($n_filesize) {
		return $this->getFilesize ( $n_filesize );
	}
	protected function getFilesize($n_filesize) {
		if ($n_filesize >= (1024 * 1024)) {
			$n_filesize = $n_filesize / (1024 * 1024);
			$n_filesize = round ( $n_filesize, 2 );
			return $n_filesize . ' G';
		} else if ($n_filesize > (1024)) {
			$n_filesize = $n_filesize / 1024;
			$n_filesize = round ( $n_filesize, 2 );
			return $n_filesize . ' MB';
		} else {
			return $n_filesize . ' KB';
		}
	
	}
	protected function TimeAccount($n_time, $s_update) {
		try {
			$o_date = new DateTime ( 'Asia/Chongqing' );
			$n_nowTime = $o_date->format ( 'U' );
			$n_result = $n_nowTime - $n_time;
			if ($n_result < 60) {
				return $n_result . ' ' . SysText::Index ( '014' );
			}
			if ($n_result >= 60 && $n_result < 3600) {
				return ( int ) ($n_result / 60) . ' ' . SysText::Index ( '015' );
			}
			if ($n_result >= 3600 && $n_result < 86400) {
				return ( int ) ($n_result / 3600) . ' ' . SysText::Index ( '016' );
			}
			if ($n_result >= 86400 && $n_result < 961200) {
				return ( int ) ($n_result / 86400) . ' ' . SysText::Index ( '017' );
			}
			$a_temp = explode ( ' ', $s_update );
			$a_time = explode ( ':', $a_temp [1] );
			return $a_temp [0] . ' ' . $a_time [0] . ':' . $a_time [1];
		} catch ( exception $err ) {
			return '';
		}
	}
	protected function GetDateForText($o_date) {
		return $o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' ) . ' ' . $o_date->format ( 'H' ) . ':' . $o_date->format ( 'i' ) . ':' . $o_date->format ( 's' );
	}
	public function GetTimeCut() {
		$o_date = new DateTime ( 'Asia/Chongqing' );
		return $o_date->format ( 'U' );
	}
	public function GetDateNow() {
		$o_date = new DateTime ( 'Asia/Chongqing' );
		return $o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' ) . ' ' . $o_date->format ( 'H' ) . ':' . $o_date->format ( 'i' ) . ':' . $o_date->format ( 's' );
	}
	protected function GetDate() {
		$o_date = new DateTime ( 'Asia/Chongqing' );
		return $o_date->format ( 'Y' ) . '-' . $o_date->format ( 'm' ) . '-' . $o_date->format ( 'd' );
	}
	protected function AilterTextArea($s_text) {
		$s_content = $s_text;
		$s_content = str_replace ( "\n", "<br/>", $s_content );
		$s_content = str_replace ( "\r", "", $s_content );
		$s_content = str_replace ( "\\", "\\\\\\\\", $s_content );
		while ( ! (strpos ( $s_content, "<br/><br/>" ) === false) ) {
			$s_content = str_replace ( "<br/><br/>", "<br/>", $s_content );
		}
		$s_content = str_replace ( '  ', '&nbsp;&nbsp;', $s_content );
		return $s_content;
	}
	protected function AilterInput($s_text) {
		$s_content = $s_text;
		$s_content = str_replace ( "", "/>", $s_content );
		$s_content = str_replace ( "", "<", $s_content );
		return $s_content;
	}
	// Returns true if $string is valid UTF-8 and false otherwise. 
	protected function IsUtf8($word) {
		if (preg_match ( "/^([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){1}/", $word ) == true || preg_match ( "/([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){1}$/", $word ) == true || preg_match ( "/([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){2,}/", $word ) == true) {
			return true;
		} else {
			return false;
		}
	} // function is_utf8 
	function Is_gb2312($str) {
		for($i = 0; $i < strlen ( $str ); $i ++) {
			$oneOrd = ord ( $str [$i] );
			if ($oneOrd > 227 && $oneOrd < 234) {
				if ($i + 2 >= strlen ( $str ) - 1)
					return true;
				$twoOrd = ord ( $str [$i + 1] );
				$threeOrd = ord ( $str [$i + 2] );
				if ($twoOrd > 128 && $twoOrd < 192 && $threeOrd > 127 && $threeOrd < 192)
					return false;
				return true;
			}
		}
		return true;
	}
	protected function DeleteDir($dir) {
		//先删除目录下的文件：
		$dh = opendir ( $dir );
		while ( $file = readdir ( $dh ) ) {
			if ($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if (! is_dir ( $fullpath )) {
					unlink ( $fullpath );
				} else {
					$this->DeleteDir ( $fullpath );
				}
			}
		}
		closedir ( $dh );
		//删除当前文件夹：
		if (rmdir ( $dir )) {
			return true;
		} else {
			return false;
		}
	}
	public function getEmailModule($str) {
		return $str;
	}
	protected function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
	{
    if(!is_file($src_img))
    {
        return false;
    }
    $ot=strtolower ( trim ( substr ( strrchr ( $dst_img, '.' ), 1 ) ) );
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;

    /**
     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
     */
    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
    {
        $proportion = 1;
    }
    if($width> $src_w)
    {
        $dst_w = $width = $src_w;
    }
    if($height> $src_h)
    {
        $dst_h = $height = $src_h;
    }

    if(!$width && !$height && !$proportion)
    {
        return false;
    }
    if(!$proportion)
    {
        if($cut == 0)
        {
            if($dst_w && $dst_h)
            {
                if($dst_w/$src_w> $dst_h/$src_h)
                {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                }
                else
                {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            }
            else if($dst_w xor $dst_h)
            {
                if($dst_w && !$dst_h)  //有宽无高
                {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h  = $src_h * $propor;
                }
                else if(!$dst_w && $dst_h)  //有高无宽
                {
                    $propor = $dst_h / $src_h;
                    $width  = $dst_w = $src_w * $propor;
                }
            }
        }
        else
        {
            if(!$dst_h)  //裁剪时无高
            {
                $height = $dst_h = $dst_w;
            }
            if(!$dst_w)  //裁剪时无宽
            {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int)round($src_w * $propor);
            $dst_h = (int)round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    }
    else
    {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width  = $dst_w = $src_w * $proportion;
    }

    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    if(function_exists('imagecopyresampled'))
    {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    else
    {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}
	public function TravelNumberFormat($n_number)
	{
		if ($n_number<10)
		{
			return '00'.$n_number;
		}
		if ($n_number<100)
		{
			return '0'.$n_number;
		}
		return $n_number;
	}
}
?>