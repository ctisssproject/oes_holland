<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
//只有注册学员才可分享
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
if ($O_Session->Login () == false ||$O_Session->getType () < 3) //如果没有注册，跳转到首页
{
	echo ('<script type="text/javascript">parent.startExamGuest()</script>');	
	exit (0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/dialog.css" />

<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>

<script type="text/javascript">
	 $(window).load(function(){setAllInput();document.getElementById('Vcl_Url').value=parent.location});
	 $(window).load(function(){setAllInput()});
	    function setAllInput()
	    {
	        //每个文本输入框，都加上点击以后边框颜色变
	        var o_form=document.getElementById('submit_form')
	        var a_input=o_form.getElementsByTagName('input')
	        for(var i=0;i<a_input.length;i++)
	        {
	            switch (a_input[i].id)
	            {
	                case 'Vcl_Name':
	                    a_input[i].onblur=function(){this.className='off';checkName(this)} 
	                    a_input[i].onfocus=function(){this.className='on'} 
	                    break;
	                case 'Vcl_Email':
	                    a_input[i].onblur=function(){this.className='off';checkEmail(this)} 
	                    a_input[i].onfocus=function(){this.className='on'} 
	                    break;                
	             
	            }            
	        }
	    }
	    function checkName(obj)
	    {
	        if (obj.value=='')
	        {
	            $('#'+obj.id+'_no').show()
	            $('#'+obj.id+'_ok').hide()
	            $('#'+obj.id+'_no').html('好友姓名不能为空')
	            return false      
	        }else{
	            $('#'+obj.id+'_ok').show()
	            $('#'+obj.id+'_no').hide()
	            return true
	        } 
	    }
	    function checkEmail(obj)
	    {
	        if (obj.value=='')
	        {
	            $('#'+obj.id+'_no').show()
	            $('#'+obj.id+'_ok').hide()
	            $('#'+obj.id+'_no').html('邮箱不能为空')   
	            return false     
	        }else{
	            if (isEmail(obj.value))
	            {
	                $('#'+obj.id+'_ok').show()
	                $('#'+obj.id+'_no').hide()
	                return true
	            }else{
	                $('#'+obj.id+'_no').show()
	                $('#'+obj.id+'_ok').hide()
	                $('#'+obj.id+'_no').html('邮箱格式错误')
	                return false
	            }
	        }
	    }
	    function shareFirendSubmit()
	    {
	        if (checkName(document.getElementById('Vcl_Name'))==true && checkEmail(document.getElementById('Vcl_Email'))==true)
	        {
	            document.getElementById('submit_form').onsubmit();
	        }
	    }
    </script>

</head>
<body>
<form method="post" id="submit_form"
	action="<?php echo (RELATIVITY_PATH)?>sub/student/include/bn_submit.svr.php?function=ShareFirend"
	enctype="multipart/form-data" target="ajax_submit_frame"
	style="width: 100%"
	onsubmit="this.submit();parent.Common_OpenLoading_Dialog()"> <table
	border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="title"> 分享给好友 </td>
</tr>
<tr>
<td class="text"> <div style="float: left"> 好友真实姓名</div> <div
	id="Vcl_Name_ok" class="input_ok"> </div> <div id="Vcl_Name_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"> <input id="Vcl_Name" name="Vcl_Name" maxlength="10"
	type="text"/></td>
</tr>
<tr>
<td class="text"> <div style="float: left"> 好友E-mail</div> <div
	id="Vcl_Email_ok" class="input_ok"> </div> <div id="Vcl_Email_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_Email" name="Vcl_Email" maxlength="100"
	type="text"/></td>
</tr>
<tr>
<td class="button" style="height:50px;"><input type="hidden" name="Vcl_Url" id="Vcl_Url"/><input type="hidden" name="Vcl_ChapterId" value="<?php echo($_GET['chapterid'])?>" id="Vcl_ChapterId"/> <div
	onclick="parent.Common_CloseDialog()"> </div> <div class="ok"
	onclick="shareFirendSubmit()"> </div> </td>
</tr>
</table> </form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>
