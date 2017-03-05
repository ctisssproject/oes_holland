function Disabled_Vcl(){
    for(var i = 0; i < document.getElementsByTagName("input").length; i++){
        //document.getElementsByTagName("input")[i].disabled="disabled"
    }    
}
function Enable_Vcl(){
    for(var i = 0; i < document.getElementsByTagName("input").length; i++){
        //document.getElementsByTagName("input")[i].disabled=""
    }    
}
function getExt(path) {
	return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
}
function getPath(obj){
	if (obj) {
		if (is_ie) {
			obj.select();
			// IE下取得图片的本地路径
			return document.selection.createRange().text;
			
		} else if(is_moz) {
				if (obj.files) {
					// Firefox下取得的是图片的数据
					return obj.files.item(0).getAsDataURL();
				}
				return obj.value;
		}
		return obj.value;
	}
}
var userAgent = navigator.userAgent.toLowerCase();
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko') && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);
var is_safari = (userAgent.indexOf('webkit') != -1 || userAgent.indexOf('safari') != -1);
var S_Root='';
function Common_Register(){
    //验证用户输入
    var s_username=document.getElementById('Vcl_UserName').value;
    var s_password1=document.getElementById('Vcl_Password1').value;
    var s_password2=document.getElementById('Vcl_Password2').value;
    var s_email=document.getElementById('Vcl_Email').value;
    var o_showtext=document.getElementById('ShowText')
    if (s_username.length==0){
        o_showtext.innerHTML="用户名不能为空"
        return
    }
    if (s_username.length<4){
        o_showtext.innerHTML="用户名不能小于4个字符"
        return
    }
    if (s_password1.length==0){
        o_showtext.innerHTML="密码不能为空"
        return
    }
    if (s_password1.length<6){
        o_showtext.innerHTML="密码不能小于6个字符"
        return
    }
    if (s_password1!=s_password2){
        o_showtext.innerHTML="两次输入的密码不一致"
        return
    }
    if (s_email.length==0){
        o_showtext.innerHTML="Email不能为空"
        return
    }
    document.getElementById('dialog_form').submit();
    if (!is_moz){
        Common_OpenLoading();   
    }
}
function Common_SubmitLoading(s_formid){
    document.getElementById(s_formid).submit();
    if (!is_moz){
        Common_OpenLoading();   
    } 
}
function Common_Refresh_Submit(){
    window.navigate('www.newcbd.cn')   
    if (!is_moz){
    //window.navigate('http://www.newcbd.cn') 
        history.go(0); 

    }else{
        location.reload()
        //window.navigate('http://www.newcbd.cn') 
    } 
}
function Common_TextTotal(s_vclid,s_textid,n_number){//统计还可输入多少文字
    var o_vcl=document.getElementById(s_vclid)
    var o_output=document.getElementById(s_textid)
    var s_text=o_vcl.value;
    o_vcl.value=s_text.substring(0,n_number)
    o_output.innerHTML=n_number-s_text.length
}
function Common_ShowPage(s_site_map,s_content){  
    var o_content=document.getElementById('content');
    var o_site_map=document.getElementById('site_map');
    o_content.innerHTML=s_content;
    o_site_map.innerHTML=s_site_map;
    Common_CloseDialog()
} 
function goLoginPage(s_root)
{
    if (s_root==null)
    {
    s_root=S_Root
    }
    try
    {
        parent.parent.window.open(s_root+'login.php','_parent')
        return
    }
    catch(e)
    {
    }
    try
    {
        parent.window.open(s_root+'login.php','_parent')
        return
    }
    catch(e)
    {
    }
    try
    {
        window.open(s_root+'login.php','_parent')
        return
    }
    catch(e)
    {
    }
}
function inputTipText(o_obj,s_text)
{
    o_obj.value=s_text;
    o_obj.style.color='#8896A0';
    o_obj.onmouseover=function(){
        if(o_obj.value==s_text)
        {
            o_obj.style.color='#000000';
        }
    }
    o_obj.onmouseout=function(){
        if(o_obj.value==s_text)
        {
            o_obj.style.color='#8896A0';
        }
    }
    o_obj.onfocus=function(){
        if(o_obj.value==s_text)
        {
            o_obj.value='';
            o_obj.style.color='#000000';
        }
    }
    o_obj.onblur=function(){
        if(o_obj.value=='')
        {
            o_obj.value=s_text;
            o_obj.style.color='#8896A0';
        }
    }
}
//用于传递转换为日志的参数
var N_Year=0;
var N_Month=0;
var N_Day=0;
var S_Time=''
var S_Address='';
var S_Content='';
//-----------------------
function checkIE()
{
	try
	{
	    var isIE = (document.all) ? true : false;
	    var isIE6 = isIE && ([/MSIE (\d)\.0/i.exec(navigator.userAgent)][0][1] == 6);
	    if(isIE6)
	    {
	        window.alert("您的IE浏览器版本过低！！\n\n为了不影响网站整体观看效果\n\n请您使用IE 8.0以上的浏览器浏览。")
	    }		
	}catch(e){
		
	}
}
checkIE()

function goTo(s_url)
{
    location=s_url
}
function goToOpen(s_url)
{
    window.open(s_url,'_blank');
}
function isMobile(str) 
{
    if (str.toString().length != 11) return false;
    var prefix = [130,133,135,189,137,136,131,134,138,139,150,151,152,155,156,185,132,153,158,187,182,159,186,180,181,157,182,187,188,145,147,188];
    var re = new RegExp("^(" + prefix.join("|") + ")\\d+$");
    return re.test(str);
}
function isEmail(strEmail) { 
    if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
         return true; 
    else 
        return false;
}
function IsInteger(fData)
{
    //如果为空，返回true
    if ((isNaN(fData)) || (fData.indexOf(".")!=-1) || (fData.indexOf("-")!=-1))
        return false    
    
    return true    
}