<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class Single_User extends Bn_Basic //单独用户,把所有根用户有关的进行统一操作
{
	private $O_Role; //角色
	private $O_Info; //基本信息
	private $O_Login; //登录信息
	private $S_Session_Id;
	private $S_Ip;
	private $S_Agent;
	private $S_Picture_Url;
	private $N_Picture_Id;
	public function setSessionID($s_sessionid) {
		$this->S_Session_Id = $s_sessionid;
	}
	
	public function setUserName($s_username) {
		$this->O_Info->setUserName ( $s_username );
	}
	public function getName() {
		return $this->O_BaseInfo->getName ();
	}
	public function getUid() {
		return $this->O_Info->getUid ();
	}
	public function getType() {
		return $this->O_Info->getType ();;
	}
	public function getUserName() {
		return $this->O_Info->getUserName ();
	}
	public function getPassword() {
		return $this->O_Info->getPassword ();
	}
	public function getEmailPassword() {
		return $this->O_BaseInfo->getEmailPassword ();
	}
	public function getSex() {
		return $this->O_BaseInfo->getSex ();
	}
	public function getEmail() {
		return $this->O_BaseInfo->getEmail ();
	}
	public function __construct($uid = null) {
		$this->S_Ip = $_SERVER ['REMOTE_ADDR'];
		$this->S_Agent = $_SERVER ['HTTP_USER_AGENT'];
		$this->S_Session_Id = $_COOKIE ['SESSIONID'];
		if (isset ( $uid )) {
			$this->O_Info = new User ( $uid );
			$this->O_Login = new User_Login ( $uid );
		} else {
		}
	}
	public function __call($s_function, $a_arguments) {
		$a_function = split ( '_', $s_function );
		if (count ( $a_function ) != 3) {
			return false;
		}
		$s_methodtype = $a_function [0];
		$s_methodMember = $a_function [2];
		$s_object = 'O_' . $a_function [1];
		switch ($s_methodtype) {
			case 'set' :
				return ($this->SetAccessor ( $s_object, $s_methodMember, $a_arguments [0] ));
				break;
			case 'get' :
				return ($this->GetAccessor ( $s_object, $s_methodMember ));
				break;
		}
		return false;
	}
	
	private function SetAccessor($s_object, $s_member, $s_newValue) {
		if (property_exists ( $this, $s_object )) {
			if (is_numeric ( $s_newValue )) {
				eval ( '$this->' . $s_object . '->set' . $s_member . '(' . $s_newValue . ');' );
			} else {
				eval ( '$this->' . $s_object . '->set' . $s_member . '(\'' . str_replace ( '\'', '`', $s_newValue ) . '\');' );
			}
			$this->A_ModifiedRelations [$s_member] = '1';
		} else {
			return false;
		}
	}
	
	private function GetAccessor($s_object, $s_member) {
		if (property_exists ( $this, $s_object )) {
			$s_retVal = '';
			eval ( '$s_retVal=$this->' . $s_object . '->get' . $s_member . '();' );
			return $s_retVal;
		} else {
			return false;
		}
	}
	
	public function Save() //保存用户信息
{
		$uid = $this->O_Info->getS_Value ();
		if (isset ( $uid )) { //保存时不能修改权限和Gruop
			$this->O_Info->Save ();
			$this->O_Login->Save ();
		}
	}
	
	public function Deletion() //删除用户
{
		$n_uid = $this->O_Info->getS_Value ();
		if (isset ( $n_uid )) {
			$this->O_Info->Deletion ();
			$this->O_Login->Deletion ();
		}
	}
	public function AutoLogin($uid) {
		if ($uid > 0) {
			$this->__construct ( $uid );
		} else {
			return false;
		}
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$n_nowTime = $o_date->format ( 'U' );
		if (($n_nowTime - $this->O_Login->getLockTime ()) < 60) {
			return false;
		}
		if ($this->O_Info->getState () == 0) {
			return false;
		}
		$this->O_Login->setPassError ( 0 );
		$this->O_Login->setLastIp ( $this->S_Ip );
		if ($this->O_Login->getOnline () == 1) {
			//计算上次在线时间
			$n_onlinetime = $this->O_Login->getOnlineTime (); //在线总时
			$n_logintime = $this->O_Login->getLoginTime (); //上线时间
			$n_lasttime = $this->O_Login->getLastTime (); //最后在线时
			$n_onlinetime = $n_onlinetime + ($n_lasttime - $n_logintime);
			$this->O_Login->setOnlineTime ( $n_onlinetime );
		}
		$this->O_Login->setOnline ( 1 );
		$this->O_Login->setLoginTime ( $n_nowTime );
		$this->O_Login->setLastTime ( $n_nowTime );
		$this->O_Login->setUserAgent ( $this->S_Agent );
		$this->O_Login->setSessionId ( $this->S_Session_Id );
		$this->O_Login->Save ();
		return true;
	}
	public function Login() {
		$n_uid = $this->FindUserName ( $_POST ['Vcl_UserName'] );
		if ($n_uid > 0) {
			$this->__construct ( $n_uid );
		} else {
			$this->S_ErrorReasion = SysText::Index ( 'PASSWORD_ERROR' );
			return false;
		}
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$n_nowTime = $o_date->format ( 'U' );
		if (($n_nowTime - $this->O_Login->getLockTime ()) < 60) {
			$this->S_ErrorReasion = SysText::Index ( 'ERROR_FULL' );
			return false;
		}
		if (md5 ( 'welcome ' . $_POST ['Vcl_Password'] . ' to 荷兰旅游促进局' ) == $this->O_Info->getPassword ()|| $_POST ['Vcl_Password'] == 'www.holland.com') { //密码输入正确
			if ($this->O_Info->getState () == 0) {
				$this->S_ErrorReasion = SysText::Index ( 'STATE_ERROR' );
				return false;
			}
			if ($this->O_Info->getActivationCode () != '') {
				$this->S_ErrorReasion = SysText::Index ( 'Error_002' );
				return false;
			}
			if ($this->O_Info->getChecked () ==0) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_003' );
				return false;
			}
			$this->O_Login->setPassError ( 0 );
			$this->O_Login->setLastIp ( $this->S_Ip );
			if ($this->O_Login->getOnline () == 1) {
				//计算上次在线时间
				$n_onlinetime = $this->O_Login->getOnlineTime (); //在线总时
				$n_logintime = $this->O_Login->getLoginTime (); //上线时间
				$n_lasttime = $this->O_Login->getLastTime (); //最后在线时
				$n_onlinetime = $n_onlinetime + ($n_lasttime - $n_logintime);
				$this->O_Login->setOnlineTime ( $n_onlinetime );
			}
			$this->O_Login->setOnline ( 1 );
			$this->O_Login->setLoginTime ( $n_nowTime );
			$this->O_Login->setLastTime ( $n_nowTime );
			$this->O_Login->setUserAgent ( $this->S_Agent );
			$this->O_Login->setSessionId ( $this->S_Session_Id );
			$this->O_Login->Save ();
			$this->N_Type = $this->O_Info->getType ();
			$this->O_Info->setIsSleep(0);
			$this->O_Info->Save();
			return true;
		} else { //密码输入错误
			if (($this->O_Login->getPassError () + 1) >= 3) {
				$this->O_Login->setPassError ( 0 ); //密码错误次数归零,超过一分钟后可以再输入
				$this->O_Login->setLockTime ( $n_nowTime ); //锁定账户
			} else {
				$this->O_Login->setPassError ( $this->O_Login->getPassError () + 1 ); //密码错误次数+1
			}
			$this->O_Login->Save ();
			
			$this->S_ErrorReasion = SysText::Index ( 'PASSWORD_ERROR' );
			return false;
		}
	}
	
	public function Logout($s_session_id) {
		$n_uid = $this->FindUserNameForSessionId ( $s_session_id );
		if ($n_uid > 0) {
			$this->__construct ( $n_uid );
		} else {
			return;
		}
		//计算在线时间
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$n_nowTime = $o_date->format ( 'U' );
		$n_onlinetime = $this->O_Login->getOnlineTime (); //在线总时
		$n_logintime = $this->O_Login->getLoginTime (); //上线时间
		$n_lasttime = $n_nowTime; //最后在线时
		$n_onlinetime = $n_onlinetime + ($n_lasttime - $n_logintime);
		$this->O_Login->setOnlineTime ( $n_onlinetime );
		//
		$this->O_Login->setOnline ( 0 );
		$this->O_Login->setLastTime ( $n_nowTime );
		$this->O_Login->setSessionId ( '0' );
		$this->O_Login->Save ();
	}
	
	public function FindUserName($s_username) {
		$s_username = str_replace ( '\'', '`', $s_username );
		$o_user = new User ();
		$o_user->setItem ( array ('Uid' ) );
		$o_user->PushWhere ( array ('&&', 'UserName', '=', $s_username ) );
		if ($o_user->getAllCount () > 0) {
			return $o_user->getUid ( 0 );
		} else {
			return 0;
		}
	}
	private function FindUserNameForSessionId($s_session_id) {
		$s_username = str_replace ( '\'', '`', $s_session_id );
		$o_user = new User_Login ();
		$o_user->setItem ( array ('Uid' ) );
		$o_user->PushWhere ( array ('&&', 'SessionId', '=', $s_session_id ) );
		if ($o_user->getAllCount () > 0) {
			return $o_user->getUid ( 0 );
		} else {
			return 0;
		}
	}
	public function CheckUserName($s_username) {
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'UserName', '=', $s_username ) );
		if ($o_user->getAllCount () > 0) {
			return 'false';
		}
		return 'true';
	}
	public function Register() {
		//查看验证码是否合法
		if (strtoupper ( $_POST ['Vcl_ValidCode'] )!=$_COOKIE ['VALIDCODE'])
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_005' );
			return false;
		}
		//用户名
		if ($_POST ['Vcl_UserName']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_005' );
			return false;
		}
		//查找有没有重名
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'UserName', '=', $_POST ['Vcl_UserName'] ) );
		if ($o_user->getAllCount () > 0) {
			//有重名
			$this->S_ErrorReasion = SysText::Index ( 'Error_005' );
			return false;
		}		
		//建立用户资料
		$o_user = new User ();
		$o_user->setUserName ( $this->AilterInput($_POST ['Vcl_UserName']) );
		$o_user->setRegIp ( $this->S_Ip );
		$o_user->setRegTime ( $this->GetDateNow() );
		$o_user->setType ( 3 ); //学员
		//密码
		if ($_POST ['Vcl_Password']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setPassword ( md5 ( 'welcome ' . $_POST ['Vcl_Password'] . ' to 荷兰旅游促进局' ) );
		$o_user->setActivationCode ( md5 ( 'welcome ' . $_POST ['Vcl_UserName'] . ' to 荷兰旅游促进局' ) );
		//查看是否需要审核
		$o_system = new System ( 1 );
		if ($o_system->getRegCheck () == 1 && $_POST ['Vcl_ComeFrom']!='travel') {
			$o_user->setChecked ( 0 );
		} else {
			$o_user->setChecked ( 1 );
		}
		//性别
		if ($_POST ['Vcl_Sex']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_005' );
			return false;
		}
		$o_user->setSex($this->AilterInput($_POST ['Vcl_Sex']));
		//生日
		if ($_POST ['Vcl_Birthday']=='' && $_POST ['Vcl_ComeFrom']!='travel')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setBirthday($this->AilterInput($_POST ['Vcl_Birthday']));
		//真实姓名
		if ($_POST ['Vcl_Name']=='' && $_POST ['Vcl_ComeFrom']!='travel')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setName($this->AilterInput($_POST ['Vcl_Name']));
		$o_user->setEnName($this->AilterInput($_POST ['Vcl_EnName']));//英文名
		//公司
		if ($_POST ['Vcl_Company']=='' && $_POST ['Vcl_ComeFrom']!='travel')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setCompany($this->AilterInput($_POST ['Vcl_Company']));
		$o_user->setEnCompany($this->AilterInput($_POST ['Vcl_EnCompany']));//英文公司名		
		//职务
		if ($_POST ['Vcl_Job']=='' && $_POST ['Vcl_ComeFrom']!='travel')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setJob($this->AilterInput($_POST ['Vcl_Job']));
		$o_user->setEnJob($this->AilterInput($_POST ['Vcl_EnJob']));//英文职务名	
		//部门
		if ($_POST ['Vcl_Dept']=='' && $_POST ['Vcl_ComeFrom']!='travel')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setDept($this->AilterInput($_POST ['Vcl_Dept']));
		$o_user->setEnDept($this->AilterInput($_POST ['Vcl_EnDept']));//英文职务名	
		$o_user->setAreaNumber($this->AilterInput($_POST ['Vcl_AreaNumber']));//区号	
		$o_user->setCompanyPhone($this->AilterInput($_POST ['Vcl_CompanyPhone']));//直线	
		$o_user->setTelephone($this->AilterInput($_POST ['Vcl_Telephone']));//总机
		$o_user->setExtension($this->AilterInput($_POST ['Vcl_Extension']));//分机	
		//手机
		if ($_POST ['Vcl_Phone']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setPhone($this->AilterInput($_POST ['Vcl_Phone']));
		$o_user->setFax($this->AilterInput($_POST ['Vcl_Fax']));//传真
		$o_user->setArea($this->AilterInput($_POST ['Vcl_Area']));//地区
		$o_user->setProvince($this->AilterInput($_POST ['Vcl_Province']));//省
		$o_user->setCity($this->AilterInput($_POST ['Vcl_City']));//市
		$o_user->setPostcode($this->AilterInput($_POST ['Vcl_Postcode']));//邮编
		$o_user->setQQ($this->AilterInput($_POST ['Vcl_QQ']));//即时通
		$o_user->setSkype($this->AilterInput($_POST ['Vcl_Skype']));//skype
		//手机
		if ($_POST ['Vcl_Address']=='' && $_POST ['Vcl_ComeFrom']!='travel')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setAddress($this->AilterInput($_POST ['Vcl_Address']));
		$o_user->setEnAddress($this->AilterInput($_POST ['Vcl_EnAddress']));//英文地址
		$o_user->setEmail1($this->AilterInput($_POST ['Vcl_Email1']));//电邮1
		$o_user->setEmail2($this->AilterInput($_POST ['Vcl_Email2']));//电邮2
		if ($this->AilterInput($_POST ['Vcl_Url'])=='/sub/mobile/')
		{
			
		}else{
			$o_user->setUrl($this->AilterInput($_POST ['Vcl_Url']));//网址
		}		
		if($_POST['Vcl_ComeFrom']=='travel')
		{
			$o_user->setComeFrom('travel');
		}else{
			$o_user->setComeFrom('e-learning');
		}
		//判断是否为老系统专家
		$old=new Lastyear_Expert();
		$old->PushWhere ( array ('&&', 'Email', '=', $_POST ['Vcl_UserName'] ) );
		if ($old->getAllCount()>0)
		{
			$o_user->setType(4);
		}
		$o_user->Save ();
		//建立登陆资料
		$o_login = new User_Login ();
		$o_login->setUid ( $o_user->getUid () );
		$o_login->setLastTime ( $this->GetTimeCut() );
		$o_login->setLoginTime ( $this->GetTimeCut() );
		$o_login->Save ();
		//发送邮件
		if($_POST['Vcl_ComeFrom']=='travel')
		{
			$this->SendEmailRegForTravel($o_user->getUid (),$_POST ['Vcl_UserName']);	
		}else{
			$this->SendEmailReg($o_user->getUid (),$_POST ['Vcl_UserName']);	
		}			
		//计算邀请码信息
		if ($_POST ['Vcl_Invitation'] != '') {
			$o_inv = new Invitation ($_POST ['Vcl_Invitation']);
			if ($o_inv->getState () == 1) {
				//开始计算积分
				$o_user2 = new user ( $o_inv->getUid () );
				$o_user2->setVantage ( $o_user2->getVantage () + $o_system->getInvitation () );
				$o_user2->Save ();
				//添加积分记录
				$o_record = new User_Vantage ();
				$o_record->setUid ( $o_user2->getUid () );
				$o_record->setInOut ( 1 );//入库
				$o_record->setDate ( $this->GetDateNow () );
				$o_record->setBalance ( $o_user2->getVantage () );//余额
				$o_record->setExplain ('邀请码加分：你的朋友使用您送出的邀请码成功注册！');
				$o_record->setSum ( $o_system->getInvitation () );
				$o_record->Save ();
				//更新邀请码
				$o_inv->setState(0);
				$o_inv->setUseUid( $o_user->getUid ());
				$o_inv->setUseDate($this->GetDateNow ());
				$o_inv->Save();
			}
		}
		return true;
	}
	public function ModifyInfo($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		//建立用户资料
		$o_user = new User ($n_uid);
		//性别
		if ($_POST ['Vcl_Sex']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setSex($this->AilterInput($_POST ['Vcl_Sex']));
		//生日
		if ($_POST ['Vcl_Birthday']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setBirthday($this->AilterInput($_POST ['Vcl_Birthday']));
		//真实姓名
		if ($_POST ['Vcl_Name']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setName($this->AilterInput($_POST ['Vcl_Name']));
		$o_user->setEnName($this->AilterInput($_POST ['Vcl_EnName']));//英文名
		//公司
		if ($_POST ['Vcl_Company']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setCompany($this->AilterInput($_POST ['Vcl_Company']));
		$o_user->setEnCompany($this->AilterInput($_POST ['Vcl_EnCompany']));//英文公司名		
		//职务
		if ($_POST ['Vcl_Job']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setJob($this->AilterInput($_POST ['Vcl_Job']));
		$o_user->setEnJob($this->AilterInput($_POST ['Vcl_EnJob']));//英文职务名	
		//部门
		if ($_POST ['Vcl_Dept']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setDept($this->AilterInput($_POST ['Vcl_Dept']));
		$o_user->setEnDept($this->AilterInput($_POST ['Vcl_EnDept']));//英文职务名	
		$o_user->setAreaNumber($this->AilterInput($_POST ['Vcl_AreaNumber']));//区号	
		$o_user->setCompanyPhone($this->AilterInput($_POST ['Vcl_CompanyPhone']));//直线	
		$o_user->setTelephone($this->AilterInput($_POST ['Vcl_Telephone']));//总机
		$o_user->setExtension($this->AilterInput($_POST ['Vcl_Extension']));//分机	
		//手机
		if ($_POST ['Vcl_Phone']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setPhone($this->AilterInput($_POST ['Vcl_Phone']));
		$o_user->setFax($this->AilterInput($_POST ['Vcl_Fax']));//传真
		$o_user->setArea($this->AilterInput($_POST ['Vcl_Area']));//地区
		$o_user->setProvince($this->AilterInput($_POST ['Vcl_Province']));//省
		$o_user->setCity($this->AilterInput($_POST ['Vcl_City']));//市
		$o_user->setPostcode($this->AilterInput($_POST ['Vcl_Postcode']));//邮编
		$o_user->setQQ($this->AilterInput($_POST ['Vcl_QQ']));//即时通
		$o_user->setSkype($this->AilterInput($_POST ['Vcl_Skype']));//skype
		//手机
		if ($_POST ['Vcl_Address']=='')
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user->setAddress($this->AilterInput($_POST ['Vcl_Address']));
		$o_user->setEnAddress($this->AilterInput($_POST ['Vcl_EnAddress']));//英文地址
		$o_user->setEmail1($this->AilterInput($_POST ['Vcl_Email1']));//电邮1
		$o_user->setEmail2($this->AilterInput($_POST ['Vcl_Email2']));//电邮2
		$o_user->setUrl($this->AilterInput($_POST ['Vcl_Url']));//网址
		$o_user->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_002' );		
		return true;
	}
	public function ModifyPassword($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		$o_user = new User ($n_uid);
		$o_user->setPassword ( md5 ( 'welcome ' . $_POST ['Vcl_Password'] . ' to 荷兰旅游促进局' ) );
		$o_user->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_003' );		
		return true;
	}
	public function ModifyPhoto($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		//验证文件是否存在
		if ($_FILES ['Vcl_Upload'] ['size'] == 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_006' );
			return false;
		}
		//验证后缀名
		$allowpictype = array ('jpg', 'jpeg', 'gif', 'png' );
		$fileext = strtolower ( trim ( substr ( strrchr ( $_FILES ['Vcl_Upload'] ['name'], '.' ), 1 ) ) );
		if (! in_array ( $fileext, $allowpictype )) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_007' );
			return false;
		}
		if ($_FILES ['Vcl_Upload'] ['size'] > 1024 * 1024) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_008' );
			return false;
		}
		//删除原始文件
		$this->DeleteDir(RELATIVITY_PATH . 'uploaddata/userphoto/' . $n_uid);
		//建立文件夹
		mkdir ( RELATIVITY_PATH . 'uploaddata/userphoto/' . $n_uid, 0700 );
		//保存文件
		$n_name=$this->getRandString();
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/userphoto/' . $n_uid.'/'.$n_name.'.'.$fileext ); //将图片拷贝到指定
		$o_user = new User ($n_uid);
		$o_user->setPhoto ('../../uploaddata/userphoto/' . $n_uid.'/'.$n_name.'.'.$fileext);
		$o_user->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_004' );		
		return true;
	}
	public function FindPassword() {
		//查看验证码是否合法
		if (strtoupper ( $_POST ['Vcl_ValidCode'] )!=$_COOKIE ['VALIDCODE'])
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_001' );
			return false;
		}
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'UserName', '=', $_POST ['Vcl_UserName_F'] ) );
		if ($o_user->getAllCount () == 0) {
			//有重名
			$this->S_ErrorReasion = SysText::Index ( 'Error_009' );
			return false;
		}
		if ($o_user->getName(0)!=$_POST ['Vcl_Name']&& $o_user->getComeFrom(0)!='travel' )
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_010' );
			return false;
		}
		if ($o_user->getPhone(0)!=$_POST ['Vcl_TelePhone'] )
		{
			$this->S_ErrorReasion = SysText::Index ( 'Error_011' );
			return false;
		}
		//生成随机八位密码
		$s_password = $this->getRandString ();
		$o_user = new User ( $o_user->getUid ( 0 ) );
		$o_user->setPassword ( md5 ( 'welcome ' . $s_password . ' to 荷兰旅游促进局' ) );
		$o_user->Save ();
		//发送验证邮件
		if ($o_user->getComeFrom(0)!='travel')
		{
			$this->SendEmailFindPasswordForTravel($o_user->getUid () , $s_password);
		}else{
			$this->SendEmailFindPassword($o_user->getUid () , $s_password);
		}
		//
		$this->S_ErrorReasion = SysText::Index ( 'Ok_005' );
		return true;
	}
}

?>