<?php
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰行程网-新用户注册第二步</title>
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="js/register.fun.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../js/common.fun.js"></script>
<script type="text/javascript" src="js/dialog.fun.js"></script>
</head>
<body>
    <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                &nbsp;
            </td>
            <td style="width: 986px">
                <div style="width: 986px; height: 135px; text-align: center;">
                    <img style="padding-top: 44px;" alt="" src="images/logo_1.png" />
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr style="background-color: #50BAD0">
            <td>
                &nbsp;
            </td>
            <td>
                <div style="width: 986px; height: 47px;">
                    <div class="logo" style="margin-left: 408px;" onclick="location='index.php'">
                    </div>
                </div>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <div style="width: 986px;">
                    <div style="text-align: center;">
                        <img style="padding-top: 130px;" alt="" src="images/reg_setp_2.png" />
                    </div>
                    <form method="post" id="submit_form"
			action="../../include/bn_submit.svr.php?function=Register"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
                    <table border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0px 0px 140px;
                        width: 707px; background-color: White; border: 1px solid #E8E9E4;">
                        <tr>
                            <td class="form">
                                <table border="0" cellpadding="0" cellspacing="0" id="form" style="width: 600px">
                                    <tr>
                                        <td style="width: 270px" colspan="2">
                                            <div style="float: left">
                                                用户名（必须为QQ邮箱）<span>*</span></div>
                                            <div id="Vcl_UserName_ok" class="input_ok">
                                            </div>
                                            <div id="Vcl_UserName_no" class="input_no">
                                            </div>
                                        </td>
                                        <td style="width: 60px">
                                        </td>
                                        <td>
                                            <div style="float: left">
                                                性别 <span>*</span></div>
                                            <div id="Vcl_Sex_ok" class="input_ok mini">
                                            </div>
                                            <div id="Vcl_Sex_no" class="input_no mini">
                                            </div>
                                        </td>
                                        <td>
                                            <div style="float: left">
                                                手机 <span>*</span></div>
                                            <div id="Vcl_Phone_ok" class="input_ok mini">
                                            </div>
                                            <div id="Vcl_Phone_no" class="input_no mini">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align: top">
                                            <input id="Vcl_UserName" name="Vcl_UserName" style="width: 182px; float: left; text-align: right;"
                                                maxlength="100" type="text" /><div style="color: #FF7000; float: right; margin-top: 14px;
                                                    font-size: 16px">
                                                    @qq.com</div>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <input id="Vcl_Sex" class="mini" name="Vcl_Sex" maxlength="1" type="text" />
                                        </td>
                                        <td>
                                            <input class="mini" id="Vcl_Phone" name="Vcl_Phone" maxlength="15" type="text" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div style="float: left">
                                                登录密码（不能少于6位）<span>*</span></div>
                                            <div id="Vcl_Password_ok" class="input_ok">
                                            </div>
                                            <div id="Vcl_Password_no" class="input_no">
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td colspan="2" style="width: 270px">
                                            <div style="float: left">
                                                确认密码 <span>*</span></div>
                                            <div id="Vcl_Password2_ok" class="input_ok">
                                            </div>
                                            <div id="Vcl_Password2_no" class="input_no">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align: top">
                                            <input id="Vcl_Password" name="Vcl_Password" maxlength="50" type="password" onkeyup="passwordSafe();"
                                                style="margin-bottom: 0px" />
                                            <div class="passwordstyle">
                                                <div class="a">
                                                </div>
                                                <div class="b">
                                                </div>
                                                <div class="c">
                                                </div>
                                                <div class="d">
                                                </div>
                                                <div class="e">
                                                </div>
                                            </div>
                                            <div class="passwordsafe">
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td colspan="2">
                                            <input id="Vcl_Password2" name="Vcl_Password2" maxlength="50" type="password" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div style="float: left">
                                                验证码 <span>*</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #2A80B9" href="javascript:updateValidCode();">看不清换一张</a></div>
                                            <div id="Vcl_ValidCode_ok" class="input_ok">
                                            </div>
                                            <div id="Vcl_ValidCode_no" class="input_no">
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td colspan="2">
                                        &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input class="mini" id="Vcl_ValidCode" name="Vcl_ValidCode" maxlength="6" type="text"
                                                style="float: left" />
                                            <div style="float: right; padding-top: 10px" id="validcode">
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td colspan="2">
                                        &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="height:30px;">
                                        </td>
                                        <td>
                                        </td>
                                        <td colspan="2">
                                        &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="Vcl_ComeFrom" value="travel"/> 
                	</form>
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <div style="width: 986px; padding-top: 30px">
                    <div class="button_1" style="float: right; margin-right: 140px" onclick="registerSubmit()">
                        提交</div>
                    <div class="button_2" style="float: right; margin-right: 12px" onclick="location='register_1.php'">
                        上一步</div>
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <div style="height: 100px">
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
    </table>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
<script type="text/javascript">
updateValidCode()
</script>
</body>
</html>