<?php
define ( 'RELATIVITY_PATH', '' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage=new ShowPage();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰旅游专家-新用户注册第一步</title>
    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/register.css" />
    <script type="text/javascript" src="js/common.fun.js"></script>
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
                            <td class="on step_1_on">
                                &nbsp;
                            </td>
                            <td class="auto text">
                                <img src="images/reg_step1_text.png" alt="" />
                            </td>
                            <td class="off line step_2_off">
                                &nbsp;
                            </td>
                            <td class="off step_3_off">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                            <td class="jiao">
                                &nbsp;
                            </td>
                            <td class="auto">
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
					<?php echo($o_showpage->getTerms())?>
                    <table class="button" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                            <div class="dontagree idontagree" title="不同意使用条款" onclick="goTo('index.php?invitation=<?php echo($_GET ['invitation'])?>')">
                                   </div>
                                <div class="agree iagree" title="同意使用条款" onclick="goTo('register_2.php?invitation=<?php echo($_GET ['invitation'])?>')">
                                    </div>
                                    
                            </td>
                        </tr>
                    </table>
                    <?php echo($o_showpage->getFooter())?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>