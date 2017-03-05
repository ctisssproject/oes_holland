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
    <title>荷兰行程网-新用户注册成功</title>
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
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
                        <img style="padding-top: 130px;" alt="" src="images/reg_setp_3.png" />
                    </div>
                    <table border="0" cellpadding="0" cellspacing="0" style="margin: 30px 0px 0px 140px;
                        width: 700px; background-color: White;;">
                        <tr>
                            <td>
                            <div class="button_1" style=" position:absolute; font-size:18px;width:120px;margin-top:290px;margin-left:120px;" title="立即登录邮箱验证" onclick="Dialog_Message('点击“确定”将进入邮箱！<br/>如无法显示邮箱登录页面，请到您邮箱的指定页面登录。',function(){goTo('<?php echo($_GET ['email']) ?>')});">验证邮箱</div>
                                <img alt="" src="images/reg_success.jpg" />
                            </td>
                        </tr>
                    </table>
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
</body>
</html>