<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once '../include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
	<link rel="stylesheet" type="text/css" href="../css/dialog.css" /> 
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
</head>
<body style=" background-image:none;padding:0px;">
    <div>
        <div style="float: left">
            <div style=" width: 150px; height: 150px;border: 1px solid #858585;margin:50px 80px 0px 80px;">
                            <?php
                            $url='http://www.hollandtravelexpert.com/sub/travel/content.php?id='.$_GET['id']; 
                            require_once '../include/qrcode/qrlib.php';
                            QRcode::png($url, '../images/code/'.$_GET['id'].'.png', 10, 4, 2);  
                            echo ('<img src="../images/code/'.$_GET['id'].'.png" />');
                            ?>
            </div>
            <table>
	            <tr>
					<td class="button" style="height:50px;"><div class="ok"
	onclick="parent.Common_CloseDialog()" style="float:left;margin-top:30px;margin-left:125px;"> </div></td>
				</tr>
			</table>
        </div>
        <div style="padding: 10px; background-color: #FAF0DB; width: 196px;float: left; ">
            <div style="width: 196px; overflow: hidden; padding-top: 20px; padding-bottom: 20px;">
                <div style="width: 1000px;margin-left:100px" id="weixin">
                    <div style="float: left">
                        <img src="<?php
	echo (RELATIVITY_PATH)?>images/weixin_1.png" />
                        <div style=" text-align:center; padding-top:10px; font-weight:bold">
                            微信扫描左侧二维码</div>
                    </div>
                   <div style="float: left; margin-left:20px;">
                        <img src="<?php
	echo (RELATIVITY_PATH)?>images/weixin_2.png" />
                        <div style=" text-align:center; padding-top:10px; font-weight:bold">
                            点右上角的分享按钮</div>
                    </div>
                    <div style="float: left;margin-left:20px;">
                        <img src="<?php
	echo (RELATIVITY_PATH)?>images/weixin_3.png" />
                        <div style=" text-align:center; padding-top:10px; font-weight:bold">
                            选择发送给朋友</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
        var Left = 0;
        var TimeHandle = 0;
        start()
        function start() {
            $("#weixin").css("margin-left","0px")
            Left=0
            clearInterval(TimeHandle)
            TimeHandle=setInterval('moving()', 3000)
        }
        function moving() {
            Left = Left - 216
            if (Left < -500) {
                Left=0
            }
            $("#weixin").animate({ marginLeft: Left+"px" }, "normal");
        }
    </script>
</body>
</html>
