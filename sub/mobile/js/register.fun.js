 $(window).load(function(){setAllInput();updateValidCode()});
function setAllInput()
{
    //每个文本输入框，都加上点击以后边框颜色变
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        switch (a_input[i].id)
        {
            case 'Vcl_UserName':
                a_input[i].onblur=function(){checkUserName(this)} 
                break;
            case 'Vcl_UserName_F':
                a_input[i].onblur=function(){checkUserNameF(this)} 
                break;
            case 'Vcl_Password_Old':
                a_input[i].onblur=function(){checkPasswordOld(this)} 
                break;
            case 'Vcl_Password':
                a_input[i].onblur=function(){checkPassword(this)} 
                break;
            case 'Vcl_Password2':
                a_input[i].onblur=function(){checkPassword2(this)}
                break;
            case 'Vcl_ValidCode':
                a_input[i].onblur=function(){checkValidCode(this)} 
                break;
            case 'Vcl_Name':
                a_input[i].onblur=function(){checkName(this)} 
                break;
            case 'Vcl_Name2':
                a_input[i].onblur=function(){checkName(this)} 
                break;
            case 'Vcl_Company':
                a_input[i].onblur=function(){checkNotNull(this)} 
                break;
            case 'Vcl_Job':
                a_input[i].onblur=function(){checkNotNull(this)}
                break;
            case 'Vcl_Dept':
                a_input[i].onblur=function(){checkNotNull(this)} 
                break;
            case 'Vcl_Phone':
                a_input[i].onblur=function(){checkPhone(this)} 
                break;
            case 'Vcl_Address':
                a_input[i].onblur=function(){checkNotNull(this)}
                break;
            case 'Vcl_Invitation':
                a_input[i].onblur=function(){checkInvitation(this)} 
                break;
            case 'Vcl_TelePhone':
                a_input[i].onblur=function(){checkPhone(this)} 
                break;            
        }
        //a_input[i].onfocus=function(){this.style.borderColor='#FF7000'} 
        
    }
}
var B_Vcl_UserName=false;
var B_Vcl_UserName_F=false;
var B_Vcl_Sex=true
var B_Vcl_Password=false
var B_Vcl_Password2=false
var B_Vcl_Birthday=true
var B_Vcl_ValidCode=false
var B_Vcl_Name=false
var B_Vcl_Name2=false
var B_Vcl_Company=false
var B_Vcl_Job=false
var B_Vcl_Dept=false
var B_Vcl_Phone=false
var B_Vcl_Address=false
var B_Vcl_Password_Old=false
var B_Vcl_TelePhone=false
function checkUserName(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'_ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')        
    }else{
        if (isEmail(obj.value))
        {
            var o_ajax_request=new AjaxRequest();
            o_ajax_request.setFunction ('CheckUserName');
            o_ajax_request.setPage('../../include/it_ajax.svr.php');
            o_ajax_request.PushParameter(obj.value);
            o_ajax_request.SendRequest() 
            return
        }else{
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no_text').html('邮箱错误')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkUserNameF(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'_ok').hide()
        $('#' + obj.id + '_no_text').html('不能为空')        
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
            $('#' + obj.id + '_no_text').html('邮箱错误')
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
        $('#'+obj.id+'_no_text').html('不能为空')        
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
            $('#'+obj.id+'_no_text').html('号码有误')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkUserNameCallback(str)
{
    if (str=='true')
    {
        $('#Vcl_UserName_ok').show()
        $('#Vcl_UserName_no').hide()
        B_Vcl_UserName=true
    }else{
        $('#Vcl_UserName_no').show()
        $('#Vcl_UserName_ok').hide()
        $('#Vcl_UserName_no_text').html('邮箱已存在请更换')
        B_Vcl_UserName=false
    }
}
function checkName(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')        
    }else{
        if (obj.value.search(/[^\u4e00-\u9fa5]/)==-1)
        {
            $('#'+obj.id+'_ok').show()
            $('#'+obj.id+'_no').hide()
            eval('B_'+obj.id+'=true;')
            return
        }else{
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no_text').html('填写中文')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkName2(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')        
    }else{
        $('#'+obj.id+'_ok').show()
        $('#'+obj.id+'_no').hide()
        eval('B_'+obj.id+'=true;')
        return
    }
    eval('B_'+obj.id+'=false;') 
}
function checkPassword(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')        
    }else{
        if (obj.value.length>5)
        {
            $('#'+obj.id+'_ok').show()
            $('#'+obj.id+'_no').hide()
            eval('B_'+obj.id+'=true;')
            checkPassword2(document.getElementById('Vcl_Password2'))
            return
        }else{
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no_text').html('密码少于6位')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkPassword2(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')        
    }else{
        if (obj.value==document.getElementById('Vcl_Password').value)
        {
            $('#'+obj.id+'_ok').show()
            $('#'+obj.id+'_no').hide()
            eval('B_'+obj.id+'=true;')
            return
        }else{
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no_text').html('两次密码不一致')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkValidCode(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'_ok').hide()
        eval('B_'+obj.id+'=false')        
    }else{
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CheckValidCode');
        o_ajax_request.setPage('../../include/it_ajax.svr.php');
        o_ajax_request.PushParameter(obj.value);
        o_ajax_request.SendRequest() 
        return
    } 
}
function checkValidCodeCallback(str)
{
    if (str=='true')
    {
        $('#Vcl_ValidCode_ok').show()
        $('#Vcl_ValidCode_no').hide()
        B_Vcl_ValidCode=true
    }else{
        $('#Vcl_ValidCode_no').show()
        $('#Vcl_ValidCode_ok').hide()
        updateValidCode()
        B_Vcl_ValidCode=false
    }
}
function checkInvitation(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').hide()
        $('#'+obj.id+'_ok').hide()
    }else{
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CheckInvitation');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(obj.value);
        o_ajax_request.SendRequest() 
        return
    }
}
function checkInvitationCallback(str)
{
    if (str=='true')
    {
        $('#Vcl_Invitation_ok').show()
        $('#Vcl_Invitation_no').hide()
    }else{
        $('#Vcl_Invitation_no').show()
        $('#Vcl_Invitation_ok').hide()
        $('#Vcl_Invitation_no').html('邀请码无效')
    }
}
function checkNotNull(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'_ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')
        eval('B_'+obj.id+'=false')        
    }else{
        $('#'+obj.id+'_ok').show()
        $('#'+obj.id+'_no').hide()
        eval('B_'+obj.id+'=true')
    } 
}
function registerSubmit()
{
    Common_OpenLoading();
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        try{
            if (a_input[i].id=='Vcl_Birthday')
            {
                continue
            }
            a_input[i].focus()
            a_input[i].blur()
         }catch(e)
        {
        }
    }
    if (B_Vcl_UserName==false||B_Vcl_Password==false||B_Vcl_Password2==false||B_Vcl_ValidCode==false||B_Vcl_Name==false||B_Vcl_Company==false||B_Vcl_Job==false||B_Vcl_Dept==false||B_Vcl_Phone==false||B_Vcl_Address==false)
    {
        window.alert("请将信息填写完整后提交！")
        Common_CloseDialog();
        return
    }
    document.getElementById('submit_form').submit();
    
}
function findPasswordSubmit() {

    Common_OpenLoading();
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        try{
            a_input[i].focus()
            a_input[i].blur()
         }catch(e)
        {
        }
    }
    if (B_Vcl_UserName_F==false||B_Vcl_ValidCode==false||B_Vcl_Name==false||B_Vcl_TelePhone==false)
    {
        window.alert("请将信息填写完整后提交！")
        Common_CloseDialog();
        return
    }
    document.getElementById('submit_form').submit();
    
}
function sendCredentialSubmit()
{
    Common_OpenLoading();
        var o_form=document.getElementById('submit_form')
        var a_input=o_form.getElementsByTagName('input')
        for(var i=0;i<a_input.length;i++)
        {
            try{
                a_input[i].focus()
                a_input[i].blur()
             }catch(e)
            {
            }
        }
        if (B_Vcl_Phone==false||B_Vcl_Address==false||B_Vcl_Name2==false)
        {
            window.alert("请将信息填写完整后提交！")
            Common_CloseDialog();
            return
        }
        document.getElementById('submit_form').submit();
}
function findPasswordSubmitCallback()
{
    updateValidCode();
    document.getElementById('Vcl_ValidCode').value=''
    $('#Vcl_ValidCode_ok').hide()
    $('#Vcl_ValidCode_no').hide()
    B_Vcl_ValidCode=false 
}
function updateValidCode() {
	var s_img ='../../include/bn_submit.svr.php?function=ValidCode&parameter='+Math.random();		
	if(document.getElementById('validcode')) {
		document.getElementById('validcode').innerHTML='<img class="validcodeimg" src="'+s_img+'">'
	}
}
function checkPasswordOld(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'_ok').hide()
        $('#'+obj.id+'_no_text').html('不能为空')        
    }else{
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CheckPasswordOld');
        o_ajax_request.setPage('../../sub/student/include/it_ajax.svr.php');
        o_ajax_request.PushParameter(obj.value);
        o_ajax_request.SendRequest() 
        return
    }
    eval('B_'+obj.id+'=false;') 
}
function checkPasswordOldCallback(str)
{
    if (str=='true')
    {
        $('#Vcl_Password_Old_ok').show()
        $('#Vcl_Password_Old_no_text').hide()
        B_Vcl_Password_Old=true
    }else{
        $('#Vcl_Password_Old_no').show()
        $('#Vcl_Password_Old_ok').hide()
        $('#Vcl_Password_Old_no_text').html('原始密码错误')
        B_Vcl_Password_Old=false
    }
}
function modifyPasswordSubmit() {

    Common_OpenLoading();
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        try{
            a_input[i].focus()
            a_input[i].blur()
         }catch(e)
        {
        }
    }
    if (B_Vcl_Password_Old==false||B_Vcl_Password==false||B_Vcl_Password2==false)
    {
        window.alert("请将信息填写完整后提交！")
        Common_CloseDialog();
        return
    }
    document.getElementById('submit_form').submit();
    
}
function modifyInfoSubmit()
{
    Common_OpenLoading();
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        try{
            if (a_input[i].id=='Vcl_Birthday')
            {
                continue
            }
            a_input[i].focus()
            a_input[i].blur()
         }catch(e)
        {
        }
    }
    if (B_Vcl_Name==false||B_Vcl_Company==false||B_Vcl_Job==false||B_Vcl_Dept==false||B_Vcl_Phone==false||B_Vcl_Address==false)
    {
        window.alert("请将信息填写完整后提交！")
        Common_CloseDialog();
        return
    }
    document.getElementById('submit_form').submit();
    
}
function credentialStyleModify(id) {
    Common_OpenLoading();
    var o_ajax_request = new AjaxRequest();
    o_ajax_request.setFunction('CredentialStyleModify');
    o_ajax_request.setPage('../../sub/student/include/it_ajax.svr.php');
    o_ajax_request.PushParameter(id);
    o_ajax_request.SendRequest()

}
function credentialStyleModifyCallback() {
    window.alert("修改证书样式成功！");
    location='ucenter.php'
}