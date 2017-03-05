<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-找回密码</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
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
<form method="post" id="submit_form"
			action="../../include/bn_submit.svr.php?function=FindPasswordForMobile"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%">
	<?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	?>
    <div class="forgot_pass_box" id="form">
        <div class="forgot_pass_title">
            <div class="pass_title_icon">
                <span class="icon-lock"></span>
                <h1>找回密码</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>请填写找回信息</h2>
        </div>
        <div class="forgot_pass_info">
            <div class="info_box">
                <div class="account_email">
                    <h1>电子邮箱</h1>
                    <div class="input_box email">
                        <input type="text" id="Vcl_UserName_F" name="Vcl_UserName_F" value="" />
                        <!-- 对勾容器 -->
                        <div class="check" style="display:none;" id="Vcl_UserName_F_ok">
                            <span class="icon-check"></span>
                        </div>
                        <!-- 叉子容器 -->
                        <div class="cross" style="display:none;" id="Vcl_UserName_F_no">
                            <span class="icon-cross"></span>
                            <h2 id="Vcl_UserName_F_text"></h2>
                        </div>

                    </div>
                </div>
                <div class="account_name">
                <h1>真实姓名</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Name" name="Vcl_Name" maxlength="10"/>

                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Name_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Name_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Name_text"></h2>
                    </div>

                </div>
            </div>
            <div class="account_name">
                <h1>手机号</h1>
                <div class="input_box">
                    <input type="text"  id="Vcl_TelePhone" name="Vcl_TelePhone" maxlength="15"/>

                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_TelePhone_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_TelePhone_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_TelePhone_text"></h2>
                    </div>

                </div>
            </div>
            <div class="submit_box">
                <div class="account_verification">
                    <h1>验证码</h1>
                    <div class="input_box">
                        <input type="text" id="Vcl_ValidCode" name="Vcl_ValidCode" maxlength="6"/>
                        <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_ValidCode_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_ValidCode_no">
                        <span class="icon-cross"></span>
                    </div>
                    </div>
                </div>
                <div class="verification_img">
                    <h1 onclick="updateValidCode()">点击换一张</h1>
                    <div id="validcode"></div>
                </div>
                <div class="submit_but" onclick="findPasswordSubmit()">
                    提交
                </div>
            </div>
            </div>
        </div>
    </div>
</form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj"
	style="position: absolute; background-color: black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;display:none"><div><img src="images/loading.gif" alt="" style="width:32px;height:32px"/></div></div>
<div id="master_box_loading"
	style="position: absolute; background-color: red; z-index: 2001; left: 0px; top: 0px;"></div>
<script type="text/javascript">
updateValidCode()
</script>
</body>
</html>

