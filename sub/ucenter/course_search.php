<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/ajax.class.js"></script>
	<script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
	<script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
<script type="text/javascript" src="js/course.fun.js"></script>
</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<div class="list out">
		<div class="title">
		<div>高级智能搜索</div>
		<div class="subButton2" onclick="goBack()">返回</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="bright">
				<td style="width: 100px"><span>搜索内容</span></td>
				<td class="right_none">
				<div style="float: left"><input id="Vcl_Text" name="Vcl_Text"
					value="" style="width: 400px; height: 23px" type="text" /></div>
				<div class="page"
					style="float: left; border: 0px; padding: 0px; margin: 0px; margin-left: 20px">
				<div class="subButton" onclick="courseSearchSubmit()">搜索</div>
				</div>
				</td>
			</tr>
			<tr class="dark">
				<td><span>关键字</span></td>
				<td class="right_none" style="padding-bottom: 12px">
				<input id="Vcl_Key" name="Vcl_Key" type="hidden"/> 
					<?php
					$o_key = new Bank_Section_Key ();
					$o_key->PushOrder ( array ('Name', 'A' ) );
					$n_count = $o_key->getAllCount ();
					$s_html = '';
					for($i = 0; $i < $n_count; $i ++) {
						$s_html .= '
							<div class="keybox">
								<div class="name" onclick="courseSearchAddKey(this)">' . $o_key->getName ( $i ) . '</div>
							</div>
							';
					}
					if ($n_count > 0) {
						echo ('<div id="key">
									' . $s_html . '
								</div>
								');
					}
					?>
					
					</td>
			</tr>
			<tr class="bright">
				<td><span>学期</span></td>
				<td class="right_none"><select name="Vcl_TermId" id="Vcl_TermId"
					class="BigSelect" onchange="courseGetChapterForSearch(this)">
					<option value="" selected="selected">全部</option>
				<?php
				$o_temp = new Bank_Term ();
				$o_temp->PushWhere ( array ('&&', 'State', '<>', 2 ) );
				$o_temp->PushOrder ( array ('Date', 'D' ) );
				$n_count = $o_temp->getAllCount ();
				for($i = 0; $i < $n_count; $i ++) {
					echo ('<option value="' . $o_temp->getTermId ( $i ) . '">' . $o_temp->getName ( $i ) . '</option>');
				}
				?>
				</select></td>
			</tr>
			<tr class="dark">
				<td><span>章</span></td>
				<td class="right_none"><div id="chapter"><select name="Vcl_ChapterId" id="Vcl_ChapterId"
				class="BigSelect"><option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				</select></div></td>
			</tr>
			<tr class="bright">
				<td><span>显示类型</span></td>
				<td class="right_none"><select name="Vcl_Display" id="Vcl_Display"
				class="BigSelect" onchange="courseSearchSubmit()"><option value="0">全部</option>
				<option value="1">只显示节</option>
				<option value="2">只显示题</option>
				</select>
				</td>
			</tr>			
		</table>		
		</div>
		<div id="result">		
		</div>
		</td>
	</tr>
</table>
</div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<script type="text/javascript">

   //实例化编辑器
    setInterval(resizeLeaveRight,100);
    parent.parent.Common_CloseDialog();
</script>
</body>
</html>