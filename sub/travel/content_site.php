<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
$o_item=new Travel_Item($_GET['id']);
if ($o_item->getState()!=1)
{
	echo ('<script>parent.location=\'index.php\'</script>');
	echo ('<script>location=\'index.php\'</script>');
	exit ( 0 );	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/common.css" />

    <script src="../../js/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
	    $(window).load(function(){resizeSite();parent.Common_CloseDialog()});
        function resizeSite()
        {
            try{
                var sl = parent.document.getElementsByTagName("iframe")[0].contentWindow.document.body.scrollHeight
                var obj=parent.document.getElementsByTagName("iframe")[0]
                $(obj).height(sl)  
            } catch(e)
            {
            window.alert(e)
            }  
        }
    </script>

</head>
<body class="content_site">
    <div style="color: #F08300; font-size: 18px;">
        <?php echo($o_item->getName())?></div>
    <div style="height:25px;"></div>
        <?php 
        $s_timetype='';
    	//建立行程介绍
    	$o_detail=new Travel_Detail();
    	$o_detail->PushWhere ( array ('&&', 'ItemId', '=',$_GET['id']) );
    	$o_detail->PushOrder ( array ('StartHour', 'A' ) );
		$n_count=$o_detail->getAllCount();
		for($i=0;$i<$n_count;$i++)		
		{
			$s_this=getTimeType($o_detail->getStartHour($i),$o_detail->getEndHour($i));
			//为了不重复显示时间类型
			if ($s_this==$s_timetype)
			{
				$s_this='';
			}else{
				$s_timetype=$s_this;
			}
			if ($o_detail->getRegionId($i)==0)
			{
						echo('
			<table style="width: 800px;font-size:14px;margin-top:20px;margin-left:19px;" border="0" cellpadding="0" cellspacing="0">
		        <tr>
		            <td style="vertical-align:top; width:90px; text-align:right">
		            '.$s_this.'
		            </td>
		            <td style="vertical-align:top;padding-right:108px;color:#F08300; font-size:12px;line-height:20px;">
		            '.$o_detail->getExplain($i).'
		            </td>
		        </tr>      
		    </table>
			');		
			}else{
			$o_region=new View_Library_Region($o_detail->getRegionId($i));
			echo('
			<table style="width: 800px;font-size:14px;margin-top:20px;margin-left:19px;" border="0" cellpadding="0" cellspacing="0">
		        <tr>
		            <td style="vertical-align:top; width:90px;text-align:right">
		            '.$s_this.'
		            </td>
		            <td style="vertical-align:top;text-align:left;width:710px;">
		            <a href="javascript:;" title="点击查看详情" hidefocus="true" onclick="$(\'#box_'.$i.$o_detail->getRegionId($i).'\').slideToggle()">'.$o_region->getCityName().'-'.$o_region->getName().'</a><br />
		            </td>
		        </tr>
		        <tr>
		            <td colspan="2" style="margin:0px;padding:0px;padding-left:0px">
		                <div id="box_'.$i.$o_detail->getRegionId($i).'" style="margin:0px;margin-top:20px;width:747px;display:none">
		                <div style="background-image:url(\'images/site_box_bj_top.png\');height:50px"><div class="button_close" onclick="$(\'#box_'.$i.$o_detail->getRegionId($i).'\').slideToggle()"></div></div>
		                <div style="background-image:url(\'images/site_box_bj_center.png\');">
		                    <iframe id="main" marginwidth="0" border="0" frameborder="0" src="content_site_photo.php?id='.$o_detail->getRegionId($i).'"
		                            scrolling="no" style="height: 320px; width: 730px; margin-left:10px;overflow-x: hidden; overflow-y: hidden;"></iframe>
		                    <div style="margin-top:10px;margin-left:45px;margin-right:40px;" class="travel_content">
		                    '.$o_region->getContent().'		                    
		                    </div>
		                    <div style="margin-top:20px;margin-left:45px;padding-left:20px;font-size:12px;background-image:url(\'images/site_box_address.png\'); background-position:left center; background-repeat:no-repeat">
		                    地址：'.$o_region->getStreet().' '.$o_region->getAddress().', '.$o_region->getZip().'
		                    </div>
		                    <div style="margin-top:5px;margin-left:45px;padding-left:20px;font-size:12px;background-image:url(\'images/site_box_web.png\'); background-position:left center; background-repeat:no-repeat">
		                    网址：'.$o_region->getWeb().'
		                    </div>
		                    <div style="margin-top:5px;margin-left:45px;padding-left:20px;font-size:12px;background-image:url(\'images/site_box_phone.png\'); background-position:left center; background-repeat:no-repeat">
		                    电话：'.$o_region->getTel().'
		                    </div>
		                </div>
		                <div style="background-image:url(\'images/site_box_bj_down.png\');height:35px"></div>
		                <div style="height:15px"></div>
		                </div>
		            </td>
		        </tr>  
		        <tr>
		            <td style="vertical-align:top; width:90px; text-align:right">
		            </td>
		            <td style="vertical-align:top;padding-right:108px;padding-top:5px;color:#F08300; font-size:12px;line-height:20px;top;text-align:left">
		            '.$o_detail->getExplain($i).'
		            </td>
		        </tr>      
		    </table>
			');		
			}

		}
    	?>
    <script type="text/javascript">
        setInterval(resizeSite,30);
    </script>

</body>
</html>
