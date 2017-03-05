function travelTitleAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 行程线路名称 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Date').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 创建日期 ] 不能为空！')
        return
    }
    var text = UE.getEditor('editor').getContent()
    document.getElementById('Vcl_Content').value = text
    if (document.getElementById('Vcl_Content').value == '') {
        parent.parent.parent.Dialog_Message('[ 介绍 ] 内容不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();  
}
function travelTitleDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelTitleDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除此行程路线？<br/>删除后，该行程下所有内容将<br/>同时被删除，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function travelTitleDeleteCallback()
{
    location.reload()
    parent.document.getElementsByTagName('frame')[0].contentWindow.location.reload()
}
function travelItemAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 分站名称 ] 不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function travelItemDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelItemDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除此分站？<br/>删除后，该分站下所有内容将<br/>同时被删除，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function travelItemDeleteCallback(b)
{
    if (b=='false')
    {
        
    }else{
        location.reload()
    }    
    parent.document.getElementsByTagName('frame')[0].contentWindow.navRefreshOpenNav()
}
function travelItemSetNumber(n_chapterid,n_number)
{
    parent.parent.Common_OpenLoading()
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelItemSetNumber');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_chapterid);
    o_ajax_request.PushParameter(n_number);
    o_ajax_request.SendRequest()
}
function travelSelectCity()
{
    var city=document.getElementById('Vcl_CityId').value
    var type=document.getElementById('Vcl_TypeId').value
    parent.parent.Common_OpenLoading()
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelGetRegion');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(city);
    o_ajax_request.PushParameter(type);
    o_ajax_request.SendRequest()
    $('#hotel').html('')
}
function travelSelectCityCallback(str)
{
    parent.parent.Common_CloseDialog()
    $('#region').html(str)
}
function travelSelectCityForHotel(obj)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelGetHotel');
    o_ajax_request.setPage('../include/it_ajax.svr.php');
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()
}
function travelSelectCityForHotelCallback(str)
{
    $('#hotel').html(str)
}
function travelItemAddHotel(id,str)
{
    //var id=Math.floor(Math.random()*1000000+1)
    //window.alert(str)
    var html=$('#hotel').html()
    if (html.indexOf('Vcl_HotelId_'+id)>0)
    {
        return
    }else{
        $('#hotel').html($('#hotel').html()+'<div style="padding:0px 5px 0px 5px;"><input type="hidden" name="Vcl_HotelId_'+id+'" id="Vcl_HotelId_'+id+'" value="'+id+'" /><span style="color:#0F85B7;font-weight:bold">'+str+'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:red" href="javascript:;" onclick="this.parentNode.innerHTML=\'\'">删除</a></div>')
    }
    
}
function travelDetailDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelDetailDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除此时间段？<br/>删除后，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function travelDetailDeleteCallback()
{
    parent.document.getElementsByTagName('frame')[0].contentWindow.navRefreshOpenNav()
    location.reload()
}
function travelTypeAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 分类名称 ] 不能为空！')
        return
    } 
    document.getElementById('submit_form').onsubmit();  
}
function travelTypeDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('TravelTypeDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除此分类？<br/>分类下的行程将一起删除！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}