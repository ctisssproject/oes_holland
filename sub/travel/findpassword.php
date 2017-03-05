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
    <title>荷兰行程网-找回密码</title>
    <link rel="stylesheet" type="text/css" href="css/common.css" />
        <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="js/register.fun.js" type="text/javascript"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../js/common.fun.js"></script>
<script type="text/javascript" src="js/dialog.fun.js"></script>
</head>
<body style="background-image:url('images/findpassword_bj.png'); background-repeat:no-repeat; background-position:center top;">
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
                <form method="post" id="submit_form"
			action="../../include/bn_submit.svr.php?function=FindPassword"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
                    <table border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0px 0px 140px;
                        width: 707px;">
                        <tr>
                            <td class="form">
                                <table border="0" cellpadding="0" cellspacing="0" id="form" style="width: 600px">
                                    <tr>
                                        <td style="width: 270px;height:150px; font-size:18px; font-weight:bold" colspan="3" >
                                           找回密码
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 270px">
                                            <div style="float: left">
                                                用户名（必须为QQ邮箱）<span>*</span></div>
                                            <div id="Vcl_UserName_F_ok" class="input_ok">
                                            </div>
                                            <div id="Vcl_UserName_F_no" class="input_no">
                                            </div>
                                        </td>
                                        <td style="width: 60px">
                                        </td>
                                        <td>
                                            <div style="float: left">
                                                手机 <span>*</span></div>
                                            <div id="Vcl_TelePhone_ok" class="input_ok mini">
                                            </div>
                                            <div id="Vcl_TelePhone_no" class="input_no mini">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top">
                                            <input id="Vcl_UserName_F" name="Vcl_UserName_F"
                                                maxlength="100" type="text" />
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <input class="mini" id="Vcl_TelePhone" name="Vcl_TelePhone" maxlength="15" type="text" />
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td>
                                            <div style="float: left">
                                                验证码 <span>*</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #2A80B9" href="javascript:updateValidCode();">看不清换一张</a></div>
                                            <div id="Vcl_ValidCode_ok" class="input_ok">
                                            </div>
                                            <div id="Vcl_ValidCode_no" class="input_no">
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="mini" id="Vcl_ValidCode" name="Vcl_ValidCode" maxlength="6" type="text"
                                                style="float: left" />
                                            <div style="float: right; padding-top: 10px" id="validcode">
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
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
                    <div class="button_2" style="float: right; margin-right: 220px" onclick="goTo('index.php')">
                        取消</div>
                    <div class="button_1" style="float: right; margin-right: 12px" onclick="findPasswordSubmit()">
                        提交</div>
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

