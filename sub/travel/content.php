<?php
require_once 'include/it_head.inc.php';
//判断是否为手机，如果不是，那么需要跳转道PC版
if (isMobile())
{
	echo ('<script>location=\'content_mobile.php?id='.$_GET['id'].'\'</script>');
	exit ( 0 );
}
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
if (isset ( $_COOKIE ['SESSIONID'] )) {

} else {
	echo ('<script>location=\''.RELATIVITY_PATH.'index.php\'+\'?url=\'+document.location</script>');
	exit ( 0 );
}
//验证是否是激活邮箱用户
if (isset ( $_GET ['activation_code'] )) {
	//开始激活邮箱
	$s_html = '';
	$o_user = new User ();
	$o_user->PushWhere ( array ('&&', 'ActivationCode', '=', $_GET ['activation_code'] ) );
	if ($o_user->getAllCount () > 0) {
		
		//邮箱激活成功，开始使用
		$o_user = new User ( $o_user->getUid ( 0 ) );
		$o_user->setActivationCode ( '' ); //激活邮箱只能一次，所以为了不让学员二次激活，清掉激活码。
		$o_user->Save ();
		//自动登录
		$n_uid = $o_user->getUid ();
		require_once RELATIVITY_PATH . 'include/bn_user.class.php';
		$o_user = new Single_User ();
		$o_user->AutoLogin ( $n_uid );
		$s_html = '<script type="text/javascript">Dialog_Success("恭喜：邮箱邮件成功！<br/>点击确认，即可开启荷兰行程之旅！")</script>';
	}
}
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
$o_operate=new Bn_Basic();
$o_user = new User ( $O_Session->getUid () );
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
    <link rel="stylesheet" type="text/css" href="css/common.css" />

    <script src="../../js/jquery.min.js" type="text/javascript"></script>

    <script src="js/index.fun.js" type="text/javascript"></script>

    <script src="../../js/ajax.class.js" type="text/javascript"></script>

    <script src="../../js/common.fun.js" type="text/javascript"></script>

    <script type="text/javascript" src="js/dialog.fun.js"></script>

</head>
<body>
    <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                &nbsp;
            </td>
            <td style="width: 986px">
                <div style="width: 986px; height: 135px;">                
                    <div class="sina" style="margin-left: 84px">
                    </div>
                    <div class="weichat">
                    </div>
                    <div class="top_button" style="margin-left: 33px">
                        <a href="http://www.hollandtravelexpert.com/sub/student/index.php" target="_blank">荷兰旅游专家</a></div>
                    <div class="top_button" style="display:none">
                        <a href="javascript:;" target="_blank">荷兰礼品订购网</a></div>
                    <?php 
                //登陆后，显示顶部导航--------------------------------------？？？
                if ($o_user->getType () == 1 || $o_user->getType () == 2) {
					$s_button = '
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/travel/index.php\'" class="top_nav" style="margin-left:740px">行程网</div>
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/library/index.php\'" class="top_nav" style="margin-left:800px">资料库</div>
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/student/index.php\'" class="top_nav" style="margin-left:860px">旅游专家</div>
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/ucenter/index.php\'" class="top_nav" style="margin-left:930px">专家后台</div>';
					echo($s_button);
                }
                ?>
                    <img style="margin-top: 44px; float: right" alt="" src="images/logo_1.png" />
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr style="background-color: #55CDE6">
            <td>
                &nbsp;
            </td>
            <td style="width: 986px">
                <div style="width: 986px; height: 47px;">
                    <div class="logo" onclick="location='index.php'">
                    </div>
                    <div class="nav" id="nav">
                    <?php 
                   	//构建菜单
                   	$o_type=new Travel_Type();
                    $o_type->PushWhere ( array ('&&', 'Delete', '=',0) );
                    $o_type->PushWhere ( array ('&&', 'State', '=',1) );
					$o_type->PushOrder ( array ('Number', 'A' ) );
					$n_count=$o_type->getAllCount();
					$n_count_nav=4;
					if ($n_count<4)
					{
						$n_count_nav=$n_count;
					}
					for($i=0;$i<$n_count_nav;$i++)		
					{
							echo('<div class="nav_but" id="nav'.$o_type->getTypeId($i).'" onclick="changeNavForList(this)">'.$o_type->getName($i).'</div>');
					}
					if ($n_count>4)
					{
						echo('
						<ul class="nav_but2 home" style="position:absolute; margin-top:16px;margin-left:50px;width:100px;">
                            <li>
                                <div class="more" id="nav0" onclick="changeNavForList(this)">更多</div>
                            </li>
                        </ul>
						');
					}
                    ?>
                    </div>
                    <div class="login">
                        <?php 
                   
                    if ($O_Session->Login () == false) //没有登录
					{	
						?>
						<form method="post" id="submit_form"
					action="../../include/bn_submit.svr.php?function=Login"
					enctype="multipart/form-data" target="ajax_submit_frame"
					style="width: 100%" onsubmit="this.submit();Common_OpenLoading();">				
                        
                        <img alt="" src="images/login_username.png"/>
                        <div>用户名</div>
                        <input id="Vcl_UserName" name="Vcl_UserName" type="text" value="可用荷兰专家账号" onfocus="inputOnfocus(this)" onblur="checkInputUserName(this)" />
                        <img alt="" src="images/login_password.png" />
                        <div>密码</div>
                        <input id="Vcl_Password" name="Vcl_Password" type="password" />
                        <div class="line"></div>
                        <div class="but" title="点击后登录荷兰行程网" onclick="document.getElementById('submit_form').onsubmit();">登陆<br/><input type="submit" style="border:0px;width:0px;height:0px;background-color:#55CDE7;" value=""/></div>
                        <div class="line"></div>
                        <div class="but" onclick="location='register_1.php'">注册</div>
                        <div class="line"></div>
                        <div class="but" onclick="location='contact.php'">联系我们</div>
                        <div class="line"></div>                        
                        <input type="hidden" name="Vcl_Url" value="<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; ?>"/> 
                        </form>
						<?php
					}else{
						?>
						<div>欢迎你 : <?php echo($o_user->getUserName())?></div>
						<div class="line"></div>
                        <div class="but" title="修改登录密码" onclick="location='modify_password.php'">修改密码</div>
                        <div class="line"></div>
                        <div class="but" onclick="location='contact.php'">联系我们</div>
                        <div class="line"></div>
                        <div class="but" title="退出登录" onclick="Dialog_Confirm('确定退出荷兰行程网吗？',function(){location='../../index.php?loginout=1'})">退出</div>
                        <div class="line"></div>
						<?php
					}
                    ?>
                    </div>
                </div>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td style="background-image: url('images/bj1.png'); background-repeat: no-repeat;
                background-position: bottom right">
                &nbsp;
            </td>
            <td style="width: 986px; background-image: url('images/bj2.png'); background-repeat: no-repeat;
                background-position: bottom left">
                <div style="width: 926px; padding-top: 85px; padding-left: 30px; padding-right: 30px;
                    padding-bottom: 100px; overflow: hidden">
                    <div style="margin-left: 36px; width: 864px; overflow: hidden">
                    <?php 
                    for($i=0;$i<$n_count_nav;$i++)		
					{
						echo('
						<div class="list1" id="'.$o_type->getTypeId($i).'">
	                    	<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
						');
						$o_temp=new Travel_Title();
                    	$o_temp->PushWhere ( array ('&&', 'TypeId', '=', $o_type->getTypeId($i)) );
						$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
						$o_temp->PushOrder ( array ('Date', 'D' ) );
						$n_count_title=$o_temp->getAllCount();
						for($j=0;$j<10000;$j++)
						{
							if ($j>$n_count_title)
							{
								break;
							}
							echo('
							<tr>
							');
							if ($j<$n_count_title)
							{
								echo('<td><a href="content.php?id='.$o_temp->getTitleId($j).'">'.$o_temp->getName($j).'</a></td>');
							}else{
								echo('<td></td>');
							}
							$j++;
							if ($j<$n_count_title)
							{
								echo('<td><a href="content.php?id='.$o_temp->getTitleId($j).'">'.$o_temp->getName($j).'</a></td>');
							}else{
								echo('<td></td>');
							}
							$j++;
							if ($j<$n_count_title)
							{
								echo('<td><a href="content.php?id='.$o_temp->getTitleId($j).'">'.$o_temp->getName($j).'</a></td>');
							}else{
								echo('<td>&nbsp;</td>');
							}
							echo('
							</tr>
							');
						}
						echo('
							</table>
	                    </div>
						');
					}
                    ?>   
	                    <div class="list1" id="0">
	                    <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
	                    <?php 
	                	for($i=4;$i<$n_count;$i++)
	                	{
	                		echo('<tr>
		                    		<td class="list1_title">
		                    		'.$o_type->getName($i).'
		                    		</td><td class="list1_list">');
	                		$o_temp=new Travel_Title();
	                    	$o_temp->PushWhere ( array ('&&', 'TypeId', '=', $o_type->getTypeId($i)) );
							$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
							$o_temp->PushOrder ( array ('Date', 'D' ) );
							$n_count_title=$o_temp->getAllCount();
							for($j=0;$j<$n_count_title;$j++)
							{
								if (($j+1)>=$n_count_title)
								{
									echo('<a href="content.php?id='.$o_temp->getTitleId($j).'">'.$o_temp->getName($j).'</a>');
								}else{
									echo('<a href="content.php?id='.$o_temp->getTitleId($j).'">'.$o_temp->getName($j).'</a><a class="duan">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</a>');
								}
							}
	                		echo('</td></tr>');
	                	}
	                	?> 
	                    </table>
	                    </div>
                        <div style="background-color: White; padding: 8px; overflow: hidden;">
                            <div style="float: left; width: 286px; height: 295px; background-image: url('images/content_logo.jpg')">
                                <div style="margin-top: 24px; margin-left: 26px; font-size: 30px; color: White; width: 140px;">
                                    <?php echo($s_type_name);?></div>
                            </div>
                            <img style="margin-left: 8px; float: right; width: 552px; height: 295px" alt="" src="<?php echo($o_title->getPhoto());?>" />
                        </div>
                        <div style="background-color: White; margin-top: 15px; padding: 35px 40px 35px 40px">
                            <div style="color: #F08300; font-size: 24px;">
                               <?php echo($o_operate->TravelNumberFormat($o_title->getTitleId()).' '.$o_title->getName());?>
                            </div>
                            <div class="travel_content">
                                <?php echo($o_title->getExplain());?>
                            </div>
                        </div>
                        <div style="background-color: White; margin-top: 15px; padding: 30px 25px 25px 25px">
                            <div style="color: #F08300; font-size: 18px; margin-left: 14px;">
                                详细行程：
                            </div>
                            <div class="content_site_icon">
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
                            	if ($i==0)
                            	{
                            		echo('<div class="on" onclick="changeSet(this,'.$o_site->getItemId($i).')"><img src="images/content_site_icon_'.$i.'.png" /></div>');
                            	}else{
                            		echo('<div onclick="changeSet(this,'.$o_site->getItemId($i).')"><img src="images/content_site_icon_'.$i.'.png" /></div>');
                            	}
                            }
                            ?>
                            </div>
                        </div>
                        <iframe id="main" marginwidth="0" border="0" frameborder="0" src="content_site.php?id=<?php echo($o_site->getItemId(0))?>"
                            scrolling="no" style="height: 1000px; width: 864px; overflow-x: hidden; overflow-y: hidden;">
                        </iframe>
                        <div class="share" style="overflow: hidden;">
                            <div class="button" align="center" title="将当前页面下载到邮箱" onclick="<?php 
                            //如果是注册用户，直接下载到邮箱
                            if($O_Session->Login () == false)
                            {
                            	echo('Dialog_Iframe(\'dialog/download_travel.php?id='.$o_title->getTitleId().'\',254,230)');
                            }else{
                            	echo('downTravel('.$o_title->getTitleId().')');
                            }
                            //如果是未注册用户，需要填写邮箱与手机号
                            ?>">
                                下载</div>
                                <?php 
                                if($O_Session->Login () == true)
                            {
                            	echo('<div class="button" align="center" title="将当前页面下载到邮箱" onclick="window.open(\'download_travel.php?id='.$o_title->getTitleId().'\',\'_blank\')">打印</div>');
                            }
                                ?>
                            <div class="sina2" title="分享到新浪微博" onclick="sinaWeibo('这个行程不错，看看吧！！','http://www.hollandtravelexpert.com/sub/travel/content.php?id=<?php echo($_GET['id']);?>','http://www.hollandtravelexpert.com/sub/travel/images/logo.png')">
                            </div>
                            <div class="qqweibo" title="分享到腾讯微博" onclick="qqWeibo('这个行程不错，看看吧！！','http://www.hollandtravelexpert.com/sub/travel/content.php?id=<?php echo($_GET['id']);?>','http://www.hollandtravelexpert.com/sub/travel/images/logo.png')">
                            </div>
                            <div class="qqzone" title="分享到QQ空间" onclick="qqZone('这个行程不错，看看吧！！','http://www.hollandtravelexpert.com/sub/travel/content.php?id=<?php echo($_GET['id']);?>','http://www.hollandtravelexpert.com/sub/travel/images/logo.png')">
                            </div>
                            <div class="weichat2" title="分享到微信" onclick="Dialog_Iframe('dialog/code.php?id=<?php echo($_GET['id'])?>',530,270)">
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr style="background-color: #F08300">
            <td>
                &nbsp;
            </td>
            <td style="width: 986px; padding: 10px 0px 40px 0px;">
                <div style="width: 936px; padding: 0px 0px 0px 30px">
                   <?php 
                //读取广告
                $o_ad=new Travel_Advert();
                $o_ad->PushWhere ( array ('&&', 'State', '=', 1) );
                $o_ad->PushOrder ( array ('Number', 'A' ) );
                $n_count3=$o_ad->getAllCount();
                for($i=0;$i<$n_count3;$i++)
                {
                	$s_target='_parent';
                	if ($o_ad->getOpen($i)==1)
                	{
                		$s_target='_blank';
                	}
                	echo('
                	<div class="ad">
                		<a href="'.$o_ad->getUrl($i).'" target="'.$s_target.'"><img alt="" src="'.$o_ad->getOnout($i).'" /></a>
                    </div>
                	');
                }
                ?>        
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr style="background-color: #55CDE6">
            <td>
                &nbsp;
            </td>
            <td style="width: 986px; height: 56px; vertical-align: top">
                <div style="padding-left: 20px; padding-top: 20px;">
                    Copyright c2008 Holland.com.cn All rights reserved&nbsp;&nbsp;&nbsp;&nbsp;荷兰国家旅游会议促进局官方网站&nbsp;&nbsp;&nbsp;&nbsp;版权所有&nbsp;&nbsp;&nbsp;&nbsp;京ICP备08103526号</div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
    </table>
    <?php 
    $o_title->setVisit($o_title->getVisit()+1);
    $o_title->Save();
    ?>
      <iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
    <div id="master_box_bj" style="position: absolute; background-color: Black; width: 0px;
        height: 0px; z-index: 1999; left: 0px; top: 0px;">
    </div>
    <div id="master_box" style="position: absolute; z-index: 2000; left: 0px; top: 0px;">
    </div>
    <div id="master_box_loading" style="position: absolute; z-index: 2001; left: 0px;
        top: 0px;">
    </div>
</body>
</html>
