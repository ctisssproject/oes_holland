<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class Operate extends Bn_Basic {
	private $N_SendId;
	public $N_UserCount;
	public $N_Start;
	public function getSendId() {
		return $this->N_SendId;
	}
	public function __construct() {
		$this->Result = TRUE;
	}
	
	public function AdminState($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_user = new User ( $n_uid );
		if ($o_user->getState () == 1) {
			$o_user->setState ( 0 );
		} else {
			$o_user->setState ( 1 );
		}
		$o_user->Save ();
		return true;
	}
	public function AdminModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Uid', '<>', $_POST ['Vcl_Uid'] ) );
		$o_user->PushWhere ( array ('&&', 'UserName', '=', $_POST ['Vcl_UserName'] ) );
		if ($o_user->getAllCount () > 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_013' );
			return FALSE;
		}
		$o_user = new User ( $_POST ['Vcl_Uid'] );
		$o_user->setUserName ( $_POST ['Vcl_UserName'] );
		$o_user->setName ( $_POST ['Vcl_Name'] );
		$o_user->setType ( $_POST ['Vcl_Type'] );
		$o_user->setSex ( $_POST ['Vcl_Sex'] );
		$o_user->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function AdminResetPassword($n_type) {
		if (! ($n_type = 1)) {
			return;
		}
		$o_user = new User ( $_POST ['Vcl_Uid'] );
		$o_user->setPassword ( md5 ( 'welcome ' . $_POST ['Vcl_Password'] . ' to 荷兰旅游促进局' ) );
		$o_user->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_010' );
		return true;
	}
	public function StudentSendMail($n_type, $s_name) {
		if (! ($n_type = 1)) {
			return;
		}
		$o_system = new System ( 1 );
		$s_typename = '';
		if ($_POST ['e-learning'] == 'on') {
			$s_typename = '旅行社';
		}
		if ($_POST ['media'] == 'on') {
			$s_typename .= ' 媒体';
		}
		if ($_POST ['travel'] == 'on') {
			$s_typename .= ' 大众';
		}
		if ($s_typename == '') {
			$s_typename = '自定义';
		}
		$s_title = $_POST ['Vcl_Title'];
		$s_count = $_POST ['Vcl_Content']; //还要修正图片地址，/oes/
		//添加景区附件
		$o_region = new View_Library_Region ();
		$o_region->PushOrder ( array ('CityId', 'A' ) );
		$n_count = $o_region->getAllCount ();
		$s_region='';
		for($i = 0; $i < $n_count; $i ++) {
			if ($_POST ['Vcl_Region_' . $o_region->getRegionId ( $i )] == 'on') {
				$s_region.='<a href="'.$o_system->getHost ().'sub/library/review_region.php?id='.$o_region->getRegionId ( $i ).'" title="点击预览文档" target="_blank" style="margin-top:10px;margin-right:10px;font-size:12px;color:#3bb1e2; text-decoration:underline;word-break:keep-all">'.$o_region->getCityName($i).'-'.$o_region->getName($i).'</a>';
			}
		}
		if($s_region!='')
		{
			$s_attach.='<tr>
                                <td style="padding:5px">
	                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color: #ffffff;">
	                                	<tr>
	                                		<td style="width:120px;vertical-align:top">
	                                		景区介绍附件：
	                                		</td>
	                                		<td>
	                                '.$s_region.'
	                                		</td>
	                                	</tr>
	                                </table>
                                </td>
                            </tr>  ';
		}
		//
		$s_count = '
						<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background-color: #ffffff;">  
                            '.$s_attach.' 
                            <tr>
                                <td>'.$s_count.'</td>
                            </tr>                 
                        </table>
		';
		//添加记录邮件
		$o_mailrecord = new MailRecord ();
		$o_mailrecord->setDate ( $this->GetDateNow () );
		$o_mailrecord->setUserName ( $s_name );
		$o_mailrecord->setTitle ( $_POST ['Vcl_Title'] );
		
		//还要修正图片邮件中的图片地址，/oes/
		$s_count = str_replace ( "/sub/ucenter/editor/php/../../../..", '', $s_count );
		$s_count = str_replace ( "/uploaddata/", $o_system->getHost () . 'uploaddata/', $s_count ); //替换网址
		$o_edm = new Edm ();
		$o_edm->PushWhere ( array ('&&', 'EdmId', '=', rand ( 1, 5 ) ) );
		$o_edm->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_edm->getAllCount ();
		$s_html = $o_edm->getHtml ( 0 );
		$s_title2 = '您好！&nbsp;&nbsp;&nbsp;&nbsp;“荷兰旅游专家”欢迎您';
		$s_html = str_replace ( "<URL/>", $o_system->getHost (), $s_html ); //替换网址
		$s_html = str_replace ( "<DATE/>", $this->GetDate (), $s_html ); //替换日期
		$s_html = str_replace ( "<EDMID/>", $o_edm->getEdmId ( 0 ), $s_html ); //替换Id
		$s_html = str_replace ( "<CONTENT/>", $s_count, $s_html ); //替换内容
		$s_html = str_replace ( "<TITLE/>", $s_title2, $s_html ); //替换标题	
		$o_mailrecord->setContent ( $s_html );
		$o_mailrecord->setType ( $s_typename );
		$o_mailrecord->Save ();
		$o_mailrecord->setCsv ( $o_mailrecord->getId () . '.csv' );
		$o_mailrecord->Save ();
		$fp = fopen ( '../output/' . $o_mailrecord->getId () . '.csv', 'w' );
		$this->SetTotalInfo ( '公司名称', '姓名', '邮件地址', $fp );
		//发送收件群组
		$o_user = new User ();
		if ($_POST ['e-learning'] == 'on') {
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		if ($_POST ['media'] == 'on') {
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		if ($_POST ['travel'] == 'on') {
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
		$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', '111' ) );
		$o_user->PushOrder ( array ('Company', 'A' ) );
		$n_count = $o_user->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			//发送邮件
			$this->setEdmUser ( $o_user->getUid ( $i ) );
			$this->setEdmTitle ( $s_title );
			$this->setEdmFromMail ( 'admin@hollandtravelexpert.com' );
			$this->setEdmContent ( ':<br/>' . $s_count );
			$this->SendEdm ();
			//构建导出文件	
			$this->SetTotalInfo ( $o_user->getCompany ( $i ), $o_user->getName ( $i ), $o_user->getUserName ( $i ), $fp );
		}
		//发送特定人
		if ($_POST ['Vcl_Receiver'] != '') {
			$a_mail = explode ( ";", $_POST ['Vcl_Receiver'] );
			for($i = 0; $i < count ( $a_mail ); $i ++) {
				//发送邮件
				$this->setEdmUser ( 0 );
				$this->setEdmEmail ( $a_mail [$i] );
				$this->setEdmName ( '用户' );
				$this->setEdmTitle ( $s_title );
				$this->setEdmFromMail ( 'admin@hollandtravelexpert.com' );
				$this->setEdmContent ( ':<br/>' . $s_count );
				$this->SendEdm ();
				//构建导出文件	
				$this->SetTotalInfo ( '无', '无', $a_mail [$i], $fp );
			}
		}
		fclose ( $fp );
		$this->S_ErrorReasion = SysText::Index ( 'Ok_012' ) . '<br/>共发送 ' . ($n_count + count ( $a_mail )) . ' 封邮件！';
		return true;
	}
	private function SetTotalInfo($var1, $var2, $var3, $file) {
		$a_item = array ();
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var1 ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var2 ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var3 ) );
		fputcsv ( $file, $a_item );
	}
	public function AdminDelete($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new User ( $n_uid );
		$o_user->Deletion ();
		$o_user = new User_Login ( $n_uid );
		$o_user->Deletion ();
		return true;
	}
	public function StudentDelete($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new User ( $n_uid );
		$o_user->Deletion ();
		$o_user = new User_Login ( $n_uid );
		$o_user->Deletion ();
		//删除学习内容和奖品积分记录。
		$o_user = new User_Study_Chapter ();
		$o_user->DeleteUser ( $n_uid );
		$o_user = new User_Study_Section ();
		$o_user->DeleteUser ( $n_uid );
		$o_user = new User_Vantage ();
		$o_user->DeleteUser ( $n_uid );
		$o_user = new Goods_Send ();
		$o_user->DeleteUser ( $n_uid );
		return true;
	}
	public function StudentAllow($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new User ( $n_uid );
		$o_system = new System ( 1 );
		//发送邮件
		$this->SendEmailStudentAllow ( $o_user->getUid () );
		//
		$o_user->setChecked ( 1 );
		$o_user->Save ();
		return true;
	}
	public function AdminAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'UserName', '=', $_POST ['Vcl_UserName'] ) );
		if ($o_user->getAllCount () > 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_013' );
			return FALSE;
		}
		$o_user = new User ();
		$o_user->setUserName ( $_POST ['Vcl_UserName'] );
		$o_user->setPassword ( md5 ( 'welcome ' . $_POST ['Vcl_Password'] . ' to 荷兰旅游促进局' ) );
		$o_user->setName ( $_POST ['Vcl_Name'] );
		$o_user->setType ( $_POST ['Vcl_Type'] );
		$o_user->setSex ( $_POST ['Vcl_Sex'] );
		$o_user->setRegIp ( $_SERVER ['REMOTE_ADDR'] );
		$o_user->setRegTime ( $this->GetDateNow () );
		$o_user->setChecked ( 1 );
		$o_user->Save ();
		$o_login = new User_Login ();
		$o_login->setUid ( $o_user->getUid () );
		$o_login->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_011' );
		return true;
	}
	public function SystemNewsAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new News ();
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setDate ( $_POST ['Vcl_Date'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_014' );
		return true;
	}
	public function SystemNewsModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new News ( $_POST ['Vcl_NewsId'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setDate ( $_POST ['Vcl_Date'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemNewsDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_teble = new News ( $n_id );
		$o_teble->Deletion ();
		return true;
	}
	public function SystemNewsState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new News ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function SystemAdvertState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Advert ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function SystemAdvertDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Advert ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/ad/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		$this->SystemAdvertSortForDelete ();
		return true;
	}
	public function SystemAdvertAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		//建立文件夹
		$o_table = new Advert ();
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setSize ( $_POST ['Vcl_Size'] );
		$o_table->setUrl ( $_POST ['Vcl_Url'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setOpen ( $_POST ['Vcl_Open'] );
		$o_table->Save ();
		$o_table->setOnout ( '/uploaddata/ad/' . $o_table->getAdvertId () . '/off.' . $fileext );
		$o_table->Save ();
		//读取图片
		

		mkdir ( RELATIVITY_PATH . 'uploaddata/ad/' . $o_table->getAdvertId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/ad/' . $o_table->getAdvertId () . '/off.' . $fileext ); //将图片拷贝到指定
		$this->SystemAdvertSort ( $o_table->getAdvertId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_015' );
		return true;
	}
	public function SystemAdvertModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Advert ( $_POST ['Vcl_AdvertId'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setSize ( $_POST ['Vcl_Size'] );
		$o_table->setUrl ( $_POST ['Vcl_Url'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setOpen ( $_POST ['Vcl_Open'] );
		$o_table->Save ();
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table->setOnout ( '/uploaddata/ad/' . $o_table->getAdvertId () . '/off.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/ad/' . $o_table->getAdvertId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/ad/' . $o_table->getAdvertId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/ad/' . $o_table->getAdvertId () . '/off.' . $fileext ); //将图片拷贝到指定
		}
		$this->SystemAdvertSort ( $o_table->getAdvertId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	private function SystemAdvertSort($n_advertid, $n_number) {
		$o_all = new Advert ();
		$o_all->PushWhere ( array ('&&', 'AdvertId', '<>', 1 ) );
		$o_all->PushWhere ( array ('&&', 'AdvertId', '<>', 2 ) );
		$o_all->PushWhere ( array ('&&', 'AdvertId', '<>', $n_advertid ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Advert ( $o_all->getAdvertId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	private function SystemAdvertSortForDelete() {
		$o_table = new Advert ();
		$o_table->PushWhere ( array ('&&', 'AdvertId', '<>', 1 ) );
		$o_table->PushWhere ( array ('&&', 'AdvertId', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Advert ( $o_table->getAdvertId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	public function SystemPartnersState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Partners ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function SystemPartnersDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Partners ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/partners/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		$this->SystemPartnersSortForDelete ();
		return true;
	}
	private function SystemPartnersSort($n_partnerid, $n_number) {
		$o_all = new Partners ();
		$o_all->PushWhere ( array ('&&', 'PartnerId', '<>', $n_partnerid ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Partners ( $o_all->getPartnerId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	private function SystemPartnersSortForDelete() {
		$o_table = new Partners ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Partners ( $o_table->getPartnerId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	public function SystemPartnersAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		//建立文件夹
		$o_table = new Partners ();
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setUrl ( $_POST ['Vcl_Url'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		$o_table->setIcon ( '/uploaddata/partners/' . $o_table->getPartnerId () . '/off.' . $fileext );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/partners/' . $o_table->getPartnerId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/partners/' . $o_table->getPartnerId () . '/off.' . $fileext ); //将图片拷贝到指定
		$this->SystemPartnersSort ( $o_table->getPartnerId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_016' );
		return true;
	}
	public function SystemPartnersModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Partners ( $_POST ['Vcl_PartnerId'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setUrl ( $_POST ['Vcl_Url'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table->setOnout ( '/uploaddata/partners/' . $o_table->getPartnerId () . '/off.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/partners/' . $o_table->getPartnerId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/partners/' . $o_table->getPartnerId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/partners/' . $o_table->getPartnerId () . '/off.' . $fileext ); //将图片拷贝到指定
		}
		$this->SystemPartnersSort ( $o_table->getPartnerId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemTermsModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_system = new System ( 1 );
		$o_system->setTerms ( $_POST ['Vcl_Content'] );
		$o_system->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemContactModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_system = new System ( 1 );
		$o_system->setContact ( $_POST ['Vcl_Content'] );
		$o_system->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemFocusState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new FocusPhoto ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function SystemFocusDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new FocusPhoto ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/focus/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		$this->SystemFocusSortForDelete ();
		return true;
	}
	public function SystemVantageState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new VantagePhoto ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function SystemVantageDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new VantagePhoto ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/vantage/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		$this->SystemVantageSortForDelete ();
		return true;
	}
	private function SystemFocusSort($n_photoid, $n_number) {
		$o_all = new FocusPhoto ();
		$o_all->PushWhere ( array ('&&', 'PhotoId', '<>', $n_photoid ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new FocusPhoto ( $o_all->getPhotoId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	private function SystemFocusSortForDelete() {
		$o_table = new FocusPhoto ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new FocusPhoto ( $o_table->getPhotoId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	private function SystemVantageSort($n_photoid, $n_number) {
		$o_all = new VantagePhoto ();
		$o_all->PushWhere ( array ('&&', 'PhotoId', '<>', $n_photoid ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new VantagePhoto ( $o_all->getPhotoId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	private function SystemVantageSortForDelete() {
		$o_table = new VantagePhoto ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new VantagePhoto ( $o_table->getPhotoId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	public function SystemFocusAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		//建立文件夹
		$o_table = new FocusPhoto ();
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		$o_table->setPath ( '/uploaddata/focus/' . $o_table->getPhotoId () . '/off.' . $fileext );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/focus/' . $o_table->getPhotoId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/focus/' . $o_table->getPhotoId () . '/off.' . $fileext ); //将图片拷贝到指定
		$this->SystemFocusSort ( $o_table->getPhotoId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_017' );
		return true;
	}
	public function SystemFocusModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new FocusPhoto ( $_POST ['Vcl_PhotoId'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table->setPath ( '/uploaddata/focus/' . $o_table->getPhotoId () . '/off.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/focus/' . $o_table->getPhotoId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/focus/' . $o_table->getPhotoId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/focus/' . $o_table->getPhotoId () . '/off.' . $fileext ); //将图片拷贝到指定
		}
		$this->SystemFocusSort ( $o_table->getPhotoId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemVantageAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		//建立文件夹
		$o_table = new VantagePhoto ();
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		$o_table->setPath ( '/uploaddata/vantage/' . $o_table->getPhotoId () . '/photo.' . $fileext );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/vantage/' . $o_table->getPhotoId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/vantage/' . $o_table->getPhotoId () . '/photo.' . $fileext ); //将图片拷贝到指定
		$this->SystemVantageSort ( $o_table->getPhotoId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_017' );
		return true;
	}
	public function SystemVantageModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new VantagePhoto ( $_POST ['Vcl_PhotoId'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table->setPath ( '/uploaddata/vantage/' . $o_table->getPhotoId () . '/photo.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/vantage/' . $o_table->getPhotoId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/vantage/' . $o_table->getPhotoId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/vantage/' . $o_table->getPhotoId () . '/photo.' . $fileext ); //将图片拷贝到指定
		}
		$this->SystemVantageSort ( $o_table->getPhotoId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemImageModifyLogo($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table = new System ( 1 );
			$o_table->setLogo ( '/uploaddata/logo/image.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/logo' );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/logo', 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/logo/image.' . $fileext ); //将图片拷贝到指定
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemImageModifyRegPhoto($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table = new System ( 1 );
			$o_table->setRegSuccessPhoto ( '/uploaddata/reg/image.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/reg' );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/reg', 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/reg/image.' . $fileext ); //将图片拷贝到指定
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function SystemSetupModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_system = new System ( 1 );
		$o_system->setRegCheck ( $_POST ['Vcl_RegCheck'] );
		$o_system->setInvitation ( $_POST ['Vcl_Invitation'] );
		$o_system->setInvitationSum ( $_POST ['Vcl_InvitationSum'] );
		$o_system->setTerm ( $_POST ['Vcl_Term'] );
		$o_system->setNewtermRemind ( $_POST ['Vcl_NewtermRemind'] );
		$o_system->setSleepRemind ( $_POST ['Vcl_SleepRemind'] );
		$o_system->setIsSleep ( $_POST ['Vcl_IsSleep'] );
		$o_system->setReward ( $_POST ['Vcl_Reward'] );
		$o_system->setHost ( $_POST ['Vcl_Host'] );
		$o_system->setCopyright ( $_POST ['Vcl_Copyright'] );
		$o_system->setPrizeCheck ( $_POST ['Vcl_PrizeCheck'] );
		$o_system->setInformationCheck ( $_POST ['Vcl_InformationCheck'] );
		$o_system->setCredentialCheck ( $_POST ['Vcl_CredentialCheck'] );
		$o_system->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function CourseGetNav2($n_type, $n_termid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Chapter ();
		$o_table->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<table border="0" cellpadding="0" cellspacing="0">
            			<tr>
                			<td class="nav2" onclick="nav2GoTo(\'course_section.php?chapterid=' . $o_table->getChapterId ( $i ) . '\',this,\'#nav_3_' . $o_table->getChapterId ( $i ) . '\',' . $o_table->getChapterId ( $i ) . ')">
                    			' . $o_table->getName ( $i ) . '
                			</td>
            			</tr>
       				 </table>
        			<div class="nav3_border" id="nav_3_' . $o_table->getChapterId ( $i ) . '"></div>';
		}
		if ($s_html == '') {
			$s_html = '<table border="0" cellpadding="0" cellspacing="0">
            			<tr>
                			<td class="nav2">
                    			这个学期下没有章
                			</td>
            			</tr>
       				 </table>';
		}
		return $s_html;
	}
	public function CourseGetNav3($n_type, $n_chapterid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Section ();
		$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapterid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<table border="0" cellpadding="0" cellspacing="0">
                		<tr>
                    		<td class="nav3">
                        		<div>
                            		<a href="javascript:;" hidefocus="true" onclick="nav3GoTo(\'course_subject.php?sectionid=' . $o_table->getSectionId ( $i ) . '\',this)">' . $o_table->getTitle ( $i ) . '</a></div>
                    		</td>
                		</tr>
            		</table>
			';
		}
		if ($n_count == 0) {
			$s_html = '<table border="0" cellpadding="0" cellspacing="0">
                		<tr>
                    		<td class="nav3">
                        		<div>
                            		这个章下没有节</div>
                    		</td>
                		</tr>
            		</table>';
		}
		return $s_html;
	}
	public function CourseTermDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_term = new Bank_Term ( $n_id );
		$o_term->setState ( 2 );
		$o_term->Save ();
		return true;
	}
	public function CourseTermAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Bank_Term ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setDate ( $_POST ['Vcl_Date'] );
		$o_table->setEndDate ( $_POST ['Vcl_EndDate'] );
		$o_table->setState ( 0 );
		$o_table->setExplain ( $_POST ['Vcl_Explain'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_018' );
		return true;
	}
	public function CourseTermModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Bank_Term ( $_POST ['Vcl_TermId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setDate ( $_POST ['Vcl_Date'] );
		$o_table->setEndDate ( $_POST ['Vcl_EndDate'] );
		$o_table->setExplain ( $_POST ['Vcl_Explain'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function CourseChapterDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_chapter = new Bank_Chapter ( $n_id );
		$o_chapter->setState ( 2 );
		$o_chapter->Save ();
		$this->CourseChapterSortForDelete ( $o_chapter->getTermId () );
		return true;
	}
	private function CourseChapterSortForDelete($n_termid) {
		$o_table = new Bank_Chapter ();
		$o_table->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Bank_Chapter ( $o_table->getChapterId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	private function CourseChapterSort($n_chapterid, $n_number, $n_termid) {
		$o_all = new Bank_Chapter ();
		$o_all->PushWhere ( array ('&&', 'ChapterId', '<>', $n_chapterid ) );
		$o_all->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
		$o_all->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Bank_Chapter ( $o_all->getChapterId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	public function CourseChapterAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$a_ext = array ();
		for($i = 1; $i < 4; $i ++) {
			if ($_POST ['Vcl_TermId']==8 && $i!=3)
			{
				array_push ( $a_ext,'');
				continue;
			}
			//验证文件是否存在
			if ($_FILES ['Vcl_Upload' . $i] ['size'] == 0) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_006' );
				return false;
			}
			//验证后缀名
			$allowpictype = array ('jpg', 'jpeg', 'gif', 'png' );
			$fileext = strtolower ( trim ( substr ( strrchr ( $_FILES ['Vcl_Upload' . $i] ['name'], '.' ), 1 ) ) );
			if (! in_array ( $fileext, $allowpictype )) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_007' );
				return false;
			}
			if ($_FILES ['Vcl_Upload' . $i] ['size'] > 1024 * 1024) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_008' );
				return false;
			}
			array_push ( $a_ext, '.' . $fileext );
		}
		//建立文件夹
		$o_table = new Bank_Chapter ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setTermId ( $_POST ['Vcl_TermId'] );
		$o_table->setState ( 1 );
		$o_table->setRestudy ( $_POST ['Vcl_Restudy'] );
		$o_table->setSendCredentials ( $_POST ['Vcl_SendCredentials'] );
		$o_table->setCredentialsName ( $_POST ['Vcl_CredentialsName'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		if ($_POST ['Vcl_TermId']==8)
		{
			//微信版
			$o_table->setPhoto ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/photo' . $a_ext [2] );
		}else{
			$o_table->setPhotoOn ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/on' . $a_ext [0] );
			$o_table->setPhotoOff ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/off' . $a_ext [1] );
			$o_table->setPhoto ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/photo' . $a_ext [2] );
		}		
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId (), 0700 );
		if ($_POST ['Vcl_TermId']==8)
		{
			//微信版
			copy ( $_FILES ['Vcl_Upload3'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId () . '/photo' . $a_ext [2] ); //将图片拷贝到指定
		}else{
			copy ( $_FILES ['Vcl_Upload1'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId () . '/on' . $a_ext [0] ); //将图片拷贝到指定
			copy ( $_FILES ['Vcl_Upload2'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId () . '/off' . $a_ext [1] ); //将图片拷贝到指定
		}
		$this->CourseChapterSort ( $o_table->getChapterId (), $_POST ['Vcl_Number'], $o_table->getTermId () ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_019' );
		return true;
	}
	public function CourseChapterModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Bank_Chapter ( $_POST ['Vcl_ChapterId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setRestudy ( $_POST ['Vcl_Restudy'] );
		$o_table->setSendCredentials ( $_POST ['Vcl_SendCredentials'] );
		$o_table->setCredentialsName ( $_POST ['Vcl_CredentialsName'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		if ($_FILES ['Vcl_Upload1'] ['size'] > 0) {
			
			//验证后缀名
			$allowpictype = array ('jpg', 'jpeg', 'gif', 'png' );
			$fileext = strtolower ( trim ( substr ( strrchr ( $_FILES ['Vcl_Upload1'] ['name'], '.' ), 1 ) ) );
			if (! in_array ( $fileext, $allowpictype )) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_007' );
				return false;
			}
			if ($_FILES ['Vcl_Upload1'] ['size'] > 1024 * 1024) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_008' );
				return false;
			}
			$o_table->setPhotoOn ( '/uploaddata/chapterphoto/' . $_POST ['Vcl_ChapterId'] . '/on.' . $fileext );
			copy ( $_FILES ['Vcl_Upload1'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $_POST ['Vcl_ChapterId'] . '/on.' . $fileext ); //将图片拷贝到指定
		}
		if ($_FILES ['Vcl_Upload2'] ['size'] > 0) {
			
			//验证后缀名
			$allowpictype = array ('jpg', 'jpeg', 'gif', 'png' );
			$fileext = strtolower ( trim ( substr ( strrchr ( $_FILES ['Vcl_Upload2'] ['name'], '.' ), 1 ) ) );
			if (! in_array ( $fileext, $allowpictype )) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_007' );
				return false;
			}
			if ($_FILES ['Vcl_Upload2'] ['size'] > 1024 * 1024) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_008' );
				return false;
			}
			$o_table->setPhotoOff ( '/uploaddata/chapterphoto/' . $_POST ['Vcl_ChapterId'] . '/off.' . $fileext );
			copy ( $_FILES ['Vcl_Upload2'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $_POST ['Vcl_ChapterId'] . '/off.' . $fileext ); //将图片拷贝到指定
		}
		if ($_FILES ['Vcl_Upload3'] ['size'] > 0) {
			
			//验证后缀名
			$allowpictype = array ('jpg', 'jpeg', 'gif', 'png' );
			$fileext = strtolower ( trim ( substr ( strrchr ( $_FILES ['Vcl_Upload3'] ['name'], '.' ), 1 ) ) );
			if (! in_array ( $fileext, $allowpictype )) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_007' );
				return false;
			}
			if ($_FILES ['Vcl_Upload3'] ['size'] > 1024 * 1024) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_008' );
				return false;
			}
			$o_table->setPhoto ( '/uploaddata/chapterphoto/' . $_POST ['Vcl_ChapterId'] . '/photo.' . $fileext );
			copy ( $_FILES ['Vcl_Upload3'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $_POST ['Vcl_ChapterId'] . '/photo.' . $fileext ); //将图片拷贝到指定
		}
		$o_table->Save ();
		//读取图片
		$this->CourseChapterSort ( $o_table->getChapterId (), $_POST ['Vcl_Number'], $o_table->getTermId () ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function CourseTermPublish($n_type, $n_id,$n_start) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_system = new System ( 1 );
		//把所有当前的学期变成未发布
		$o_term = new Bank_Term ();
		$o_term->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$n_count = $o_term->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Bank_Term ( $o_term->getTermId ( $i ) );
			$o_temp->setState ( 0 );
			$o_temp->Save ();
		}
		//设置发布学期状态
		$o_term = new Bank_Term ( $n_id );
		$o_term->setState ( 1 );
		$o_term->Save ();
		/*if ($o_system->getNewtermRemind () == 1) {
			//保存邮件副本					
			//$o_mailrecord = new MailRecord ();
			//$o_mailrecord->setDate ( $this->GetDateNow () );
			//$o_mailrecord->Save ();
			//$o_mailrecord->setCsv ( $o_mailrecord->getId () . '.csv' );
			//$fp = fopen ( '../output/' . $o_mailrecord->getId () . '.csv', 'w' );
			//$this->SetTotalInfo ( '公司名称', '姓名', '邮件地址', $fp );
		}*/
		//循环修正学员信息
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		$o_user->PushWhere ( array ('&&', 'State', '=', 1 ) ); //状态必须为激活状态
		$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) ); //必须为审核通过
		$o_user->PushOrder ( array ('Uid', 'A' ) );
		$o_user->setStartLine ($n_start ); //起始记录
		$o_user->setCountLine (100);
		$n_allcount = $o_user->getAllCount ();
		$n_count = $o_user->getCount ();
		for($i = 0; $i < $n_count; $i ++) {
			if ($o_user->getType ( $i ) > 3) {
				$o_temp = new User ( $o_user->getUid ( $i ) );
				//验证证书有效期
				if ($o_temp->getType () == 4) {
					if ($o_temp->getTerm () > $o_system->getTerm ()) {
						//已过期
						$o_temp->setType ( 3 );
						$o_temp->setTerm ( 0 );
						$o_temp->setPercent ( 0 );
					} else {
						//没过期，学期+1
						$o_temp->setTerm ( $o_temp->getTerm () + 1 );
					}
				}
				//本学期专家变为专家，证书有效期加一
				if ($o_temp->getType () == 5) {
					$o_temp->setType ( 4 );
					$o_temp->setTerm ( 1 );
				}
				$o_temp->setPercent ( 0 );
				$o_temp->setIsSend ( 0 );
				$o_temp->Save ();
			
			}
			if ($o_system->getNewtermRemind () == 1) {
				//新学期提醒
				$this->SendEmailRemTerm ( $o_user->getUid ( $i ), $o_system );
				//构建导出文件	
				//$this->SetTotalInfo ( $o_user->getCompany ( $i ), $o_user->getName ( $i ), $o_user->getUserName ( $i ), $fp );
			}
		}
		/*if ($o_system->getNewtermRemind () == 1) {
			//保存邮件副本				
			//$o_mailrecord->setUserName ( $s_name );
			$o_date = new DateTime ( 'Asia/Chongqing' );
			//$o_mailrecord->setTitle ( '参加“荷兰旅游专家”' . $o_date->format ( 'Y' ) . '年度提高课程，赢取更多荷兰丰厚奖品！' );
			$s_count = '尊敬的学员' . $this->getContent ();
			$o_edm = new Edm ();
			$o_edm->PushWhere ( array ('&&', 'EdmId', '=', rand ( 1, 5 ) ) );
			$o_edm->PushWhere ( array ('&&', 'State', '=', 1 ) );
			$o_edm->getAllCount ();
			$s_html = $o_edm->getHtml ( 0 );
			$s_title = '您好！&nbsp;&nbsp;&nbsp;&nbsp;“荷兰旅游专家”欢迎您';
			$s_html = str_replace ( "<URL/>", $o_system->getHost (), $s_html ); //替换网址
			$s_html = str_replace ( "<DATE/>", $this->GetDate (), $s_html ); //替换日期
			$s_html = str_replace ( "<EDMID/>", $o_edm->getEdmId ( 0 ), $s_html ); //替换Id
			$s_html = str_replace ( "<CONTENT/>", $s_count, $s_html ); //替换内容
			$s_html = str_replace ( "<TITLE/>", $s_title, $s_html ); //替换标题	
			//$o_mailrecord->setContent ( $s_html );
			//$o_mailrecord->setType ( '所有学员' );
			//$o_mailrecord->Save ();
			//fclose ( $fp );
		}*/
		//清空寄送记录
		$temp=new Mail();
		$temp->ClearData();
		
		//清空邮件记录
		$temp=new Goods_Send();
		$temp->ClearData();
		
		
		//清空学籍记录
		$temp=new User_Study_Chapter();
		$temp->ClearData();
		$temp=new User_Study_Section();
		$temp->ClearData();
		
		$this->N_UserCount=$n_allcount;
		$this->N_Start=$n_start+100;
		return true;
	}
	public function CourseChapterMove($n_type) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Chapter ( $_POST ['Vcl_ChapterId'] );
		$n_old = $o_table->getTermId ();
		$o_table->setTermId ( $_POST ['Vcl_TermId'] );
		$o_table->setNumber ( 1000 );
		$o_table->Save ();
		$this->CourseChapterSortForDelete ( $_POST ['Vcl_TermId'] );
		$this->CourseChapterSortForDelete ( $n_old );
		return true;
	}
	public function CourseChapterCopy($n_type, $n_fromid, $n_toid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_from = new Bank_Chapter ( $n_fromid );
		$o_to = new Bank_Chapter ();
		$o_to->setTermId ( $n_toid );
		$o_to->setNumber ( 1000 );
		$o_to->setName ( $o_from->getName () );
		$o_to->setState ( $o_from->getState () );
		$o_to->setRestudy ( $o_from->getRestudy () );
		$o_to->setSendCredentials ( $o_from->getSendCredentials () );
		$o_to->setCredentialsName ( $o_from->getCredentialsName () );
		$o_to->setContent ( $o_from->getContent () );
		$o_to->Save ();
		//复制下面的所有节
		$o_section = new Bank_Section ();
		$o_section->PushWhere ( array ('&&', 'ChapterId', '=', $o_from->getChapterId () ) );
		$o_section->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$n_count = $o_section->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$this->CourseSectionCopy ( $n_type, $o_section->getSectionId ( $i ), $o_to->getChapterId () );
		}
		//复制图片
		$s_file = substr ( $o_from->getPhoto (), strlen ( $o_from->getPhoto () ) - 4, strlen ( $o_from->getPhoto () ) );
		$o_to->setPhoto ( '/uploaddata/chapterphoto/' . $o_to->getChapterId () . '/photo' . $s_file );
		mkdir ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getChapterId (), 0700 );
		copy ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_from->getChapterId () . '/photo' . $s_file, RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getChapterId () . '/photo' . $s_file ); //将图片拷贝到指定
		//复制图片
		$s_file = substr ( $o_from->getPhotoOff (), strlen ( $o_from->getPhotoOff () ) - 4, strlen ( $o_from->getPhotoOff () ) );
		$o_to->setPhotoOff ( '/uploaddata/chapterphoto/' . $o_to->getChapterId () . '/off' . $s_file );
		mkdir ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getChapterId (), 0700 );
		copy ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_from->getChapterId () . '/off' . $s_file, RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getChapterId () . '/off' . $s_file ); //将图片拷贝到指定
		//复制图片
		$s_file = substr ( $o_from->getPhotoOn (), strlen ( $o_from->getPhotoOn () ) - 4, strlen ( $o_from->getPhotoOn () ) );
		$o_to->setPhotoOn ( '/uploaddata/chapterphoto/' . $o_to->getChapterId () . '/on' . $s_file );
		mkdir ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getChapterId (), 0700 );
		copy ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_from->getChapterId () . '/on' . $s_file, RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getChapterId () . '/on' . $s_file ); //将图片拷贝到指定
		

		$o_to->Save ();
		$this->CourseChapterSortForDelete ( $n_toid ); //排序
		return true;
	}
	public function CourseChapterSetNumber($n_type, $n_chapterid, $n_number) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Chapter ( $n_chapterid );
		$o_table->setNumber ( $n_number );
		$o_table->Save ();
		$this->CourseChapterSort ( $o_table->getChapterId (), $n_number, $o_table->getTermId () ); //排序
		return true;
	}
	private function CourseSectionSortForDelete($n_chapterid) {
		$o_table = new Bank_Section ();
		$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapterid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Bank_Section ( $o_table->getSectionId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	private function CourseSectionSort($n_sectionid, $n_number, $n_chapterid) {
		$o_all = new Bank_Section ();
		$o_all->PushWhere ( array ('&&', 'SectionId', '<>', $n_sectionid ) );
		$o_all->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapterid ) );
		$o_all->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Bank_Section ( $o_all->getSectionId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	public function CourseSectionSetNumber($n_type, $n_sectionid, $n_number) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Section ( $n_sectionid );
		$o_table->setNumber ( $n_number );
		$o_table->Save ();
		$this->CourseSectionSort ( $o_table->getSectionId (), $n_number, $o_table->getChapterId () ); //排序
		return true;
	}
	public function CourseSectionDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_section = new Bank_Section ( $n_id );
		$o_section->setState ( 2 );
		$o_section->Save ();
		$this->CourseSectionSortForDelete ( $o_section->getChapterId () );
		return true;
	}
	public function CourseSectionAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		$o_table = new Bank_Section ();
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setSubjectSum ( $_POST ['Vcl_SubjectSum'] );
		$o_table->setRate ( $_POST ['Vcl_Rate'] );
		$o_table->setTime ( $_POST ['Vcl_Time'] );
		$o_table->setVantage ( $_POST ['Vcl_Vantage'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setChapterId ( $_POST ['Vcl_ChapterId'] );
		$s_key = $_POST ['Vcl_Key'];
		$s_key = str_replace ( "；", ";", $s_key );
		//添加关键字到词库
		$a_key = explode ( ";", $s_key );
		for($i = 0; $i < count ( $a_key ); $i ++) {
			$o_temp = new Bank_Section_Key ();
			$o_temp->PushWhere ( array ('&&', 'Name', '=', $a_key [$i] ) );
			if ($o_temp->getAllCount () == 0) {
				if ($a_key [$i] != '') {
					$o_temp = new Bank_Section_Key ();
					$o_temp->setName ( $a_key [$i] );
					$o_temp->Save ();
				}
			}
		}
		
		if ($a_key [count ( $a_key ) - 1] != '') {
			$s_key = $s_key . ';';
		}
		$o_table->setSKey ( $s_key );
		$o_table->Save ();
		
		$o_table->setPhoto ( '/uploaddata/sectionphoto/' . $o_table->getSectionId () . '/photo.' .$fileext);
		$o_table->Save ();
		mkdir ( RELATIVITY_PATH . 'uploaddata/sectionphoto/' . $o_table->getSectionId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/sectionphoto/' . $o_table->getSectionId () . '/photo.' . $fileext ); //将图片拷贝到指定
		$this->CourseSectionSort ( $o_table->getSectionId (), $_POST ['Vcl_Number'], $o_table->getChapterId () );
		$this->S_ErrorReasion = SysText::Index ( 'Ok_020' );
		return true;
	}
	public function CourseSectionModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Bank_Section ( $_POST ['Vcl_SectionId'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setSubjectSum ( $_POST ['Vcl_SubjectSum'] );
		$o_table->setRate ( $_POST ['Vcl_Rate'] );
		$o_table->setTime ( $_POST ['Vcl_Time'] );
		$o_table->setVantage ( $_POST ['Vcl_Vantage'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$s_key = $_POST ['Vcl_Key'];
		$s_key = str_replace ( "；", ";", $s_key );
		//添加关键字到词库
		$a_key = explode ( ";", $s_key );
		for($i = 0; $i < count ( $a_key ); $i ++) {
			$o_temp = new Bank_Section_Key ();
			$o_temp->PushWhere ( array ('&&', 'Name', '=', $a_key [$i] ) );
			if ($o_temp->getAllCount () == 0) {
				if ($a_key [$i] != '') {
					$o_temp = new Bank_Section_Key ();
					$o_temp->setName ( $a_key [$i] );
					$o_temp->Save ();
				}
			}
		}
		
		if ($a_key [count ( $a_key ) - 1] != '') {
			$s_key = $s_key . ';';
		}
		$o_table->setSKey ( $s_key );
		
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) {
			
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
			mkdir ( RELATIVITY_PATH . 'uploaddata/sectionphoto/' .$_POST ['Vcl_SectionId'], 0700 );
			$o_table->setPhoto ( '/uploaddata/sectionphoto/' . $_POST ['Vcl_SectionId'] . '/photo.' . $fileext );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/sectionphoto/' . $_POST ['Vcl_SectionId'] . '/photo.' . $fileext ); //将图片拷贝到指定
		}
		$o_table->Save ();
		$this->CourseSectionSort ( $o_table->getSectionId (), $_POST ['Vcl_Number'], $o_table->getChapterId () );
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function CourseGetChapter($n_type, $n_termid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Chapter ();
		$o_table->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '<select onChange="courseGetSection(this)" name="Vcl_ChapterId" id="Vcl_ChapterId" class="BigSelect">
						<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<option value="' . $o_table->getChapterId ( $i ) . '">' . $o_table->getName ( $i ) . '</option>
                		';
		}
		$s_html .= '</select>';
		return $s_html;
	}
	public function CourseGetSection($n_type, $n_chapterid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Section ();
		$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $n_chapterid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '<select name="Vcl_SectionId" id="Vcl_SectionId" class="BigSelect">
						<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<option value="' . $o_table->getSectionId ( $i ) . '">' . $o_table->getTitle ( $i ) . '</option>
                		';
		}
		$s_html .= '</select>';
		return $s_html;
	}
	public function CourseSectionMove($n_type) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Section ( $_POST ['Vcl_SectionId'] );
		$n_old = $o_table->getChapterId ();
		$o_table->setChapterId ( $_POST ['Vcl_ChapterId'] );
		$o_table->setNumber ( 1000 );
		$o_table->Save ();
		$this->CourseSectionSortForDelete ( $_POST ['Vcl_ChapterId'] );
		$this->CourseSectionSortForDelete ( $n_old );
		return true;
	}
	public function CourseSectionCopy($n_type, $n_fromid, $n_toid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_from = new Bank_Section ( $n_fromid );
		$o_to = new Bank_Section ();
		$o_to->setNumber ( 1000 );
		$o_to->setKey ( $o_from->getKey () );
		$o_to->setPhoto ( $o_from->getPhoto () );
		$o_to->setContent ( $o_from->getContent () );
		$o_to->setTitle ( $o_from->getTitle () );
		$o_to->setVantage ( $o_from->getVantage () );
		$o_to->setSubjectSum ( $o_from->getSubjectSum () );
		$o_to->setRate ( $o_from->getRate () );
		$o_to->setTime ( $o_from->getTime () );
		$o_to->setState ( $o_from->getState () );
		$o_to->setChapterId ( $n_toid );
		$o_to->Save ();
		//拷贝节下所有题目
		$o_subject = new Bank_Subject ();
		$o_subject->PushWhere ( array ('&&', 'SectionId', '=', $n_fromid ) );
		$n_count = $o_subject->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$this->CourseSubjectCopy ( $n_type, $o_subject->getSubjectId ( $i ), $o_to->getSectionId () );
		}
		//复制图片
		$s_file = substr ( $o_from->getPhoto (), strlen ( $o_from->getPhoto () ) - 4, strlen ( $o_from->getPhoto () ) );
		$o_to->setPhoto ( '/uploaddata/sectionphoto/' . $o_to->getSectionId () . '/photo' . $s_file );
		mkdir ( RELATIVITY_PATH . 'uploaddata/sectionphoto/' . $o_to->getSectionId (), 0700 );
		copy ( RELATIVITY_PATH . 'uploaddata/sectionphoto/' . $o_from->getSectionId () . '/photo' . $s_file, RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_to->getSectionId () . '/photo' . $s_file ); //将图片拷贝到指定
		//新到这里要排序
		$this->CourseSectionSortForDelete ( $n_toid );
		return true;
	}
	public function CourseSubjectAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Bank_Subject ();
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setSectionId ( $_POST ['Vcl_SectionId'] );
		$o_table->Save ();
		$s_right_id = '';
		$s_right = '';
		//建立答案
		$a_option = array ('A', 'B', 'C', 'D', 'E', 'F' );
		for($i = 0; $i < count ( $a_option ); $i ++) {
			if ($_POST ['Vcl_Option_' . $a_option [$i]] == '') {
				break;
			} else {
				$n_option = new Bank_Option ();
				$n_option->setNumber ( $a_option [$i] );
				$n_option->setSubjectId ( $o_table->getSubjectId () );
				$n_option->setText ( $_POST ['Vcl_Option_' . $a_option [$i]] );
				$n_option->Save ();
				if ($_POST ['Vcl_Right_' . $a_option [$i]] == 'on') {
					$s_right_id .= '<1>' . $a_option [$i];
					$s_right .= '<1>' . $n_option->getOptionId ();
				}
			}
		}
		$s_right = substr ( $s_right, 3, strlen ( $s_right ) );
		$s_right_id = substr ( $s_right_id, 3, strlen ( $s_right_id ) );
		$o_table->setRightOptionId ( $s_right );
		$o_table->setRightOption ( $s_right_id );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_021' );
		return true;
	}
	public function CourseSubjectModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Bank_Subject ( $_POST ['Vcl_SubjectId'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$s_right_id = '';
		$s_right = '';
		//删除所有选项
		$n_option = new Bank_Option ();
		$n_option->DeleteOption ( $_POST ['Vcl_SubjectId'] );
		//建立答案
		$a_option = array ('A', 'B', 'C', 'D', 'E', 'F' );
		for($i = 0; $i < count ( $a_option ); $i ++) {
			if ($_POST ['Vcl_Option_' . $a_option [$i]] == '') {
				break;
			} else {
				$n_option = new Bank_Option ();
				$n_option->setNumber ( $a_option [$i] );
				$n_option->setSubjectId ( $_POST ['Vcl_SubjectId'] );
				$n_option->setText ( $_POST ['Vcl_Option_' . $a_option [$i]] );
				$n_option->Save ();
				if ($_POST ['Vcl_Right_' . $a_option [$i]] == 'on') {
					$s_right_id .= '<1>' . $a_option [$i];
					$s_right .= '<1>' . $n_option->getOptionId ();
				}
			}
		}
		$s_right = substr ( $s_right, 3, strlen ( $s_right ) );
		$s_right_id = substr ( $s_right_id, 3, strlen ( $s_right_id ) );
		$o_table->setRightOptionId ( $s_right );
		$o_table->setRightOption ( $s_right_id );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function CourseSubjectDelete($n_type, $id) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Bank_Subject ( $id );
		$o_table->Deletion ();
		$n_option = new Bank_Option ();
		$n_option->DeleteOption ( $id );
		return true;
	}
	public function CourseSubjectMove($n_type) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Subject ( $_POST ['Vcl_SubjectId'] );
		$o_table->setSectionId ( $_POST ['Vcl_SectionId'] );
		$o_table->Save ();
		return true;
	}
	public function CourseSubjectCopy($n_type, $n_fromid, $n_toid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_from = new Bank_Subject ( $n_fromid );
		$o_to = new Bank_Subject ();
		$o_to->setContent ( $o_from->getContent () );
		$o_to->setRightOption ( $o_from->getRightOption () );
		$o_to->setSectionId ( $n_toid );
		$o_to->Save ();
		//复制选项
		$o_temp = new Bank_Option ();
		$o_temp->PushWhere ( array ('&&', 'SubjectId', '=', $n_fromid ) );
		$n_count = $o_temp->getAllCount ();
		$a_temp = explode ( "<1>", $o_from->getRightOptionId () );
		for($i = 0; $i < $n_count; $i ++) {
			if (in_array ( $o_temp->getOptionId ( $i ), $a_temp )) {
				$s_right_id .= '<1>' . $o_from->getRightOptionId ();
			}
			$o_option = new Bank_Option ();
			$o_option->setText ( $o_temp->getText ( $i ) );
			$o_option->setNumber ( $o_temp->getNumber ( $i ) );
			$o_option->setSubjectId ( $o_to->getSubjectId () );
			$o_option->Save ();
		
		}
		$s_right_id = substr ( $s_right_id, 3, strlen ( $s_right_id ) );
		$o_to->setRightOptionId ( $s_right_id );
		$o_to->Save ();
		return true;
	}
	public function GoodsCredentialCheck($n_type, $id) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Goods_Send ( $id );
		$o_table->setState ( 2 );
		$o_table->Save ();
		return true;
	}
	public function GoodsCredentialDelete($n_type, $id) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Goods_Send ( $id );
		//给用户发送邮件
		$o_user = new User ( $o_table->getUid () );
		//发送邮件
		$this->setEdmUser ( $o_user->getUid () );
		$this->setEdmTitle ( '荷兰旅游专家，证书寄未被通过' );
		$this->setEdmFromMail ( 'service@hollandtravelexpert.com' );
		$this->setEdmContent ( ':<br/>&nbsp;&nbsp;&nbsp;&nbsp;您好！对不起，您的证书寄送申请未审核通过，请您登陆系统重新申请！' );
		$this->SendEdm ();
		//$this->JmailSendEmail ( $o_user->getUserName (), '荷兰旅游专家，证书寄未被通过', $o_user->getName () . ':<br/>&nbsp;&nbsp;&nbsp;&nbsp;您好！对不起，您的证书寄送申请未审核通过，请您登陆系统重新申请！' );
		$o_user->setIsSend ( 0 );
		$o_user->Save ();
		$o_table->Deletion ();
		return true;
	}
	public function GoodsCredentialSend($n_type) {
		if (! ($n_type = 1 || $n_type = 2)) {
			//直接退出系统
			return false;
		}
		$o_table = new Goods_Send ( $_POST ['Vcl_Id'] );
		$o_table->setLogistic ( $_POST ['Vcl_Logistic'] );
		$o_table->setOrderNumber ( $_POST ['Vcl_OrderNumber'] );
		$o_table->setState ( 3 );
		$o_table->setSendDate ( $this->GetDateNow () );
		$o_table->Save ();
		$this->SendEmailSendCredential ( $o_table->getUid (), $_POST ['Vcl_Logistic'], $_POST ['Vcl_OrderNumber'], $o_table->getName (), $o_table->getAddress (), $o_table->getPostcod (), $o_table->getPhone () );
		$this->S_ErrorReasion = SysText::Index ( 'Ok_022' );
		return true;
	}
	public function GoodsInformationUseCheck($n_type) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Goods_Send ( $_POST ['Vcl_UseId'] );
		$o_table->setSum ( $_POST ['Vcl_Sum'] );
		$o_table->setState ( 2 );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_023' );
		return true;
	}
	public function GoodsInformationUseDelete($n_type, $id) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Goods_Send ( $id );
		//给用户发送邮件
		$o_user = new User ( $o_table->getUid () );
		$this->setEdmUser ( $o_user->getUid () );
		$this->setEdmTitle ( '荷兰旅游专家，资料申请未被通过' );
		$this->setEdmFromMail ( 'service@hollandtravelexpert.com' );
		$this->setEdmContent ( ':<br/>&nbsp;&nbsp;&nbsp;&nbsp;您好！对不起，您的资料申请未审核通过，请您登陆系统重新申请！' );
		$this->SendEdm ();
		//$this->JmailSendEmail ( $o_user->getUserName (), '荷兰旅游专家，资料申请未被通过', $o_user->getName () . '' );
		$o_table->Deletion ();
		return true;
	}
	public function GoodsInformationUseSend($n_type) {
		if (! ($n_type = 1 || $n_type = 2)) {
			//直接退出系统
			return false;
		}
		$o_table = new Goods_Send ( $_POST ['Vcl_UseId'] );
		$o_table->setLogistic ( $_POST ['Vcl_Logistic'] );
		$o_table->setOrderNumber ( $_POST ['Vcl_OrderNumber'] );
		$o_table->setState ( 3 );
		$o_table->setSendDate ( $this->GetDateNow () );
		$o_table->Save ();
		//发送邮件
		$this->SendEmailSendInfo ( $o_table->getUid (), $_POST ['Vcl_Logistic'], $_POST ['Vcl_OrderNumber'], $o_table->getName (), $o_table->getAddress (), $o_table->getPostcod (), $o_table->getPhone () );
		//
		$this->S_ErrorReasion = SysText::Index ( 'Ok_022' );
		return true;
	}
	public function GoodsPrizeExchangeCheck($n_type, $id) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Goods_Send ( $id );
		$o_table->setState ( 2 );
		$o_table->Save ();
		return true;
	}
	public function GoodsPrizeExchangeSend($n_type) {
		if (! ($n_type = 1 || $n_type = 2)) {
			//直接退出系统
			return false;
		}
		$o_table = new Goods_Send ( $_POST ['Vcl_ExchangeId'] );
		$o_table->setLogistic ( $_POST ['Vcl_Logistic'] );
		$o_table->setOrderNumber ( $_POST ['Vcl_OrderNumber'] );
		$o_table->setState ( 3 );
		$o_table->setSendDate ( $this->GetDateNow () );
		$o_table->Save ();
		//发送邮件
		$this->SendEmailSendPrize ( $o_table->getUid (), $_POST ['Vcl_Logistic'], $_POST ['Vcl_OrderNumber'], $o_table->getName (), $o_table->getAddress (), $o_table->getPostcod (), $o_table->getPhone () );
		//
		$this->S_ErrorReasion = SysText::Index ( 'Ok_022' );
		return true;
	}
	public function GoodsSendStart($n_type) {
		if (! ($n_type = 1 || $n_type = 2)) {
			//直接退出系统
			return false;
		}
		$o_table = new Goods_Send ();
		//$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
		//$o_table->PushWhere ( array ('&&', 'Uid', '=', $_POST ['Vcl_Uid'] ) );
		$o_table->PushWhere ( array ('||', 'State', '=', 2 ) );
		$o_table->PushWhere ( array ('&&', 'Uid', '=', $_POST ['Vcl_Uid'] ) );
		$n_count = $o_table->getAllCount ();
		//检测是否选择了项目
		$s_title_1 = '';
		$s_title_2 = '';
		$s_title_3 = '';
		$s_select = false;
		$b_name = true;
		$s_name = '';
		$s_address = '';
		$s_number = 0;
		for($i = 0; $i < $n_count; $i ++) {
			//查看是否已经选择
			if ($_POST ['Vcl_Id_' . $o_table->getId ( $i )] == "on") {
				$s_select = true;
				if ($s_name == '') {
					$s_name = $o_table->getName ( $i );
				}
				if ($s_address == '') {
					$s_address = $o_table->getAddress ( $i );
				}
				if ($o_table->getAddress ( $i ) != $s_address) {
					$b_name = false;
				}
				if ($o_table->getName ( $i ) != $s_name) {
					$b_name = false;
				}
				$this->N_SendId = $o_table->getId ( $i );
				$s_number = $i;
			}
		}
		
		if ($s_select == false) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_015' );
			return false;
		}
		if ($b_name == false) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_016' );
			return false;
		}
		//开始写入
		for($i = 0; $i < $n_count; $i ++) {
			if ($_POST ['Vcl_Id_' . $o_table->getId ( $i )] == "on") {
				if ($o_table->getType ( $i ) == 1) {
					$s_title_1 = '‘荷兰旅游专家’证书';
				}
				if ($o_table->getType ( $i ) == 2) {
					$s_title_2 = '积分兑换礼品';
				}
				if ($o_table->getType ( $i ) == 3) {
					$s_title_3 = '荷兰旅游宣传资料';
				}
				$o_temp = new Goods_Send ( $o_table->getId ( $i ) );
				$o_temp->setLogistic ( $_POST ['Vcl_Logistic'] );
				$o_temp->setOrderNumber ( $_POST ['Vcl_OrderNumber'] );
				$o_temp->setState ( 3 );
				$o_temp->setSendDate ( $this->GetDateNow () );
				$o_temp->Save ();
			
		//发送邮件	
			}
		}
		if ($s_title_1 != '') {
			$s_title = $s_title . $s_title_1;
		}
		if ($s_title != '' && $s_title_2 != '') {
			$s_title = $s_title . '，' . $s_title_2;
		} else {
			$s_title = $s_title . $s_title_2;
		}
		if ($s_title != '' && $s_title_3 != '') {
			$s_title = $s_title . '，' . $s_title_3;
		} else {
			$s_title = $s_title . $s_title_3;
		}
		$this->SendEmailSend ( $o_table->getUid ( $s_number ), $s_title . '已寄出，请您届时查收', $s_title, $_POST ['Vcl_Logistic'], $_POST ['Vcl_OrderNumber'], $o_table->getName ( $s_number ), $o_table->getAddress ( $s_number ), $o_table->getPostcode ( $s_number ), $o_table->getPhone ( $s_number ) );
		$this->S_ErrorReasion = SysText::Index ( 'Ok_022' );
		return true;
	}
	public function GoodsGetSingleExpert($n_type, $n_termid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Chapter ();
		$o_table->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'SendCredentials', '=', 1 ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '<select name="Vcl_ChapterId" id="Vcl_ChapterId" class="BigSelect">
						<option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<option value="' . $o_table->getChapterId ( $i ) . '">' . $o_table->getCredentialsName ( $i ) . '</option>
                		';
		}
		$s_html .= '</select>';
		return $s_html;
	}
	public function GoodsPrizeAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		//建立文件夹
		$o_table = new Prize ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setExplain ( $this->AilterTextArea ( $_POST ['Vcl_Explain'] ) );
		$o_table->setState ( 1 );
		$o_table->setVantage ( $_POST ['Vcl_Vantage'] );
		$o_table->setIsExpert ( $_POST ['Vcl_IsExpert'] );
		$o_table->setSum ( $_POST ['Vcl_Sum'] );
		$o_table->setRemSum ( $_POST ['Vcl_RemSum'] );
		$o_table->setRemEmail ( $_POST ['Vcl_RemEmail'] );
		if ($_POST ['Vcl_ChapterId'] > 0) {
			$o_table->setChapterId ( $_POST ['Vcl_ChapterId'] );
		}
		$o_table->Save ();
		$o_table->setPhoto ( '/uploaddata/prize/' . $o_table->getPrizeId () . '/photo.' . $fileext );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/prize/' . $o_table->getPrizeId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/prize/' . $o_table->getPrizeId () . '/photo.' . $fileext ); //将图片拷贝到指定
		$this->S_ErrorReasion = SysText::Index ( 'Ok_026' );
		return true;
	}
	public function GoodsPrizeModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Prize ( $_POST ['Vcl_PrizeId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setExplain ( $this->AilterTextArea ( $_POST ['Vcl_Explain'] ) );
		$o_table->setVantage ( $_POST ['Vcl_Vantage'] );
		$o_table->setIsExpert ( $_POST ['Vcl_IsExpert'] );
		$o_table->setSum ( $_POST ['Vcl_Sum'] );
		$o_table->setRemSum ( $_POST ['Vcl_RemSum'] );
		$o_table->setRemEmail ( $_POST ['Vcl_RemEmail'] );
		if ($_POST ['Vcl_ChapterId'] > 0) {
			$o_table->setChapterId ( $_POST ['Vcl_ChapterId'] );
		} else {
			$o_table->setChapterId ( 0 );
		}
		$o_table->Save ();
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table->setPhoto ( '/uploaddata/prize/' . $o_table->getPrizeId () . '/photo.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/prize/' . $o_table->getPrizeId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/prize/' . $o_table->getPrizeId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/prize/' . $o_table->getPrizeId () . '/photo.' . $fileext ); //将图片拷贝到指定
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function GoodsPrizeDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Prize ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/prize/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		return true;
	}
	public function GoodsPrizeState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Prize ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function GoodsInformationAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
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
		//建立文件夹
		$o_table = new Information ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setSum ( $_POST ['Vcl_Sum'] );
		$o_table->setExplain ( $this->AilterTextArea ( $_POST ['Vcl_Explain'] ) );
		$o_table->setState ( 1 );
		$o_table->Save ();
		$o_table->setPhoto ( '/uploaddata/information/' . $o_table->getInformationId () . '/photo.' . $fileext );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/information/' . $o_table->getInformationId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/information/' . $o_table->getInformationId () . '/photo.' . $fileext ); //将图片拷贝到指定
		$this->S_ErrorReasion = SysText::Index ( 'Ok_027' );
		return true;
	}
	public function GoodsInformationModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Information ( $_POST ['Vcl_InformationId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setSum ( $_POST ['Vcl_Sum'] );
		$o_table->setExplain ( $this->AilterTextArea ( $_POST ['Vcl_Explain'] ) );
		$o_table->Save ();
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) { //说明修改图片
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
			$o_table->setPhoto ( '/uploaddata/information/' . $o_table->getInformationId () . '/photo.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/information/' . $o_table->getInformationId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/information/' . $o_table->getInformationId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/information/' . $o_table->getInformationId () . '/photo.' . $fileext ); //将图片拷贝到指定
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function GoodsInformationDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Information ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/information/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		return true;
	}
	public function GoodsInformationState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Information ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function CourseSectionDeleteKey($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Bank_Section_Key ( $n_id );
		$o_table->Deletion ();
		return true;
	}
	public function CourseSearchSubmit($n_type, $s_text, $s_key, $s_termid, $s_chapterid, $s_display) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$s_html = '
		<div class="list out">
		<div class="title">
		<div>搜索结果</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			
		</table>
		</div>		
		';
		$n_total = 0;
		//搜索节
		if ($s_display == '1' || $s_display == '0') {
			//搜索text
			$o_table = new View_Section ();
			if ($s_key != '') {
				$a_key = explode ( ";", $s_key );
			} else {
				$a_key = array ();
			}
			if ($s_text != '') {
				$a_text = explode ( " ", $s_text );
				for($k = 0; $k < count ( $a_text ); $k ++) {
					$o_table->PushWhere ( array ('&&', 'Title', 'LIKE', '%' . $a_text [$k] . '%' ) );
					if ($s_termid > 0) {
						$o_table->PushWhere ( array ('&&', 'TermId', '=', $s_termid ) );
					}
					if ($s_chapterid > 0) {
						$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $s_chapterid ) );
					}
					for($j = 0; $j < (count ( $a_key ) - 1); $j ++) {
						$o_table->PushWhere ( array ('&&', 'SKey', 'LIKE', '%' . $a_key [$j] . '%' ) );
					}
				}
				for($k = 0; $k < count ( $a_text ); $k ++) {
					if ($k == 0) {
						$o_table->PushWhere ( array ('||', 'Content', 'LIKE', '%' . $a_text [$k] . '%' ) );
					} else {
						$o_table->PushWhere ( array ('&&', 'Content', 'LIKE', '%' . $a_text [$k] . '%' ) );
					}
					if ($s_termid > 0) {
						$o_table->PushWhere ( array ('&&', 'TermId', '=', $s_termid ) );
					}
					if ($s_chapterid > 0) {
						$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $s_chapterid ) );
					}
					for($j = 0; $j < (count ( $a_key ) - 1); $j ++) {
						$o_table->PushWhere ( array ('&&', 'SKey', 'LIKE', '%' . $a_key [$j] . '%' ) );
					}
				}
			} else {
				if ($s_termid > 0) {
					$o_table->PushWhere ( array ('&&', 'TermId', '=', $s_termid ) );
				}
				if ($s_chapterid > 0) {
					$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $s_chapterid ) );
				}
				for($j = 0; $j < (count ( $a_key ) - 1); $j ++) {
					$o_table->PushWhere ( array ('&&', 'SKey', 'LIKE', '%' . $a_key [$j] . '%' ) );
				}
			}
			$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
			$o_table->PushOrder ( array ('TermId', 'D' ) );
			$o_table->PushOrder ( array ('ChapterId', 'D' ) );
			$o_table->PushOrder ( array ('SectionId', 'A' ) );
			$n_count = $o_table->getAllCount ();
			$s_tr = '';
			
			for($i = 0; $i < $n_count; $i ++) {
				$s_class = 'bright';
				if (abs ( $n_total % 2 ) == 0) {
					$s_class = 'dark';
				}
				$n_total ++;
				$s_tr .= '			
			<tr class="' . $s_class . '" id="section_' . $o_table->getSectionId ( $i ) . '">
				<td class="operate" style="line-height:1.6;padding:5px">
				<a title="点击后预览" href="../../sub/student/chapter.php?sectionid=' . $o_table->getSectionId ( $i ) . '" target="_blank"><span style="font-size:18px;font-family:微软雅黑;color:#1BAEED">' . $o_table->getTitle ( $i ) . '</span></a>
				<br/>
				<span class="gray">位置：' . $this->DeleteBR ( $o_table->getTerm ( $i ) ) . ' >> ' . $this->DeleteBR ( $o_table->getChapter ( $i ) ) . '</span>
				<br/>
				<span class="gray">奖励积分：' . $o_table->getVantage ( $i ) . ' 分</span>
				<br/>
				' . $this->CutStr ( $o_table->getContent ( $i ), 400 ) . '
				<br/>
					<div title="删除" class="delete" onclick="courseSectionDeleteForSearch(' . $o_table->getSectionId ( $i ) . ')">
                    </div>
                    <div title="修改" class="modify" onclick="window.open(\'course_search_modify.php?url=' . rawurlencode ( 'course_section_modify.php?sectionid=' . $o_table->getSectionId ( $i ) . '&search=true' ) . '\',\'_blank\')">
                    </div>
                    <div title="复制" class="copy" onclick="Dialog_Iframe(\'dialog/course_section_copy.php?sectionid=' . $o_table->getSectionId ( $i ) . '&search=true\',300,170,\'\',this)">
                    </div>
                    <div title="移动" class="move" onclick="Dialog_Iframe(\'dialog/course_section_move.php?sectionid=' . $o_table->getSectionId ( $i ) . '&search=true\',300,170,\'\',this)">
                    </div>
				</td>
			</tr>
			';
			}
		}
		//搜索题
		if ($s_display == '2' || $s_display == '0') {
			//搜索text
			$o_table = new View_Subject ();
			if ($s_key != '') {
				$a_key = explode ( ";", $s_key );
			} else {
				$a_key = array ();
			}
			if ($s_text != '') {
				$a_text = explode ( " ", $s_text );
				for($k = 0; $k < count ( $a_text ); $k ++) {
					if ($k == 0) {
						$o_table->PushWhere ( array ('||', 'Content', 'LIKE', '%' . $a_text [$k] . '%' ) );
					} else {
						$o_table->PushWhere ( array ('&&', 'Content', 'LIKE', '%' . $a_text [$k] . '%' ) );
					}
					if ($s_termid > 0) {
						$o_table->PushWhere ( array ('&&', 'TermId', '=', $s_termid ) );
					}
					if ($s_chapterid > 0) {
						$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $s_chapterid ) );
					}
					for($j = 0; $j < (count ( $a_key ) - 1); $j ++) {
						$o_table->PushWhere ( array ('&&', 'SKey', 'LIKE', '%' . $a_key [$j] . '%' ) );
					}
				}
			} else {
				if ($s_termid > 0) {
					$o_table->PushWhere ( array ('&&', 'TermId', '=', $s_termid ) );
				}
				if ($s_chapterid > 0) {
					$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $s_chapterid ) );
				}
				for($j = 0; $j < (count ( $a_key ) - 1); $j ++) {
					$o_table->PushWhere ( array ('&&', 'SKey', 'LIKE', '%' . $a_key [$j] . '%' ) );
				}
			}
			$o_table->PushOrder ( array ('TermId', 'D' ) );
			$o_table->PushOrder ( array ('ChapterId', 'D' ) );
			$o_table->PushOrder ( array ('SectionId', 'A' ) );
			$o_table->PushOrder ( array ('SubjectId', 'A' ) );
			$n_count = $o_table->getAllCount ();
			
			for($i = 0; $i < $n_count; $i ++) {
				$s_class = 'bright';
				if (abs ( $n_total % 2 ) == 0) {
					$s_class = 'dark';
				}
				$n_total ++;
				$s_tr .= '			
			<tr class="' . $s_class . '" id="subject_' . $o_table->getSubjectId ( $i ) . '">
				<td class="operate" style="line-height:1.6;padding:5px">
				<span style="font-size:14px;font-family:微软雅黑;color:#1BAEED">' . $this->CutStr ( $o_table->getContent ( $i ), 400 ) . '</span>
				<br/>
				<span class="gray">位置：' . $this->DeleteBR ( $o_table->getTerm ( $i ) ) . ' >> ' . $this->DeleteBR ( $o_table->getChapter ( $i ) ) . ' >> ' . $this->DeleteBR ( $o_table->getSection ( $i ) ) . '</span>
				<br/>				
				<span class="gray">答案：' . str_replace ( "<1>", ' ', $o_table->getRightOption ( $i ) ) . '</span>
				<br/>
					<div title="删除" class="delete" onclick="courseSubjcetDeleteForSearch(' . $o_table->getSubjectId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="window.open(\'course_search_modify.php?url=' . rawurlencode ( 'course_subject_modify.php?subjectid=' . $o_table->getSubjectId ( $i ) . '&search=true' ) . '\',\'_blank\')">
                                    </div>
                                    <div title="复制" class="copy" onclick="Dialog_Iframe(\'dialog/course_subject_copy.php?subjectid=' . $o_table->getSubjectId ( $i ) . '&search=true\',300,205,\'\',this)">
                                    </div>
                                    <div title="移动" class="move" onclick="Dialog_Iframe(\'dialog/course_subject_move.php?subjectid=' . $o_table->getSubjectId ( $i ) . '&search=true\',300,205,\'\',this)">
                                    </div>
				</td>
			</tr>
			';
			}
		}
		$s_html = '
		<div class="list out">
		<div class="title">
		<div>搜索结果：共 <span id="total">' . $n_total . '</span> 个</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			' . $s_tr . '
		</table>
		</div>		
		';
		return $s_html;
	}
	public function DeleteBR($str) {
		$str = str_replace ( "<BR/>", '', $str );
		$str = str_replace ( "<br/>", '', $str );
		$str = str_replace ( "<BR />", '', $str );
		$str = str_replace ( "<br />", '', $str );
		$str = str_replace ( "<br>", '', $str );
		$str = str_replace ( "<BR>", '', $str );
		return $str;
	}
	public function CutStr($string, $length) {
		preg_match_all ( "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info );
		for($i = 0; $i < count ( $info [0] ); $i ++) {
			$wordscut .= $info [0] [$i];
			$j = ord ( $info [0] [$i] ) > 127 ? $j + 2 : $j + 1;
			if ($j > $length - 3) {
				return $wordscut . "...";
			}
		}
		return join ( '', $info [0] );
	}
	public function SendEmailToSleep() {
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Type', '==', 5 ) );
		$o_user->PushWhere ( array ('&&', 'State', '=', 1 ) ); //状态必须为激活状态
		$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) ); //必须为审核通过
		$n_user = $o_user->getAllCount ();
		$o_system = new System ( 1 );
		$b_send = $o_system->getSleepRemind (); //读取系统设置的是否给睡眠用户发邮件
		$n_day = $o_system->getIsSleep (); //读取多久未登录为睡眠户
		$n_day = $n_day * 3600 * 24; //天数乘以3600*24
		$n_day = $this->GetTimeCut () - $n_day; //当前时间，减去计算的天数，如果用户最后登录时间小于这个时间，说明是睡眠户。
		$o_user = new View_User ();
		$o_user->PushWhere ( array ('&&', 'LastTime', '<=', $n_day ) );
		$o_user->PushWhere ( array ('&&', 'Type', '<>', 1 ) ); //必须为学员
		$o_user->PushWhere ( array ('&&', 'Type', '<>', 2 ) ); //必须为学员
		$o_user->PushWhere ( array ('&&', 'Type', '<>', 5 ) ); //必须为学员
		$o_user->PushWhere ( array ('&&', 'IsSleep', '=', 0 ) ); //必须为未睡眠的用户，不要多次提醒
		$o_user->PushWhere ( array ('&&', 'State', '=', 1 ) ); //状态必须为激活状态
		$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) ); //必须为审核通过
		$n_count = $o_user->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			//开始设置该用户为睡眠户
			$o_user_temp = new User ( $o_user->getUid ( $i ) );
			$o_user_temp->setIsSleep ( 1 );
			$o_user_temp->Save ();
			if ($b_send == 1) {
				//发送邮件提醒到用户邮箱 
				$this->SendEmailRemSleep ( $o_user->getUid ( $i ), $o_system, $o_user_temp->getPercent (), $n_user );
			}
		}
		//清楚未验证的用户
		$n_day = 3 * 3600 * 24; //天数乘以3600*24
		$n_day = $this->GetTimeCut () - $n_day;
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'ActivationCode', '<>', '' ) );
		$n_count = $o_user->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_user2 = new User_Login ();
			$o_user2->PushWhere ( array ('&&', 'LoginTime', '<=', $n_day ) );
			$o_user2->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid ( $i ) ) );
			if ($o_user2->getAllCount () > 0) {
				//删除用户
				$this->StudentDelete ( 1, $o_user->getUid ( $i ) );
			}
		}
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		$o_user->PushWhere ( array ('&&', 'State', '=', 1 ) ); //状态必须为激活状态
		$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) ); //必须为审核通过
		$o_user->PushWhere ( array ('&&', 'ActivationCode', '=', '' ) );
		$n_user1 = $o_user->getAllCount ();
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Type', '=', 5 ) );
		$o_user->PushWhere ( array ('&&', 'State', '=', 1 ) ); //状态必须为激活状态
		$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) ); //必须为审核通过
		$o_user->PushWhere ( array ('&&', 'ActivationCode', '=', '' ) );
		$n_user2 = $o_user->getAllCount ();
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Type', '=', 4 ) );
		$o_user->PushWhere ( array ('&&', 'State', '=', 1 ) ); //状态必须为激活状态
		$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) ); //必须为审核通过
		$o_user->PushWhere ( array ('&&', 'ActivationCode', '=', '' ) );
		$n_user3 = $o_user->getAllCount ();
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'IsSleep', '=', 1 ) );
		$n_user4 = $o_user->getAllCount ();
		//校验
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Percent', '>', 100 ) );
		$n_count = $o_user->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_user2 = new User ( $o_user->getUid ( $i ) );
			$o_user2->setType ( 5 );
			$o_user2->setPercent ( 100 );
			$o_user2->Save ();
		}
		$o_user = new User ();
		$o_user->PushWhere ( array ('&&', 'Type', '=', 5 ) );
		$o_user->PushWhere ( array ('&&', 'Percent', '<', 100 ) );
		$n_count = $o_user->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_user2 = new User ( $o_user->getUid ( $i ) );
			$o_user2->setPercent ( 100 );
			$o_user2->Save ();
		}
		$o_user = new User_Study_Chapter ();
		$o_user->PushWhere ( array ('&&', 'Percent', '>', 100 ) );
		$n_count = $o_user->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_user2 = new User_Study_Chapter ( $o_user->getStudyId ( $i ) );
			$o_user2->setPercent ( 100 );
			$o_user2->Save ();
		}
		return $this->GetDateNow () . '，学员总数：' . $n_user1 . '，本年专家：' . $n_user2 . '，往年专家：' . $n_user3 . '，睡眠户：' . $n_user4;
	}
	public function CourseChangeType($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Travel_Title ();
		$o_table->PushWhere ( array ('&&', 'TypeId', '=', $n_id ) );
		$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_table->PushOrder ( array ('TypeId', 'A' ) );
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$s_html = '';
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_html.='<option value="' . $o_table->getTitleId($i) . '">' . $o_table->getName($i) . '</option>';				
		}
		return '<select class="BigSelect" name="Vcl_TitleId" id="Vcl_TitleId">
				<option value="0"></option>'.$s_html.'</select> <span class="red">*</span>';
	}
	public function CourseChapterInput($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//行程标题转章
		$o_title=new Travel_Title($_POST ['Vcl_TitleId']);
		$o_table = new Bank_Chapter ();
		$o_table->setName ( $o_title->getName() );
		$o_table->setTermId ( $_POST ['Vcl_TermId'] );
		$o_table->setState ( 1 );
		$o_table->setRestudy ( $_POST ['Vcl_Restudy'] );
		$o_table->setSendCredentials ( $_POST ['Vcl_SendCredentials'] );
		$o_table->setCredentialsName ( $_POST ['Vcl_CredentialsName'] );
		$o_table->setContent ( $o_title->getExplain() );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		$s_temp1=$o_title->getPhotoOn();
		$s_temp1=strtolower ( trim ( substr ( strrchr ( $s_temp1, '.' ), 1 ) ) );
		$o_table->setPhotoOn ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/on.' . $s_temp1 );
		$o_table->setPhotoOff ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/off.jpg' );
		$s_temp2=$o_title->getPhoto();
		$s_temp2=strtolower ( trim ( substr ( strrchr ( $s_temp2, '.' ), 1 ) ) );
		$o_table->setPhoto ( '/uploaddata/chapterphoto/' . $o_table->getChapterId () . '/photo.' . $s_temp2 );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId (), 0700 );
		//复制图片
		copy ( RELATIVITY_PATH . 'uploaddata/library/travel/' . $o_title->getTitleId () . '/on.' . $s_temp1, RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId () . '/on.' . $s_temp1 ); //将图片拷贝到指定
		copy ( RELATIVITY_PATH . 'sub/ucenter/images/off.jpg', RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId () . '/off.jpg' ); //将图片拷贝到指定
		copy ( RELATIVITY_PATH . 'uploaddata/library/travel/' . $o_title->getTitleId () . '/photo.' . $s_temp2, RELATIVITY_PATH . 'uploaddata/chapterphoto/' . $o_table->getChapterId () . '/photo.' .$s_temp2); //将图片拷贝到指定
		$this->CourseChapterSort ( $o_table->getChapterId (), $_POST ['Vcl_Number'], $o_table->getTermId () ); //排序
		//分站转节
		$o_item=new Travel_Item();
		$o_item->PushWhere ( array ('&&', 'TitleId', '=', $o_title->getTitleId () ) );
		$o_item->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_item->PushOrder ( array ('Number', 'A' ) );
		$n_count=$o_item->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			$s_timetype = '';
			$s_content='';
			$s_content.='<div style="margin-top: 5px; font-size: 24px; font-weight: bold;text-align:center;font-family:微软雅黑,microsoft yahei">' . $o_item->getName ( $i ) . '</div>';
			$o_detail = new Travel_Detail ();
			$o_detail->PushWhere ( array ('&&', 'ItemId', '=', $o_item->getItemId ( $i ) ) );
			$o_detail->PushOrder ( array ('StartHour', 'A' ) );
			$n_count_detail = $o_detail->getAllCount ();
			$number=1;
			for($j = 0; $j < $n_count_detail; $j ++) {
				
				$s_this = $this->getTimeType ( $o_detail->getStartHour ( $j ), $o_detail->getEndHour ( $j ) );
				//为了不重复显示时间类型
				if ($s_this == $s_timetype) {
					$s_this = '';
					$number++;
				} else {
					$s_timetype = $s_this;
					$number=1;
				}
				if ($o_detail->getRegionId ( $j ) == 0) {
					$s_content.='
					<div style="margin-top: 20px; margin-left: 20px; font-size: 20px; font-weight: bold;font-family:微软雅黑, simhei;">' . $s_this . '</div>
					<div style="margin-top: 20px; margin-left: 60px;font-size: 18px;font-family:微软雅黑, simhei;">' . $o_detail->getExplain ( $j ) . '</div>
					';
				} else {
					$o_region = new View_Library_Region ( $o_detail->getRegionId ( $j ) );
					$s_content.='<div style="margin-top: 20px; margin-left: 20px; font-size: 20px; font-weight: bold;font-family:微软雅黑, simhei;">' . $s_this . '</div>';
					$s_content.='<div style="margin-top: 20px; margin-left: 60px; font-size: 20px; font-weight: bold;font-family:微软雅黑, simhei;">'.$number.'. ' . $o_region->getCityName () . '-' . $o_region->getName () . '</div>';
					$s_content.='<div style="margin-top: 10px; margin-left: 80px;font-family:微软雅黑, simhei;">';
					//图片
					$o_photo = new Library_Region_Photo ();
					$o_photo->PushWhere ( array ('&&', 'RegionId', '=', $o_detail->getRegionId ( $j )) );
					$o_photo->PushOrder ( array ('Id', 'A' ) );
					$n_count_photo = $o_photo->getAllCount ();
					$html = '';
					for($k = 0; $k < $n_count_photo; $k ++) {
						$s_content.='<div style="margin-top:5px;"><img width="535" height="286" src="../../' .$o_photo->getImage ( $k ) . '"/></div>';
					}
					$s_content.='<div style="width:535px;margin-top:10px;font-family:微软雅黑, simhei;">' . $o_region->getContent () . '	</div>';
					$s_content.='
							<div style="margin-top: 10px;font-size: 16px;font-family:微软雅黑, simhei;"><strong>地址：</strong>' . $o_region->getStreet () . '' . $o_region->getAddress () . ' ' . $o_region->getZip () . '</div>
							<div style="margin-top: 10px;font-size: 16px;font-family:微软雅黑, simhei;"><strong>网址：</strong>' . $o_region->getWeb () . '</div>
							<div style="margin-top: 10px;font-size: 16px;font-family:微软雅黑, simhei;"><strong>电话：</strong>' . $o_region->getTel () . '</div>
					';
					$s_content.='<div style="margin-top: 20px;font-size: 16px;font-family:微软雅黑, simhei;"><strong>相关说明</strong></div>';
					$s_content.='<div style="margin-top: 5px; margin-left: 20px;font-size: 16px;font-family:微软雅黑, simhei;">' . $o_detail->getExplain ( $j ) . '</div>';
					$s_content.='</div>';
				}
			}
			//开始保存
			$o_section=new Bank_Section();
			$o_section->setTitle ($o_item->getName($i));
			$o_section->setNumber ($o_item->getNumber($i));
			$o_section->setSubjectSum ( 0 );
			$o_section->setRate (100);
			$o_section->setTime (60);
			$o_section->setVantage (0);
			$o_section->setContent ('<p style="font-family:微软雅黑, simhei;font-size:14px;">'.$s_content.'</p>');
			$o_section->setChapterId ( $o_table->getChapterId () );
			$o_section->setSKey ('');
			$o_section->Save ();
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_038' );
		return true;
	}
	private function getTimeType($start, $end) {
		if (intval ( $end ) <= 9) {
			return '早餐：';
		}
		if (intval ( $start ) >= 9 && intval ( $end ) <= 12) {
			return '上午：';
		}
		if (intval ( $start ) >= 12 && intval ( $end ) <= 14) {
			return '午餐：';
		}
		if (intval ( $start ) >= 14 && intval ( $end ) <= 18) {
			return '下午：';
		}
		if (intval ( $start ) >= 18 && intval ( $end ) <= 20) {
			return '晚餐：';
		}
		if (intval ( $start ) >= 20) {
			return '晚上：';
		}
		return '';
	}	
}
?>