<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class Operate extends Bn_Basic {
	public function __construct() {
		$this->Result = FALSE;
	}	
	public function CheckPasswordOld($n_uid, $s_password) {
		if (! ($n_uid > 0)) {
			return false;
		}
		$o_user = new User ( $n_uid );
		if ($o_user->getPassword () == md5 ( 'welcome ' . $s_password . ' to 荷兰旅游促进局' )) {
			return true;
		} else {
			return false;
		}
	}	
	public function getResult() {
		return $this->Result;
	}
	public function DownTravel($n_uid, $id) {
		if (! ($n_uid > 0)) {
			return false;
		}
		$o_user=new User($n_uid);
		//验证该用户下载时间是否大于1分钟$o_visitor=new Travel_Visitor();
		$o_visitor=new Travel_Visitor();
		$o_visitor->PushWhere ( array ('&&', 'Email', '=', $o_user->getUserName()) );
		$o_visitor->PushWhere ( array ('&&', 'Phone', '=', $o_user->getPhone()) );
		$o_visitor->PushWhere ( array ('&&', 'TitleId', '=', $id) );
		$o_visitor->PushWhere ( array ('&&', 'Date', '>', date('Y-m-d H:i:s',($this->GetTimeCut()+28740))) );
		if ($o_visitor->getAllCount()>0)
		{
			return false;
		}
		//记录下载信息
		$o_visitor=new Travel_Visitor();
		$o_visitor->PushWhere ( array ('&&', 'Email', '=', $o_user->getUserName()) );
		$o_visitor->PushWhere ( array ('&&', 'Phone', '=', $o_user->getPhone()) );
		$o_visitor->PushWhere ( array ('&&', 'TitleId', '=', $id) );
		if ($o_visitor->getAllCount()>0)
		{
			$o_visitor=new Travel_Visitor($o_visitor->getId(0));
			$o_visitor->setDate($this->GetDateNow());
			$o_visitor->setSum($o_visitor->getSum()+1);
		}else{
			$o_visitor=new Travel_Visitor();
			$o_visitor->setEmail($o_user->getUserName());
			$o_visitor->setPhone($o_user->getPhone());
			$o_visitor->setIp($_SERVER ['REMOTE_ADDR']);
			$o_visitor->setTitleId($id);
			$o_visitor->setSum(1);
			$o_visitor->setDate($this->GetDateNow());
		}
		$o_visitor->Save();		
		$this->SendEmailDownLoadTravel($n_uid, $id);
		return true;
	}
	public function DownloadTravelForVisitor() {
		//验证该用户下载时间是否大于1分钟$o_visitor=new Travel_Visitor();
		$o_visitor=new Travel_Visitor();
		$o_visitor->PushWhere ( array ('&&', 'Email', '=', $_POST['Vcl_UserName']) );
		$o_visitor->PushWhere ( array ('&&', 'Phone', '=', $_POST['Vcl_Phone']) );
		$o_visitor->PushWhere ( array ('&&', 'TitleId', '=', $_POST['Vcl_TitleId']) );
		$o_visitor->PushWhere ( array ('&&', 'Date', '>', date('Y-m-d H:i:s',($this->GetTimeCut()+28740))) );
		if ($o_visitor->getAllCount()>0)
		{
			return false;
		}
		//记录下载信息
		$o_visitor=new Travel_Visitor();
		$o_visitor->PushWhere ( array ('&&', 'Email', '=', $_POST['Vcl_UserName']) );
		$o_visitor->PushWhere ( array ('&&', 'Phone', '=', $_POST['Vcl_Phone']) );
		$o_visitor->PushWhere ( array ('&&', 'TitleId', '=', $_POST['Vcl_TitleId']) );
		if ($o_visitor->getAllCount()>0)
		{
			$o_visitor=new Travel_Visitor($o_visitor->getId(0));
			$o_visitor->setDate($this->GetDateNow());
			$o_visitor->setSum($o_visitor->getSum()+1);
		}else{
			$o_visitor=new Travel_Visitor();
			$o_visitor->setEmail($_POST['Vcl_UserName']);
			$o_visitor->setPhone($_POST['Vcl_Phone']);
			$o_visitor->setIp($_SERVER ['REMOTE_ADDR']);
			$o_visitor->setTitleId($_POST['Vcl_TitleId']);
			$o_visitor->setSum(1);
			$o_visitor->setDate($this->GetDateNow());
		}
		$o_visitor->Save();		
		$this->SendEmailDownLoadTravel(0, $_POST['Vcl_TitleId'],$_POST['Vcl_UserName']);
		return true;
	}
}
?>