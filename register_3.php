<?php
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰旅游专家-新用户注册成功</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/register.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/register.fun.js"></script>
<script type="text/javascript" src="js/ajax.class.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/dialog.fun.js"></script>

</head>
<body>
    <div align="center">
        <table class="main" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td class="center">
                    <?php echo($o_showpage->getLogo())?>
                    <table class="reg_title" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="setp_title">
                                &nbsp;
                            </td>
                            <td class="off step_1_off">
                                &nbsp;
                            </td>
                            <td class="off step_2_off">
                                &nbsp;
                            </td>
                            <td class="on step_3_on">
                                &nbsp;
                            </td>
                            <td class="auto text">
                                <img src="images/reg_step3_text.png" alt="" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td class="jiao">
                                &nbsp;
                            </td>
                            <td class="auto">
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                    <div align="center">
                    <table class="step_seccuss" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            <td>                       
                                <div title="立即登录邮箱验证" onclick="Dialog_Message('点击“确定”将进入邮箱！<br/>如无法显示邮箱登录页面，请到您邮箱的指定页面登录。',function(){goTo('<?php echo($_GET ['email']) ?>')});"></div>
                                <?php echo($o_showpage->getRegSuccessPhoto())?>                               
                            </td>
                        </tr>
                    </table>
                    </div>
                    <?php echo($o_showpage->getFooter())?>
                </td>
            </tr>
        </table>
    </div>
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
