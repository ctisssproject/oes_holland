<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
$o_user = new User ( $O_Session->getUid () );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-修改登陆密码</title>
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
			action="../../include/bn_submit.svr.php?function=ModifyPasswordForMobile"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%">
	<?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =1,$s_logo=''));
	?>
    <div class="forgot_pass_box" id="form" style="margin-top:0px;">
        <div class="forgot_pass_title">
            <div class="pass_title_icon">
                <span class="icon-lock"></span>
                <h1>修改密码</h1>
            </div>
            <div class="right_triangle"></div>
            <h2>请填写修改密码信息</h2>
        </div>
        <div class="forgot_pass_info">
            <div class="account_info" style="border-top: 0px solid #A5A5A5">
                <div class="account_email">
                    <h1>原始密码</h1>
                    <div class="input_box email">
                        <input type="password" id="Vcl_Password_Old" name="Vcl_Password_Old" value="" />
                        <!-- 对勾容器 -->
                        <div class="check" style="display:none;" id="Vcl_Password_Old_ok">
                            <span class="icon-check"></span>
                        </div>
                        <!-- 叉子容器 -->
                        <div class="cross" style="display:none;" id="Vcl_Password_Old_no">
                            <span class="icon-cross"></span>
                            <h2 id="Vcl_Password_Old_no_text"></h2>
                        </div>

                    </div>
                </div>
            <div class="account_pas">
                <h1>新密码（至少6位）</h1>
                <div class="input_box pas">
                    <input id="Vcl_Password" name="Vcl_Password" type="password" value="" maxlength="200"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Password_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Password_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Password_no_text">111</h2>
                    </div>
                </div>
            </div>
            <div class="account_pas">
                <h1>确认密码</h1>
                <div class="input_box pas">
                    <input type="password" id="Vcl_Password2" name="Vcl_Password2" maxlength="200"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Password2_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Password2_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Password2_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="submit_box">                
                <div class="submit_but" onclick="modifyPasswordSubmit()">
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
</body>
</html>

