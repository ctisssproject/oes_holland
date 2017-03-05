<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false) //如果没有注册，跳转到首页
{
	echo ('<script type="text/javascript">parent.parent.location=\'' . RELATIVITY_PATH . 'index.php?out=true\';</script>');
	echo ('<script type="text/javascript">parent.location=\'' . RELATIVITY_PATH . 'index.php?out=true\';</script>');
	echo ('<script type="text/javascript">location=\'' . RELATIVITY_PATH . 'index.php?out=true\';</script>');
	exit ( 0 );
}
if ($O_Session->getType () != 1 && $O_Session->getType () != 2) //如果不是系统管理员
{
	echo ('<script type="text/javascript">parent.parent.location=\'' . RELATIVITY_PATH . 'index.php\';</script>');
	echo ('<script type="text/javascript">parent.location=\'' . RELATIVITY_PATH . 'index.php\';</script>');
	echo ('<script type="text/javascript">location=\'' . RELATIVITY_PATH . 'index.php\';</script>');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_user = new User ( $_GET ['uid'] );
$o_table = new Goods_Send ();
//$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
//$o_table->PushWhere ( array ('&&', 'Uid', '=', $_GET ['uid'] ) );
$o_table->PushWhere ( array ('&&', 'State', '=', 2 ) );
$o_table->PushWhere ( array ('&&', 'Uid', '=', $_GET ['uid'] ) );
$o_table->PushOrder ( array ('Name', 'D' ) );
$o_table->PushOrder ( array ('Address', 'D' ) );
$o_table->PushOrder ( array ('Type', 'A' ) );
$o_table->PushOrder ( array ('GoodsId', 'A' ) );
$n_count = $o_table->getAllCount ();
if ($n_count == 0) {
	if ($O_Session->getType () == 1)
	{
		echo ('<script type="text/javascript">location=\'goods_send.php\';</script>');
	}else{
		echo ('<script type="text/javascript">location=\'goods_send_list.php\';</script>');
	}	
	exit ( 0 );
}
$s_html = '';
for($i = 0; $i < $n_count; $i ++) {
	$s_class = 'bright';
	if (abs ( $i % 2 ) == 0) {
		$s_class = 'dark';
	}
	$s_name='';
	$s_button='';
	if ($o_table->getType ( $i )==1)
	{
		$s_name='荷兰旅游专家证书';
		$s_button='<div title="删除" class="delete" onclick="goodsCredentialDelete(' . $o_table->getId ( $i ) . ')"></div>';
	}
	if ($o_table->getType ( $i )==2)
	{
		$o_temp=new Prize($o_table->getGoodsId ( $i ));
		$s_name='<img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_temp->getPhoto ( ) . '" alt="" /> '.$o_temp->getName();
		$s_button='';
	}
	if ($o_table->getType ( $i )==3)
	{
		$o_temp=new Information($o_table->getGoodsId ( $i ));
		$s_name='<img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_temp->getPhoto ( ) . '" alt="" /> '.$o_temp->getName();
		$s_button='<div title="删除" class="delete" onclick="goodsPrizeExchangeDelete(' . $o_table->getId ( $i ) . ')"></div>';
	}
	$s_html .= '<tr class="'.$s_class.'">
				<td style="width: 100px"><input class="checkbox" name="Vcl_Id_' . $o_table->getId ( $i ) . '" id="Vcl_Id_' . $o_table->getId ( $i ) . '" type="checkbox" /> '.($i+1).'</td>
				<td>' . $s_name . '</td>
				<td>' . $o_table->getSum ( $i ) . '</td>
				<td>' . $o_table->getName ( $i ) . '</td>
				<td>' . $o_table->getAddress ( $i ) . '</td>
				<td>' . $o_table->getPostcode ( $i ) . '</td>
				<td class="right_none">' . $o_table->getPhone ( $i ) . '</td>
			</tr>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/goods.fun.js"></script>

<script type="text/javascript">
	 $(window).load(function(){resizeLeave2();parent.parent.Common_CloseDialog()});
    </script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=GoodsSendStart"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>用户信息</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>用户名</span></td>
				<td class="right_none" colspan="6"><?php
				echo ($o_user->getUserName ())?></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>姓名</span></td>
				<td class="right_none" colspan="6"><?php
				echo ($o_user->getName ())?></td>
			</tr>	
			<tr class="caption">
				<td style="width: 100px"><input class="checkbox" type="checkbox" onclick="selectAll(this)"/> 全选</td>
				<td>物品名称</td>
				<td>数量</td>
				<td>收件人</td>
				<td>地址</td>
				<td>邮编</td>
				<td class="right_none">电话</td>
			</tr>			
			<?php
			echo ($s_html)?>	
			<tr class="caption">
				<td style="width: 100px;height:5px"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="right_none"></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>快递公司</span></td>
				<td class="right_none" colspan="6"><select name="Vcl_Logistic" id="Vcl_Logistic"
				class="BigSelect">
						<option value="全峰快递">全峰快递</option>
					</select>
				</td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>运单号</span></td>
				<td class="right_none" colspan="6"><input id="Vcl_OrderNumber" name="Vcl_OrderNumber" maxlength="200"
					value="" style="width: 240px;"type="text" /> <span class="red">*</span></td>
			</tr>	
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="goodsCredentialSendSubmit()">提交</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Uid"
			value="<?php
			echo ($_GET ['uid'])?>" /></form>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
function selectAll(o_obj)
{
	var o_tr=document.getElementsByTagName('input')
   for(var i = 1; i < o_tr.length; i++){    
       if (o_tr[0].checked)
       {
    	   o_tr[i].checked=true;
       }else{
    	   o_tr[i].checked=false;
       }
   }
}
</script>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>