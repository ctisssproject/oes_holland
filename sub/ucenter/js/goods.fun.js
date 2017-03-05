function goodsCredentialCheck(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsCredentialCheck');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要通过这个申请？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsCredentialDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsCredentialDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个申请？<br/>删除后将不能恢复！！<br/>将会以邮件方式通知用户！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsCredentialSendSubmit()
{
    if (document.getElementById('Vcl_OrderNumber').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 运单号 ] 不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function goodsInformationUseDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsInformationUseDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个申请？<br/>删除后将不能恢复！！<br/>将会以邮件方式通知用户！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsPrizeExchangeCheck(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsPrizeExchangeCheck');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要通过这个申请？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsGetSingleExpert(obj)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsGetSingleExpert');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()   
}
function foodGetSingleExpertCallback(str)
{
    $('#chapter').html(str)
}
function goodsPrizeAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 奖品名称 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Vantage').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 兑换积分 ] 不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function goodsPrizeDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsPrizeDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个奖品？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsPrizeState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsPrizeState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是要'+s_str+'这个奖品吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsInformationAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 材料名称 ] 不能为空！')
        return
    }
    if (parseInt(document.getElementById('Vcl_Sum').value)>0)
    {        
    }else{
        parent.parent.parent.Dialog_Message('请正确填写 [ 领用数量 ] ！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function goodsInformationDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsInformationDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否要删除这个材料？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function goodsInformationState(s_str,n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('GoodsInformationState');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是要'+s_str+'这个材料吗？',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}