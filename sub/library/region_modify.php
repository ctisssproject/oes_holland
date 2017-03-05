<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table=new Library_Region($_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo(RELATIVITY_PATH)?>css/common.css" />

<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript" src="<?php echo(RELATIVITY_PATH)?>js/jquery.min.js"></script>
    <script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
	<script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/ajax.class.js"></script>
<script type="text/javascript" src="js/region.fun.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_config.js"></script>
<script type="text/javascript" charset="utf-8"
	src="editor/editor_api.js"></script>

</head>
<body class="iframebody">
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=RegionModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%" onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
			<div class="title">
				<div>修改资料信息</div>
				<div class="subButton2" onclick="history.go(-1)">取消</div>
				<div class="subButton" onclick="regionAddSubmit()">提交</div>
			</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width: 100px"><span>资料类型</span></td>
				<td class="right_none">
				<select name="Vcl_TypeId" id="Vcl_TypeId" class="BigSelect" style="width:auto">
					<?php 
					$o_temp = new Library_Region_Type ();
					$o_temp->PushOrder ( array ('TypeId', 'A' ) );
					$n_count=$o_temp->getAllCount();
					for($i=0;$i<$n_count;$i++)
					{
						echo('<option value="'.$o_temp->getTypeId($i).'">'.$o_temp->getName($i).'</option>');				
					}					
					?>
				</select> <span class="red">*</span> <a style="color:green" href="javascript:;" onclick="Dialog_Iframe('dialog/library_region_type_add.php',350,140,'',this)">+添加</a></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>所在城市</span></td>
				<td class="right_none">
				<select name="Vcl_CityId" id="Vcl_CityId" class="BigSelect" style="width:auto">
					<?php 
					$o_temp = new Library_City ();
					$o_temp->PushOrder ( array ('Name', 'A' ) );
					$n_count=$o_temp->getAllCount();
					for($i=0;$i<$n_count;$i++)
					{
						if ($i==0)
						{
							echo('<option value="'.$o_temp->getCityId($i).'" selected="seclected">'.$o_temp->getName($i).'</option>');
						}else{
							echo('<option value="'.$o_temp->getCityId($i).'">'.$o_temp->getName($i).'</option>');
						}						
					}					
					?>
				</select> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>资料名称</span></td>
				<td class="right_none"><input id="Vcl_Name" name="Vcl_Name"
					value="<?php echo($o_table->getName())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>街道</span></td>
				<td class="right_none"><input id="Vcl_Street" name="Vcl_Street"
					value="<?php echo($o_table->getStreet())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>门牌号</span></td>
				<td class="right_none"><input id="Vcl_Address" name="Vcl_Address"
					value="<?php echo($o_table->getAddress())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>邮编</span></td>
				<td class="right_none"><input id="Vcl_Zip" name="Vcl_Zip"
					value="<?php echo($o_table->getZip())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td><span>关键字</span></td>
				<td class="right_none"><input id="Vcl_Key" name="Vcl_Key"
					value="<?php echo($o_table->getSKey())?>" style="width: 400px" type="text"/> 
					<?php 
						$o_key=new Bank_Section_Key();
						$o_key->PushOrder ( array ('Name', 'A' ) );
						$n_count=$o_key->getAllCount();
						$s_html='';
						for($i=0;$i<$n_count;$i++)
						{
							$s_html.='
							<div class="keybox">
								<div class="name" title="添加" onclick="regionAddKey(this)">'.$o_key->getName($i).'</div>
								<div class="button" title="从库中删除" onclick="regionDeleteKey(this,'.$o_key->getKeyId($i).')">
									×
								</div>
							</div>
							';
						}
						if ($n_count>0)
						{
							echo('<span class="gray">多个关键字之间用  <strong>;</strong> 分开</span>
								<div id="key">
									'.$s_html.'
								</div>
								');
						}else{
							echo(' <span class="gray">多个关键字之间用  <strong>;</strong> 分开</span>');
						}
					?>
					
					</td>
			</tr>		
			<tr class="bright">
				<td style="width: 100px"><span>价格</span></td>
				<td class="right_none">€ <input id="Vcl_Price" name="Vcl_Price"
					value="<?php echo($o_table->getPrice())?>" type="text" style="width:50px"/> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="width: 100px"><span>网址</span></td>
				<td class="right_none"><input id="Vcl_Web" name="Vcl_Web"
					value="<?php echo($o_table->getWeb())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>电话</span></td>
				<td class="right_none"><input id="Vcl_Tel" name="Vcl_Tel"
					value="<?php echo($o_table->getTel())?>"
					type="text" style="width:300px"/> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td style="vertical-align: top;"><span>介绍</span></td>
				<td class="right_none"><script id="editor" type="text/plain"><?php echo($o_table->getContent())?></script></td>
			</tr>
			<tr class="bright">
				<td style="width: 100px"><span>发送群体</span></td>
				<td class="right_none">
					<input style="width:15px" id="e-learning" name="e-learning" type="checkbox" /> <strong>旅行社组</strong>
					&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:15px" id="media" name="media" type="checkbox" /> <strong>媒体组</strong>
					&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:15px" id="travel" name="travel" type="checkbox" /> <strong>大众组</strong>
				</td>	
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="regionAddSubmit()">提交</div>
		<div class="subButton2" onclick="history.go(-1)">取消</div>
		</div>
		</div>
		<input type="hidden" name="Vcl_Content" id="Vcl_Content" value="" />
		<input type="hidden" name="Vcl_RegionId" value="<?php echo($_GET['id'])?>"/> </form>
		</td>
	</tr>
</table>
</div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
	<script type="text/javascript">
	<?php 
	echo ('document.getElementById("Vcl_CityId").value='.$o_table->getCityId().';');
	echo ('document.getElementById("Vcl_TypeId").value='.$o_table->getTypeId().';');
	?>
   //实例化编辑器
	var editor = new UE.ui.Editor({ initialFrameWidth:680});
	editor.render("editor");
    //UE.getEditor('editor');
    setInterval(resizeLeaveRight,100);
    parent.parent.Common_CloseDialog();
    
</script>
</body>
</html>