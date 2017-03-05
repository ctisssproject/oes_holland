<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ($O_Session->getUserObject());
$o_user = new User ( $O_Session->getUid () );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>荷兰旅游专家-修改登陆密码</title>
    <link type="text/css" rel="Stylesheet" href="css/publick.css" />
    <link type="text/css" rel="stylesheet" href="css/login.css" />
    <link type="text/css" rel="Stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>


    <script src="js/mobiscroll.core-2.5.2.js" type="text/javascript"></script>
    <script src="js/mobiscroll.core-2.5.2-zh.js" type="text/javascript"></script>

    <link href="css/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css" />
    <link href="css/mobiscroll.animation-2.5.2.css" rel="stylesheet" type="text/css" />
    <script src="js/mobiscroll.datetime-2.5.1.js" type="text/javascript"></script>
    <script src="js/mobiscroll.datetime-2.5.1-zh.js" type="text/javascript"></script>

    <link href="css/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/register.fun.js"></script>
    <script type="text/javascript" src="../../js/common.fun.js"></script>
    <script type="text/javascript" src="../../js/ajax.class.js"></script>
    <script type="text/javascript" src="../../js/dialogformobile.fun.js"></script> 

    <script type="text/javascript">
        $(function () {
            var currYear = (new Date()).getFullYear();
            var opt = {};
            opt.date = { preset: 'date', minDate: new Date(1950, 1, 1) };
            opt.default = {
                theme: 'android-ics light', //皮肤样式
                display: 'modal', //显示方式
                mode: 'scroller', //日期选择模式
                lang: 'zh',
                endYear: currYear - 0 //结束年份
            };

            $("#Vcl_Birthday").val('<?php echo($o_user->getBirthday())?>').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
            //var appDate = $.extend(opt['appDate'], opt['default']);
            //$("#appDate").mobiscroll(appDate).date(appDate);
        });
        function cho_sex(a) {
            if (a == "wo") {
                $(".man").css({ "background-color": "#f2f0e7", "color": "#747474" });
                $(".woman").css({ "background-color": "#ff6f00", "color": "#fff" });
                $("#Vcl_Sex").val('女');
            } else {
                $(".woman").css({ "background-color": "#f2f0e7", "color": "#747474" });
                $(".man").css({ "background-color": "#ff6f00", "color": "#fff" });
                $("#Vcl_Sex").val('男');
            }
            
        }
    </script>
</head>
<body style="background:none;">
<form method="post" id="submit_form"
			action="../../include/bn_submit.svr.php?function=ModifyInfoForMobile"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%">
    <?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =1,$s_logo=''));
	?>
    <div class="news_list_title">
        <div class="list_title_icon">
            <span class="icon-user"></span>
            <h1>修改信息</h1>
        </div>
        <div class="right_triangle"></div>
        <h2>请填写以下信息</h2>
    </div>
    <div class="sign_in_box page_2 change_info" id="form">
        <div class="per_info">
            <div class="per_info_title">
                个人信息
            </div>
            <div class="account_name">
                <h1>真实姓名（请填写中文）</h1>
                <div class="input_box">
                    <input value="<?php echo($o_user->getName())?>" type="text" id="Vcl_Name" name="Vcl_Name"/>

                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Name_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Name_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Name_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="account_birthday">
                <h1>生日</h1>
                <div class="birthday_box">
                    <input type="text" id="Vcl_Birthday" name="Vcl_Birthday" value="<?php echo($o_user->getBirthday())?>"/>
                </div>
                <div class="woman" onclick="cho_sex('wo')">女</div>
                <div class="man" onclick="cho_sex('man')">男</div>
                <?php 
                if ($o_user->getSex()=='女')
                {
                	echo('<script>
                	cho_sex(\'wo\');
                	</script>');
                }
                ?>
                <input id="Vcl_Sex" name="Vcl_Sex" value="男" type="hidden"/>
            </div>
             <div class="account_com">
                <h1>公司名称（请填写公司全称）</h1>
                <div class="input_box">
                    <input value="<?php echo($o_user->getCompany())?>" type="text" id="Vcl_Company" name="Vcl_Company" maxlength="200"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Company_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Company_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Company_no_text"></h2>
                    </div>

                </div>
            </div>
            <div class="account_com">
                <h1>公司名称（英文）</h1>
                <div class="input_box">
                    <input id="Vcl_EnCompany" name="Vcl_EnCompany"
							maxlength="100" type="text" value="<?php echo($o_user->getEnCompany())?>"/>
                </div>
            </div>
            <div class="account_job">
                <h1>职务全称</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Job" name="Vcl_Job" maxlength="200" value="<?php echo($o_user->getJob())?>"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Job_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Job_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Job_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="account_dep">
                <h1>职务（英文）</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_EnJob" name="Vcl_EnJob"
							maxlength="40" type="text" value="<?php echo($o_user->getEnJob())?>"/>
                </div>
            </div>
            <div class="account_job">
                <h1>部门</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Dept" name="Vcl_Dept" maxlength="40" value="<?php echo($o_user->getDept())?>"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Dept_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Dept_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Dept_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="account_dep">
                <h1>部门（英文）</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_EnDept" name="Vcl_EnDept"
							maxlength="40" type="text" value="<?php echo($o_user->getEnDept())?>"/>
                </div>
            </div>
        </div>
        <div class="contact_info" style="margin-top:10px;">
            <div class="contact_info_title">
                联系信息
            </div>
            <div class="account_job">
                <h1>区号</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_AreaNumber" name="Vcl_AreaNumber"
							maxlength="10" type="text" value="<?php echo($o_user->getAreaNumber())?>"/>
                </div>
            </div>
            <div class="account_dep">
                <h1>直线</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_CompanyPhone"
							name="Vcl_CompanyPhone" maxlength="15" type="text" value="<?php echo($o_user->getCompanyPhone())?>"/>
                </div>
            </div>
            <div class="account_job">
                <h1>总机</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_Telephone" name="Vcl_Telephone"
							maxlength="15" type="text" value="<?php echo($o_user->getTelephone())?>"/>
                </div>
            </div>
            <div class="account_dep">
                <h1>分机</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_Extension" name="Vcl_Extension"
							maxlength="10" type="text" value="<?php echo($o_user->getExtension())?>"/>
                </div>
            </div>
            <div class="account_tel">
                <h1>手机号</h1>
                <div class="input_box">
                    <input value="<?php echo($o_user->getPhone())?>" type="text" id="Vcl_Phone" name="Vcl_Phone" maxlength="15"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Phone_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Phone_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Phone_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="account_address">
                <h1>传真</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_Fax" name="Vcl_Fax" maxlength="20"
							type="text" value="<?php echo($o_user->getFax())?>"/>
                </div>
            </div>
            <div class="account_job">
                <h1>地区</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_Area" name="Vcl_Area"
							maxlength="15" type="text" value="<?php echo($o_user->getArea())?>"/>
                </div>
            </div>
            <div class="account_dep">
                <h1>省</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_Province" name="Vcl_Province"
							maxlength="15" type="text" value="<?php echo($o_user->getProvince())?>"/>
                </div>
            </div>
            <div class="account_job">
                <h1>市</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_City" name="Vcl_City"
							maxlength="15" type="text" value="<?php echo($o_user->getCity())?>"/>
                </div>
            </div>
            <div class="account_dep">
                <h1>邮政编码</h1>
                <div class="input_box">
                    <input class="mini" id="Vcl_Postcode" name="Vcl_Postcode"
							maxlength="10" type="text" value="<?php echo($o_user->getPostcode())?>"/>
                </div>
            </div>
            <div class="account_address">
                <h1>地址</h1>
                <div class="input_box">
                    <input value="<?php echo($o_user->getAddress())?>" type="text" id="Vcl_Address" name="Vcl_Address" maxlength="50"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Address_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Address_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Address_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="account_address">
                <h1>地址（英文）</h1>
                <div class="input_box">
                    <input id="Vcl_EnAddress" name="Vcl_EnAddress"
							maxlength="100" type="text" value="<?php echo($o_user->getEnAddress())?>"/>
                </div>
            </div>
            <div class="account_job">
                <h1>即时通讯</h1>
                <div class="input_box">
                   <input id="Vcl_QQ" name="Vcl_QQ" class="mini" maxlength="30"
							type="text" value="<?php echo($o_user->getQQ())?>"/>
                </div>
            </div>
            <div class="account_dep">
                <h1>Skype</h1>
                <div class="input_box">
                    <input id="Vcl_Skype" name="Vcl_Skype" class="mini"
							maxlength="30" type="text" value="<?php echo($o_user->getSkype())?>"/>
                </div>
            </div>
            <div class="account_address">
                <h1>电子邮箱</h1>
                <div class="input_box">
                    <input id="Vcl_Email1" name="Vcl_Email1"
							maxlength="50" type="text" value="<?php echo($o_user->getEmail1())?>"/>
                </div>
            </div>
            <div class="account_address">
                <h1>电子邮箱（备用）</h1>
                <div class="input_box">
                    <input id="Vcl_Email2" name="Vcl_Email2"
							maxlength="50" type="text" value="<?php echo($o_user->getEmail2())?>"/>
                </div>
            </div>
            <div class="account_address">
                <h1>网址</h1>
                <div class="input_box">
                    <input id="Vcl_Url" name="Vcl_Url" maxlength="50"
							type="text" value="<?php echo($o_user->getUrl())?>"/>
                </div>
            </div>
            <div class="submit_box">               
                <div class="submit_but cancle_bg" onclick="location='ucenter.php'">
                    取消
                </div>
                <div class="submit_but" onclick="modifyInfoSubmit()">
                   提交
                </div>
            </div>
        </div>
    </div>
</form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
<div id="master_box_bj" style="position: absolute; background-color: black; width: 0px; height: 0px; z-index: 1999; left: 0px; top: 0px;"></div>
<div id="master_box" style="position: absolute; z-index: 2000; left: 0px; top: 0px;display:none"><div><img src="images/loading.gif" alt="" style="width:32px;height:32px"/></div></div>
<div id="master_box_loading" style="position: absolute; background-color: red; z-index: 2001; left: 0px; top: 0px;"></div>
</body>
</html>