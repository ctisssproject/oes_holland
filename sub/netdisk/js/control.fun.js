﻿   function resizeLayout()
   {
      // 主操作区域高度
      var wWidth = (window.document.documentElement.clientWidth || window.document.body.clientWidth || window.innerHeight);
      var wHeight = (window.document.documentElement.clientHeight || window.document.body.clientHeight || window.innerHeight);
      var nHeight = $('#north').is(':visible') ? $('#north').outerHeight() : 0;
      var fHeight = $('#funcbar').is(':visible') ? $('#funcbar').outerHeight() : 0;
      var cHeight = wHeight - nHeight - fHeight - $('#south').outerHeight() - $('#taskbar').outerHeight()-66;
      $('#center').height(cHeight);
      
      $("#center iframe").css({height: cHeight});

/*
      if(isTouchDevice())
      {
         $('.tabs-panel:visible').height(cHeight);
         if($('.tabs-panel > iframe:visible').height() > cHeight)
            $('.tabs-panel:visible').height($('.tabs-panel > iframe:visible').height());
      }
*/
      //一级标签宽度
   };
function showButton(obj)
 {
    a_div=obj.getElementsByTagName('div')
    if (a_div.length>1)
    {
        a_div[3].style.display='block'
    }else{
        a_div[0].style.display='block'
    }
 }
function hideButton(obj)
 {
    a_div=obj.getElementsByTagName('div')
    if (a_div.length>1)
    {
        a_div[3].style.display='none'
    }else{
        a_div[0].style.display='none'
    }
 }
function selected(obj)
 {
    if (obj.getElementsByTagName('input')[0].checked==true)
    {
        obj.className='off' 
        obj.getElementsByTagName('input')[0].checked=false 
    }else{
        obj.getElementsByTagName('input')[0].checked=true
        obj.className='on' 
    }

 }
function selectedForCheck(obj)
 {
    if (obj.checked==true)
    {
        obj.parentNode.className='off'
        obj.checked=false 
    }else{
        obj.parentNode.className='on'
        obj.checked=true 
    }
}
function selectAll(obj)
{
   if (obj.checked==true)
    {
        var a_obj=document.getElementsByTagName('input')
        for (var i=0;i<a_obj.length;i++)
        {
            a_obj[i].parentNode.parentNode.className='on'
            a_obj[i].checked=true 
        }
    }else{
        var a_obj=document.getElementsByTagName('input')
        for (var i=0;i<a_obj.length;i++)
        {
            a_obj[i].parentNode.parentNode.className='off'
            a_obj[i].checked=false 
        }
 
    }

}
function goTo(s_url){
    var o_ifram=parent.document.getElementsByTagName('frame')[1]
    try{
    o_ifram.src=s_url
    } catch(e)
    {}
    
}
function goUp(s_id){
    
    try{
        parent.document.getElementsByTagName('frame')[0].contentWindow.refreshPath(s_id) 
     } catch(e)
    {}  
    location='explorer.php?folderid='+s_id; 
}
function goIn(s_parent,s_id){
    try{
        parent.parent.document.getElementsByTagName('frame')[0].contentWindow.refreshPath(s_parent) 
        var o_ifram=parent.parent.document.getElementsByTagName('frame')[1]
        o_ifram.src='explorer.php?folderid='+s_id; 
    } catch(e)
    {
    
    }
    
}