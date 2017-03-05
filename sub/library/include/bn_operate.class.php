<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class Operate extends Bn_Basic {
	private $N_SendId;
	
	public function __construct() {
		$this->Result = TRUE;
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
	
	public function CityDelete($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new Library_City ( $n_uid );
		$o_user->Deletion ();
		return true;
	}
	public function HotelDelete($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new Library_Hotel ( $n_uid );
		$o_user->Deletion ();
		return true;
	}
	public function RegionDelete($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new Library_Region ( $n_uid );
		$o_user->Deletion ();
		//删除word
		unlink(RELATIVITY_PATH . 'uploaddata/library/region/'.$n_uid.'.docx');
		return true;
	}
	public function CityAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_City ();
		$o_table->PushWhere ( array ('&&', 'Name', '=', $_POST ['Vcl_Name'] ) );
		if ($o_table->getAllCount () > 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_017' );
			return FALSE;
		}
		$o_table = new Library_City ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ('Ok_029');
		return true;
	}
	public function HotelAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_Hotel ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setCityId ( $_POST ['Vcl_CityId'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setPrice ( $_POST ['Vcl_Price'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_030' );
		return true;
	}
	public function RegionTypeAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_Region_Type ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		if($_POST ['Vcl_Name']!='')
		{
			$o_table->Save ();
		}
		
		return true;
	}
	public function RegionAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_Region ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setCityId ( $_POST ['Vcl_CityId'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setAddress ( $_POST ['Vcl_Address'] );
		$o_table->setPrice ( $_POST ['Vcl_Price'] );
		$o_table->setStreet ( $_POST ['Vcl_Street'] );
		$o_table->setZip ( $_POST ['Vcl_Zip'] );
		$o_table->setWeb ( $_POST ['Vcl_Web'] );
		$o_table->setTel ( $_POST ['Vcl_Tel'] );
		$o_table->setTypeId ( $_POST ['Vcl_TypeId'] );
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
		$this->S_ErrorReasion = SysText::Index ( 'Ok_031' );
		$html = $_POST ['Vcl_Content'];
		$html = str_replace ( "sub/library/editor/php/../../../../", '', $html );
		/*//转换为Word文档
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/phpword/PHPWord.php';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/simplehtmldom/simple_html_dom.php';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/htmltodocx_converter/h2d_htmlconverter.php';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/example_files/styles.inc';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/documentation/support_functions.inc';
		$this->S_ErrorReasion = SysText::Index ( 'Ok_031' );
		$html = $_POST ['Vcl_Content'];
		$html = str_replace ( "sub/library/editor/php/../../../../", '', $html );
		$phpword_object = new PHPWord ();
		$section = $phpword_object->createSection ();
		$html_dom = new simple_html_dom ();
		$html_dom->load ( '<html><body>' . $html . '</body></html>' );
		$html_dom_array = $html_dom->find ( 'html', 0 )->children ();
		$paths = htmltodocx_paths ();
		$initial_state = array (
		'phpword_object' => &$phpword_object, 
		'base_root' => $paths ['base_root'], 'base_path' => $paths ['base_path'],
		'current_style' => array ('size' => '12' ), 
		'parents' => array (0 => 'body' ), 
		'list_depth' => 0,
		'context' => 'section',
		'pseudo_list' => TRUE,
		'pseudo_list_indicator_font_name' => 'Wingdings',
		'pseudo_list_indicator_font_size' => '7', 
		'pseudo_list_indicator_character' => 'l ',
		'table_allowed' => TRUE, 
		'treat_div_as_paragraph' => TRUE, 
		'style_sheet' => htmltodocx_styles_example () );
		htmltodocx_insert_html ( $section, $html_dom_array [0]->nodes, $initial_state );
		$html_dom->clear ();
		unset ( $html_dom );
		$objWriter = PHPWord_IOFactory::createWriter ( $phpword_object, 'Word2007' );
		$objWriter->save ( RELATIVITY_PATH . 'uploaddata/library/region/'.$o_table->getRegionId().'.docx' );*/
		//发送邮件
		$s_title='荷兰魅力之旅-'.$_POST ['Vcl_Name'];
		$o_system = new System ( 1 );
		$s_count = str_replace ( "/sub/ucenter/editor/php/../../../..", '', $html );
		$s_count = str_replace ( "/uploaddata/", $o_system->getHost () . 'uploaddata/', $s_count ); //替换网址
		$o_edm = new Edm ();
		$o_edm->PushWhere ( array ('&&', 'EdmId', '=', rand ( 1, 5 ) ) );
		$o_edm->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_edm->getAllCount ();
		$s_html = $o_edm->getHtml ( 0 );
		$s_title2 = '您好！&nbsp;&nbsp;&nbsp;&nbsp;“荷兰旅游专家”欢迎您';
		//$s_count = '尊敬的用户您好：' . $s_count;
		$s_html = str_replace ( "<URL/>", $o_system->getHost (), $s_html ); //替换网址
		$s_html = str_replace ( "<DATE/>", $this->GetDate (), $s_html ); //替换日期
		$s_html = str_replace ( "<EDMID/>", $o_edm->getEdmId ( 0 ), $s_html ); //替换Id
		$s_html = str_replace ( "<CONTENT/>", $s_count, $s_html ); //替换内容
		$s_html = str_replace ( "<TITLE/>", $s_title2, $s_html ); //替换标题	
		//发送收件群组
		$o_user = new User ();		
		if ($_POST['e-learning']=='on')
		{
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		if ($_POST['media']=='on')
		{
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		if ($_POST['travel']=='on')
		{
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
		}
		//发送特定人
		if ( $_POST ['visitor']=='on')
		{
			$o_visitro=new Travel_Visitor();
			$o_visitro->PushWhere ( array ('&&', 'TitleId', '=',  ) );
			$a_mail=explode ( ";", $_POST ['Vcl_Receiver'] );
			for($i = 0; $i < count($a_mail); $i ++) {
				//发送邮件
				$this->setEdmUser ( 0 );
				$this->setEdmEmail($a_mail[$i]);
				$this->setEdmTitle ( $s_title );
				$this->setEdmFromMail ( 'admin@hollandtravelexpert.com' );
				$this->setEdmContent ( ':<br/>' . $s_count );
				$this->SendEdm ();
				//构建导出文件	
			}
		}
		return true;
	}
	public function RegionPhotoAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$a_ext = array ();
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
			if ($_FILES ['Vcl_Upload'] ['size'] > 1024 * 1024*2) {
				$this->S_ErrorReasion = SysText::Index ( 'Error_008' );
				return false;
			}
		$o_table = new Library_Region_Photo ();
		$o_table->setRegionId ( $_POST ['Vcl_RegionId'] );
		$o_table->Save ();
		$o_table->setImage ( 'uploaddata/library/region/' . $o_table->getId () . '.' .$fileext );
		$o_table->setIcon ( 'uploaddata/library/region/' . $o_table->getId () . '_min.' .$fileext );
		$o_table->Save ();
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/library/region/' . $o_table->getId () . '.' .$fileext  ); //将图片拷贝到指定
		$this->img2thumb(RELATIVITY_PATH . 'uploaddata/library/region/' . $o_table->getId () . '.' .$fileext, RELATIVITY_PATH . 'uploaddata/library/region/' . $o_table->getId () . '_min.' .$fileext,150,107,1,0);
		$this->S_ErrorReasion = SysText::Index ( 'Ok_036' );
		return true;
		
	}
	public function CityModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_City ();
		$o_table->PushWhere ( array ('&&', 'Name', '=', $_POST ['Vcl_Name'] ) );
		$o_table->PushWhere ( array ('&&', 'CityId', '<>', $_POST ['Vcl_CityId'] ) );
		if ($o_table->getAllCount () > 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_017' );
			return FALSE;
		}
		$o_table = new Library_City ( $_POST ['Vcl_CityId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function HotelModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_Hotel ( $_POST ['Vcl_HotelId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setCityId ( $_POST ['Vcl_CityId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setPrice ( $_POST ['Vcl_Price'] );
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function RegionModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Library_Region ( $_POST ['Vcl_RegionId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setCityId ( $_POST ['Vcl_CityId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setContent ( $_POST ['Vcl_Content'] );
		$o_table->setPrice ( $_POST ['Vcl_Price'] );
		$o_table->setStreet ( $_POST ['Vcl_Street'] );
		$o_table->setAddress ( $_POST ['Vcl_Address'] );
		$o_table->setZip ( $_POST ['Vcl_Zip'] );
		$o_table->setWeb ( $_POST ['Vcl_Web'] );
		$o_table->setTel ( $_POST ['Vcl_Tel'] );
		$o_table->setTypeId ( $_POST ['Vcl_TypeId'] );;
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
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		$html = $_POST ['Vcl_Content'];
		$html = str_replace ( "sub/library/editor/php/../../../../", '', $html );
		/*//转换为Word文档
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/phpword/PHPWord.php';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/simplehtmldom/simple_html_dom.php';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/htmltodocx_converter/h2d_htmlconverter.php';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/example_files/styles.inc';
		require_once RELATIVITY_PATH . 'sub/library/php_htmlword/documentation/support_functions.inc';
		
		
		$phpword_object = new PHPWord ();
		$section = $phpword_object->createSection ();
		$html_dom = new simple_html_dom ();
		$html_dom->load ( '<html><body>' . $html . '</body></html>' );
		$html_dom_array = $html_dom->find ( 'html', 0 )->children ();
		$paths = htmltodocx_paths ();
		$initial_state = array (
		'phpword_object' => &$phpword_object, 
		'base_root' => $paths ['base_root'], 'base_path' => $paths ['base_path'],
		'current_style' => array ('size' => '12' ), 
		'parents' => array (0 => 'body' ), 
		'list_depth' => 0,
		'context' => 'section',
		'pseudo_list' => TRUE,
		'pseudo_list_indicator_font_name' => 'Wingdings',
		'pseudo_list_indicator_font_size' => '7', 
		'pseudo_list_indicator_character' => 'l ',
		'table_allowed' => TRUE, 
		'treat_div_as_paragraph' => TRUE, 
		'style_sheet' => htmltodocx_styles_example () );
		htmltodocx_insert_html ( $section, $html_dom_array [0]->nodes, $initial_state );
		$html_dom->clear ();
		unset ( $html_dom );
		$objWriter = PHPWord_IOFactory::createWriter ( $phpword_object, 'Word2007' );
		$objWriter->save ( RELATIVITY_PATH . 'uploaddata/library/region/'.$o_table->getRegionId().'.docx' );*/
		//发送邮件
		$s_title='荷兰魅力之旅-'.$_POST ['Vcl_Name'];
		$o_system = new System ( 1 );
		$s_count = str_replace ( "/sub/ucenter/editor/php/../../../..", '', $html );
		$s_count = str_replace ( "/uploaddata/", $o_system->getHost () . 'uploaddata/', $s_count ); //替换网址
		$o_edm = new Edm ();
		$o_edm->PushWhere ( array ('&&', 'EdmId', '=', rand ( 1, 5 ) ) );
		$o_edm->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_edm->getAllCount ();
		$s_html = $o_edm->getHtml ( 0 );
		$s_title2 = '您好！&nbsp;&nbsp;&nbsp;&nbsp;“荷兰旅游专家”欢迎您';
		//$s_count = '尊敬的用户您好：' . $s_count;
		$s_html = str_replace ( "<URL/>", $o_system->getHost (), $s_html ); //替换网址
		$s_html = str_replace ( "<DATE/>", $this->GetDate (), $s_html ); //替换日期
		$s_html = str_replace ( "<EDMID/>", $o_edm->getEdmId ( 0 ), $s_html ); //替换Id
		$s_html = str_replace ( "<CONTENT/>", $s_count, $s_html ); //替换内容
		$s_html = str_replace ( "<TITLE/>", $s_title2, $s_html ); //替换标题	
		//发送收件群组
		$o_user = new User ();		
		if ($_POST['e-learning']=='on')
		{
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		if ($_POST['media']=='on')
		{
			$o_user->PushWhere ( array ('||', 'Checked', '=', 1 ) );
			$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		if ($_POST['travel']=='on')
		{
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
		}
		//发送特定人
		/*if ( $_POST ['visitor']=='on')
		{
			$o_visitor=new Travel_Visitor();
			$o_visitor->PushWhere ( array ('&&', 'TitleId', '=',$o_table->getRegionId()  ) );
			$n_count=$o_visitor->getAllCount();
			for($i = 0; $i < $n_count; $i ++) {
				//发送邮件
				$this->setEdmUser ( 0 );
				$this->setEdmEmail($o_visitor->getEmail($i));
				$this->setEdmTitle ( $s_title );
				$this->setEdmFromMail ( 'admin@hollandtravelexpert.com' );
				$this->setEdmContent ( ':<br/>' . $s_count );
				$this->SendEdm ();
				//构建导出文件	
			}
		}*/
		return true;
	}
	public function TravelTitleAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$a_ext = array ();
		for($i = 1; $i < 2; $i ++) {
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
		$o_table = new Travel_Title ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setDate ( $_POST ['Vcl_Date'] );
		$o_table->setTypeId ( $_POST ['Vcl_TypeId'] );
		$o_table->setState ( 1 );
		$o_table->setExplain ( $_POST ['Vcl_Content'] );
		$o_table->Save ();
		$o_table->setPhotoOn ( '/uploaddata/library/travel/' . $o_table->getTitleId () . '/on' . $a_ext [0] );
		$o_table->setPhoto ( '/uploaddata/library/travel/' . $o_table->getTitleId () . '/photo' . $a_ext [1] );
		$o_table->Save ();
		mkdir ( RELATIVITY_PATH . 'uploaddata/library/travel/' . $o_table->getTitleId (), 0700 );
		copy ( $_FILES ['Vcl_Upload1'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/library/travel/' . $o_table->getTitleId () . '/on' . $a_ext [0] ); //将图片拷贝到指定
		copy ( $_FILES ['Vcl_Upload2'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/library/travel/' . $o_table->getTitleId () . '/photo' . $a_ext [1] ); //将图片拷贝到指定
		$this->S_ErrorReasion = SysText::Index ( 'Ok_032' );
		return true;
	}
	public function RegionPhotoDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_term = new Library_Region_Photo ( $n_id );
		//unlink ( RELATIVITY_PATH . $o_term->getImage() );//先不删除，为了防止导入到专家后用
		unlink ( RELATIVITY_PATH . $o_term->getIcon() );
		$o_term->Deletion();
		return true;
	}
	public function TravelTitleDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_term = new Travel_Title ( $n_id );
		$o_term->setState(0);
		$o_term->Save();
		$o_visitor = new Travel_Visitor ();
		$o_visitor->DeleteVisitor ( $n_id );
		return true;
	}
	public function TravelTitleModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Travel_Title ( $_POST ['Vcl_TitleId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setTypeId ( $_POST ['Vcl_TypeId'] );
		$o_table->setDate ( $_POST ['Vcl_Date'] );
		$o_table->setExplain ( $_POST ['Vcl_Content'] );
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
			$o_table->setPhotoOn ( '/uploaddata/library/travel/' . $_POST ['Vcl_TitleId'] . '/on.' . $fileext );
			copy ( $_FILES ['Vcl_Upload1'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/library/travel/' . $_POST ['Vcl_TitleId'] . '/on.' . $fileext ); //将图片拷贝到指定
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
			$o_table->setPhoto ( '/uploaddata/library/travel/' . $_POST ['Vcl_TitleId'] . '/photo.' . $fileext );
			copy ( $_FILES ['Vcl_Upload2'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/library/travel/' . $_POST ['Vcl_TitleId'] . '/photo.' . $fileext ); //将图片拷贝到指定
		}
		$o_table->Save ();
		
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function TravelGetNav2($n_type, $n_termid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Travel_Item ();
		$o_table->PushWhere ( array ('&&', 'TitleId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<table border="0" cellpadding="0" cellspacing="0">
            			<tr>
                			<td class="nav2" onclick="nav2GoTo(\'travel_detail.php?itemid=' . $o_table->getItemId ( $i ) . '\',this,\'#nav_3_' . $o_table->getItemId ( $i ) . '\',' . $o_table->getItemId ( $i ) . ')">
                    			' . $o_table->getName ( $i ) . '
                			</td>
            			</tr>
       				 </table>
        			<div class="nav3_border" id="nav_3_' . $o_table->getItemId ( $i ) . '"></div>';
		}
		if ($s_html == '') {
			$s_html = '<table border="0" cellpadding="0" cellspacing="0">
            			<tr>
                			<td class="nav2">
                    			没有内容
                			</td>
            			</tr>
       				 </table>';
		}
		return $s_html;
	}
	public function TravelGetNav3($n_type, $n_chapterid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Travel_Detail ();
		$o_table->PushWhere ( array ('&&', 'ItemId', '=', $n_chapterid ) );
		$o_table->PushOrder ( array ('StartHour', 'A' ) );
		$o_table->PushOrder ( array ('StartMin', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '';
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<table border="0" cellpadding="0" cellspacing="0">
                		<tr>
                    		<td class="nav3">
                        		<div>
                            		<a href="javascript:;" hidefocus="true" onclick="nav3GoTo(\'travel_detail_show.php?detailid=' . $o_table->getDetailId ( $i ) . '\',this)">' . $o_table->getStartHour ( $i ) . ':' . $o_table->getStartMin ( $i ) . ' 至 ' . $o_table->getEndHour ( $i ) . ':' . $o_table->getEndMin ( $i ) . '</a></div>
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
                            		没有内容</div>
                    		</td>
                		</tr>
            		</table>';
		}
		return $s_html;
	}
	public function TravelItemAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Travel_Item ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setTitleId ( $_POST ['Vcl_TitleId'] );
		$o_table->setState ( 1 );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		$this->TravelItemSort ( $o_table->getItemId (), $_POST ['Vcl_Number'], $o_table->getTitleId () ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_033' );
		return true;
	}
	private function TravelItemSort($n_chapterid, $n_number, $n_termid) {
		$o_all = new Travel_Item ();
		$o_all->PushWhere ( array ('&&', 'ItemId', '<>', $n_chapterid ) );
		$o_all->PushWhere ( array ('&&', 'TitleId', '=', $n_termid ) );
		$o_all->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Travel_Item ( $o_all->getItemId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	public function TravelItemDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_chapter = new Travel_Item ( $n_id );
		$o_chapter->setState ( 2 );
		$o_chapter->Save ();
		$this->TravelItemSortForDelete ( $o_chapter->getTitleId () );
		return true;
	}
	private function TravelItemSortForDelete($n_termid) {
		$o_table = new Travel_Item ();
		$o_table->PushWhere ( array ('&&', 'TitleId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Travel_Item ( $o_table->getItemId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	public function TravelItemModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Travel_Item ( $_POST ['Vcl_ItemId'] );
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->Save ();
		//读取图片
		$this->TravelItemSort ( $o_table->getItemId (), $_POST ['Vcl_Number'], $o_table->getTitleId () ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function TravelItemSetNumber($n_type, $n_chapterid, $n_number) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Travel_Item ( $n_chapterid );
		$o_table->setNumber ( $n_number );
		$o_table->Save ();
		$this->TravelItemSort ( $o_table->getItemId (), $n_number, $o_table->getTitleId () ); //排序
		return true;
	}
	public function TravelGetRegion($n_type, $n_termid,$n_typeid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Library_Region ();
		$o_table->PushWhere ( array ('&&', 'CityId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'TypeId', '=', $n_typeid ) );
		$o_table->PushOrder ( array ('Name', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = '<select name="Vcl_RegionId" id="Vcl_RegionId" class="BigSelect" style="width:auto">
						';
		if($n_count==0)
		{
			$s_html .= '<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;空&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
		}
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<option value="' . $o_table->getRegionId ( $i ) . '">&nbsp;&nbsp;' . $o_table->getName ( $i ) . '&nbsp;&nbsp;</option>
                		';
		}
		$s_html .= '</select>';
		
		return $s_html;
	}
	public function TravelGetHotel($n_type, $n_termid) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Library_Hotel ();
		$o_table->PushWhere ( array ('&&', 'CityId', '=', $n_termid ) );
		$o_table->PushOrder ( array ('Name', 'A' ) );
		$n_count = $o_table->getAllCount ();
		$s_html = ' <select name="Vcl_HotelId" id="Vcl_HotelId" class="BigSelect" style="width:auto">
						';
		if ($n_count == 0) {
			$s_html .= '<option value="0">=请先选择城市=</option>
                		';
		}
		for($i = 0; $i < $n_count; $i ++) {
			$s_html .= '<option value="' . $o_table->getHotelId ( $i ) . '">' . $o_table->getName ( $i ) . ' $' . $o_table->getPrice ( $i ) . '/天</option>
                		';
		}
		$s_html .= '</select>';
		return $s_html;
	}
	public function TravelDetailAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Travel_Detail ();
		$o_table->setStartHour ( $_POST ['Vcl_StartHour'] );
		$o_table->setStartMin ( $_POST ['Vcl_StartMin'] );
		$o_table->setEndHour ( $_POST ['Vcl_EndHour'] );
		$o_table->setEndMin ( $_POST ['Vcl_EndMin'] );
		$o_table->setItemId ( $_POST ['Vcl_ItemId'] );
		$o_table->setCityId ( $_POST ['Vcl_CityId'] );
		$o_table->setExplain ( $this->AilterTextArea ( $_POST ['Vcl_Explain'] ) );
		if ($_POST ['Vcl_RegionId'] > 0) {
			$o_table->setRegionId ( $_POST ['Vcl_RegionId'] );
		}
		//获取酒店
		$o_hotel = new Library_Hotel ();
		$o_hotel->PushWhere ( array ('&&', 'CityId', '=', $_POST ['Vcl_CityId'] ) );
		$n_count = $o_hotel->getAllCount ();
		$a_hotelid = array ();
		for($i = 0; $i < $n_count; $i ++) {
			if ($_POST ['Vcl_HotelId_' . $o_hotel->getHotelId ( $i )] > 0) {
				array_push ( $a_hotelid, $o_hotel->getHotelId ( $i ) );
			}
		}
		if (count ( $a_hotelid ) > 0) {
			$o_table->setHotelId ( json_encode ( $a_hotelid ) );
		}
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_034' );
		return true;
	}
	public function TravelDetailDelete($n_type, $n_uid) {
		if (! ($n_type = 1)) {
			return false;
		}
		$o_user = new Travel_Detail ( $n_uid );
		$o_user->Deletion ();
		return true;
	}
	public function TravelDetailModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Travel_Detail ( $_POST ['Vcl_DetailId'] );
		$o_table->setStartHour ( $_POST ['Vcl_StartHour'] );
		$o_table->setStartMin ( $_POST ['Vcl_StartMin'] );
		$o_table->setEndHour ( $_POST ['Vcl_EndHour'] );
		$o_table->setEndMin ( $_POST ['Vcl_EndMin'] );
		$o_table->setCityId ( $_POST ['Vcl_CityId'] );
		$o_table->setExplain ( $this->AilterTextArea ( $_POST ['Vcl_Explain'] ) );
		if ($_POST ['Vcl_RegionId'] > 0) {
			$o_table->setRegionId ( $_POST ['Vcl_RegionId'] );
		} else {
			$o_table->setRegionId ( 0 );
		}
		//获取酒店
		$o_hotel = new Library_Hotel ();
		$o_hotel->PushWhere ( array ('&&', 'CityId', '=', $_POST ['Vcl_CityId'] ) );
		$n_count = $o_hotel->getAllCount ();
		$a_hotelid = array ();
		for($i = 0; $i < $n_count; $i ++) {
			if ($_POST ['Vcl_HotelId_' . $o_hotel->getHotelId ( $i )] > 0) {
				array_push ( $a_hotelid, $o_hotel->getHotelId ( $i ) );
			}
		}
		if (count ( $a_hotelid ) > 0) {
			$o_table->setHotelId ( json_encode ( $a_hotelid ) );
		} else {
			$o_table->setHotelId ( '' );
		}
		$o_table->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	public function TravelTypeAdd($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Travel_Type ();
		$o_table->PushWhere ( array ('&&', 'Name', '=', $_POST ['Vcl_Name'] ) );
		$o_table->PushWhere ( array ('&&', 'Delete', '=', 0) );
		if ($o_table->getAllCount () > 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_018' );
			return FALSE;
		}
		$o_table = new Travel_Type ();
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setState ( $_POST ['Vcl_State'] );
		$o_table->Save ();
		mkdir ( RELATIVITY_PATH . 'uploaddata/library/type/' . $o_table->getTypeId(), 0700 );
		$this->TravelTypeSort($o_table->getTypeId(),$_POST ['Vcl_Number']); 
		$this->S_ErrorReasion = SysText::Index ('Ok_037');
		return true;
	}
	public function TravelTypeModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		$o_table = new Travel_Type ();
		$o_table->PushWhere ( array ('&&', 'Name', '=', $_POST ['Vcl_Name'] ) );
		$o_table->PushWhere ( array ('&&', 'TypeId', '<>', $_POST ['Vcl_TypeId'] ) );
		$o_table->PushWhere ( array ('&&', 'Delete', '=', 0) );
		if ($o_table->getAllCount () > 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_018' );
			return FALSE;
		}
		$o_table = new Travel_Type ($_POST ['Vcl_TypeId']);
		$o_table->setName ( $_POST ['Vcl_Name'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setState ( $_POST ['Vcl_State'] );
		$o_table->setTitleId ( $_POST ['Vcl_TitleId'] );
		//上传图片
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
			$s_file=rand(100, 999);
			$o_table->setPhoto( '/uploaddata/library/type/' . $_POST ['Vcl_TypeId'] . '/'.$s_file.'.' . $fileext );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/library/type/' . $_POST ['Vcl_TypeId'] . '/'.$s_file.'.' . $fileext ); //将图片拷贝到指定
		}
		$o_table->Save ();
		$this->TravelTypeSort($o_table->getTypeId(),$_POST ['Vcl_Number']); 
		$this->S_ErrorReasion = SysText::Index ('Ok_009');
		return true;
	}
	private function TravelTypeSort($n_id, $n_number) {
		$o_all = new Travel_Type ();
		$o_all->PushWhere ( array ('&&', 'TypeId', '<>', $n_id ) );
		$o_all->PushWhere ( array ('&&', 'Delete', '=', 0 ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Travel_Type ( $o_all->getTypeId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	private function TravelTypeSortForDelete() {
		$o_table = new Travel_Type ();
		$o_table->PushWhere ( array ('&&', 'Delete', '=', 0 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Travel_Type ( $o_table->getTypeId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
	public function TravelTypeDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_chapter = new Travel_Type ( $n_id );
		$o_chapter->setDelete ( 1);
		$o_chapter->Save ();
		$this->TravelTypeSortForDelete ();
		return true;
	}
	public function AdvertState($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Travel_Advert ( $n_id );
		if ($o_table->getState () == 1) {
			$o_table->setState ( 0 );
		} else {
			$o_table->setState ( 1 );
		}
		$o_table->Save ();
		return true;
	}
	public function AdvertDelete($n_type, $n_id) {
		if (! ($n_type = 1)) {
			//直接退出系统
			return false;
		}
		$o_table = new Travel_Advert ( $n_id );
		//删除文件
		$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/travel/ad/' . $n_id );
		//删除数据
		$o_table->Deletion ();
		//排序
		$o_table->__destruct ();
		$this->AdvertSortForDelete ();
		return true;
	}
	public function AdvertAdd($n_type) {
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
		$o_table = new Travel_Advert ();
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
		$o_table->setUrl ( $_POST ['Vcl_Url'] );
		$o_table->setNumber ( $_POST ['Vcl_Number'] );
		$o_table->setOpen ( $_POST ['Vcl_Open'] );
		$o_table->Save ();
		$o_table->setOnout ( '/uploaddata/travel/ad/' . $o_table->getAdvertId () . '/off.' . $fileext );
		$o_table->Save ();
		//读取图片
		mkdir ( RELATIVITY_PATH . 'uploaddata/travel/ad/' . $o_table->getAdvertId (), 0700 );
		copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/travel/ad/' . $o_table->getAdvertId () . '/off.' . $fileext ); //将图片拷贝到指定
		$this->AdvertSort ( $o_table->getAdvertId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_015' );
		return true;
	}
	public function AdvertModify($n_type) {
		if (! ($n_type = 1)) {
			return true;
		}
		//建立文件夹
		$o_table = new Travel_Advert ( $_POST ['Vcl_AdvertId'] );
		$o_table->setTitle ( $_POST ['Vcl_Title'] );
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
			$o_table->setOnout ( '/uploaddata/travel/ad/' . $o_table->getAdvertId () . '/off.' . $fileext );
			$o_table->Save ();
			//删除原来的图片
			$this->DeleteDir ( RELATIVITY_PATH . '/uploaddata/travel/ad/' . $o_table->getAdvertId () );
			//新建文件
			mkdir ( RELATIVITY_PATH . 'uploaddata/travel/ad/' . $o_table->getAdvertId (), 0700 );
			copy ( $_FILES ['Vcl_Upload'] ['tmp_name'], RELATIVITY_PATH . 'uploaddata/travel/ad/' . $o_table->getAdvertId () . '/off.' . $fileext ); //将图片拷贝到指定
		}
		$this->AdvertSort ( $o_table->getAdvertId (), $_POST ['Vcl_Number'] ); //排序
		$this->S_ErrorReasion = SysText::Index ( 'Ok_009' );
		return true;
	}
	private function AdvertSort($n_advertid, $n_number) {
		$o_all = new Travel_Advert ();
		$o_all->PushWhere ( array ('&&', 'AdvertId', '<>', $n_advertid ) );
		$o_all->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_all->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_focus = new Travel_Advert ( $o_all->getAdvertId ( $i ) );
			if (($i + 1) >= $n_number) {
				$o_focus->setNumber ( $i + 2 );
			} else {
				$o_focus->setNumber ( $i + 1 );
			}
			$o_focus->Save ();
		}
	}
	private function AdvertSortForDelete() {
		$o_table = new Travel_Advert ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$n_count = $o_table->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$o_temp = new Travel_Advert ( $o_table->getAdvertId ( $i ) );
			$o_temp->setNumber ( $i + 1 );
			$o_temp->Save ();
		}
	}
}
?>