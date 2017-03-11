<?php
define ( 'RELATIVITY_PATH', '../../' ); //定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false) //如果没有注册，跳转到首页
{
	echo ('非法操作');
	exit ( 0 );
}
if ($O_Session->getType () != 1) //如果不是系统管理员
{
	echo ('非法操作');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
if (isset ( $_GET ['type'] )) {
	$n_type = $_GET ['type'];
} else {
	exit ( 0 );
}
if (isset ( $_GET ['sleep'] )) {
	$n_sleep = $_GET ['sleep'];
} else {
	exit ( 0 );
}
$S_Filename = '学员信息列表.csv';
OutputList ($n_type,$n_sleep);

$file_name = 'ready.csv';
$file_dir = RELATIVITY_PATH . '/sub/ucenter/output/';
$rename = rawurlencode ( $S_Filename );
if (! file_exists ( $file_dir . $file_name )) { //检查文件是否存在
	echo "对不起,您要下载的文件不存在";
	exit ();
} else {
	// 一下是php文件下载的重点
	Header ( "Content-type: application/octet-stream" );
	Header ( "Accept-Ranges: bytes" );
	Header ( "Content-Type: application/force-download" ); //强制浏览器下载
	Header ( "Content-Disposition: attachment; filename=" . $rename ); //重命名文件
	Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) ); //文件大小
	// 读取文件内容
	@readfile ( $file_dir . $file_name ); //加@不输出错误信息
}
function OutputList($n_type,$n_sleep) {
	$fp = fopen ( 'output/ready.csv', 'w' );
	SetTotalInfo ( '注册日期','往年专家','本年专家','证书模板','客户编号', '客户编码', '地区', '类别', '国别', '来源', '公司名称', '公司名称（英文）', '姓名', '姓名（英文）', '性别', '职务', '职务（英文）', '部门', '部门（英文）', '区号', '直线', '电话', '分机', '传真', '手机', '邮编', '省', '市', '地址', '地址（英文）', '即时通讯', '电邮', '电邮2', '网址', 'skype', '生日', '客户级别', '是否合作伙伴', $fp );
	$o_user = new View_User_Credential ();
	$o_user->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
	$n_comefrom='';
	if ($n_type==7)
	{
		$n_comefrom='media';
		$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
		$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
	}elseif($n_type==8){
		$n_comefrom='travel';
		$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
		$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		$o_user->PushOrder ( array ('RegTime', 'D' ) );
	}elseif($n_type==9){
		$n_comefrom='wechat';
		$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'wechat' ) );
		$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		$o_user->PushOrder ( array ('RegTime', 'D' ) );
	}else{
		$n_comefrom='e-learning';
		$o_user->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
		if ($n_type > 0) {
			if ($n_type == 6) {
				$o_user->PushWhere ( array ('&&', 'Type', '>=', 4 ) );
			} else {
				$o_user->PushWhere ( array ('&&', 'Type', '=', $n_type ) );
			}
		} else if ($n_sleep == 1) {
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_user->PushWhere ( array ('&&', 'IsSleep', '=', 1 ) );	
		} else {
			$o_user->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		$o_user->PushOrder ( array ('RegTime', 'D' ) );
	}	
	$o_user->PushOrder ( array ('UserName', 'D' ) );
	$n_count = $o_user->getAllCount ();
	for($i = 0; $i < $n_count; $i ++) {
		//查询学校	
		$o_date = new DateTime ( 'Asia/Chongqing' );
		$s_type1='';
		$s_type2='';
		if($o_user->getType ( $i )==4)
		{
			$s_type1='Yes';
		}
		if($o_user->getType ( $i )==5)
		{
			$s_type2='Yes';
		}
		$s_email=$o_user->getUserName ( $i );
		if ($n_type==9)
		{
			$s_email=$o_user->getEmail1 ( $i );
		}
		SetTotalInfo ( $o_user->getRegTime ( $i ),$s_type1,$s_type2,$o_user->getCredentialName ( $i ),'', '', $o_user->getArea ( $i ), '', '', $n_comefrom, $o_user->getCompany ( $i ), $o_user->getEnCompany ( $i ), $o_user->getName ( $i ), $o_user->getEnName ( $i ), $o_user->getSex ( $i ), $o_user->getJob ( $i ), $o_user->getEnJob ( $i ), $o_user->getDept ( $i ), $o_user->getEnDept ( $i ), '\''.$o_user->getAreaNumber ( $i ), $o_user->getCompanyPhone ( $i ), $o_user->getTelephone ( $i ), $o_user->getExtension ( $i ), $o_user->getFax ( $i ), $o_user->getPhone ( $i ), $o_user->getPostcode ( $i ), $o_user->getProvince ( $i ), $o_user->getCity ( $i ), $o_user->getAddress ( $i ), $o_user->getEnAddress ( $i ), $o_user->getQQ ( $i ),$s_email, $o_user->getEmail2 ( $i ), $o_user->getUrl ( $i ), $o_user->getSkype ( $i ), $o_user->getBirthday ( $i ), '', '', $fp );
	}
	fclose ( $fp );
}

function SetTotalInfo($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var12, $var13, $var14, $var15, $var16, $var17, $var18, $var19, $var20, $var21, $var22, $var23, $var24, $var25, $var26, $var27, $var28, $var29, $var30, $var31, $var32, $var33, $var34, $var35,$var36,$var37, $var38, $file) {
	$a_item = array ();
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var1 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var2 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var3 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var4 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var5 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var6 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var7 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var8 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var9 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var10 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var11 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var12 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var13 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var14 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var15 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var16 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var17 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var18 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var19 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var20 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var21 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var22 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var23 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var24 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var25 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var26 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var27 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var28 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var29 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var30 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var31 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var32 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var33 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var34 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var35 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var36 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var37 ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $var38 ) );
	fputcsv ( $file, $a_item );
}
?>