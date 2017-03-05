<?php
define ( 'RELATIVITY_PATH', '../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );

require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false) //如果没有注册，跳转到首页
{
	echo ('<script type="text/javascript">location=\''.RELATIVITY_PATH.'index.php\'</script>');	
	exit (0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰行程网-修改密码</title>
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
			action="../../sub/student/include/bn_submit.svr.php?function=ModifyPassword"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">
			<input type="hidden" name="Vcl_ComeFrom" value="travel"/>
                    <table border="0" cellpadding="0" cellspacing="0" style="margin: 00px 0px 0px 140px;
                        width: 707px;">
                        <tr>
                            <td class="form">
                                <table border="0" cellpadding="0" cellspacing="0" id="form" style="width: 600px">
                                    <tr>
                                        <td style="width: 270px;height:100px; font-size:18px; font-weight:bold" colspan="3" >
                                           修改密码
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 270px">
                                            <div style="float: left">原始密码 <span>*</span></div>
						<div id="Vcl_Password_Old_ok" class="input_ok"></div>
						<div id="Vcl_Password_Old_no" class="input_no"></div>
                                        </td>
                                        <td style="width: 60px">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top">
                                            <input id="Vcl_Password_Old" name="Vcl_Password_Old"
							maxlength="50" type="password" />
                                        </td>
                                        <td>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 270px">
                                            <div style="float: left">新密码 <span>*</span></div>
						<div id="Vcl_Password_ok" class="input_ok"></div>
						<div id="Vcl_Password_no" class="input_no"></div>
                                        </td>
                                        <td style="width: 60px">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top; height:80px">
                                           <input id="Vcl_Password" name="Vcl_Password"
							maxlength="50" type="password" onkeyup="passwordSafe();"
							style="margin-bottom: 0px" />
						<div class="passwordstyle" style="">
						<div class="a"></div>
						<div class="b"></div>
						<div class="c"></div>
						<div class="d"></div>
						<div class="e"></div>
						</div>
						<div class="passwordsafe"></div>
                                        </td>
                                        <td>
                                        </td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <td style="width: 270px;">
                                            <div style="float: left">确认密码 <span>*</span></div>
						<div id="Vcl_Password2_ok" class="input_ok"></div>
						<div id="Vcl_Password2_no" class="input_no"></div>
                                        </td>
                                        <td style="width: 60px">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top">
                                           <input id="Vcl_Password2" name="Vcl_Password2"
							maxlength="50" type="password" />
                                        </td>
                                        <td>
                                        </td>
                                        <td></td>
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
                    <div title="提交修改密码申请" class="button_1" style="float: right; margin-right: 12px" onclick="modifyPasswordSubmit()">
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

