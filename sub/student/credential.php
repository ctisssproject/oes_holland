<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
$b_isuser = $O_Session->Login (); //是否为登录用户
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-证书样式</title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/ucenter.css" />
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/ajax.class.js"></script>
<script type="text/javascript"
	src="js/ajax.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/dialog.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/login.fun.js"></script>
</head>
<body>
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<?php
		if ($b_isuser) {
			echo ($o_showpage->getLogo ());
		} else {
			echo ($o_showpage->getLogo ( 0 ));
		}
		echo ($o_showpage->getTop ( 'title_credential', $o_user ))?>
		<table class="prize" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>				
				<?php
				$o_prize = new Credential ();
				$o_prize->PushOrder ( array ('CredentialId', 'A' ) );
				$n_count = $o_prize->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					$s_id = '';
					if ($i == 0) {
						$s_id = ' id="info" name="info"';
					}
					$s_imagestyle='#ffffff';
					$s_button='<div align="center" title="点击修改样式" onclick="credentialStyleModify('.$o_prize->getCredentialId($i).')">
								选择
							</div>';
					if ($o_prize->getCredentialId($i)==$o_user->getCredentialId())
					{
						$s_imagestyle='#FF7000';
						$s_button='<div class="off" align="center">
								已选择
							</div>';	
					}
					echo ('
					<div class="prize_box"' . $s_id . ' style="width:438px;margin-left:25px;">
						<div style="background-color:'.$s_imagestyle.';padding:4px;height:344px">
							<img style="width:430px;height:344px;" src="' . $o_prize->getImage ( $i ) . '" alt="" />
						</div>
						<div class="prize_but" align="center">
							'.$s_button.'
						</div>
					</div>
					');
				}
				?>				
			</td>
			</tr>
		</table>		
		<?php
		echo ($o_showpage->getUcenterNews ());
		echo ($o_showpage->getAdvert ());
		echo ($o_showpage->getFirend ());
		echo ($o_showpage->getFooter ())?>
		</td>
	</tr>
</table>
</div>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
<script type="text/javascript">
<?php 
//判断证书是否已经寄送
$o_send=new Goods_Send();
$o_send->PushWhere ( array ('&&', 'Type', '=', 1 ) );
$o_send->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
$o_send->PushWhere ( array ('&&', 'State', '=', 2 ) );
if ($o_send->getAllCount()==0)
{
	echo('Dialog_Message(\'您的证书已经寄送，不能修改证书样式！\',function(){location=\'index.php\'})');
}	
?>
</script>
</body>
</html>