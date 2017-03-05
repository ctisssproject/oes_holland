function regionDelete(n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('RegionDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要删除此景区？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function regionAddSubmit() {
    if (document.getElementById('Vcl_Name').value=="")
    {
        parent.parent.parent.Dialog_Message('资料名称不能为空！')
        return
    }
    if (document.getElementById('Vcl_Street').value=="")
    {
        parent.parent.parent.Dialog_Message('街道不能为空！')
        return
    }
    if (document.getElementById('Vcl_Address').value=="")
    {
        parent.parent.parent.Dialog_Message('门牌号不能为空！')
        return
    }
    if (document.getElementById('Vcl_Zip').value=="")
    {
        parent.parent.parent.Dialog_Message('邮编不能为空！')
        return
    }
    if (document.getElementById('Vcl_Tel').value=="")
    {
        parent.parent.parent.Dialog_Message('电话不能为空！')
        return
    }
    if (document.getElementById('Vcl_Price').value=="")
    {
        parent.parent.parent.Dialog_Message('景区价格不能为空！')
        return
    }
    var text=UE.getEditor('editor').getContent() 
    document.getElementById('Vcl_Content').value=text
    document.getElementById('submit_form').onsubmit();
}
function regionAddKey(obj) {
    //替换
    var s_html = $('#Vcl_Key').val()
    while (s_html.indexOf($(obj).html() + ';') >= 0) {
        s_html = s_html.replace($(obj).html() + ';', "")
    }
    $('#Vcl_Key').val(s_html + $(obj).html() + ';')
}
function regionDeleteKey(obj, n_id) {
    var o_ajax_request = new AjaxRequest();
    o_ajax_request.setFunction('CourseSectionDeleteKey');
    o_ajax_request.setPage('../ucenter/include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('从库中删除？<br/>删除后，不能恢复！！', function () { o_ajax_request.SendRequest(); obj.parentNode.style.display = 'none' })
}
function regionPhotoDelete(n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('RegionPhotoDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要删除此图片？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}