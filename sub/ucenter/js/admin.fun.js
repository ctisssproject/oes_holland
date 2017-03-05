function adminState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('AdminState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要'+s_str+'此用户？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function adminDelete(n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('AdminDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要删除此用户？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function AdminResetPasswordSubmit()
{
    if (document.getElementById('Vcl_Password').value.length<6)
    {
        parent.parent.parent.Dialog_Message('新密码不能少于6位！')
        return
    }
    if (document.getElementById('Vcl_Password').value != document.getElementById('Vcl_Password2').value)
    {
        parent.parent.parent.Dialog_Message('两次输入的密码不一致！')
        return
    }
    document.getElementById('submit_form').onsubmit();
    
}
function AdminAddSubmit()
{
    if (document.getElementById('Vcl_UserName').value=="")
    {
        parent.parent.parent.Dialog_Message('用户名不能为空！')
        return
    }
    if (document.getElementById('Vcl_Password').value.length<6)
    {
        parent.parent.parent.Dialog_Message('新密码不能少于6位！')
        return
    }
    if (document.getElementById('Vcl_Password').value != document.getElementById('Vcl_Password2').value)
    {
        parent.parent.parent.Dialog_Message('两次输入的密码不一致！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function AdminModifySubmit()
{
    if (document.getElementById('Vcl_UserName').value=="")
    {
        parent.parent.parent.Dialog_Message('用户名不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
