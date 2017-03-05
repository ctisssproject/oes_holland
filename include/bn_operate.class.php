<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class Operate extends Bn_Basic {
	protected $ModuleName;
	protected $Nav2Name;
	protected $Nav2Url;
	protected $Result;
	protected $Number;
	protected $ParentId;
	protected $ModuleId;
	protected $Text;
	protected $Item;
	protected $Info;
	protected $Receive;
	protected $AffixFileSize;
	public function __construct() {
		$this->Result = TRUE;
	}
	
	public function getResult() {
		return $this->Result;
	}
	
	public function UploadTempFile($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->Result = FALSE;
			return;
		}
		$o_user = new Single_User ( $n_uid );
		$this->DeleteDir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/netdisk/netdisk_temp' ); //删除临时文件	
		mkdir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/netdisk/netdisk_temp', 0700 );
		if ($_FILES ['Vcl_Upload'] ['size'] > 0) {
			move_uploaded_file ( $_FILES ["Vcl_Upload"] ["tmp_name"], RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/netdisk/netdisk_temp/' . iconv ( 'UTF-8', 'gb2312', $_FILES ['Vcl_Upload'] ['name'] ) );
		} else {
			return 3;
		}
	}
	public function UploadAffixFile($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->Result = FALSE;
			return;
		}
		$o_user = new Single_User ( $n_uid );
		mkdir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ), 0700 );
		mkdir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/netdisk', 0700 );
		$dir = RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/netdisk/netdisk_temp';
		$dh = opendir ( $dir );
		while ( $file = readdir ( $dh ) ) {
			if ($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if (! is_dir ( $fullpath )) {
					$o_path = md5 ( $file . $n_uid . rand ( 0, 9999 ) . $this->GetTimeCut () );
					mkdir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/netdisk/' . $o_path, 0700 );
					//$filename = rawurlencode($file);
					$filename = iconv ( 'gb2312', 'UTF-8', $file );
					mkdir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/affixfile', 0700 );
					mkdir ( RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/affixfile/' . $o_path, 0700 );
					$o_to = RELATIVITY_PATH . 'userdata/' . md5 ( $o_user->getUserName () ) . '/affixfile/' . $o_path . '/' . $file;
					rename ( $fullpath, $o_to );
					break;
				}
			}
		}
		closedir ( $dh );
		//$this->DeleteDir ( $dir ); //删除临时文件	
		return 'http://www.xcjyxxzx.cn/userdata/' . md5 ( $o_user->getUserName () ) . '/affixfile/' . $o_path . '/' . $filename;
	}
}
?>