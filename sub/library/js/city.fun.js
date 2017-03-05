function cityDelete(n_uid,n_hotel,n_region)
{
	if (n_hotel>0 || n_region>0)
	{
		parent.parent.parent.Dialog_Message('请先删除该城市下的<br/>酒店与景区资料！')
        return
	}
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CityDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要删除此城市？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function cityAddSubmit() {
    if (document.getElementById('Vcl_Name').value=="")
    {
        parent.parent.parent.Dialog_Message('城市名称不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}