<?php
require_once 'include/it_head.inc.php';
//判断是否为手机，如果不是，那么需要跳转道PC版
if (isMobile()==false)
{
	echo ('<script>location=\'content.php?id='.$_GET['id'].'\'</script>');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
if (isset ( $_COOKIE ['SESSIONID'] )) {

} else {
	echo ('<script>location=\''.RELATIVITY_PATH.'index.php\'+\'?url=\'+document.location</script>');
	exit ( 0 );
}

require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
$o_operate=new Bn_Basic();
$o_title=new Travel_Title($_GET['id']);
if ($o_title->getState()!=1)
{
	echo ('<script>location=\'index.php\'</script>');
	exit ( 0 );	
}
$s_type_name='';
$o_temp=new Travel_Type($o_title->getTypeId());
$s_type_name=$o_temp->getName();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>荷兰行程网</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"
        name="viewport" />
    <link rel="stylesheet" type="text/css" href="css/mobile.css" />

    <script src="../../js/jquery.min.js" type="text/javascript"></script>

    <script src="js/mobile.fun.js" type="text/javascript"></script>

</head>
<body>
	<img class="go_top" onclick="scroll(0,0)" alt="" src="images/mobile/go_top.png" />
	<div class="top">
		<img alt="" src="images/mobile/top.png" />
	</div>
	<div class="see_all_travel" onclick="$('.menu').slideToggle()">
        	查看全部行程
        <div class="menu">
        <?php 
        //读取全部行程
        $o_temp_travel=new Travel_Title();
		$o_temp_travel->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_temp_travel->PushOrder ( array ('TitleId', 'A' ) );
		$n_count=$o_temp_travel->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			echo('
			<div onclick="location=\'content_mobile.php?id='.$o_temp_travel->getTitleId($i).'\'">'.$o_operate->TravelNumberFormat($o_temp_travel->getTitleId($i)).' '.$o_temp_travel->getName($i).'</div>
			');
		}
        ?>
        </div>
	</div>
	<div class="travel_number"><?php echo($o_operate->TravelNumberFormat($o_title->getTitleId()));?></div>
	<div class="travel_title">
        <div><?php echo($o_title->getName());?></div>
    </div>
    <img alt="" src="<?php echo($o_title->getPhoto());?>" />
    <div class="travel_content">
        <div class="content">
            <?php echo($o_title->getExplain());?>
        </div>
    </div>  
    <img class="travel_detail" alt="" src="images/mobile/detail.png" /> 
    <div style="height: 25px;">
    </div> 
    <?php 
    //构建详细行程
    $o_site=new Travel_Item();
    $o_site->PushWhere ( array ('&&', 'TitleId', '=',$o_title->getTitleId()) );
    $o_site->PushWhere ( array ('&&', 'State', '=',1) );
    $o_site->PushOrder ( array ('Number', 'A' ) );
    $n_count=$o_site->getAllCount();
    for($i=0;$i<$n_count;$i++)
    {
    	if ($i>8)
        {
        	break;
        }
        //盒子头
		echo('
			<div class="travel_day day'.($i+1).'">
				<div class="day_title" onclick="$(\'#'.($i+1).'\').slideToggle()">
            		<img class="travel_detail" alt="" src="images/mobile/day'.($i+1).'.jpg" />
            		<div>0'.($i+1).'</div>
        		</div>
        		<div class="box" id="'.($i+1).'">
		');
		$s_timetype='';
    	//建立行程介绍
    	$o_detail=new Travel_Detail();
    	$o_detail->PushWhere ( array ('&&', 'ItemId', '=',$o_site->getItemId($i)) );
    	$o_detail->PushOrder ( array ('StartHour', 'A' ) );
		$n_count2=$o_detail->getAllCount();
		for($j=0;$j<$n_count2;$j++)		
		{
			$s_this=getTimeType($o_detail->getStartHour($j),$o_detail->getEndHour($j));
			//为了不重复显示时间类型
			if ($s_this==$s_timetype)
			{
				$s_this='&nbsp;';
			}else{
				$s_timetype=$s_this;
			}
			if ($o_detail->getRegionId($j)==0)
			{
						echo('
						<div class="travel_setp">
                			<div>
                    			'.$s_this.'
                			</div>
                			<div class="name">
                    			'.$o_detail->getExplain($j).'
                			</div>
            			</div>
			');		
			}else{
				$o_region=new View_Library_Region($o_detail->getRegionId($j));
				echo('
					<div class="travel_setp">
		                <div>
		                    '.$s_this.'
		                </div>
	                <div class="name click" onclick="region_click(this,'.$o_region->getRegionId().')">
	                    '.$o_region->getCityName().'-'.$o_region->getName().'
	                </div>
	            </div>
	            <div class="region" id="region_'.$o_region->getRegionId().'" >
	                <iframe marginwidth="0" id="region_'.$o_region->getRegionId().'_photo" border="0" frameborder="0" src="" scrolling="no" style="height: 200px; width: 100%; overflow-x: hidden; overflow-y: hidden;">
	                </iframe>
	                <div class="tips">可用手指左右滑动</div>
	                <div class="region_content">
	                	'.$o_region->getContent().'	 
	                </div>
	                <div class="region_contact">
	                    <img alt="" src="images/site_box_address.png" /> 地址：'.$o_region->getStreet().' '.$o_region->getAddress().', '.$o_region->getZip().'<br/>
	                    <img alt="" src="images/site_box_web.png" /> 网址：'.$o_region->getWeb().'<br/>
	                    <img alt="" src="images/site_box_phone.png" /> 电话：'.$o_region->getTel().'<br/>
	                </div>
	            </div>
	            <div class="travel_setp" style="padding-top: 0px">
	                <div>
	                    &nbsp;
	                </div>
	                <div class="name explain">
	                   '.$o_detail->getExplain($j).'
	                </div>
	            </div>
				');
			}
		}
		//盒子尾
		echo('
				<div class="close" onclick="$(\'#'.($i+1).'\').slideToggle()">
	                <img alt="" src="images/mobile/close.png" />
	            </div> 
				</div>
			</div>
			');
    	
    }
    ?>
<div class="footer">
        <div class="code">
            <img alt="" src="images/mobile/code.png" />
        </div>
        <div class="footer_text">
            请将二维码存入手机，打开微信扫一扫，选择手机相册，<br />
            关注荷兰旅游局官方微信，获取更多的行程资料！
        </div>
        <div class="share">
            <img alt="" src="images/mobile/sina.png" onclick="sinaWeibo('这个行程不错，看看吧！！','http://www.hollandtravelexpert.com/sub/travel/content.php?id=<?php echo($_GET['id']);?>','http://www.hollandtravelexpert.com/sub/travel/images/logo.png')"/><img
                alt="" src="images/mobile/tengxun.png" onclick="qqWeibo('这个行程不错，看看吧！！','http://www.hollandtravelexpert.com/sub/travel/content.php?id=<?php echo($_GET['id']);?>','http://www.hollandtravelexpert.com/sub/travel/images/logo.png')"/><img
                    alt="" src="images/mobile/qq.png" onclick="qqZone('这个行程不错，看看吧！！','http://www.hollandtravelexpert.com/sub/travel/content.php?id=<?php echo($_GET['id']);?>','http://www.hollandtravelexpert.com/sub/travel/images/logo.png')"/>
        </div>
        <div class="footer_text">
            联系方式：北京代表处<br />
            北京市光华东里8号院中海广场南楼1603室 邮编：100020<br />
            邮箱：PM-NBTC-INFO-CN@holland.com
        </div>
    </div>    
</body>
</html>
