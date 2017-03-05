<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/it_showpage.class.php';
$o_showpage = new ShowPage ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>注册</title>
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

            $("#Vcl_Birthday").val('2000-03-03').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
            //var Vcl_Birthday = $.extend(opt['Vcl_Birthday'], opt['default']);
            //$("#Vcl_Birthday").mobiscroll(Vcl_Birthday).date(Vcl_Birthday);
        });
        function cho_sex(a) {
            if (a == "wo") {
                $(".man").css({ "background-color": "#f2f0e7", "color": "#747474" });
                $(".woman").css({ "background-color": "#ff6f00", "color": "#fff" });
                //设置控件
                $("#Vcl_Sex").val('女');
            } else {
                $(".woman").css({ "background-color": "#f2f0e7", "color": "#747474" });
                $(".man").css({ "background-color": "#ff6f00", "color": "#fff" });
                $("#Vcl_Sex").val('男');
            }
        }
    </script>
</head>
<body>
<form method="post" id="submit_form"
			action="../../include/bn_submit.svr.php?function=RegisterForMobile"
			enctype="multipart/form-data" target="ajax_submit_frame"
			style="width: 100%">
			<input type="hidden" name="Vcl_Url" value="<?php echo(str_replace ( substr( $_SERVER['PHP_SELF'] , strrpos($_SERVER['PHP_SELF'] , '/')+1 ), '', $_SERVER['PHP_SELF']))?>"/>
	<?php 
	    //显示顶部
	    echo($o_showpage->getLogoForMobile($b =0,$s_logo=''));
	?>
    <div class="sign_in_box page_2" id="form">
        <div class="sign_in_title">
            <h1>会员注册</h1>
            <div class="step_box">
                <h2>1</h2>
            </div>
            <div class="step_box step">
                <h2>2</h2>
                <div class="bottom_triangle"></div>
            </div>
            <div class="step_box">
                <h2>3</h2>
                <div class="next_triangle"></div>
            </div>
        </div>
        <div class="sign_in_agreement">
            填写注册信息
        </div>
        <div class="account_info">
            <div class="account_info_title">
                账号信息
            </div>
            <div class="account_email">
                <h1>电子邮箱</h1>
                <div class="input_box email">
                    <input id="Vcl_UserName" name="Vcl_UserName" type="text" value="" maxlength="200"/>

                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_UserName_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_UserName_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_UserName_no_text"></h2>
                    </div>

                </div>
            </div>
            <div class="account_pas">
                <h1>密码（至少6位）</h1>
                <div class="input_box pas">
                    <input id="Vcl_Password" name="Vcl_Password" type="password" value="" maxlength="200"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Password_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Password_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Password_no_text"></h2>
                    </div>
                </div>
            </div>
            <div class="account_pas">
                <h1>确认密码</h1>
                <div class="input_box pas">
                    <input type="password" id="Vcl_Password2" name="Vcl_Password2" maxlength="200"/>
                    <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_Password2_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_Password2_no">
                        <span class="icon-cross"></span>
                        <h2 id="Vcl_Password2_no_text"></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="per_info">
            <div class="per_info_title">
                个人信息
            </div>
            <div class="account_name">
                <h1>真实姓名（请填写中文）</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Name" name="Vcl_Name" maxlength="200"/>

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
                    <input type="text" id="Vcl_Birthday" name="Vcl_Birthday"/>
                </div>
                <div class="woman" onclick="cho_sex('wo')">女</div>
                <div class="man" onclick="cho_sex('man')">男</div>
                <input id="Vcl_Sex" name="Vcl_Sex" value="男" type="hidden"/>
            </div>
            <div class="account_com">
                <h1>公司名称（请填写公司全称）</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Company" name="Vcl_Company" maxlength="200"/>
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
            <div class="account_job">
                <h1>职务全称</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Job" name="Vcl_Job" maxlength="200"/>
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
                <h1>部门</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Dept" name="Vcl_Dept" maxlength="40"/>
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
        </div>
        <div class="contact_info">
            <div class="contact_info_title">
                联系信息
            </div>
            <div class="account_tel">
                <h1>手机号</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Phone" name="Vcl_Phone" maxlength="15"/>
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
                <h1>地址</h1>
                <div class="input_box">
                    <input type="text" id="Vcl_Address" name="Vcl_Address" maxlength="50"/>
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
            <div class="submit_box">
                <div class="account_verification">
                    <h1>验证码</h1>
                    <div class="input_box">
                        <input type="text" id="Vcl_ValidCode" name="Vcl_ValidCode" maxlength="6"/>
                        <!-- 对勾容器 -->
                    <div class="check" style="display:none;" id="Vcl_ValidCode_ok">
                        <span class="icon-check"></span>
                    </div>
                    <!-- 叉子容器 -->
                    <div class="cross" style="display:none;" id="Vcl_ValidCode_no">
                        <span class="icon-cross"></span>
                    </div>
                    </div>
                </div>
                <div class="verification_img">
                    <h1 onclick="updateValidCode()">点击换一张</h1>
                    <div id="validcode"></div>
                </div>
                <div class="submit_but" onclick="registerSubmit()">
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
<script type="text/javascript">
updateValidCode()
</script>
</body>
</html>