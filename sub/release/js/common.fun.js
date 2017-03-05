function getGoodsByCode()
{
    if (document.getElementById('Vcl_OrderNumber').value=='')
    {
        $('#result').html('')
        resizeLeave2()
        document.getElementById('Vcl_OrderNumber').focus();
        return
    }
    parent.parent.Common_OpenLoading();
        var o_ajax_request=new AjaxRequest();
        o_ajax_request.setFunction ('GetGoodsByCode');
        o_ajax_request.setPage('include/it_ajax.svr.php');
        o_ajax_request.PushParameter(document.getElementById('Vcl_OrderNumber').value);
        o_ajax_request.SendRequest()
}
function getGoodsByCodeCallback(str)
{
    $('#result').html(str)
    parent.parent.Common_CloseDialog()
    document.getElementById('Vcl_OrderNumber').value='';
    resizeLeave2()
    document.getElementById('Vcl_OrderNumber').focus();
}