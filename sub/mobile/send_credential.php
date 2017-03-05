<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
if ($o_user->getType()!=5)
{
	echo ('<script type="text/javascript">parent.location=\'ucenter.php\'</script>');
	exit ( 0 );
}
if ($o_user->getIsSend()==1)
{
	echo ('<script type="text/javascript">parent.location=\'credential.php\'</script>');
	exit ( 0 );
}

//获取以前寄送地址
$s_name = '';
$s_phone = '';
$s_address = '';
$s_postcode = '';
$o_temp = new Goods_Send();
$o_temp->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
$o_temp->PushOrder ( array ('Date', 'D' ) );
if ($o_temp->getAllCount () > 0) {
	$s_name = $o_temp->getName ( 0 );
	$s_phone = $o_temp->getPhone ( 0 );
	$s_address = $o_temp->getAddress ( 0 );
	$s_postcode = $o_temp->getPostcode ( 0 );
}else{
	$s_name = $o_user->getName ( );
	$s_phone = $o_user->getPhone ( );
	$s_address = $o_user->getAddress ( );
	$s_postcode = $o_user->getPostcode ( );	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-证书寄送</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="stylesheet" href="css/login.css" />
    <link rel="Stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/register.fun.js"></script>
    <script type="text/javascript" src="../../js/common.fun.js"></script>
    <script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../../js/dialogformobile.fun.js"></script> 
</head>
<body style="background-image:none;">
        <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile());
		?>
<form method="post" id="submit_form"
	action="<?php
	echo (RELATIVITY_PATH)?>sub/student/include/bn_submit.svr.php?function=SendCredentialForMobile"
	enctype="multipart/form-data" target="ajax_submit_frame"
	style="width: 100%">
    <div class="forgot_pass_box" style="margin-top:0px">
        <div class="forgot_pass_title">
            <div class="pass_title_icon">
                <span class="icon-doc"></span>
                <h1>证书寄送</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>《荷兰旅游专家》 证书寄送</h2>
        </div>
        <div class="forgot_pass_info">
            <div class="info_box" id="form">
                <div class="row" style="margin-top:10px;">
                    <div class="account_name">
                        <h1>收件人</h1>
                        <div class="input_box">
                            <input id="Vcl_Name2" name="Vcl_Name" maxlength="100" type="text" value="<?php echo($s_name)?>"/>
                             <!-- 对勾容器 -->
		                    <div class="check" style="display:none;" id="Vcl_Name2_ok">
		                        <span class="icon-check"></span>
		                    </div>
		                    <!-- 叉子容器 -->
		                    <div class="cross" style="display:none;" id="Vcl_Name2_no">
		                        <span class="icon-cross"></span>
		                    </div>
		                </div>
		            </div>                   
                </div>
                <div class="account_name">
                    <h1>收货的详细地址</h1>
                    <div class="input_box">
	                    <input type="text" id="Vcl_Address" value="<?php echo($s_address)?>" name="Vcl_Address" maxlength="50"/>
	                    <!-- 对勾容器 -->
	                    <div class="check" style="display:none;" id="Vcl_Address_ok">
	                        <span class="icon-check"></span>
	                    </div>
	                    <!-- 叉子容器 -->
	                    <div class="cross" style="display:none;" id="Vcl_Address_no">
	                        <span class="icon-cross"></span>
	                    </div>                        
                    </div>
                </div>
                <div class="account_name">
                    <h1>邮政编码</h1>
                    <div class="input_box">
                        <input class="mini" id="Vcl_PostCode" name="Vcl_PostCode"
							maxlength="10" type="text" value="<?php echo($s_postcode)?>"/>
                    </div>
                </div>
                <div class="account_name">
                    <h1>手机号</h1>
                    <div class="input_box">
                        <input type="text" id="Vcl_Phone" name="Vcl_Phone" maxlength="15" value="<?php echo($s_phone)?>"/>
	                    <!-- 对勾容器 -->
	                    <div class="check" style="display:none;" id="Vcl_Phone_ok">
	                        <span class="icon-check"></span>
	                    </div>
	                    <!-- 叉子容器 -->
	                    <div class="cross" style="display:none;" id="Vcl_Phone_no">
	                        <span class="icon-cross"></span>
	                    </div>
                    </div>
                </div>
                <div class="submit_box">
                	<div class="submit_but gray_bg" onclick="window.alert('点击个人中心的“完成度”标志，可以继续申请证书寄送！');location='ucenter.php'">
                        取消
                    </div>
                    <div class="submit_but" onclick="sendCredentialSubmit()">
                        确定
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="Vcl_PrizeId" value="<?php echo($_GET['prizeid'])?>"/> 
</form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj" style="position: absolute; background-color: black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box" style="position: absolute; z-index: 2000; left: 0px; top: 0px;display:none"><div><img src="images/loading.gif" alt="" style="width:32px;height:32px"/></div></div>
<div id="master_box_loading" style="position: absolute; background-color: red; z-index: 2001; left: 0px; top: 0px;"></div>
</body>
</html>