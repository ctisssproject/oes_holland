<?php
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once RELATIVITY_PATH.'sub/student/include/it_include.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_user = new User ( $O_Session->getUid () );
if ($o_user->getIsSend()==1)
{
	echo ('<script type="text/javascript">parent.location=\'/sub/student/credential.php\'</script>');
	exit ( 0 );
}
//获取以前寄送地址
$s_name = '';
$s_phone = '';
$s_address = '';
$s_postcode = '';
$o_temp = new Goods_Send();
$o_temp->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
$o_temp->PushOrder ( array ('Date', 'D' ) );
if ($o_temp->getAllCount () > 0) {
	$s_name = $o_temp->getName ( 0 );
	$s_phone = $o_temp->getPhone ( 0 );
	$s_address = $o_temp->getAddress ( 0 );
	$s_postcode = $o_temp->getPostcode ( 0 );
}else{
	$s_name = $o_user->getName ( );
	$s_phone = $o_user->getPhone ( );
	$s_address = $o_user->getAddress ( );
	$s_postcode = $o_user->getPostcode ( );	
	
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
	 $(window).load(function(){setAllInput();});
    function setAllInput()
    {
        //每个文本输入框，都加上点击以后边框颜色变
        var o_form=document.getElementById('submit_form')
        var a_input=o_form.getElementsByTagName('input')
        for(var i=0;i<a_input.length;i++)
        {
        	a_input[i].onblur=function(){this.className='off';checkNotNull(this)}
            a_input[i].onfocus=function(){this.className='on'}            
        }
    }
    var B_Vcl_Phone=false
    var B_Vcl_Address=false
    var B_Vcl_Name=false
    var B_Vcl_PostCode=false
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
        if (B_Vcl_Phone==false||B_Vcl_Address==false||B_Vcl_Name==false||B_Vcl_PostCode==false)
        {
            return
        }
        document.getElementById('submit_form').onsubmit();
    }
    </script>

</head>
<body>
<form method="post" id="submit_form"
	action="<?php echo (RELATIVITY_PATH)?>sub/student/include/bn_submit.svr.php?function=SendCredential"
	enctype="multipart/form-data" target="ajax_submit_frame"
	style="width: 100%"
	onsubmit="this.submit();parent.Common_OpenLoading_Dialog()"><table
	border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="title">《荷兰旅游专家》 证书寄送申请 </td>
</tr>
<tr>
<td class="text"><div style="float: left">收件人</div><div
	id="Vcl_Name_ok" class="input_ok"> </div> <div id="Vcl_Name_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_Name" name="Vcl_Name" maxlength="100" value="<?php echo($s_name)?>"
	type="text"/></td>
</tr>
<tr>
<td class="text"><div style="float: left">详细地址</div><div
	id="Vcl_Address_ok" class="input_ok"> </div> <div id="Vcl_Address_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_Address" name="Vcl_Address" maxlength="100" value="<?php echo($s_address)?>"
	type="text"/></td>
</tr>
<tr>
<td class="text"><div style="float: left">邮政编码</div><div
	id="Vcl_PostCode_ok" class="input_ok"> </div> <div id="Vcl_PostCode_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_PostCode" name="Vcl_PostCode" maxlength="100" value="<?php echo($s_postcode)?>"
	type="text"/></td>
</tr>
<tr>
<td class="text"><div style="float: left">手机</div><div
	id="Vcl_Phone_ok" class="input_ok"> </div> <div id="Vcl_Phone_no"
	class="input_no"> </div> </td>
</tr>
<tr>
<td class="vcl"><input id="Vcl_Phone" name="Vcl_Phone" maxlength="100" value="<?php echo($s_phone)?>"
	type="text"/></td>
</tr>
<tr>
<td class="button" style="height:50px;"><div
	onclick="parent.Dialog_Message('点击“个人中心”的证书标志，可以继续申请证书寄送！')"> </div> <div class="ok"
	onclick="sendCredentialSubmit()"> </div> </td>
</tr>
</table> </form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>
