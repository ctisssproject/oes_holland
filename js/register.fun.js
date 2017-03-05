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
                a_input[i].onblur=function(){this.className='off';checkUserName(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_UserName_F':
                a_input[i].onblur=function(){this.className='off';checkUserNameF(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_Sex':
                a_input[i].onblur=function(){this.className='mini';checkSex(this)} 
                a_input[i].onfocus=function(){this.className='mini on';altClose()} 
                break;
            case 'Vcl_Birthday1':
                a_input[i].onblur=function(){checkBirthday(this)} 
                a_input[i].onfocus=function(){checkBirthdayOnfocus(this);altClose()}
                a_input[i].onkeyup=function(){checkBirthday1Onkeyup(this)}
                break;
            case 'Vcl_Birthday2':
                a_input[i].onblur=function(){checkBirthday(this)} 
                a_input[i].onfocus=function(){checkBirthdayOnfocus(this);altClose()}
                a_input[i].onkeyup=function(){checkBirthday2Onkeyup(this)}
                break;
            case 'Vcl_Birthday3':
                a_input[i].onblur=function(){checkBirthday(this)} 
                a_input[i].onfocus=function(){checkBirthdayOnfocus(this);altClose()}
                break;
            case 'Vcl_Birthday_Text_1':
                break;
            case 'Vcl_Birthday_Text_2':
                break;
            case 'Vcl_Password_Old':
                a_input[i].onblur=function(){this.className='off';checkPasswordOld(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_Password':
                a_input[i].onblur=function(){this.className='off';checkPassword(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_Password2':
                a_input[i].onblur=function(){this.className='off';checkPassword2(this)}
                a_input[i].onfocus=function(){this.className='on';altClose()}  
                break;
            case 'Vcl_ValidCode':
                a_input[i].onblur=function(){this.className='mini';checkValidCode(this)} 
                a_input[i].onfocus=function(){this.className='mini on';altClose()}
                break;
            case 'Vcl_Name':
                a_input[i].onblur=function(){this.className='off';checkName(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_Company':
                a_input[i].onblur=function(){this.className='off';checkNotNull(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_Job':
                a_input[i].onblur=function(){this.className='mini';checkNotNull(this)}
                a_input[i].onfocus=function(){this.className='mini on';altClose()} 
                break;
            case 'Vcl_Dept':
                a_input[i].onblur=function(){this.className='mini';checkNotNull(this)} 
                a_input[i].onfocus=function(){this.className='mini on';altClose()}
                break;
            case 'Vcl_Phone':
                a_input[i].onblur=function(){this.className='mini';checkPhone(this)} 
                a_input[i].onfocus=function(){this.className='mini on';altClose()}
                break;
            case 'Vcl_Address':
                a_input[i].onblur=function(){this.className='off';checkNotNull(this)}
                a_input[i].onfocus=function(){this.className='on';altClose()}  
                break;
            case 'Vcl_Invitation':
                a_input[i].onblur=function(){this.className='off';checkInvitation(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()} 
                break;
            case 'Vcl_TelePhone':
                a_input[i].onblur=function(){this.className='off';checkPhone(this)} 
                a_input[i].onfocus=function(){this.className='on';altClose()}
                break;
            default:
                if (a_input[i].className=='mini')
                {
                    a_input[i].onblur=function(){this.className='mini'} 
                    a_input[i].onfocus=function(){this.className='mini on';altClose()} 
                }else{
                    a_input[i].onblur=function(){this.className='off';}
                    a_input[i].onfocus=function(){this.className='on';altClose()}                 
                }               
         
        }
        //a_input[i].onfocus=function(){this.style.borderColor='#FF7000'} 
        
    }
}
var B_Vcl_UserName=false;
var B_Vcl_UserName_F=false;
var B_Vcl_Sex=false
var B_Vcl_Password=false
var B_Vcl_Password2=false
var B_Vcl_Birthday=false
var B_Vcl_ValidCode=false
var B_Vcl_Name=false
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
        $('#'+obj.id+'_no').html('不能为空')        
    }else{
        if (isEmail(obj.value))
        {
            var o_ajax_request=new AjaxRequest();
            o_ajax_request.setFunction ('CheckUserName');
            o_ajax_request.setPage('include/it_ajax.svr.php');
            o_ajax_request.PushParameter(obj.value);
            o_ajax_request.SendRequest() 
            return
        }else{
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no').html('邮箱错误')
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
        $('#Vcl_UserName_no').html('邮箱已存在请更换')
        B_Vcl_UserName=false
    }
}
function checkSex(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no').html('不能为空')        
    }else{
        if (obj.value=='男'||obj.value=='女')
        {
            $('#'+obj.id+'_ok').show()
            $('#'+obj.id+'_no').hide()
            eval('B_'+obj.id+'=true;')
            return
        }else{
            $('#'+obj.id+'_no').show()
            $('#'+obj.id+'_ok').hide()
            $('#'+obj.id+'_no').html('性别错误')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkName(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no').html('不能为空')        
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
            $('#'+obj.id+'_no').html('填写中文')
        }
    }
    eval('B_'+obj.id+'=false;') 
}
function checkPassword(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'ok').hide()
        $('#'+obj.id+'_no').html('不能为空')        
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
            $('#'+obj.id+'_no').html('密码太短')
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
        $('#'+obj.id+'_no').html('不能为空')        
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
            $('#'+obj.id+'_no').html('两次密码不一致')
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
        $('#'+obj.id+'_no').html('不能为空')
        eval('B_'+obj.id+'=false')        
    }else{
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CheckValidCode');
        o_ajax_request.setPage('include/it_ajax.svr.php');
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
        $('#Vcl_ValidCode_no').html('验证码错误')
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
        $('#'+obj.id+'_no').html('不能为空')
        eval('B_'+obj.id+'=false')        
    }else{
        $('#'+obj.id+'_ok').show()
        $('#'+obj.id+'_no').hide()
        eval('B_'+obj.id+'=true')
    } 
}
function checkBirthday(obj)
{
    document.getElementById('Vcl_Birthday1').className='mini off'
    document.getElementById('Vcl_Birthday_Text_1').className='mini off'
    document.getElementById('Vcl_Birthday2').className='mini off'
    document.getElementById('Vcl_Birthday_Text_2').className='mini off'
    document.getElementById('Vcl_Birthday3').className='mini off' 
    if (document.getElementById('Vcl_Birthday1').value=="" && document.getElementById('Vcl_Birthday2').value=="" && document.getElementById('Vcl_Birthday3').value=="")
    {
        $('#Vcl_Birthday_no').show()
        $('#Vcl_Birthday_ok').hide()
        $('#Vcl_Birthday_no').html('不能为空')
        B_Vcl_Birthday=false   
        return    
    }
    if ((parseInt(document.getElementById('Vcl_Birthday1').value)>1900 && parseInt(document.getElementById('Vcl_Birthday1').value)<2100)==false)
    { 
        $('#Vcl_Birthday_no').show()
        $('#Vcl_Birthday_ok').hide()
        $('#Vcl_Birthday_no').html('生日错误')
        B_Vcl_Birthday=false  
        return 
    }
    var month=document.getElementById('Vcl_Birthday2').value
    if (month.length==2)
    {
    	if (month.substring(0,1)=='0')
    		{
    			month=month.substr(1,1)
    		}
    }
    if ((parseInt(month)>0 && parseInt(month)<13)==false)
    {
        $('#Vcl_Birthday_no').show()
        $('#Vcl_Birthday_ok').hide()
        $('#Vcl_Birthday_no').html('生日错误')
        B_Vcl_Birthday=false  
        return         
    }
    var month=document.getElementById('Vcl_Birthday3').value
    if (month.length==2)
    {
    	if (month.substring(0,1)=='0')
    		{
    			month=month.substr(1,1)
    		}
    }
    if ((parseInt(month)>0 && parseInt(month)<32)==false)
    {
        $('#Vcl_Birthday_no').show()
        $('#Vcl_Birthday_ok').hide()
        $('#Vcl_Birthday_no').html('生日错误')
        B_Vcl_Birthday=false
        return         
    }        
    $('#Vcl_Birthday_ok').show()
    $('#Vcl_Birthday_no').hide()
    document.getElementById('Vcl_Birthday').value=document.getElementById('Vcl_Birthday1').value+'-'+document.getElementById('Vcl_Birthday2').value+'-'+document.getElementById('Vcl_Birthday3').value
    B_Vcl_Birthday=true 
}
function checkBirthday1Onkeyup(obj)
{
    if (obj.value.length==4)
    {
        document.getElementById('Vcl_Birthday2').focus()
        document.getElementById('Vcl_Birthday2').select()
    }
}
function checkBirthday2Onkeyup(obj)
{
    if (obj.value.length==2)
    {
        document.getElementById('Vcl_Birthday3').focus()
        document.getElementById('Vcl_Birthday3').select()
    }
}
function checkBirthdayOnfocus(obj)
{
    document.getElementById('Vcl_Birthday1').className='mini on'
    document.getElementById('Vcl_Birthday_Text_1').className='mini on'
    document.getElementById('Vcl_Birthday2').className='mini on'
    document.getElementById('Vcl_Birthday_Text_2').className='mini on'
    document.getElementById('Vcl_Birthday3').className='mini on'
}
function registerSubmit()
{
    var o_form=document.getElementById('form')
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
    if (B_Vcl_UserName==false||B_Vcl_Sex==false||B_Vcl_Password==false||B_Vcl_Password2==false||B_Vcl_Birthday==false||B_Vcl_ValidCode==false||B_Vcl_Name==false||B_Vcl_Company==false||B_Vcl_Job==false||B_Vcl_Dept==false||B_Vcl_Phone==false||B_Vcl_Address==false)
    {
        Dialog_Message("请将 * 标记的信息填写完整后提交！")
        return
    }
    document.getElementById('submit_form').onsubmit();
    
}
function findPasswordSubmit()
{
    var o_form=document.getElementById('form')
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
    if (B_Vcl_UserName_F==false||B_Vcl_ValidCode==false||B_Vcl_Name==false||B_Vcl_TelePhone==false)
    {
        Dialog_Message("请将信息填写完整后提交！")
        return
    }
    document.getElementById('submit_form').onsubmit();
    
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
	var s_img ='include/bn_submit.svr.php?function=ValidCode&parameter='+Math.random();		
	if(document.getElementById('validcode')) {
		document.getElementById('validcode').innerHTML='<a href="javascript:;" title="看不清？点击换一张！" onclick="updateValidCode()"><img class="validcodeimg" src="'+s_img+'" alt="看不清？点击换一张！"></a>'
	}
}
function passwordSafe()
{
    try
    {
        var s_upper ='ABCDEFGHIJKLMNOPQRSTUVWXWZ'
        var s_lower ='abcdefghijklmnopqrstuvwxyz'
        var s_sign=' `-=\\[];\',./*-+~!@#$%^&*()_+|'
        var n_number=1;
        var o_pass=document.getElementById('Vcl_Password').value;
        var s_width='0px';
        var s_text='';
        var s_color='#FFFFFF';
        if (o_pass.length==0){
             $(".passwordsafe").hide()
            return        
        }         

        if (o_pass.length>=12)
        {
            n_number=n_number+1;
        }
        for(var i=0;i<o_pass.length;i++)
        {
            if (s_upper.indexOf(o_pass.substr(i, 1))>-1 && o_pass.length>5){
                n_number=n_number+1;
                i=o_pass.length+1
            }
        }
        for(var i=0;i<o_pass.length;i++)
        {
            if (s_lower.indexOf(o_pass.substr(i, 1))>-1 && o_pass.length>5){
                n_number=n_number+1;
                i=o_pass.length+1
            }
        }
        for(var i=0;i<o_pass.length;i++)
        {
            if (s_sign.indexOf(o_pass.substr(i, 1))>-1 && o_pass.length>5){
                n_number=n_number+1;
                i=o_pass.length+1
            }
        }
        $(".passwordsafe").show()
        switch (n_number)
        {
            case 1:                
                $(".passwordsafe").css("margin-left","22px");
                break; 
            case 2:
                $(".passwordsafe").css("margin-left","75px");
                break;
            case 3:
                $(".passwordsafe").css("margin-left","130px");
                break; 
            case 4:
                $(".passwordsafe").css("margin-left","185px");
                break; 
            case 5:
                $(".passwordsafe").css("margin-left","238px");
                break; 
            default:               
                break;
	    }
    }catch(e)
    {
    }
}
function altSet(obj)
{
    obj.parentNode.parentNode.getElementsByTagName('input')[0].value=obj.innerHTML
    altClose(obj.parentNode.parentNode.getElementsByTagName('input')[0])
}
function altClose()
{
    $('.alt').hide()
    
}
function altGet(fun,id,obj)
{
    if (obj.value=='')
    {
        document.getElementById(id).style.display='none'
        return
    }
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction (fun);
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(id);
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()     
}
function altGetCallback(id,html)
{
    if (html=='')
    {
        document.getElementById(id).innerHTML=html
        document.getElementById(id).style.display='none'
        return
    }
    document.getElementById(id).innerHTML=html
    document.getElementById(id).style.display='block'
}