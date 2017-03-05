function hotelDelete(n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('HotelDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要删除此酒店？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function hotelAddSubmit() {
    if (document.getElementById('Vcl_Name').value=="")
    {
        parent.parent.parent.Dialog_Message('酒店名称不能为空！')
        return
    }
    if (document.getElementById('Vcl_Price').value=="")
    {
        parent.parent.parent.Dialog_Message('酒店价格不能为空！')
        return
    }
    var text=UE.getEditor('editor').getContent() 
    document.getElementById('Vcl_Content').value=text
    document.getElementById('submit_form').onsubmit();
}