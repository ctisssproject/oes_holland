function changeNav(obj)
{
      //如果已经是焦点，那么没有变化
      var id=$(obj).attr("id");
      id=id.replace("nav","#box");
      if($(id).is(':hidden')==false)return;
      var sub=document.getElementById("nav").getElementsByTagName('div')
      //把所有导航文字颜色恢复成蓝色
      var showid='';
      for(var i=0;i<sub.length-1;i++)
      {
            $(sub[i]).removeClass('nav_but_on')
            //寻找哪个正在显示
            id=$(sub[i]).attr("id");
            id=id.replace("nav","#box");
            if($(id).is(':hidden')==false)showid=id;
            
      }
      var sub=document.getElementById("menu").getElementsByTagName('li')
      //把所有导航文字颜色恢复成蓝色
      for(var i=0;i<sub.length;i++)
      {
            $(sub[i]).removeClass('nav_but_on')
            //寻找哪个正在显示
            id=$(sub[i]).attr("id");
            id=id.replace("nav","#box");
            if($(id).is(':hidden')==false)showid=id;
            
      }
      //设置新的导航焦点
      $(obj).addClass('nav_but_on')
      //展示画面切换
      id=$(obj).attr("id");
      id=id.replace("nav","#box");
      eval("$(showid).fadeOut(function(){$('"+id+"').fadeIn()}); ")   
      setTimeout  
}
function changeNavForList(obj)
{
      //如果已经是焦点，那么没有变化
      var id=$(obj).attr("id");
      id=id.replace("nav","#");
      if($(id).is(':hidden')==false)
      {
        $(obj).removeClass('nav_but_on')
        if (obj=='#0')
        {
            $(obj).css('color','#55cde7');
        }
        $(id).slideToggle()
        return;
      }
      var sub=document.getElementById("nav").getElementsByTagName('div')
      //把所有导航文字颜色恢复成蓝色
      var showid='';
      var temp='';
      for(var i=0;i<sub.length-1;i++)
      {
            $(sub[i]).removeClass('nav_but_on')
            //寻找哪个正在显示
            temp=$(sub[i]).attr("id");
            temp=temp.replace("nav","#"); 
            if($(temp).is(':hidden')==false)
            {
                showid=temp;
                $(temp).hide();
            }         
      }
      
      //设置新的导航焦点
      if (id=='#0')
      {
            $(obj).css('color','#F08300');
      }else{
            $('#nav0').css('color','#55cde7');
            $(obj).addClass('nav_but_on')
      }
            if($('#0').is(':hidden')==false)
            {
                showid='#0';
                $('#0').hide();
            } 
      if (showid=='')
      {
        $(id).slideToggle()
      }else{
        $(id).show()
      }
      
      //展示画面切换
}
function hidesubmenu()
{
    $('#menu').hide()
}
function extension(obj)
{
    var id=$(obj).parent().parent().attr("id");
    id=id.replace("box","");
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GetTitle');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(id);
    var sum=6;
    eval("sum=Num"+id)
    o_ajax_request.PushParameter(sum);
    o_ajax_request.SendRequest()
    //window.alert(sum)
    //extensionCallback(id,'<div class="mini_box" style="display:none;margin-right:35px;"><a href="javascript:;"><img alt="" src="images/temp/02.jpg" /></a></div><div class="mini_box" style="display:none;margin-right:35px;"><a href="javascript:;"><img alt="" src="images/temp/02.jpg" /></a></div><div class="mini_box" style="display:none"><a href="javascript:;"><img alt="" src="images/temp/02.jpg" /></a></div>',1)
}
function extensionCallback(id,html,have)
{
    var obj=$('#box'+id).find('.fu_img')
    obj.append(html)
    var sub=$(obj).children()
    $(sub[sub.length-1]).slideToggle()
    $(sub[sub.length-2]).slideToggle()
    $(sub[sub.length-3]).slideToggle()
    //如果后面没了，那么隐藏展开按钮
    eval("Num"+id+"=Num"+id+"+3")
    if (have==0)
    {
        $('#box'+id).find('.add').hide()
    }
}
function inputOnfocus(o_obj)
{
    if ($(o_obj).val()=='可用荷兰专家账号')
    {
        $(o_obj).val('')
    }
}
function checkInputUserName(o_obj)
{
    if ($(o_obj).val()=="")
    {
        $(o_obj).val('可用荷兰专家账号')
    }
}

function changeSet(obj,id)
{   
    Common_OpenLoading()
    $('.content_site_icon div').removeClass("on")
    $(obj).addClass("on")
    document.getElementsByTagName("iframe")[0].src="content_site.php?id="+id
    //setTimeout('document.getElementsByTagName("iframe")[0].src="content_site.htm?id"',1000)
}
function qqWeibo(content,url,picurl)  
{  
    var shareqqstring='http://v.t.qq.com/share/share.php?title='+content+'&url='+url+'&pic='+picurl;  
    window.open(shareqqstring,'newwindow','height=399,width=618,top=100,left=100');  
}  
function qqZone(title,url,picurl)  
{  
    var shareqqzonestring='http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?summary='+title+'&url='+url+'&pics='+picurl;  
    window.open(shareqqzonestring,'newwindow','height=450,width=650,top=100,left=100');  
} 
function sinaWeibo(title,url,picurl)  
{  
    var sharesinastring='http://v.t.sina.com.cn/share/share.php?title='+title+'&url='+url+'&content=utf-8&sourceUrl='+url+'&pic='+picurl; 
    window.open(sharesinastring,'newwindow','height=533,width=810,top=100,left=100');  
}
function downTravel(id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('DownTravel');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(id);
    o_ajax_request.SendRequest()
    Common_OpenLoading();
}
function downTravelCallback()
{
    Dialog_Success('该行程已经下载到您的邮箱！<br/>请查收！')
}