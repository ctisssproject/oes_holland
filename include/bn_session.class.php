<?php
require_once RELATIVITY_PATH . 'include/bn_user.class.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
class Session extends Bn_Basic {
	private $O_User;
	private $S_UserIp;
	private $S_Agent;
	private $S_Session_Id;
	private $B_Login;
	private $S_Name;
	public function __construct() {
		$this->S_Ip = $_SERVER ['REMOTE_ADDR'];
		$this->S_Agent = $_SERVER ['HTTP_USER_AGENT'];
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$n_nowTime = $o_date->format ( 'U' );
		if (isset ( $_COOKIE ['SESSIONID'] )) {
			$this->S_Session_Id = $_COOKIE ['SESSIONID'];
			$uid = $this->FindUserName ( $this->S_Session_Id );
			if ($uid > 0) {
				$n_out_time = 100000000000000;
				
				$this->N_Uid = $uid;
				$this->O_User = new Single_User ( $uid );
				$this->O_User->setSessionID ( $this->S_Session_Id );
				$this->N_Type = $this->O_User->get_Info_Type ();
				$this->S_Name = $this->O_User->get_Info_Name ();
				$n_last_time = $this->O_User->get_Login_LastTime ();
				if (($n_nowTime - $n_last_time) > $n_out_time) {
				
				} else {
					$this->B_Login = true;
					$this->O_User->set_Login_LastTime ( $n_nowTime );
					$this->O_User->Save ();
				}
			} else {
				$this->B_Login = false;
				$this->N_Uid = 0;
			}
		} else {
			//$this->S_Session_Id = md5 ( $this->S_Ip . $this->S_Agent . rand ( 0, 9999 ) . $n_nowTime );
			//$s_username = '游客' . rand ( 0, 9999 );
			//setcookie ( 'VISITER', $s_username, 0 );
			//setcookie ( 'SESSIONID', $this->S_Session_Id, 0 );
			//setcookie ( 'VALIDCODE', '  ', 0 );
			$this->B_Login = false;
		}
	
	}
	public function Login() {
		return $this->B_Login;
	}
	private function FindUserName($s_sessionid) {
		$s_sessionid = str_replace ( '\'', '`', $s_sessionid );
		$o_user = new User_Login ();
		$o_user->PushWhere ( array ('&&', 'SessionId', '=', $s_sessionid ) );
		$o_user->PushOrder ( array ('LoginTime', 'D' ) );
		//两个session都可以.只要满足一个
		$o_user->setItem ( array ('Uid' ) );
		if ($o_user->getAllCount () > 0) {
			return $o_user->getUid ( 0 );
		} else {
			return 0;
		}
	}
	public function getUid() {
		return $this->N_Uid;
	}
	public function getType() {
		return $this->N_Type;
	}
	public function getName() {
		return $this->S_Name;
	}
	public function getUserObject() {
		return $this->O_User;
	}
}
?>