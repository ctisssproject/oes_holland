<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once '../include/it_head.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/dialog.css" /> 
<script type="text/javascript" src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>

<script type="text/javascript">
	 $(window).load(function(){setAllInput();});
    function setAllInput()
    {
        //每个文本输入框，都加上点击以后边框颜色变
        var o_form=document.getElementById('submit_form')
        var a_input=o_form.getElementsByTagName('input')
        for(var i=0;i<a_input.length;i++)
    	{
	        switch (a_input[i].id)
	        {
	            case 'Vcl_UserName':
	                a_input[i].onblur=function(){this.className='off';checkUserName(this)} 
	                a_input[i].onfocus=function(){this.className='on';} 
	                break;
	            case 'Vcl_Phone':
	                a_input[i].onblur=function(){this.className='off';checkPhone(this)} 
	                a_input[i].onfocus=function(){this.className='on';}
	                break;      
	            default:
	                if (a_input[i].className=='mini')
	                {
	                    a_input[i].onblur=function(){this.className='mini'} 
	                    a_input[i].onfocus=function(){this.className='mini on';} 
	                }else{
	                    a_input[i].onblur=function(){this.className='off';}
	                    a_input[i].onfocus=function(){this.className='on';}                 
	                }               
	         
	        }
    	}
    }
    var B_Vcl_Address=false
    var B_Vcl_UserName=false
    function checkUserName(obj)
    {
        if (obj.value=='')
        {
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no').html('不能为空')        
        }else{
            if (isEmail(obj.value))
            {
                $('#'+obj.id+'_ok').show()
                $('#'+obj.id+'_no').hide()
                eval('B_'+obj.id+'=true;') 
                return
            }else{
                $('#'+obj.id+'_no').show()
                $('#'+obj.id+'_ok').hide()
                $('#'+obj.id+'_no').html('邮箱错误')
            }
        }
        eval('B_'+obj.id+'=false;') 
    }
    function checkPhone(obj)
    {
        if (obj.value=='')
        {
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no').html('不能为空')        
        }else{
            if (isMobile(obj.value))
            {
                $('#'+obj.id+'_ok').show()
                $('#'+obj.id+'_no').hide()
                eval('B_'+obj.id+'=true;')
                return
            }else{
                $('#'+obj.id+'_no').show()
                $('#'+obj.id+'_ok').hide()
                $('#'+obj.id+'_no').html('号码有误')
            }
        }
        eval('B_'+obj.id+'=false;') 
    }
    function checkNotNull(obj)
    {
        if (obj.value=='')
        {
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no').html('不能为空')
            eval('B_'+obj.id+'=false')        
        }else{
            $('#'+obj.id+'_ok').show()
            $('#'+obj.id+'_no').hide()
            eval('B_'+obj.id+'=true')
        } 
    }
    function sendCredentialSubmit()
    {
        var o_form=document.getElementById('submit_form')
        var a_input=o_form.getElementsByTagName('input')
        for(var i=0;i<a_input.length;i++)
        {
            try{
                a_input[i].onfocus()
                a_input[i].onblur()
             }catch(e)
            {
            }
        }
        if (B_Vcl_Phone==false||B_Vcl_UserName==false)
        {
            return
        }
        document.getElementById('submit_form').onsubmit();
    }
    </script>

</head>
<body>
<form method="post" id="submit_form"
	action="<?php echo (RELATIVITY_PATH)?>sub/travel/include/bn_submit.svr.php?function=DownloadTravel"
	enctype="multipart/form-data" target="ajax_submit_frame"
	style="width: 100%"
	onsubmit="this.submit();parent.Common_OpenLoading_Dialog()"><input type="hidden" name="Vcl_TitleId" value="<?php echo($_GET['id']);?>"/> <table
	border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="title">下载行程到邮箱 </td>
</tr>
<tr>
<td class="text"><div style="float: left">Email</div><div
	id="Vcl_UserName_ok" class="input_ok"> </div> <div id="Vcl_UserName_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_UserName" name="Vcl_UserName" maxlength="100" value=""
	type="text"/></td>
</tr>
<tr>
<td class="text"><div style="float: left">手机</div><div
	id="Vcl_Phone_ok" class="input_ok"> </div> <div id="Vcl_Phone_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_Phone" name="Vcl_Phone" maxlength="100" value=""
	type="text"/></td>
</tr>
<tr>
<td class="button" style="height:50px;"><div
	onclick="parent.Common_CloseDialog()"> </div> <div class="ok"
	onclick="sendCredentialSubmit()"> </div> </td>
</tr>
</table> </form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>
