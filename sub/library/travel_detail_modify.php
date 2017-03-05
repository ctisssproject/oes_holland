<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table=new Travel_Detail($_GET['detailid']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
	    <link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<script type="text/javascript" src="../ucenter/js/common.fun.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../netdisk/js/dialog.fun.js"></script>
	<script type="text/javascript" src="../netdisk/js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript" src="js/travel.fun.js"></script>
<script type="text/javascript">
	 $(window).load(function(){resizeLeaveRight();parent.parent.Common_CloseDialog()});
    </script>
</head>
<body class="iframebody">
<div align="center" style="padding-bottom:120px">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<form method="post" id="submit_form"
			action="include/bn_submit.svr.php?function=TravelDetailModify"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%"
			onsubmit="this.submit();parent.parent.Common_OpenLoading();">
		<div class="list out">
		<div class="title">
		<div>修改时间段</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td><span>开始时间</span></td>
				<td class="right_none"><select name="Vcl_StartHour" id="Vcl_StartHour"
					class="BigSelect" style="width:60px">
				<?php
				for($i=0; $i<24;$i++)
				{
					if ($i<10)
					{
						echo ('<option value="0' . $i . '"> 0' . $i . '</option>');
					}else{
						echo ('<option value="' . $i . '"> ' . $i . '</option>');
					}	
				}
				?>
				</select> : <select name="Vcl_StartMin" id="Vcl_StartMin"
					class="BigSelect" style="width:60px">
					<option value="00"> 00</option>
					<option value="05"> 05</option>
					<option value="10"> 10</option>
					<option value="15"> 15</option>
					<option value="20"> 20</option>
					<option value="25"> 25</option>
					<option value="30"> 30</option>
					<option value="35"> 35</option>
					<option value="40"> 40</option>
					<option value="45"> 45</option>
					<option value="50"> 50</option>
					<option value="55"> 55</option>
				</select> <span class="red">*</span>  9点前“早餐”，9-12点“上午”，12-14点“午餐”，14-18点“下午”，18-20“晚餐”，20点后“晚上”</td>
			</tr>
			<tr class="bright">
				<td><span>结束时间</span></td>
				<td class="right_none"><select name="Vcl_EndHour" id="Vcl_EndHour"
					class="BigSelect" style="width:60px">
				<?php
				for($i=0; $i<24;$i++)
				{
					if ($i<10)
					{
						echo ('<option value="0' . $i . '"> 0' . $i . '</option>');
					}else{
						echo ('<option value="' . $i . '"> ' . $i . '</option>');
					}	
				}
				?>
				</select> : <select name="Vcl_EndMin" id="Vcl_EndMin"
					class="BigSelect" style="width:60px">
					<option value="00"> 00</option>
					<option value="05"> 05</option>
					<option value="10"> 10</option>
					<option value="15"> 15</option>
					<option value="20"> 20</option>
					<option value="25"> 25</option>
					<option value="30"> 30</option>
					<option value="35"> 35</option>
					<option value="40"> 40</option>
					<option value="45"> 45</option>
					<option value="50"> 50</option>
					<option value="55"> 55</option>
				</select> <span class="red">*</span></td>
			</tr>
			<tr class="dark">
				<td ><span>目的地类型</span></td>
				<td class="right_none"><select name="Vcl_TypeId" id="Vcl_TypeId" class="BigSelect" style="width:auto" onchange="travelSelectCity()">
					<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;空&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
					<?php 
					$o_temp = new Library_Region_Type ();
					$o_temp->PushOrder ( array ('TypeId', 'A' ) );
					$n_count=$o_temp->getAllCount();
					for($i=0;$i<$n_count;$i++)
					{
						echo('<option value="'.$o_temp->getTypeId($i).'">&nbsp;&nbsp;'.$o_temp->getName($i).'&nbsp;&nbsp;</option>');				
					}					
					?>
				</select>
				
				</td>
			</tr>
			<tr class="bright">
				<td ><span>目的地城市</span></td>
				<td class="right_none"><select id="Vcl_CityId" name="Vcl_CityId" class="BigSelect" style="width:auto" onchange="travelSelectCity()">
					<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;空&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
					<?php 
					$o_city=new Library_City();
					$o_city = new Library_City ();
					$o_city->PushOrder ( array ('Name', 'A' ) );
					$n_count=$o_city->getAllCount();
					for($i=0;$i<$n_count;$i++)
					{
						echo('<option value="'.$o_city->getCityId($i).'">&nbsp;&nbsp;'.$o_city->getName($i).'&nbsp;&nbsp;</option>');
					}
					?>
				</select>
				<script type="text/javascript">
				<?php 
					echo ('document.getElementById("Vcl_CityId").value="' . $o_table->getCityId () . '";');
				?>
				</script>
				</td>
			</tr>
			<tr class="dark" style="display:none">
				<td style="vertical-align: top;"><span>入住酒店</span></td>
				<td class="right_none">
				<div><a style="color:green" href="javascript:;" onclick="if (document.getElementById('Vcl_CityId').value==0){parent.parent.parent.Dialog_Message('请先选择 [城市]');return}Dialog_Iframe('dialog/travel_detail_hotel_add.php?cityid='+document.getElementById('Vcl_CityId').value,350,140,'',this)">+添加</a></div>
				<div id="hotel" style="padding-top:5px;">
					<?php 
					if ($o_table->getHotelId ()!=''){
    					$a_hotel=json_decode($o_table->getHotelId ()); 
    					for($i=0;$i<count($a_hotel);$i++)
    					{
    						$o_temp=new Library_Hotel($a_hotel[$i]);
    						echo ('<div style="padding:0px 5px 0px 5px;"><input type="hidden" name="Vcl_HotelId_'.$a_hotel[$i].'" id="Vcl_HotelId_'.$a_hotel[$i].'" value="'.$a_hotel[$i].'" /><span style="color:#0F85B7;font-weight:bold">'.$o_temp->getName().'&nbsp;&nbsp;$'.$o_temp->getPrice().'/天</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:red" href="javascript:;" onclick="this.parentNode.innerHTML=\'\'">删除</a></div>');
    					}   								
    				}
					?>
				</div></td>
			</tr>
			<tr class="dark">
				<td ><span>目的地</span>
				<script type="text/javascript">
    		<?php
    		echo ('document.getElementById("Vcl_StartHour").value="' . $o_table->getStartHour () . '";');
    		echo ('document.getElementById("Vcl_StartMin").value="' . $o_table->getStartMin () . '";');
    		echo ('document.getElementById("Vcl_EndHour").value="' . $o_table->getEndHour () . '";');
    		echo ('document.getElementById("Vcl_EndMin").value="' . $o_table->getEndMin () . '";');
    		$n_cityid=0;
    		if($o_table->getRegionId ()>0)
    		{
    			$o_temp=new Library_Region($o_table->getRegionId ());
    			$n_cityid=$o_temp->getCityId ();
    			$n_typeid=$o_temp->getTypeId ();
    			echo ('document.getElementById("Vcl_TypeId").value="' . $o_temp->getTypeId () . '";');
    		}/*else if ($o_table->getHotelId ()!=''){
    			$a_hotel=json_decode($o_table->getHotelId ()); 
    			$o_temp=new Library_Hotel($a_hotel[0]);
    			$n_cityid=$o_temp->getCityId ();
    			echo ('document.getElementById("Vcl_CityId").value="' . $o_temp->getCityId () . '";');			
    		}*/
    		
    		?>
</script>
				</td>
				<td class="right_none"><div id="region">
				<?php 
				if ($n_cityid>0)
				{
					$o_temp = new Library_Region ();
					$o_temp->PushWhere ( array ('&&', 'CityId', '=', $n_cityid ) );
					$o_temp->PushWhere ( array ('&&', 'TypeId', '=', $n_typeid ) );
					$o_temp->PushOrder ( array ('Name', 'A' ) );
					$n_count = $o_temp->getAllCount ();
					$s_html = '<select name="Vcl_RegionId" id="Vcl_RegionId" class="BigSelect" style="width:auto">
					';
					
					for($i = 0; $i < $n_count; $i ++) {
						if($o_table->getRegionId ()==$o_temp->getRegionId ( $i ))
						{
							$s_html .= '<option value="' . $o_temp->getRegionId ( $i ) . '" selected="selected">&nbsp;&nbsp;' . $o_temp->getName ( $i ) . '&nbsp;&nbsp;</option>';
						}else{
							$s_html .= '<option value="' . $o_temp->getRegionId ( $i ) . '">&nbsp;&nbsp;' . $o_temp->getName ( $i ) . '&nbsp;&nbsp;</option>';
						}
						
					}
					$s_html .= '</select>';
					
					echo($s_html);	
				}else{
					$s_html = '<select name="Vcl_RegionId" id="Vcl_RegionId" class="BigSelect" style="width:auto">
									<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;空&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
									</select>';
					echo($s_html);
				}

				?></div></td>
			</tr>
			<tr class="bright">
				<td style="vertical-align: top;width:80px"><span>相关说明</span></td>
				<td class="right_none"><textarea id="Vcl_Explain" name="Vcl_Explain" cols="80" rows="15"><?php
					$s_content = $o_table->getExplain ();
					$s_content = str_replace ( "<br/>", "\n", $s_content );
					$s_content = str_replace ( '&nbsp;', ' ', $s_content );
					echo ($s_content)?></textarea></td>
			</tr>
		</table>
		<div class="page" style="padding-left: 120px">
		<input type="hidden" name="Vcl_ItemId" id="Vcl_ItemId" value="<?php echo($o_table->getItemId ())?>" />
		<input type="hidden" name="Vcl_DetailId" id="Vcl_DetailId" value="<?php echo($_GET['detailid'])?>" />
		<div class="subButton" onclick="document.getElementById('submit_form').onsubmit();">保存</div>
		<div class="subButton2" onclick="goBack()">取消</div>
		</div>
		</div>
		</form>
		</td>
	</tr>
</table>
</div>

<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
</body>
</html>