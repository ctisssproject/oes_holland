function systemNewsDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemNewsDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个资讯？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemNewsState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemNewsState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要'+s_str+'这条资讯吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemNewsAddSubmit()
{
    if (document.getElementById('Vcl_Date').value=='')
    {
        parent.parent.parent.Dialog_Message('标题不能为空！')
        return
    }
    if (document.getElementById('Vcl_Title').value=='')
    {
        parent.parent.parent.Dialog_Message('标题不能为空！')
        return
    }
    var text=UE.getEditor('editor').getContent() 
    document.getElementById('Vcl_Content').value=text
    if (document.getElementById('Vcl_Content').value=='')
    {
        parent.parent.parent.Dialog_Message('内容不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function systemAdvertDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemAdvertDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个广告？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemAdvertState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemAdvertState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要'+s_str+'这条广告吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemAdvertAddSubmit()
{
    if (document.getElementById('Vcl_Url').value=='')
    {
        parent.parent.parent.Dialog_Message('连接地址不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function systemPartnersDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemPartnersDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个合作伙伴？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemPartnersState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemPartnersState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要'+s_str+'这个合作伙伴吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemPartnersAddSubmit()
{
    if (document.getElementById('Vcl_Url').value=='')
    {
        parent.parent.parent.Dialog_Message('连接地址不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function systemFocusDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemFocusDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个焦点图？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemFocusState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemFocusState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要'+s_str+'这个焦点图吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemFocusAddSubmit()
{
    document.getElementById('submit_form').onsubmit();    
}
function systemSetupSubmit()
{
    if (document.getElementById('Vcl_Invitation').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 邀请奖分 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_InvitationSum').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 邀请次数 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Term').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 证书有效期 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_IsSleep').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 睡眠时间 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Reward').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 专家奖分 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Host').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 本站网址 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Copyright').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 版权说明 ] 不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}

function systemFocusDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemFocusDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个焦点图？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemVantageDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemVantageDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个焦点图？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function systemVantageState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('SystemVantageState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要'+s_str+'这个焦点图吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}