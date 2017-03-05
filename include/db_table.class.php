<?php
require_once RELATIVITY_PATH . 'include/db_operate.class.php';
require_once RELATIVITY_PATH . 'include/db_connect.class.php';
/////////////////////////////////////////////////////广告位信息
class Advert extends CRUD {
	protected $AdvertId; 
	protected $Title; 
	protected $Size;
	protected $Onover; 
	protected $Onout;
	protected $Url;
	protected $State;
	protected $Number;
	protected $Open;
	protected function DefineKey() {
		return 'advert_id';
	}
	protected function DefineTableName() {
		return 'advert';
	}
	protected function DefineRelationMap() {
		 return (array ('advert_id' => 'AdvertId', 
		 				'title' => 'Title', 
						'size' => 'Size', 
						'onover' => 'Onover', 
						'onout' => 'Onout', 
						'url' => 'Url', 
						'state' => 'State',
		 				'open' => 'Open',
		 				'number' => 'Number'
		));
	}
}
/////////////////////////////////////////////////////去年专家邮箱
class Lastyear_Expert extends CRUD {
	protected $Id; 
	protected $Email; 
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'lastyear_expert';
	}
	protected function DefineRelationMap() {
		 return (array ('id' => 'Id', 
		 				'email' => 'Email'
		));
	}
}
/////////////////////////////////////////////////////原始的章
class Bank_Chapter extends CRUD {
	protected $ChapterId; 
	protected $TermId; 
	protected $Number; 
	protected $Photo;
	protected $PhotoOff; 
	protected $PhotoOn; 
	protected $Name; 
	protected $State;
	protected $Restudy;	
	protected $Content;	
	protected $SendCredentials;
	protected $CredentialsName;
	protected function DefineKey() {
		return 'chapter_id';
	}
	protected function DefineTableName() {
		return 'bank_chapter';
	}
	protected function DefineRelationMap() {
		 return (array ('chapter_id' => 'ChapterId', 
		 				'term_id' => 'TermId', 
						'number' => 'Number', 
		 				'photo' => 'Photo', 
						'photo_off' => 'PhotoOff', 
		 				'photo_on' => 'PhotoOn',
						'name' => 'Name', 
		 				'content' => 'Content', 
						'state' => 'State', 
						'restudy' => 'Restudy',
		 				'send_credentials' => 'SendCredentials',
		 				'credentials_name' => 'CredentialsName'
		));
	}
}
/////////////////////////////////////////////////////原始的题的选项
class Bank_Option extends CRUD {
	protected $OptionId; 
	protected $Text;
	protected $Number;
	protected $SubjectId;
	protected function DefineKey() {
		return 'option_id';
	}
	protected function DefineTableName() {
		return 'bank_option';
	}
	protected function DefineRelationMap() {
		 return (array ('option_id' => 'OptionId', 
		 				'number' => 'Number', 
						'text' => 'Text', 
						'subject_id' => 'SubjectId'
		));
	}
	public function DeleteOption($n_id)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `bank_option` WHERE `bank_option`.`subject_id`='.$n_id );
			}
		}		
	}
}
/////////////////////////////////////////////////////原始的节
class Bank_Section extends CRUD {
	protected $SectionId;
	protected $ChapterId; 
	protected $Number;
	protected $SKey;
	protected $Content;
	protected $Title;
	protected $Vantage;
	protected $SubjectSum;
	protected $Rate;
	protected $Time;
	protected $State;
	protected function DefineKey() {
		return 'section_id';
	}
	protected function DefineTableName() {
		return 'bank_section';
	}
	protected function DefineRelationMap() {
		 return (array ('section_id' => 'SectionId', 
						'chapter_id' => 'ChapterId', 
						'number' => 'Number',
						'key' => 'SKey',
						'content' => 'Content',
						'title' => 'Title',
						'vantage' => 'Vantage',
						'subject_sum' => 'SubjectSum',
						'rate' => 'Rate',
		 				'state' => 'State',
						'time' => 'Time'
		));
	}
}
/////////////////////////////////////////////////////原始的题目
class Bank_Subject  extends CRUD {
	protected $SubjectId; 
	protected $Content;
	protected $RightOptionId;
	protected $RightOption;
	protected $SectionId;
	protected function DefineKey() {
		return 'subject_id';
	}
	protected function DefineTableName() {
		return 'bank_subject';
	}
	protected function DefineRelationMap() {
		 return (array ('subject_id' => 'SubjectId', 
						'content' => 'Content', 
		 				'section_id' => 'SectionId',
		 				'right_option' => 'RightOption',
						'right_option_id' => 'RightOptionId'
		));
	}
}
/////////////////////////////////////////////////////原始的章
class Bank_Term extends CRUD {
	protected $TermId; 
	protected $Name; 
	protected $Explain; 
	protected $State; 
	protected $Date;
	protected $EndDate;
	protected function DefineKey() {
		return 'term_id';
	}
	protected function DefineTableName() {
		return 'bank_term';
	}
	protected function DefineRelationMap() {
		 return (array ('term_id' => 'TermId', 
						'name' => 'Name', 
						'explain' => 'Explain', 
						'state' => 'State', 
						'date' => 'Date',
						'end_date' => 'EndDate'
		));
	}
}
/////////////////////////////////////////////////////EDM模版
class Edm extends CRUD {
	protected $EdmId; 
	protected $State; 
	protected $Html; 
	protected $Photo; 
	protected function DefineKey() {
		return 'edm_id';
	}
	protected function DefineTableName() {
		return 'edm';
	}
	protected function DefineRelationMap() {
		 return (array ('edm_id' => 'EdmId', 
						'state' => 'State', 
						'html' => 'Html', 
						'photo' => 'Photo'
		));
	}
}
/////////////////////////////////////////////////////焦点图篇
class FocusPhoto extends CRUD {
	protected $PhotoId; 
	protected $Path; 
	protected $Title; 
	protected $State;
	protected $Number;
	protected function DefineKey() {
		return 'photo_id';
	}
	protected function DefineTableName() {
		return 'focusphoto';
	}
	protected function DefineRelationMap() {
		 return (array ('photo_id' => 'PhotoId', 
						'path' => 'Path', 
						'title' => 'Title', 
						'state' => 'State', 
						'number' => 'Number'
		));
	}
}
/////////////////////////////////////////////////////学员领取的资料库
class Information extends CRUD {
	protected $InformationId; 
	protected $Name; 
	protected $Explain;
	protected $Photo;
	protected $State;
	protected $Sum;
	protected function DefineKey() {
		return 'information_id';
	}
	protected function DefineTableName() {
		return 'information';
	}
	protected function DefineRelationMap() {
		 return (array ('information_id' => 'InformationId', 
						'name' => 'Name', 
						'explain' => 'Explain',
						'photo' => 'Photo',
		 				'sum' => 'Sum',
						'state' => 'State'
		));
	}
}
/////////////////////////////////////////////////////学员领取物品记录
class Goods_Send extends CRUD {
	protected $Id;
	protected $Uid; 
	protected $Address;
	protected $Name;
	protected $Phone;
	protected $Postcode;
	protected $State;
	protected $GoodsId;
	protected $Sum;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected $Type;
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'goods_send';
	}
	protected function DefineRelationMap() {
		 return (array ('id' => 'Id', 
						'uid' => 'Uid', 
						'address' => 'Address',
						'name' => 'Name',
						'phone' => 'Phone',
		 				'postcode' => 'Postcode',
		 				'state' => 'State',
		 				'goods_id' => 'GoodsId',
		 				'sum' => 'Sum',
		 				'date' => 'Date',
		 				'send_date' => 'SendDate',
		 				'logistic' => 'Logistic',
		 				'order_number' => 'OrderNumber',
		 				'type' => 'Type'		 
		));
	}
	public function DeleteUser($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `goods_send` WHERE `goods_send`.`uid`='.$n_uid );
			}
		}		
	}
	public function GetRecordAllCount()
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'SELECT COUNT(DISTINCT uid) AS mycount FROM `goods_send` WHERE `state`=2 ORDER BY `date` DESC');
				if ($this->O_Result) {
					return  mysql_result ( $this->O_Result, 0, 'mycount' );
				}
			}
		}		
	}
	public function GetRecordUid($i)
	{
		return mysql_result ( $this->O_Result, $i, 'uid');
	}
	public function GetRecordCount()
	{
		$this->O_Result=false;
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$s_sql_1='SELECT DISTINCT uid FROM `goods_send` WHERE `state`=2 ORDER BY `date` DESC';
				//$this->Execute ( 'SELECT COUNT(DISTINCT uid) AS mycount FROM `goods_send` WHERE `state`=1 OR `state`=2 ORDER BY `date` DESC');
				if (($this->N_Start_Line > - 1) && ($this->N_Count_Line > - 1)) {
					$s_sql = ' LIMIT ' . $this->N_Start_Line . ',' . $this->N_Count_Line;
					$s_sql = $s_sql_1 . $s_sql;
					$this->Execute ( $s_sql );
					if ($this->O_Result) {
						return mysql_num_rows ( $this->O_Result );
					}
				}
			}
		}		
	}
	public function ClearData()
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'TRUNCATE TABLE `goods_send`' );
			}
		}		
	}
}
/////////////////////////////////////////////////////学员领取的资料的记录

/////////////////////////////////////////////////////邀请码
class Invitation extends CRUD {
	protected $CodeId; 
	protected $Uid; 
	protected $Date;
	protected $State;
	protected $UseUid;
	protected $UseDate;
	protected function DefineKey() {
		return 'code_id';
	}
	protected function DefineTableName() {
		return 'invitation';
	}
	protected function DefineRelationMap() {
		 return (array ('code_id' => 'CodeId', 
						'uid' => 'Uid', 
						'date' => 'Date',
						'state' => 'State',
						'use_uid' => 'UseUid',
		 				'use_date' => 'UseDate'	 
		));
	}
}
/////////////////////////////////////////////////////关键字
class Bank_Section_Key extends CRUD {
	protected $KeyId; 
	protected $Name;
	protected function DefineKey() {
		return 'key_id';
	}
	protected function DefineTableName() {
		return 'bank_section_key';
	}
	protected function DefineRelationMap() {
		 return (array ('key_id' => 'KeyId', 
						'name' => 'Name'	 
		));
	}
}
/////////////////////////////////////////////////////邮件队列
class Mail extends CRUD {
	protected $MailId; 
	protected $ToMail;
	protected $Title;
	protected $Content;
	protected $IsSend;
	protected $SendDate;
	protected $FromMail;
	protected function DefineKey() {
		return 'mail_id';
	}
	protected function DefineTableName() {
		return 'mail';
	}
	protected function DefineRelationMap() {
		 return (array ('mail_id' => 'MailId', 
						'to_mail' => 'ToMail', 
						'title' => 'Title',
						'content' => 'Content',
						'is_send' => 'IsSend',
		 				'from_mail' => 'FromMail',
		 				'send_date' => 'SendDate'	 
		));
	}
	public function ClearData()
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `mail` WHERE `mail`.`is_send` = 1' );
			}
		}		
	}
}
/////////////////////////////////////////////////////邮件记录
class MailRecord extends CRUD {
	protected $Id; 
	protected $UserName;
	protected $Title;
	protected $Content;
	protected $Date;
	protected $Csv;
	protected $Type;
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'mail_record';
	}
	protected function DefineRelationMap() {
		 return (array ('id' => 'Id', 
						'username' => 'UserName', 
						'title' => 'Title',
						'content' => 'Content',
						'date' => 'Date',
		 				'type' => 'Type',
		 				'csv' => 'Csv'	 
		));
	}
}
/////////////////////////////////////////////////////系统新闻列表
class News extends CRUD {
	protected $NewsId;
	protected $Title; 
	protected $Type;
	protected $Content;
	protected $Date;
	protected $State;
	protected function DefineKey() {
		return 'news_id';
	}
	protected function DefineTableName() {
		return 'news';
	}
	protected function DefineRelationMap() {
		 return (array ('news_id' => 'NewsId', 
						'title' => 'Title', 
		 				'type' => 'Type',
		 				'content' => 'Content',
		 				'date' => 'Date',
		 				'state' => 'State'
		));
	}
}
/////////////////////////////////////////////////////合作伙伴
class Partners extends CRUD {
	protected $PartnerId; 
	protected $Icon;
	protected $Title; 
	protected $Number; 
	protected $State;
	protected $Url;
	protected function DefineKey() {
		return 'partner_id';
	}
	protected function DefineTableName() {
		return 'partners';
	}
	protected function DefineRelationMap() {
		 return (array ('partner_id' => 'PartnerId', 
		 				'icon' => 'Icon', 
						'title' => 'Title', 
						'number' => 'Number', 
						'state' => 'State', 
						'url' => 'Url'
		));
	}
}
/////////////////////////////////////////////////////奖品列表
class Prize extends CRUD {
	protected $PrizeId; 
	protected $Name; 
	protected $Explain;
	protected $Photo;
	protected $Vantage;
	protected $State;	
	protected $ChapterId;
	protected $IsExpert;
	protected $Sum;
	protected $RemSum;
	protected $RemEmail;
	protected function DefineKey() {
		return 'prize_id';
	}
	protected function DefineTableName() {
		return 'prize';
	}
	protected function DefineRelationMap() {
		 return (array ('prize_id' => 'PrizeId', 
						'name' => 'Name', 
						'explain' => 'Explain',
						'photo' => 'Photo',
						'vantage' => 'Vantage',
		 				'state' => 'State',
		 				'is_expert' => 'IsExpert',
		 				'chapter_id' => 'ChapterId',
						'sum' => 'Sum',
						'rem_sum' => 'RemSum',
						'rem_email' => 'RemEmail'	 
		));
	}
}
/////////////////////////////////////////////////////证书模板列表
class Credential extends CRUD {
	protected $CredentialId; 
	protected $Name; 
	protected $Icon;
	protected $Image;
	protected function DefineKey() {
		return 'credential_id';
	}
	protected function DefineTableName() {
		return 'credential';
	}
	protected function DefineRelationMap() {
		 return (array ('credential_id' => 'CredentialId', 
						'name' => 'Name', 
						'icon' => 'Icon',
						'image' => 'Image' 
		));
	}
}
/////////////////////////////////////////////////////奖品领取列表
class Prize_Exchange extends CRUD {
	protected $ExchangeId; 
	protected $Uid;
	protected $Address;
	protected $Name;
	protected $Phone;
	protected $Postcode;	
	protected $State;
	protected $PrizeId;
	protected $Sum;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected function DefineKey() {
		return 'exchange_id';
	}
	protected function DefineTableName() {
		return 'prize_exchange';
	}
	protected function DefineRelationMap() {
		 return (array ('exchange_id' => 'ExchangeId', 
						'uid' => 'Uid', 
						'address' => 'Address',
						'name' => 'Name',
						'phone' => 'Phone',
		 				'postcode' => 'Postcode',	
		 				'state' => 'State',
		 				'prize_id' => 'PrizeId',
		  				'sum' => 'Sum',
		  				'date' => 'Date',
		  				'send_date' => 'SendDate',
		  				'logistic' => 'Logistic',
		  				'order_number' => 'OrderNumber'
		));
	}
	public function DeleteUser($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `prize_exchange` WHERE `prize_exchange`.`uid`='.$n_uid );
			}
		}		
	}
}
/////////////////////////////////////////////////////系统设置
class System extends CRUD {
	protected $Id;
	protected $Weibo; 
	protected $RegCheck;
	protected $Invitation;
	protected $Term;
	protected $SleepRemind;	
	protected $IsSleep;
	protected $NewtermRemind;
	protected $InvitationSum;
	protected $Reward;
	protected $Host;
	protected $TravelHost;
	protected $Logo;
	protected $Copyright;
	protected $Terms;
	protected $RegSuccessPhoto;
	protected $CredentialCheck;
	protected $InformationCheck;
	protected $PrizeCheck;
	protected $Contact;
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'system';
	}
	protected function DefineRelationMap() {
		 return (array ('id' => 'Id', 
						'weibo' => 'Weibo', 
						'reg_check' => 'RegCheck',
						'invitation' => 'Invitation',
						'term' => 'Term',
		 				'sleep_remind' => 'SleepRemind',	
		 				'is_sleep' => 'IsSleep',
		 				'newterm_remind' => 'NewtermRemind',
		  				'invitation_sum' => 'InvitationSum',
		  				'reward' => 'Reward',
		  				'host' => 'Host',
		 				'travel_host' => 'TravelHost',
		 				'copyright' => 'Copyright',
		 				'logo' => 'Logo',
		 				'terms' => 'Terms',
						'credential_check' => 'CredentialCheck',
						'information_check' => 'InformationCheck',
						'prize_check' => 'PrizeCheck',
		 				'contact' => 'Contact',
		 				'reg_success_photo' => 'RegSuccessPhoto'
		));
	}
}
/////////////////////////////////////////////////////用户信息列表
class User extends CRUD {
	protected $Uid; 
	protected $Password; 
	protected $UserName;
	protected $Sex;
	protected $Birthday;
	protected $State;
	protected $RegIp;
	protected $RegTime;
	protected $Type;
	protected $Name;
	protected $EnName;
	protected $Company;
	protected $EnCompany;
	protected $Dept;
	protected $EnDept;
	protected $Job;
	protected $EnJob;
	protected $Province;
	protected $City;
	protected $Area;
	protected $Postcode;
	protected $AreaNumber;
	protected $QQ;
	protected $CompanyPhone;
	protected $Telephone;
	protected $Extension;
	protected $Phone;
	protected $Fax;
	protected $Skype;
	protected $Address;
	protected $EnAddress;
	protected $Email1;
	protected $Email2;
	protected $Url;
	protected $Term;
	protected $IsSleep;
	protected $ActivationCode;
	protected $Checked;
	protected $Vantage;
	protected $Photo;
	protected $Percent;
	protected $IsSend;
	protected $CredentialId;
	protected $ComeFrom;
	protected function DefineKey() {
		return 'uid';
	}
	protected function DefineTableName() {
		return 'user';
	}
	protected function DefineRelationMap() {
		 return (array ('uid' => 'Uid', 
						'password' => 'Password', 
		 				'username' => 'UserName',
		 				'sex' => 'Sex',
		 				'birthday' => 'Birthday',
		 				'state' => 'State',
		 				'reg_ip' => 'RegIp',
		 				'reg_time' => 'RegTime',
		 				'type' => 'Type',
		 				'name' => 'Name',
		 				'en_name' => 'EnName',
		 				'company' => 'Company',
		 				'en_company' => 'EnCompany',
		 				'dept' => 'Dept',
		 				'en_dept' => 'EnDept',
		 				'job' => 'Job',
		 				'en_job' => 'EnJob',
		 				'province' => 'Province',
		 				'city' => 'City',
		 				'area' => 'Area',
		 				'postcode' => 'Postcode',
		 				'area_number' => 'AreaNumber',
		 				'qq' => 'QQ',
		 				'company_phone' => 'CompanyPhone',
		 				'telephone' => 'Telephone',
		 				'extension' => 'Extension',
		 				'phone' => 'Phone',
						'fax' => 'Fax',
						'skype' => 'Skype',
						'address' => 'Address',
						'en_address' => 'EnAddress',
						'email1' => 'Email1',
						'email2' => 'Email2',
						'url' => 'Url',
		 				'term' => 'Term',
		 				'is_sleep' => 'IsSleep',
		 				'activation_code' => 'ActivationCode',
		 				'checked' => 'Checked',
		 				'vantage' => 'Vantage',
		 				'photo' => 'Photo',
		 				'percent' => 'Percent',
		 				'is_send' => 'IsSend',
		 				'credential_id' => 'CredentialId',
		 				'come_from'=>'ComeFrom'
		));
	}
}
/////////////////////////////////////////////////////学员领取的资料的记录
class Information_Use extends CRUD {
	protected $Id;
	protected $Uid; 
	protected $Address;
	protected $Name;
	protected $Phone;
	protected $Postcode;
	protected $State;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'user_credential';
	}
	protected function DefineRelationMap() {
		 return (array ('id' => 'Id', 
						'uid' => 'Uid', 
						'address' => 'Address',
						'name' => 'Name',
						'phone' => 'Phone',
		 				'postcode' => 'Postcode',
		 				'state' => 'State',
		 				'date' => 'Date',
		 				'send_date' => 'SendDate',
		 				'logistic' => 'Logistic',
		 				'order_number' => 'OrderNumber'		 
		));
	}
	public function DeleteUser($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `information_use` WHERE `information_use`.`uid`='.$n_uid );
			}
		}		
	}
}
/////////////////////////////////////////////////////用户登录列表
class User_Login extends CRUD {
	protected $Uid;
	protected $LastIp; 
	protected $LastTime;
	protected $Online;
	protected $LoginTime;
	protected $OnlineTime;
	protected $UserAgent;
	protected $SessionId;
	protected $PassError;
	protected $LockTime;
	protected function DefineKey() {
		return 'uid';
	}
	protected function DefineTableName() {
		return 'user_login';
	}
	protected function DefineRelationMap() {
		 return (array ('uid' => 'Uid', 
						'last_ip' => 'LastIp', 
		 				'last_time' => 'LastTime',
		 				'online' => 'Online',
		 				'login_time' => 'LoginTime',
		 				'online_time' => 'OnlineTime',
		 				'user_agent' => 'UserAgent',
		 				'session_id' => 'SessionId',
		 				'pass_error' => 'PassError',
		 				'lock_time' => 'LockTime'
		));
	}
}
/////////////////////////////////////////////////////用户章的学习列表
class User_Study_Chapter extends CRUD {
	protected $StudyId; 
	protected $ChapterId; 
	protected $Finish;
	protected $Percent;
	protected $Uid;
	protected $Vantage;
	protected function DefineKey() {
		return 'study_id';
	}
	protected function DefineTableName() {
		return 'user_study_chapter';
	}
	protected function DefineRelationMap() {
		 return (array ('study_id' => 'StudyId', 
						'chapter_id' => 'ChapterId', 
		 				'finish' => 'Finish',
		 				'percent' => 'Percent',
		 				'uid' => 'Uid',
		 				'vantage' => 'Vantage'
		));
	}
	public function DeleteUser($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `user_study_chapter` WHERE `user_study_chapter`.`uid`='.$n_uid );
			}
		}		
	}
	public function ClearData()
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'TRUNCATE TABLE `user_study_chapter`' );
			}
		}		
	}
}
/////////////////////////////////////////////////////用户节的学习列表
class User_Study_Section extends CRUD {
	protected $StudyId; 
	protected $SectionId; 
	protected $Finish;
	protected $Uid;
	protected function DefineKey() {
		return 'study_id';
	}
	protected function DefineTableName() {
		return 'user_study_section';
	}
	protected function DefineRelationMap() {
		 return (array ('study_id' => 'StudyId', 
						'section_id' => 'SectionId', 
		 				'finish' => 'Finish',
		 				'uid' => 'Uid'
		));
	}
	public function DeleteUser($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `user_study_section` WHERE `user_study_section`.`uid`='.$n_uid );
			}
		}		
	}
	public function ClearData()
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'TRUNCATE TABLE `user_study_section`' );
			}
		}		
	}
}
/////////////////////////////////////////////////////用户积分记录
class User_Vantage  extends CRUD {
	protected $RecordId;
	protected $Uid; 
	protected $InOut;
	protected $Date;
	protected $Explain;
	protected $Balance;
	protected $Sum;
	protected function DefineKey() {
		return 'record_id';
	}
	protected function DefineTableName() {
		return 'user_vantage';
	}
	protected function DefineRelationMap() {
		 return (array ('record_id' => 'RecordId', 
						'uid' => 'Uid', 
		 				'in_out' => 'InOut',
		 				'date' => 'Date',
		 				'explain' => 'Explain',
		 				'balance' => 'Balance',
		 				'sum' => 'Sum'
		));
	}
	public function DeleteUser($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `user_vantage` WHERE `user_vantage`.`uid`='.$n_uid );
			}
		}		
	}
}
/////////////////////////////////////////////////////网盘文件列表
class Netdisk_File  extends CRUD
{
   protected $FileId;
   protected $Filename;
   protected $Filesize;
   protected $Date;
   protected $Suffix;
   protected $Path;
   protected $Delete;
   protected $FolderId;
   protected $DeleteDate;
   protected $OriginalPath;
   protected $OriginalFilename;
	 
   protected function DefineKey()
   {
      return 'file_id';
   }
   protected function DefineTableName()
   {
      return 'netdisk_file';
   }
   protected function DefineRelationMap()
   {
      return(array( 'file_id' => 'FileId',
      				'filename' => 'Filename',
      				'filesize' => 'Filesize',
      				'date' => 'Date',
      				'suffix' => 'Suffix',
      				'path' => 'Path',
      				'delete' => 'Delete',
      				'folder_id' => 'FolderId',
      				'delete_date' => 'DeleteDate',
      				'original_path' => 'OriginalPath',
      				'original_filename' => 'OriginalFilename'
                   ));
   }
}
//1111111111111111111111111111111111111111111111网盘目录列表
class Netdisk_Folder extends CRUD
{
   protected $FolderId;
   protected $FolderName;
   protected $Date;
   protected $ParentId;
   protected $Delete;
   protected $DeleteDate;
   protected $OriginalPath;
	 
   protected function DefineKey()
   {
      return 'folder_id';
   }
   protected function DefineTableName()
   {
      return 'netdisk_folder';
   }
   protected function DefineRelationMap()
   {
      return(array( 'folder_id' => 'FolderId',
      				'foldername' => 'FolderName',
      				'date' => 'Date',
      				'delete' => 'Delete',
      				'parent_id' => 'ParentId',
      				'delete_date' => 'DeleteDate',
      				'original_path' => 'OriginalPath'
                   ));
   }
}
//1111111111111111111111111111111111111111111111网盘文件类型列表
class Netdisk_Type extends CRUD
{
   protected $Suffix;
   protected $ClassName;
	 
   protected function DefineKey()
   {
      return 'suffix';
   }
   protected function DefineTableName()
   {
      return 'netdisk_type';
   }
   protected function DefineRelationMap()
   {
      return(array( 'suffix' => 'Suffix',
      				'classname' => 'ClassName'
                   ));
   }
}
//1111111111111111111111111111111111111111111111网盘空间信息
class Netdisk_Space extends CRUD
{
   protected $Id;
   protected $Free;
   protected $Use;
   protected $Total;   
	 
   protected function DefineKey()
   {
      return 'id';
   }
   protected function DefineTableName()
   {
      return 'netdisk_space';
   }
   protected function DefineRelationMap()
   {
      return(array( 'id' => 'Id',
      				'free' => 'Free',
      				'use' => 'Use',
      				'total' => 'Total'
                   ));
   }
}
/////////////////////////////////////////////////////积分记录配图
class VantagePhoto extends CRUD {
	protected $PhotoId; 
	protected $Path; 
	protected $State;
	protected $Number;
	protected function DefineKey() {
		return 'photo_id';
	}
	protected function DefineTableName() {
		return 'vantage_photo';
	}
	protected function DefineRelationMap() {
		 return (array ('photo_id' => 'PhotoId', 
						'path' => 'Path', 
						'state' => 'State', 
						'number' => 'Number'
		));
	}
}
/////////////////////////////////////////////////////行程网站城市信息
class Library_City extends CRUD {
	protected $CityId; 
	protected $Name; 
	protected $Introduce;
	protected function DefineKey() {
		return 'city_id';
	}
	protected function DefineTableName() {
		return 'library_city';
	}
	protected function DefineRelationMap() {
		 return (array ('city_id' => 'CityId', 
						'name' => 'Name', 
						'introduce' => 'Introduce'
		));
	}
}
/////////////////////////////////////////////////////行程网站酒店信息
class Library_Hotel extends CRUD {
	protected $HotelId; 
	protected $CityId; 
	protected $Name;
	protected $Content;
	protected $Price;
	protected function DefineKey() {
		return 'hotel_id';
	}
	protected function DefineTableName() {
		return 'library_hotel';
	}
	protected function DefineRelationMap() {
		 return (array ('hotel_id' => 'HotelId', 
						'name' => 'Name', 
						'city_id' => 'CityId',
		 				'content' => 'Content',
		 				'price' => 'Price'
		));
	}
}
/////////////////////////////////////////////////////行程网站景区信息
class Library_Region extends CRUD {
	protected $RegionId; 
	protected $CityId; 
	protected $Name;
	protected $Content;
	protected $SKey;
	protected $Price;
	protected $Street;
	protected $Address;
	protected $Zip;
	protected $Web;
	protected $Tel;
	protected $TypeId;
	protected function DefineKey() {
		return 'region_id';
	}
	protected function DefineTableName() {
		return 'library_region';
	}
	protected function DefineRelationMap() {
		 return (array ('region_id' => 'RegionId', 
						'name' => 'Name', 
						'city_id' => 'CityId',
		 				'key' => 'SKey',
		 				'content' => 'Content',
		 				'price' => 'Price',
		 				'street' => 'Street',
		 				'address' => 'Address',
		 				'zip' => 'Zip',
		 				'web' => 'Web',
		 				'tel' => 'Tel',
		 				'type_id' => 'TypeId'
		));
	}
}
/////////////////////////////////////////////////////行程网站资料类型
class Library_Region_Type extends CRUD {
	protected $TypeId; 
	protected $Name;
	protected $Delete;
	protected function DefineKey() {
		return 'type_id';
	}
	protected function DefineTableName() {
		return 'library_region_type';
	}
	protected function DefineRelationMap() {
		 return (array (
						'name' => 'Name', 
		 				'type_id' => 'TypeId',
		 'delete' => 'Delete'
		));
	}
}
/////////////////////////////////////////////////////行程网站景区图片信息
class Library_Region_Photo extends CRUD {
	protected $RegionId; 
	protected $Id; 
	protected $Image;
	protected $Icon;
	protected $Number;
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'library_region_photo';
	}
	protected function DefineRelationMap() {
		 return (array ('region_id' => 'RegionId', 
						'image' => 'Image', 
						'id' => 'Id',
		 				'icon' => 'Icon',
		 				'number' => 'Number'
		));
	}
}
/////////////////////////////////////////////////////行程网站类型
class Travel_Type extends CRUD {
	protected $TypeId; 
	protected $Name; 
	protected $State;
	protected $Delete;
	protected $TitleId;
	protected $Number;
	protected $Photo;
	protected function DefineKey() {
		return 'type_id';
	}
	protected function DefineTableName() {
		return 'travel_type';
	}
	protected function DefineRelationMap() {
		 return (array ('type_id' => 'TypeId', 
						'name' => 'Name', 
						'state' => 'State',
		 				'delete' => 'Delete',
		 				'title_id' => 'TitleId',
		 				'number' => 'Number',
						'photo' => 'Photo'
		));
	}
}
/////////////////////////////////////////////////////行程网站行程标题
class Travel_Title extends CRUD {
	protected $TitleId; 
	protected $Name; 
	protected $Explain;
	protected $Date;
	protected $State;
	protected $Visit;
	protected $Download;
	protected $PhotoOn;
	protected $Photo;
	protected $TypeId;
	protected function DefineKey() {
		return 'title_id';
	}
	protected function DefineTableName() {
		return 'travel_title';
	}
	protected function DefineRelationMap() {
		 return (array ('title_id' => 'TitleId', 
						'name' => 'Name', 
						'explain' => 'Explain',
		 				'date' => 'Date',
		 				'visit' => 'Visit',
		 				'download' => 'Download',
		 				'state' => 'State',
		 'photo_on' => 'PhotoOn',
		 'type_id' => 'TypeId',
		 'photo' => 'Photo'
		));
	}
}
/////////////////////////////////////////////////////行程网站项目标题
class Travel_Item extends CRUD {
	protected $ItemId; 
	protected $Name; 
	protected $Number;
	protected $State;
	protected $TitleId;
	protected function DefineKey() {
		return 'item_id';
	}
	protected function DefineTableName() {
		return 'travel_item';
	}
	protected function DefineRelationMap() {
		 return (array ('item_id' => 'ItemId', 
						'name' => 'Name', 
						'number' => 'Number',
		 				'state' => 'State',
		 				'title_id' => 'TitleId'
		));
	}
}
/////////////////////////////////////////////////////行程网站明细
class Travel_Detail extends CRUD {
	protected $DetailId;
	protected $StartHour; 
	protected $StartMin;
	protected $EndHour;
	protected $EndMin;
	protected $HotelId;
	protected $CityId;
	protected $RegionId;
	protected $ItemId;
	protected $Explain;
	protected function DefineKey() {
		return 'detail_id';
	}
	protected function DefineTableName() {
		return 'travel_detail';
	}
	protected function DefineRelationMap() {
		 return (array ('detail_id' => 'DetailId', 
						'start_hour' => 'StartHour', 
						'start_min' => 'StartMin',
		 				'end_hour' => 'EndHour',
		 				'end_min' => 'EndMin',
		 				'city_id' => 'CityId',
						'hotel_id' => 'HotelId',
		 				'region_id' => 'RegionId',
						'item_id' => 'ItemId',
						'explain' => 'Explain'
		));
	}
}
/////////////////////////////////////////////////////访客下载记录
class Travel_Visitor extends CRUD {
	protected $Id;
	protected $Email; 
	protected $Phone;
	protected $Date;
	protected $TitleId;
	protected $Ip;
	protected $Sum;
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'travel_visitor';
	}
	protected function DefineRelationMap() {
		 return (array ('id' => 'Id', 
						'email' => 'Email', 
						'phone' => 'Phone',
		 				'date' => 'Date',
		 				'title_id' => 'TitleId',
		 				'sum' => 'Sum',
						'ip' => 'Ip'
		));
	}
	public function DeleteVisitor($n_uid)
	{
		for($i=0;$i<1000;$i++)
		{
			if ($this->O_Result)
			{
				break;
			}else{
				$this->Execute ( 'DELETE FROM `travel_visitor` WHERE `travel_visitor`.`title_id`='.$n_uid );
			}
		}		
	}
}
/////////////////////////////////////////////////////行程网站广告位信息
class Travel_Advert extends CRUD {
	protected $AdvertId; 
	protected $Title; 
	protected $Size;
	protected $Onover; 
	protected $Onout;
	protected $Url;
	protected $State;
	protected $Number;
	protected $Open;
	protected function DefineKey() {
		return 'advert_id';
	}
	protected function DefineTableName() {
		return 'travel_advert';
	}
	protected function DefineRelationMap() {
		 return (array ('advert_id' => 'AdvertId', 
		 				'title' => 'Title', 
						'size' => 'Size', 
						'onover' => 'Onover', 
						'onout' => 'Onout', 
						'url' => 'Url', 
						'state' => 'State',
		 				'open' => 'Open',
		 				'number' => 'Number'
		));
	}
}
?>