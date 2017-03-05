var N_Dialog_TimeHandle=0
var N_Dialog_Width=0
var N_Dialog_Height=0
var TimeHandle=0
var O_Func
//$(window).load(function(){$('#master_box_bj').animate({opacity:0.5});});
;
function Dialog_Error(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=250
	N_Dialog_Width=343
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetFrame('box_error',s_message);	
	showBox()
}
function Dialog_Success(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=250
	N_Dialog_Width=343
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetFrame('box_success',s_message);
	showBox()
}
function Dialog_Message(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=250
	N_Dialog_Width=343
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetFrame('box_message',s_message);	
	showBox()
}
function Dialog_Confirm(s_message,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=250
	N_Dialog_Width=343
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	o_obj.innerHTML=Dialog_GetFrame('box_confirm',s_message);
	showBox()	
}
function Common_OpenLoading(){
    window.clearInterval(TimeHandle);
    var o_obj=document.getElementById('master_box');
    var a_arr=[];
	N_Dialog_Height=32
	N_Dialog_Width=32
	o_obj.style.top='-1000px';
	$("#master_box_bj").show()
    $("#master_box").show()
    $("#master_box_loading").show()
	$('#master_box_bj').css("opacity",0.5)
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
	
	//Disabled_Vcl()//禁用控件   
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
function Dialog_GetFrame(s_title,s_message){
    var a_arr=[];
    a_arr.push('<div class="box '+s_title+'">');
    a_arr.push('    <table border="0" cellpadding="0" cellspacing="0">');
    a_arr.push('        <tr>');
    a_arr.push('            <td class="icon">&nbsp;');
    a_arr.push('           </td>');
    a_arr.push('            <td class="title"><div class="background"><div></div></div>');
    a_arr.push('            </td>');
    a_arr.push('        </tr>');
    a_arr.push('        <tr>');
    a_arr.push('            <td>&nbsp;');
    a_arr.push('            </td>');
    a_arr.push('            <td class="content">'+s_message);
    a_arr.push('            </td>');
    a_arr.push('        </tr>');
    a_arr.push('        <tr>');
    a_arr.push('            <td>&nbsp;');
    a_arr.push('            </td>');
    a_arr.push('            <td class="button"><div onclick="Common_CloseDialog()"></div><div class="ok" onclick="Dialog_Ok_Button()"></div>');
    a_arr.push('            </td>');
    a_arr.push('        </tr>');
    a_arr.push('    </table>');
    a_arr.push('</div>');
	return a_arr.join('\n')
}
function Common_CloseDialog(){

    window.clearInterval(TimeHandle);
    $("#master_box_bj").hide()
    $("#master_box").hide()
    $("#master_box_loading").hide()
}
function Dialog_SetPosition(){
    var ch = document.compatMode == "BackCompat"?document.body.clientHeight:document.documentElement.clientHeight;
    var cw = document.compatMode == "BackCompat"?document.body.clientWidth:document.documentElement.clientWidth;
    var st = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    var sl = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
    var _div=document.getElementById("master_box");
    var _divloading=document.getElementById("master_box_loading");
    $('#master_box_bj').width(cw+sl)
    $('#master_box_bj').height(ch+st+200)

    _divloading.style.top=((ch - N_Dialog_Height) / 2 + st)+'px';
    _divloading.style.left = ((cw - N_Dialog_Width) / 2 +sl)+'px';
    _div.style.top=((ch - N_Dialog_Height) / 2 + st)+'px';
    _div.style.left = ((cw - N_Dialog_Width) / 2 +sl)+'px';
}
function showBox()
{
    $('#master_box_loading').hide()
    if($('#master_box_bj').css('display')=='block') 
    {
        if ($('#master_box').css('opacity')==0.5)
        {
           $('#master_box').fadeTo(0, 0) 
        }        
	    $('#master_box').fadeTo(300, 1)	
    }else{
    	$('#master_box_bj').fadeTo(0, 0)
	    $('#master_box_bj').show()
	    $('#master_box_bj').fadeTo(300, 0.5)
	    $('#master_box').show()
        if ($('#master_box').css('opacity')==0.5)
        {
           $('#master_box').fadeTo(0, 0) 
        }        
	    $('#master_box').fadeTo(300, 1)	
	    $('#master_box').fadeTo(300, 1)	
    }

}
function showLoading()
{      
	$('#master_box_loading').show()	
}
function hideBox()
{
    $('#master_box_bj').fadeTo(300, 0)
    $('#master_box').fadeTo(300, 0)
}
function Dialog_Iframe(url,width,height,o_func){
    var o_obj=document.getElementById('master_box');
    O_Func=o_func
	window.clearInterval(N_Dialog_TimeHandle);
	N_Dialog_Height=height+50
	N_Dialog_Width=width+50
	o_obj.style.top='-1000px';
	TimeHandle=window.setInterval(Dialog_SetPosition,30)//开始动画
    var a_arr=[];
    a_arr.push('<div class="box box_success" style="width:'+width+'px">');
    a_arr.push('    <table border="0" cellpadding="0" cellspacing="0">');
    a_arr.push('        <tr>');
    a_arr.push('            <td><iframe marginwidth="0" border="0" scrolling="no" frameborder="0" src="'+url+'" style="width:'+width+'px;height:'+height+'px"></iframe>');
    a_arr.push('            </td>');
    a_arr.push('        </tr>');
    a_arr.push('    </table>');
    a_arr.push('</div>');
	o_obj.innerHTML=a_arr.join('\n');	
	showBox()
}