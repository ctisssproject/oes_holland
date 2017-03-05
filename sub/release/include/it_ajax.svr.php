<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
$S_Request = '';
require_once RELATIVITY_PATH . 'include/bn_ajaxrequest.class.php';
$O_Request = new AjaxRequest ( $_GET ['xml'] );
switch ($O_Request->getFunction ()) {
	case 'GetGoodsByCode' : //改变管理员状态
		$s_command = '$S_Request=' . $O_Request->getCommand ( '$O_Request' );
		eval ( $s_command );
		break;
	default :
		break;
}
echo ($S_Request);
exit ( 0 );
function GetGoodsByCode($id) {
	global $O_Session;
	global $O_Request;
	$o_table = new Goods_Send ();
	$o_table->PushWhere ( array ('&&', 'OrderNumber', '=', $id ) );
	$o_table->PushOrder ( array ('Type', 'A' ) );
	$o_table->PushOrder ( array ('GoodsId', 'A' ) );
	$n_count = $o_table->getAllCount ();
	$s_html = '';
	$n_total = 0;
	for($i = 0; $i < $n_count; $i ++) {
		$s_class = 'bright';
		if (abs ( $i % 2 ) == 0) {
			$s_class = 'dark';
		}
		$s_name = '';
		$s_button = '';
		if ($o_table->getType ( $i ) == 1) {
			$s_name = '荷兰旅游专家证书';
		
		//$s_button = '<div title="删除" class="delete" onclick="goodsCredentialDelete(' . $o_table->getId ( $i ) . ')"></div>';
		}
		if ($o_table->getType ( $i ) == 2) {
			$o_temp = new Prize ( $o_table->getGoodsId ( $i ) );
			$s_name = '<img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_temp->getPhoto () . '" alt="" /> ' . $o_temp->getName ();
		
		//$s_button = '';
		}
		if ($o_table->getType ( $i ) == 3) {
			$o_temp = new Information ( $o_table->getGoodsId ( $i ) );
			$s_name = '<img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_temp->getPhoto () . '" alt="" /> ' . $o_temp->getName ();
		
		//$s_button = '<div title="删除" class="delete" onclick="goodsPrizeExchangeDelete(' . $o_table->getId ( $i ) . ')"></div>';
		}
		$s_tr .= '<tr class="' . $s_class . '">
				<td>' . $s_name . '</td>
				<td>' . $o_table->getSum ( $i ) . '</td>
				<td>' . $o_table->getName ( $i ) . '</td>
				<td>' . $o_table->getAddress ( $i ) . '</td>
				<td>' . $o_table->getPostcode ( $i ) . '</td>
				<td class="right_none">' . $o_table->getPhone ( $i ) . '</td>
			</tr>';
	}
	$s_html = '
		<div class="list out">
		<div class="title">
		<div>搜索结果：共 <span id="total">' . $n_count . '</span> 个</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
					<tr class="item">
                                <td>
                                  物品名称
                                </td>
                                <td>
                                  数量
                                </td>
                                <td>
                                  收件人
                                </td>
                                <td>
                                  地址
                                </td>
                                <td>
                                   邮编
                                </td>                               
                                <td class="right_none">
                                    联系电话
                                </td>
                            </tr>
			' . $s_tr . '
		</table>
		</div>		
		';
	$O_Request->setFunction ( 'getGoodsByCodeCallback' );
	$O_Request->PushParameter ( $s_html );
	return $O_Request->getSendXml ();
}

?>