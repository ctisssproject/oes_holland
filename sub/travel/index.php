<?php
require_once 'include/it_head.inc.php';
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
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
$o_operate=new Bn_Basic();
$O_Session = new Session ();
$o_user = new User ( $O_Session->getUid () );
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
                        <div>
                    <?php 
                //登陆后，显示顶部导航--------------------------------------？？？
                if ($o_user->getType () == 1 || $o_user->getType () == 2) {
					$s_button = '
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/travel/index.php\'" class="top_nav" style="margin-left:390px">行程网</div>
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/library/index.php\'" class="top_nav" style="margin-left:450px">资料库</div>
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/student/index.php\'" class="top_nav" style="margin-left:510px">旅游专家</div>
					<div onclick="location=\'' . RELATIVITY_PATH . 'sub/ucenter/index.php\'" class="top_nav" style="margin-left:580px">专家后台</div>';
					echo($s_button);
                }
                ?>
                </div>
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
                    //输出分类导航
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
						if ($i==0)
						{
							echo('<div id="nav'.$o_type->getTypeId($i).'" class="nav_but nav_but_on" onclick="changeNav(this)">'.$o_type->getName($i).'</div>');
						}else{
							echo('<div class="nav_but" id="nav'.$o_type->getTypeId($i).'" onclick="changeNav(this)">'.$o_type->getName($i).'</div>');
						}
					}
					if ($n_count>4)
					{
						for($i=4;$i<$n_count;$i++)		
						{
							$s_sub.='<li id="nav'.$o_type->getTypeId($i).'" onclick="changeNav(this);$(\'#menu\').hide();">'.$o_type->getName($i).'</li><br />';
						}
						echo('
						<ul class="nav_but2 home" style="position:absolute; margin-top:16px;margin-left:50px;width:100px;">
                            <li>
                                <div class="more" onclick="if($(\'#menu\').is(\':hidden\')==true)$(\'#menu\').show();else $(\'#menu\').hide()" onblur="setTimeout(\'hidesubmenu()\',200)">更多</div>
                            </li>
                            <br />
                            <li>
                                <ul id="menu">
									'.$s_sub.'	
                                </ul>
                            </li>
                        </ul>
						');
					}
                    ?>
                    
                    </div>
                    
                    <div class="login">
                    <?php 
                    //登陆成功后显示的文字-----------------------------------------------------？？？？？？
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
                <div style="width: 926px;padding-top:85px; padding-left:30px; padding-left:30px;padding-bottom:100px;">
                    <?php 
                    //输出行程图片部分
                    for($i=0;$i<$n_count;$i++)
                    {
                    	$s_style=' style="display:none"';
                    	if ($i==0)
                    	{
                    		$s_style='';
                    	}
                    	echo('<div class="focus_box" id="box'.$o_type->getTypeId($i).'"'.$s_style.'>');
                    	echo('	<div class="main_img">');
                    	//判断是否有图
                    	if ($o_type->getPhoto($i)=='')
                    	{
                    		echo('<a href="javascript:;"><img alt="" src="images/waiting_update.jpg" /></a>');
                    	}else{
                    		echo('<a href="content.php?id='.$o_type->getTitleId($i).'"><img alt="" src="'.$o_type->getPhoto($i).'" /></a>');
                    	}
                    	echo('	</div>');
                    	//读取其他推荐行程
                    	$o_travel=new Travel_Title();
                    	$o_travel->PushWhere ( array ('&&', 'TypeId', '=', $o_type->getTypeId($i)) );
                    	$o_travel->PushWhere ( array ('&&', 'TitleId', '<>',$o_type->getTitleId($i)) );
						$o_travel->PushWhere ( array ('&&', 'State', '=', 1 ) );
						$o_travel->PushOrder ( array ('Date', 'D' ) );
						$o_travel->setStartLine (0); //起始记录
						$o_travel->setCountLine (6);
						$n_countall = $o_travel->getAllCount ();
						$n_count2 = $o_travel->getCount ();
						echo('	  <div class="fu_img">');
						//循环输出六个行程
						for($j=0;$j<$n_count2;$j++)
						{
							$s_style2=' style="margin-right:35px;"';
							if (($j+1)%3==0)
							{
								$s_style2='';
							}
							
							echo('
							      	 <div class="mini_box"'.$s_style2.'>
                            			<a href="content.php?id='.$o_travel->getTitleId($j).'" target="_blank" hidefocus="true"><img alt="" src="'.$o_travel->getPhotoOn ($j).'" /></a>
                                		<div class="explain">
                                			'.$o_travel->getName($j).'
                                		</div>
                                		<div class="travel_number">
                                		'.$o_operate->TravelNumberFormat($o_travel->getTitleId($j)).'
                                		</div>
                                		<div class="button_1" onclick="window.open (\'content.php?id='.$o_travel->getTitleId($j).'\', \'_blank\')">
                                			详细行程
                                		</div>
                            		</div>
							');
						}
						echo('	  </div>');
						//如果不够6个那么不显示展开
						if($n_countall>6)
						{
							echo('    <div class="add">
		                            	<div class="button_2" onclick="extension(this)">+ 展开</div>
		                        	  </div>');
						}
	                    echo('</div>');
                    }
                    ?>                    
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
   <iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj"
	style="position: absolute; background-color: Black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box"
	style="position: absolute; z-index: 2000; left: 0px; top: 0px;"></div>
<div id="master_box_loading"
	style="position: absolute; z-index: 2001; left: 0px; top: 0px;"></div>
    <?php 
    echo($s_html);
    ?>
    <script type="text/javascript">
    <?php 
    //设置类型的变量
     for($i=0;$i<$n_count;$i++)
     {
     	echo('var Num'.$o_type->getTypeId($i).'=6;');
     } 
    ?>
    </script>
</body>
</html>
