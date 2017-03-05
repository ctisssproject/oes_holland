function studentDelete(n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('StudentDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要删除此用户？<br/>删除后将不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function studentAllow(n_uid)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('StudentAllow');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_uid);
    parent.parent.Dialog_Confirm('是否要批准注册申请？<br/>批准后用户将收到邮件！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function studentSendMailSubmit()
{
    if (document.getElementById('Vcl_Title').value=='')
    {
        parent.parent.parent.Dialog_Message('标题不能为空！')
        return
    }
    if (document.getElementById('Vcl_Receiver').value=='')
    {
        if(document.getElementById('e-learning').checked==false && document.getElementById('media').checked==false && document.getElementById('travel').checked==false)
        {
            parent.parent.parent.Dialog_Message('收件人或群组至少填写一个！')
            return
        }
    }
    var text=UE.getEditor('editor').getContent() 
    document.getElementById('Vcl_Content').value=text
    if (document.getElementById('Vcl_Content').value=='')
    {
        parent.parent.parent.Dialog_Message('邮件内容不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function selectType()
{
    if (document.getElementById('type').value=='1')
    {
    	rightGoTo('student_all.php?type=0&sleep=0')
        return
    }
    if (document.getElementById('type').value=='2')
    {
    	rightGoTo('student_all.php?type=3&sleep=0')
        return
    }
    if (document.getElementById('type').value=='3')
    {
    	rightGoTo('student_all.php?type=4&sleep=0')
        return
    }
    if (document.getElementById('type').value=='4')
    {
    	rightGoTo('student_all.php?type=5&sleep=0')
        return
    }
    if (document.getElementById('type').value=='5')
    {
    	rightGoTo('student_all.php?type=6&sleep=0')
        return
    }
    if (document.getElementById('type').value=='6')
    {
    	rightGoTo('student_all.php?type=0&sleep=1')
        return
    }
}
var j=1
function displayRegion(obj)
{
    if (j==1)
    {
        obj.innerHTML='取消'
        obj.style.color='red'
        j=0;
    }else{
        obj.innerHTML='添加'
        obj.style.color='green'
        j=1
        //所有的选项都为不选
        var a_input=document.getElementById('region').getElementsByTagName('input')
        for(var i=0;i<a_input.length;i++)
        {
            a_input[i].checked=false
        }
    }
    $('#region').slideToggle() 
    

}