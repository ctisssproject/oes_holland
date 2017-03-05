<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰旅游专家后台配送系统</title>
        <link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/common.css" />
    <link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />

    <script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
    <script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../ucenter/js/common.fun.js"></script>

</head>
<body>
    <div align="center">
        <table class="main" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width: 986px;">
            <tr>
                <td class="center">
                    <?php
		echo ($o_showpage->getLogo ())?>
                    <table class="my" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="title">
                                &nbsp;
                            </td>
                            <td class="title_right">
                                <div class="down">
                                    <div class="jiao">
                                    </div>
                                    <div class="text">
                                        欢迎你：<?php echo($O_Session->getName ())?>
                                    </div>
                                    <div class="botton" title="退出后台系统" onclick="Dialog_Confirm('是否真的要退出后台管理系统？',function(){location='../../index.php?loginout=1'})">
                                        退出
                                    </div>
                                </div>
                                <div class="menu">
                                <div class="button" onclick="menuToGo(this,'goods_search.php')">
                                        <div>
                                        </div>
                                       运单查询
                                    </div>
                                   	<div class="button" onclick="menuToGo(this,'goods_send.php')">
                                        <div>
                                        </div>
                                        批量发货
                                    </div>
                                    <div class="button" onclick="menuToGo(this,'credential.php')">
                                        <div>
                                        </div>
                                        证书配送
                                    </div>
                                    <div class="button" onclick="menuToGo(this,'information.php')">
                                        <div>
                                        </div>
                                        资料配送
                                    </div>
                                    <div class="button" onclick="menuToGo(this,'prize.php')">
                                        <div>
                                        </div>
                                      奖品配送
                                    </div>
                                    <div class="button on" onclick="menuToGo(this,'../ucenter/welcome.php')">
                                        <div>
                                        </div>
                                      &nbsp;&nbsp;首&nbsp;&nbsp;&nbsp;页&nbsp;&nbsp;
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <iframe marginwidth="0" border="0" frameborder="0" src="../ucenter/welcome.php" style="height: 1500px;
                        margin-top: 30px; margin-bottom: 30px; width: 100%"></iframe>
                </td>
            </tr>
        </table>
    </div>
   <div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: -500px;">
</div>
</body>
</html>
