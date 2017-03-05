<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../../netdisk/css/common.css" rel="stylesheet"
	type="text/css" />
<link href="../../netdisk/css/style2.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css"
	href="../../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../../ucenter/css/list.css" />
<script type="text/javascript" src="../../../js/ajax.class.js"></script>
<script type="text/javascript" src="../../../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/travel.fun.js"></script>
<script type="text/javascript">

function getSelectedText(name){
	var obj=document.getElementById(name);
	for(i=0;i<obj.length;i++){
		if(obj[i].selected==true){
			return obj[i].innerText;
			}
		}
	}
</script>
</head>
<body style="background-image: none; background-color: #ffffff">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="dialog_title" style="font-family: 微软雅黑;">添加酒店</td>
		<td style="width: 35px">
		<div onmouseover="this.className='dialog_closebutton_over'"
			class="dialog_closebutton" onclick="parent.Common_CloseDialog()"
			onmouseout="this.className='dialog_closebutton'"></div>
		</td>
	</tr>
</table>
<table class="TableBlock" style="width: 100%; margin-top: 15px;">
	<tbody>
		<tr>
			<td class="TableData" nowrap="nowrap" width="80">&nbsp;&nbsp;选择酒店</td>
			<td class="TableData"><select id="Vcl_RegionId" name="Vcl_RegionId"
				class="BigSelect" style="width: auto">
					<?php
					require_once RELATIVITY_PATH . 'include/db_table.class.php';
					$o_table = new Library_Hotel ();
					$o_table->PushWhere ( array ('&&', 'CityId', '=', $_GET['cityid'] ) );
					$o_table->PushOrder ( array ('Name', 'A' ) );
					$n_count = $o_table->getAllCount ();
					for($i = 0; $i < $n_count; $i ++) {
						echo('<option value="' . $o_table->getHotelId ( $i ) . '">' . $o_table->getName ( $i ) . ' $' . $o_table->getPrice ( $i ) . '/天</option>');
					}
					?>
				</select></td>
		</tr>
	</tbody>
</table>
<div class="list">
<div class="page dialog">
<div class="subButton2" onclick="parent.Common_CloseDialog()">取消</div>
<div class="subButton" onclick="parent.travelItemAddHotel(document.getElementById('Vcl_RegionId').value,getSelectedText('Vcl_RegionId'));parent.Common_CloseDialog()">确定</div>
</div>
</div>
</body>
</html>