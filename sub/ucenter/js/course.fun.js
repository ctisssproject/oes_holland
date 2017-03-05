function courseTermDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseTermDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除这个学期？<br/>删除后，该学期下所有内容将<br/>同时被删除，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function courseTermDeleteCallback()
{
    location.reload()
    parent.document.getElementsByTagName('frame')[0].contentWindow.location.reload()
}
function courseTermAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 学期名称 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Date').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 创建日期 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_EndDate').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 结束日期 ] 不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();  
}
function courseChapterDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseChapterDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除这个章？<br/>删除后，该章下所有内容将<br/>同时被删除，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function courseChapterDeleteCallback(b)
{
    if (b=='false')
    {
        
    }else{
        location.reload()
    }    
    parent.document.getElementsByTagName('frame')[0].contentWindow.navRefreshOpenNav()
}
function courseChapterAddSubmit()
{
    if (document.getElementById('Vcl_Name').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 章标题 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_SendCredentials1').checked==true)
    {
        
        if (document.getElementById('Vcl_CredentialsName').value=='')
        {
            parent.parent.parent.Dialog_Message('[ 证书名称 ] 不能为空！')
            return
        }
    }
    var text=UE.getEditor('editor').getContent() 
    document.getElementById('Vcl_Content').value=text
    if (document.getElementById('Vcl_Content').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 章介绍 ] 内容不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function courseChapterInputSubmit()
{
    if (document.getElementById('Vcl_TitleId').value==0)
    {
        parent.parent.parent.Dialog_Message('请选择[ 行程名称 ] ！')
        return
    }
    if (document.getElementById('Vcl_SendCredentials1').checked==true)
    {
        
        if (document.getElementById('Vcl_CredentialsName').value=='')
        {
            parent.parent.parent.Dialog_Message('[ 证书名称 ] 不能为空！')
            return
        }
    }
    document.getElementById('submit_form').onsubmit();    
}
function courseChangeType(obj)
{
    parent.parent.Common_OpenLoading()
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseChangeType');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()    
} 
function courseChangeTypeCallback(html)
{
    $('#title').html(html)
    parent.parent.Common_CloseDialog();
} 
function courseTermPublish(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseTermPublish');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    o_ajax_request.PushParameter(0);
    parent.parent.Dialog_Confirm('是否真的发布这个学期？<br/>发布学期后将计算证书有效期<br/>请确认无误后发布！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function courseTermPublishCallback(id,count,start)
{
    if (parseInt(start)>=parseInt(count))
    {
        $('#progress').html('100%')
        parent.parent.Dialog_Message('发布课程成功！',function(){location='course_term.php'})
        return
    }
    $('#progress').html(Math.floor(parseInt(start)/parseInt(count)*100)+'%')
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseTermPublish');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(id);
    o_ajax_request.PushParameter(start);
    o_ajax_request.SendRequest()
}
function courseChapterSetNumber(n_chapterid,n_number)
{
    parent.parent.Common_OpenLoading()
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseChapterSetNumber');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_chapterid);
    o_ajax_request.PushParameter(n_number);
    o_ajax_request.SendRequest()
}
function courseSectionDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSectionDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除这个节？<br/>删除后，该节下所有内容将<br/>同时被删除，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function courseSectionSetNumber(n_sectionid,n_number)
{
    parent.parent.Common_OpenLoading()
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSectionSetNumber');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_sectionid);
    o_ajax_request.PushParameter(n_number);
    o_ajax_request.SendRequest()
}
function courseSectionAddSubmit()
{
    if (document.getElementById('Vcl_Title').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 节标题 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_SubjectSum').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 单次考题数 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Rate').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 正确率 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Time').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 正确率 ] 不能为空！')
        return
    }
    if (document.getElementById('Vcl_Vantage').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 奖励积分 ] 不能为空！')
        return
    }
    var text=UE.getEditor('editor').getContent() 
    document.getElementById('Vcl_Content').value=text
    if (document.getElementById('Vcl_Content').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 节学习内容 ] 不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function courseSectionMoveAndCopySubmit()
{
    if (document.getElementById('Vcl_TermId').value=='')
    {
        parent.parent.parent.parent.Dialog_Message('请选择学期！')
        return
    }
    if (document.getElementById('Vcl_ChapterId').value=='')
    {
        parent.parent.parent.Dialog_Message('请选择章！')
        return
    }
    document.getElementById('submit_form').onsubmit(); 
}
function courseGetChapter(obj)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseGetChapter');
    o_ajax_request.setPage('../include/it_ajax.svr.php');
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()   
}
function courseGetChapterForSearch(obj)
{
    courseSearchSubmit()
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseGetChapter');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()   
}
function courseGetSection(obj)
{
    try
    {
        courseSearchSubmit()
    }catch(e)
    {
    }  
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseGetSection');
    o_ajax_request.setPage('../include/it_ajax.svr.php');
    o_ajax_request.PushParameter(obj.value);
    o_ajax_request.SendRequest()   
}
function courseGetChapterCallback(str)
{
    $('#chapter').html(str)
}
function courseGetSectionCallback(str)
{
    $('#section').html(str)  
}
function courseSubjectAddSubmit()
{
    if (document.getElementById('Vcl_Content').value=='')
    {
        parent.parent.parent.Dialog_Message('[ 题目内容 ] 不能为空！')
        return
    } 
    if (document.getElementById('Vcl_Right_A').checked || document.getElementById('Vcl_Right_B').checked || document.getElementById('Vcl_Right_C').checked || document.getElementById('Vcl_Right_D').checked || document.getElementById('Vcl_Right_E').checked || document.getElementById('Vcl_Right_F').checked)
    {
        
    }else{
        parent.parent.parent.Dialog_Message('请设定 [ 正确答案 ] ！')
        return
    }
    if (document.getElementById('Vcl_Option_A').value=='')
    {
        parent.parent.parent.Dialog_Message('请按顺序填写 [ 选项 ] ！')
        return
    }
    if (document.getElementById('Vcl_Right_A').checked && document.getElementById('Vcl_Option_A').value=='')
    {
        parent.parent.parent.Dialog_Message('A 的选项内容不能为空！')
        return
    }
    if (document.getElementById('Vcl_Right_B').checked && document.getElementById('Vcl_Option_B').value=='')
    {
        parent.parent.parent.Dialog_Message('B 的选项内容不能为空！')
        return
    }
    if (document.getElementById('Vcl_Right_C').checked && document.getElementById('Vcl_Option_C').value=='')
    {
        parent.parent.parent.Dialog_Message('C 的选项内容不能为空！')
        return
    }
    if (document.getElementById('Vcl_Right_D').checked && document.getElementById('Vcl_Option_D').value=='')
    {
        parent.parent.parent.Dialog_Message('D 的选项内容不能为空！')
        return
    }
    if (document.getElementById('Vcl_Right_E').checked && document.getElementById('Vcl_Option_E').value=='')
    {
        parent.parent.parent.Dialog_Message('E 的选项内容不能为空！')
        return
    }
    if (document.getElementById('Vcl_Right_F').checked && document.getElementById('Vcl_Option_F').value=='')
    {
        parent.parent.parent.Dialog_Message('F 的选项内容不能为空！')
        return
    }
    document.getElementById('submit_form').onsubmit();  
}
function courseSubjectDelete(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSubjectDelete');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('是否真的要删除该题？<br/>删除后，不能恢复！！',function(){parent.parent.Common_OpenLoading();o_ajax_request.SendRequest()})
}
function courseSubjectMoveAndCopySubmit()
{
    if (document.getElementById('Vcl_TermId').value=='')
    {
        parent.parent.parent.parent.Dialog_Message('请选择学期！')
        return
    }
    if (document.getElementById('Vcl_ChapterId').value=='')
    {
        parent.parent.parent.Dialog_Message('请选择章！')
        return
    }
    if (document.getElementById('Vcl_SectionId').value=='')
    {
        parent.parent.parent.Dialog_Message('请选择节！')
        return
    }
    document.getElementById('submit_form').onsubmit(); 
}
function courseSectionAddKey(obj)
{
    //替换
    var s_html=$('#Vcl_Key').val()
    while(s_html.indexOf($(obj).html()+';')>=0)
    {
        s_html=s_html.replace($(obj).html()+';',"")
    }
    $('#Vcl_Key').val(s_html+$(obj).html()+';')
}
function courseSectionDeleteKey(obj,n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSectionDeleteKey');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);
    parent.parent.Dialog_Confirm('从库中删除？<br/>删除后，不能恢复！！',function(){o_ajax_request.SendRequest();obj.parentNode.style.display='none'})
}
function courseSearchAddKey(obj)
{
    //替换
    var s_class=obj.parentNode.className
    if (s_class=='keybox')
    {
        obj.parentNode.className='keybox on'
        var s_html=$('#Vcl_Key').val()
        while(s_html.indexOf($(obj).html()+';')>=0)
        {
            s_html=s_html.replace($(obj).html()+';',"")
        }
        $('#Vcl_Key').val(s_html+$(obj).html()+';')
    }else{
        obj.parentNode.className='keybox'
        var s_html=$('#Vcl_Key').val()
        while(s_html.indexOf($(obj).html()+';')>=0)
        {
            s_html=s_html.replace($(obj).html()+';',"")
        }
        $('#Vcl_Key').val(s_html)
    }
    courseSearchSubmit()
}
function courseSearchSubmit(){    
    parent.parent.Common_OpenLoading() 
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSearchSubmit');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter($('#Vcl_Text').val());
    o_ajax_request.PushParameter($('#Vcl_Key').val());
    o_ajax_request.PushParameter($('#Vcl_TermId').val());
    o_ajax_request.PushParameter($('#Vcl_ChapterId').val());
    o_ajax_request.PushParameter($('#Vcl_Display').val());
    o_ajax_request.SendRequest()
}
function courseSearchSubmitCallback(str)
{
    $('#result').html(str)
    parent.parent.Common_CloseDialog() 
}
function courseSectionDeleteForSearch(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSectionDeleteForSearch');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);    
    parent.parent.Dialog_Confirm('是否真的要删除这个节？<br/>删除后，该节下所有内容将<br/>同时被删除，不能恢复！！',function(){
    o_ajax_request.SendRequest();
    $('#total').html(parseInt($('#total').html())-1)
    $('#section_'+n_id).hide()
    })
}
function courseSubjcetDeleteForSearch(n_id)
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('CourseSubjectDeleteForSearch');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.PushParameter(n_id);    
    parent.parent.Dialog_Confirm('是否真的要删除该题？<br/>删除后，不能恢复！！',function(){
    o_ajax_request.SendRequest();
    $('#total').html(parseInt($('#total').html())-1)
    $('#subject_'+n_id).hide()
    })
}
