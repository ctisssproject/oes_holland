function checkPasswordOld(obj)
{
    if (obj.value=='')
    {
        $('#'+obj.id+'_no').show()
        $('#'+obj.id+'_ok').hide()
        $('#'+obj.id+'_no').html('不能为空')        
    }else{
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('CheckPasswordOld');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(obj.value);
        o_ajax_request.SendRequest() 
        return
    }
    eval('B_'+obj.id+'=false;') 
}
function checkPasswordOldCallback(str)
{
    if (str=='true')
    {
        $('#Vcl_Password_Old_ok').show()
        $('#Vcl_Password_Old_no').hide()
        B_Vcl_Password_Old=true
    }else{
        $('#Vcl_Password_Old_no').show()
        $('#Vcl_Password_Old_ok').hide()
        $('#Vcl_Password_Old_no').html('原始密码错误')
        B_Vcl_Password_Old=false
    }
}
function credentialStyleModify(id) {
    Common_OpenLoading();
    var o_ajax_request = new AjaxRequest();
    o_ajax_request.setFunction('CredentialStyleModify');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(id);
    o_ajax_request.SendRequest()

}
function credentialStyleModifyCallback(id) {
    Common_OpenLoading();
    Dialog_Success("修改证书样式成功！", function () { location = 'index.php' })
}