var N_Dialog_TimeHandle=0
var N_Dialog_Width=0
var N_Dialog_Height=0
var TimeHandle=0
var O_Func
function Dialog_Error(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=200
	N_Dialog_Width=316
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(Dialog_GetFrame('错误提示',s_message ,0 ));	
}
function Dialog_Success(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=200
	N_Dialog_Width=316
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(Dialog_GetFrame('成功提示',s_message ,0 ));	
}
function Dialog_Message(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=200
	N_Dialog_Width=316
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(Dialog_GetFrame('系统提示',s_message ,0 ));	
}
function Dialog_Confirm(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=200
	N_Dialog_Width=316
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(Dialog_GetFrame('确定提示',s_message ,1 ));	
}
function Common_OpenLoading(){
    var o_obj=document.getElementById('master_box');
    var a_arr=[];
    a_arr.push('<table border="0" cellspacing="0" cellpadding="0" style="width:187px;height:40px">');
    a_arr.push('<tbody>')
    a_arr.push('<tr>')
    a_arr.push('<td class="dialog_loading">');
    a_arr.push('读取中 . . .');
    a_arr.push('</td>')
    a_arr.push('<td style="text-align:right;padding-top:5px">');
    a_arr.push('<div onmouseover="this.className=\'dialog_closebutton_over\'" class="dialog_closebutton" onclick="Common_CloseDialog()" onmouseout="this.className=\'dialog_closebutton\'"></div>')
    a_arr.push('</td>')
    a_arr.push('</tr>')
    a_arr.push('</tbody>')
    a_arr.push('</table>')
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=46
	N_Dialog_Width=204
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(a_arr.join('\n')); 
	Disabled_Vcl()//禁用控件   
}
function Dialog_Ok_Button(){
    Common_CloseDialog()
    if(O_Func){
        O_Func();
    }
}
function stopEvent(event){//阻止一切事件执行,包括浏览器默认的事件
	event = window.event||event;
	if(!event){
		return;
	}
	event.cancelBubble = true
	event.returnValue = false;
}
function Dialog_GetFrame(s_title,s_message,n_type){
    var a_arr=[];
    var button='Common_CloseDialog()'
    if (n_type==0){
        button='Dialog_Ok_Button()'
    }
    var s_icon=''
    switch (s_title){
        case '错误提示':
            s_icon='dialog_icon_error'
            break; 
        case '成功提示':
            s_icon='dialog_icon_success'
            break; 
        case '系统提示':
            s_icon='dialog_icon_message'
            break; 
        case '确定提示':
            s_icon='dialog_icon_confirm'
            break; 
        default:	            
            s_icon='dialog_icon_message'                   
            break
    }
    a_arr.push('<table style="width: 300px;" border="0" cellspacing="0" cellpadding="0">');
    a_arr.push('    <tr>');
    a_arr.push('        <td class="dialog_title" style="font-family:微软雅黑;">');
    a_arr.push('            '+s_title+'');
    a_arr.push('        </td>');
    a_arr.push('        <td style="width: 35px">');
    a_arr.push('            <div onmouseover="this.className=\'dialog_closebutton_over\'" class="dialog_closebutton"');
    a_arr.push('                onclick="'+button+'" onmouseout="this.className=\'dialog_closebutton\'">');
    a_arr.push('            </div>');
    a_arr.push('        </td>');
    a_arr.push('    </tr>');
    a_arr.push('</table>');
    a_arr.push('<table style="width: 300px; height: 100px" border="0" cellspacing="0" cellpadding="0"');
    a_arr.push('    class="dialog">');
    a_arr.push('    <tr>');
    a_arr.push('        <td style="width: 30%" class="'+s_icon+'">');
    a_arr.push('            &nbsp;');
    a_arr.push('        </td>');
    a_arr.push('        <td class="dialog_message" style="font-family:微软雅黑;">');
    a_arr.push(s_message);
    a_arr.push('        </td>');
    a_arr.push('    </tr>');
    a_arr.push('</table>');
    a_arr.push('<table style="width: 300px;" border="0" cellspacing="0" cellpadding="0" class="dialog_button_table">');
    a_arr.push('    <tr>');
    a_arr.push('        <td style="text-align: center">');
    if (n_type==0){
        a_arr.push('            <input id="Vcl_Dialog_Ok" type="button" style="font-family:微软雅黑;" value="确定" class="submitButton" onclick="'+button+'" />');
    }else{
        a_arr.push('            <input id="Vcl_Dialog_Ok" type="button" style="font-family:微软雅黑;" value="确定" class="submitButton" onclick="Dialog_Ok_Button()" />');
        a_arr.push('            <input id="Vcl_Dialog_Cancel" type="button" style="font-family:微软雅黑;" value="取消" class="submitButton2" onclick="Common_CloseDialog()" />');
        
    }    
    a_arr.push('        </td>');
    a_arr.push('    </tr>');
    a_arr.push('</table>');
	return a_arr.join('\n')
}
function Common_CloseDialog(){
    var o_obj=document.getElementById('master_box');
    o_obj.style.top='-1000px';
    o_obj.innerHTML='';
    N_Dialog_Width=0
    N_Dialog_Height=0
    
    window.clearInterval(TimeHandle);
    window.clearInterval(N_Dialog_TimeHandle);
    Enable_Vcl()//启用控件
}
function Dialog_SetPosition(){
    var ch = document.compatMode == "BackCompat"?document.body.clientHeight:document.documentElement.clientHeight;
    var cw = document.compatMode == "BackCompat"?document.body.clientWidth:document.documentElement.clientWidth;
    var st = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    var sl = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
    var _div=document.getElementById("master_box");
    _div.style.top=((ch - N_Dialog_Height) / 2 + st)+'px';
    _div.style.left = ((cw - N_Dialog_Width) / 2 +sl)+'px';
}
function Dialog_GetBorder(s_content)
{
    var a_arr=[];
    a_arr.push('<table border="0" cellspacing="0" cellpadding="0">')
    a_arr.push('<tbody>')
    a_arr.push('<tr>')
	a_arr.push('<td width="5" height="5" class="dialog_border">');
    a_arr.push('</td>')
	a_arr.push('<td class="dialog_border">');
    a_arr.push('</td>')
	a_arr.push('<td width="5" height="5" class="dialog_border">');
    a_arr.push('</td>')
    a_arr.push('</tr>')
    a_arr.push('<tr>')
	a_arr.push('<td class="dialog_border">');
    a_arr.push('</td>')
    a_arr.push('<td style="vertical-align: top; background-color:#FFFFFF">')
    a_arr.push(s_content)    
    a_arr.push('</td>')
	a_arr.push('<td class="dialog_border">');
    a_arr.push('</td>')
    a_arr.push('</tr>')
    a_arr.push('<tr>')
	a_arr.push('<td width="5" class="dialog_border"></td>');
	a_arr.push('<td height="5" class="dialog_border"></td>');
	a_arr.push('<td width="5" class="dialog_border"></td>');
    a_arr.push('</tr>')
    a_arr.push('</tbody>')
    a_arr.push('</table>')
    return a_arr.join('\n')
}
function Dialog_Iframe(url,width,height,o_func,obj)
{
    var h=obj.offsetTop
    while(obj=obj.offsetParent)
    {
        h=h+obj.offsetTop
    }
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=height+10
	N_Dialog_Width=width+10
	o_obj.style.top='-1000px';
	Dialog_SetPosition_2(h)//开始动画
    var a_arr=[];
    a_arr.push('<table border="0" cellspacing="0" cellpadding="0">')
    a_arr.push('<tbody>')
    a_arr.push('<tr>')
	a_arr.push('<td width="5" height="5" class="dialog_border">');
    a_arr.push('</td>')
	a_arr.push('<td class="dialog_border">');
    a_arr.push('</td>')
	a_arr.push('<td width="5" height="5" class="dialog_border">');
    a_arr.push('</td>')
    a_arr.push('</tr>')
    a_arr.push('<tr>')
	a_arr.push('<td class="dialog_border">');
    a_arr.push('</td>')
    a_arr.push('<td style="vertical-align: top; background-color:#FFFFFF">')
    a_arr.push('<iframe marginwidth="0" border="0" scrolling="no" frameborder="0" src="'+url+'" style="width:'+width+'px;height:'+height+'px"></iframe>')    
    a_arr.push('</td>')
	a_arr.push('<td class="dialog_border">');
    a_arr.push('</td>')
    a_arr.push('</tr>')
    a_arr.push('<tr>')
	a_arr.push('<td width="5" class="dialog_border"></td>');
	a_arr.push('<td height="5" class="dialog_border"></td>');
	a_arr.push('<td width="5" class="dialog_border"></td>');
    a_arr.push('</tr>')
    a_arr.push('</tbody>')
    a_arr.push('</table>')
    o_obj.innerHTML=a_arr.join('\n'); 
}
function Dialog_SetPosition_2(top){
    var ch = document.compatMode == "BackCompat"?document.body.clientHeight:document.documentElement.clientHeight;
    var cw = document.compatMode == "BackCompat"?document.body.clientWidth:document.documentElement.clientWidth;
    var st = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    var sl = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
    var _div=document.getElementById("master_box");
    top=top-150
    
    if (top>(ch-300))
    {
        top=ch-300
    }
    if (top<=30)
    {
        top=100
    }
    _div.style.top=top+'px';
    _div.style.left = ((cw - N_Dialog_Width) / 2 +sl)+'px';
}
function Dialog_Login(s_username){
    var o_obj=document.getElementById('master_box');
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=230
	N_Dialog_Width=465
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(Dialog_GetLoginFrame(s_username));	
}
function Dialog_Register(s_username,s_password,s_password2,s_email,s_code){
    var o_obj=document.getElementById('master_box');
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=412
	N_Dialog_Width=535
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(Dialog_GetRegisterFrame(s_username,s_password,s_password2,s_email,s_code));
	var s_img = S_Root+'include/bn_submit.svr.php?function=ValidCode&parameter='+Math.random();	
	document.getElementById('validcode').innerHTML='<img src="'+s_img+'" align="absmiddle" style="width:100px; height:40px">'
}
/////////////////////////////////////////////////////////////////上传进度条
function uploadProgressBar()
{
    var o_obj=document.getElementById('master_box');
    var a_arr=[];
    a_arr.push('<table border="0" cellspacing="0" cellpadding="0" style="width:187px; height:50px">');
    a_arr.push('<tbody>')
    a_arr.push('<tr>')
    a_arr.push('<td class="dialog_progress">');
    a_arr.push('进度');
    a_arr.push('</td>')
    a_arr.push('<td>');
    a_arr.push('进度');
    a_arr.push('</td>')
    a_arr.push('<td>');
    a_arr.push('<div onmouseover="this.className=\'dialog_closebutton_over\'" class="dialog_closebutton" onclick="Common_CloseDialog()" onmouseout="this.className=\'dialog_closebutton\'"></div>')
    a_arr.push('</td>')
    a_arr.push('</tr>')
    a_arr.push('</tbody>')
    a_arr.push('</table>')
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=46
	N_Dialog_Width=204
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetBorder(a_arr.join('\n')); 
	Disabled_Vcl()//禁用控件   
} 