function openPrint(id)  
{  
    window.open('/sub/ucenter/goods_send_print.php?id='+id,'newwindow','height=400,width=500');  
    location.reload();
}
function openPrintSingle(id)  
{  
    window.open('/sub/ucenter/goods_send_print.php?id='+id,'newwindow','height=400,width=500');  
    goBack()
}
function openPrintInfo(id)  
{  
    window.open('/sub/ucenter/goods_send_print.php?id='+id,'newwindow','height=400,width=500');  
}
function resizeLeave1()
{
    try{
        var sl = parent.document.getElementsByTagName("iframe")[0].contentWindow.document.body.scrollHeight
        var obj=parent.document.getElementsByTagName("iframe")[0]
        $(obj).height(sl+10)  
    } catch(e)
    {
    window.alert(e)
    }  
}
function resizeLeave2()
{
    try{
        var obj=parent.parent.parent.document.getElementsByTagName("iframe")[0]
        var h=$('body').height()      
        if (h<400)
        {
            h=400
        }
        $(obj).height(h)  
    } catch(e)
    {
        window.alert(e)
    }   
}
function resizeLeaveRight()
{
    try{
        var obj=parent.parent.parent.document.getElementsByTagName("iframe")[0]
        var h=$('body').height()  
        if (h<400)
        {
            h=400
        }
        if(parent.parent.parent.N_Left>h)
        {
            parent.parent.parent.N_Right=h
            $(obj).height(parent.parent.parent.N_Left) 
            return
        }
        parent.parent.parent.N_Right=h
        $(obj).height(h)  
    } catch(e)
    {
        window.alert(e)
    }   
}
var N_Left=400
var N_Right=400
function resizeLeaveNav()
{
    try{
        var obj=parent.parent.parent.document.getElementsByTagName("iframe")[0]
        var h=$('body').height()
        if (h<400)
        {
            h=400
        }
        if(parent.parent.parent.N_Right>h)
        {        
            $(obj).height(parent.parent.parent.N_Right) 
            parent.parent.parent.N_Left=h
            return
        }        
        parent.parent.parent.N_Left=h
        $(obj).height(h)  
    } catch(e)
    {
        window.alert(e)
    }   
}
function menuToGo(obj,str)
{
    Common_OpenLoading()
    $('.main .my .title_right .menu .button').removeClass("on")
    $(obj).addClass("on")
    document.getElementsByTagName("iframe")[0].src=str
}
function navGoTo(s_url,obj){
    var o_ifram=parent.document.getElementsByTagName('frame')[1]
    try{
    o_ifram.src=s_url
    } catch(e)
    {}   
    $('td').removeClass('nav_on') 
    $(obj).addClass('nav_on') 
    parent.parent.Common_OpenLoading()
}
var S_Nav1_Open="#aaa"
var S_Nav1_Open_Id=0
var S_Nav2_Open_Id=0
var S_Nav2_Open="#aaa"
function navRefreshOpenNav(n_termid,n_chapterid)
{
    if (n_termid>0)
    {
        $("#nav_2_"+n_termid).html("")
    }
    if (n_chapterid>0)
    {
        $("#nav_3_"+n_chapterid).html("")
    }
    if (S_Nav2_Open_Id>0)
    {
        //刷新二级目录的子目录
        //显示进度条
        $(S_Nav2_Open).show()
        $(S_Nav2_Open).html('<img style="margin: 5px" src="../../images/loading.gif" alt="" />')
        //ajax调取二级目录
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CourseGetNav3');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(S_Nav2_Open_Id);
        o_ajax_request.SendRequest()
        
    }else if (S_Nav1_Open_Id>0)
    {
        //刷新以及目录的子目录
        //显示进度条
        $(S_Nav1_Open).show()
        $(S_Nav1_Open).html('<img style="margin: 5px" src="../../images/loading.gif" alt="" />')
        //ajax调取二级目录
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CourseGetNav2');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(S_Nav1_Open_Id);
        o_ajax_request.SendRequest()
    }
}
function nav1GoTo(s_url,obj,id,termid){
    parent.parent.Common_OpenLoading()
    var o_ifram=parent.document.getElementsByTagName('frame')[1]
    try{
    o_ifram.src=s_url
    } catch(e)
    {}  
    $('.nav2').removeClass('nav2_on')  
    $('.nav3').removeClass('nav3_on')
    
    if (id==S_Nav1_Open)
    {
        //$(S_Nav1_Open).slideToggle(function(){$(S_Nav1_Open).html('');S_Nav1_Open="#aaa";S_Nav1_Open_Id=0;resizeLeaveNav()})
        //$(S_Nav2_Open).slideToggle(function(){$(S_Nav2_Open).html('');S_Nav2_Open="#aaa";S_Nav2_Open_Id=0;resizeLeaveNav()})
        return
    }  
    $('.nav1').removeClass('nav1_on') 
    

    
    $(obj).addClass('nav1_on')
    $(S_Nav1_Open).slideToggle()  
    $(S_Nav2_Open).slideToggle()
    S_Nav1_Open=id
    S_Nav1_Open_Id=termid
    S_Nav2_Open="#aaa"  
    S_Nav2_Open_Id=0
    if ($(id).html()=='')
    {
        
        //显示进度条
        $(id).show()
        $(id).html('<img style="margin: 5px" src="../../images/loading.gif" alt="" />')
        //ajax调取二级目录
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CourseGetNav2');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(termid);
        o_ajax_request.SendRequest()
    }else{
        $(id).slideToggle(function(){resizeLeaveNav()})  
    }  
}
function nav1GoToCallback(str)
{
    if (str=='')
    {
        $(S_Nav1_Open).html('')
        $(S_Nav1_Open).hide() 
    }else{
        $(S_Nav1_Open).hide() 
        $(S_Nav1_Open).html(str)
        $(S_Nav1_Open).slideToggle(function(){resizeLeaveNav()})
    }    
}
function nav2GoTo(s_url,obj,id,chapterid){
    parent.parent.Common_OpenLoading()
    var o_ifram=parent.document.getElementsByTagName('frame')[1]
    try{
    o_ifram.src=s_url
    } catch(e)
    {} 
    $('.nav3').removeClass('nav3_on')  
    $('.nav2').removeClass('nav2_on')
    $(obj).addClass('nav2_on') 
    if (id==S_Nav2_Open)
    {
        //$(S_Nav2_Open).slideToggle(function(){$(S_Nav2_Open).html('');S_Nav2_Open="#aaa";S_Nav2_Open_Id=0;resizeLeaveNav()})        
        return
    }       
    $(S_Nav2_Open).slideToggle()    
    S_Nav2_Open=id  
    S_Nav2_Open_Id=chapterid
    if ($(id).html()=='')
    {
        
        //显示进度条
        $(id).show()
        $(id).html('<img style="margin: 5px" src="../../images/loading.gif" alt="" />')
        //ajax调取二级目录
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CourseGetNav3');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(chapterid);
        o_ajax_request.SendRequest()
    }else{
        $(id).slideToggle(function(){resizeLeaveNav()})  
    } 
}
function nav2GoToCallback(str)
{
    if (str=='')
    {
        $(S_Nav2_Open).html('')
        $(S_Nav2_Open).hide() 
    }else{
        $(S_Nav2_Open).hide() 
        $(S_Nav2_Open).html(str)
        $(S_Nav2_Open).slideToggle(function(){resizeLeaveNav()})
    }    
}
function nav3GoTo(s_url,obj){
    parent.parent.Common_OpenLoading()
    var o_ifram=parent.document.getElementsByTagName('frame')[1]
    try{
    o_ifram.src=s_url
    } catch(e)
    {}  
    $('.nav3').removeClass('nav3_on')  
    $(obj.parentNode.parentNode).addClass('nav3_on')   
}
function rightGoTo(url)
{
    parent.parent.Common_OpenLoading()
    location=url
}
var S_BackUrl=document.referrer
function goBack()
{
    location=S_BackUrl
} 
function searchSubmit(url)
{
	if (document.getElementById('Vcl_Key').value=='')
		{	
		parent.parent.parent.Dialog_Message('搜索内容不能为空 ！')
		return
		}
    location=url+'key='+encodeURIComponent(document.getElementById('Vcl_Key').value);
}