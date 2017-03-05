<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
$o_table=new Travel_Detail($_GET['detailid']);
$i=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="../netdisk/css/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
	    
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
<div align="center">
<table class="main" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<td class="center">
		<div class="list out">
		<div class="title">
		<div>预览</div>
		<div class="subButton" onclick="rightGoTo('travel_detail_modify.php?detailid=<?php echo($_GET['detailid'])?>')">修改</div>
		</div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr class="dark">
				<td style="width:100px"><span style="font-weight:bold">时间</span></td>
				<td class="right_none" style="font-size:14px">
					<?php 
					echo($o_table->getStartHour () . ':' . $o_table->getStartMin () . ' 至 ' . $o_table->getEndHour () . ':' . $o_table->getEndMin ());
					?>
				</td>
				<?php 
				if ($o_table->getRegionId()>0)
				{
					$i=$i+1;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					$o_region=new View_Library_Region($o_table->getRegionId());
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								类型
							</span>
						</td>
						<td class="right_none" style="font-size:14px">
							'.$o_region->getTypeName().'
						</td>
					</tr>
					');
				}
				?>
				<?php 
				if ($o_table->getCityId()>0)
				{
					$i=$i+1;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					$o_city=new Library_City($o_table->getCityId());
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								城市
							</span>
						</td>
						<td class="right_none" style="font-size:14px">
							'.$o_city->getName().'
						</td>
					</tr>
					');
				}
				?>
				<?php 
				/*if ($o_table->getHotelId ()!=''){
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}

    					$a_hotel=json_decode($o_table->getHotelId ()); 
    					for($j=0;$j<count($a_hotel);$j++)
    					{
    						$o_temp=new Library_Hotel($a_hotel[$j]);
    						$s_html.='<div style="padding:0px 5px 5px 5px;"><span style="color:#0F85B7;font-weight:bold">'.$o_temp->getName().'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$'.$o_temp->getPrice().'/天</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:green;font-size:12px" href="javascript:;" onclick="$(\'#hotel_'.$a_hotel[$j].'\').slideToggle(function(){resizeLeaveRight()})">信息</a>
    										<div style="display:none;margin-left:15px;width:750px;" id="hotel_'.$a_hotel[$j].'">'.$o_temp->getContent().'</div>
    								  </div>';
    					}   								
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								入住酒店
							</span>
						</td>
						<td class="right_none" style="font-size:14px">
							'.$s_html.'
						</td>
					</tr>
					');
				}*/
				?>
				<?php 
				if ($o_table->getRegionId()>0)
				{
					$o_region=new Library_Region($o_table->getRegionId());
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					//名称
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								名称
							</span>
						</td>
						<td class="right_none">
							'.$o_region->getName().'
						</td>
					</tr>
					');
					//地址
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								地址
							</span>
						</td>
						<td class="right_none">
							'.$o_city->getName().'-'.$o_region->getStreet().'-'.$o_region->getAddress().'
						</td>
					</tr>
					');
					//邮编
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								邮编
							</span>
						</td>
						<td class="right_none">
							'.$o_region->getZip().'
						</td>
					</tr>
					');
					//网址
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								网址
							</span>
						</td>
						<td class="right_none">
							'.$o_region->getWeb().'
						</td>
					</tr>
					');
					//电话
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								电话
							</span>
						</td>
						<td class="right_none">
							'.$o_region->getTel().'
						</td>
					</tr>
					');
					//简介
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								介绍
							</span>
						</td>
						<td class="right_none">
							<div style="font-size:18px;font-weight:bold;width:760px;text-align:center">'.$o_city->getName().' —— '.$o_region->getName().'&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:green;font-size:12px" href="javascript:;" onclick="$(\'#content\').slideToggle(function(){resizeLeaveRight()})">详细信息</a></div>
							<div id="content" style="display:none;margin-top:20px;width:760px">
								'.$o_region->getContent().'
							</div>
						</td>
					</tr>
					');
					//图片
					$i++;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					$o_image = new Library_Region_Photo (); 
					$o_image->PushWhere ( array ('&&', 'RegionId', '=', $o_table->getRegionId()) );
					$o_image->PushOrder ( array ('Id', 'D' ) );
					$n_count = $o_image->getAllCount ();
					//获取部门名称
					for($j = 0; $j < $n_count; $j ++) { //按条数循环显示
						//查询酒店数
						$s_list .= '
								<div style="float:left;width:150px;height:107px;margin-left:5px;margin-top:5px">
								
			                                  <a href="'.RELATIVITY_PATH.$o_image->getImage($j).'" target="_blank"><img style="width:150px;height:107px;" src="'.RELATIVITY_PATH.$o_image->getIcon($j).'" alt="" /></a>
			                                  
			                    </div>	
					';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								图片
							</span>
						</td>
						<td class="right_none">
							'.$s_list.'
						</td>
					</tr>
					');
				}
				?>
			</tr>	
			<?php 
				if ($o_table->getExplain()!='')
				{
					$i=$i+1;
					$s_class = 'bright';
					if (abs ( $i % 2 ) == 0) {
						$s_class = 'dark';
					}
					echo('
					<tr class="'.$s_class.'">
						<td style="vertical-align: top;">
							<span style="font-weight:bold">
								备注
							</span>
						</td>
						<td class="right_none" style="font-size:14px">
							'.$o_table->getExplain().'
						</td>
					</tr>
					');
				}
				?>		
		</table>
		<div class="page" style="padding-left: 120px">
		<div class="subButton" onclick="rightGoTo('travel_detail_modify.php?detailid=<?php echo($_GET['detailid'])?>')">修改</div>
		</div>
		</div>
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