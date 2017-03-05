function stopExam(n_result)
{
    //$(".holland a").removeClass('hollandicon')
    //$(".holland a").addClass('iconnone');
    location=n_result
    //setTimeout('document.getElementById("exam").getElementsByTagName("iframe")[0].src="";',300);
    //setTimeout('$("#start").slideToggle()',300);
    //setTimeout('hollandReset()',800);
    //$("#exam").hide();
    //$("#start").show();
    //document.getElementById("exam").getElementsByTagName("iframe")[0].src="";
}
function successExam(n_result)
{
    //$(".holland a").removeClass('hollandicon')
   // $(".holland a").addClass('iconnone');
    //setTimeout('document.getElementById("exam").getElementsByTagName("iframe")[0].src="";',300);
    //setTimeout('$("#success").slideToggle()',300);
    //setTimeout('hollandReset()',800);
    if(n_result==1)
    {
        location='credential.php'      
    //弹出证书寄送地址
    }else{
        location=n_result
    }
}
function examStartTime()
{
    N_Time=N_Time-1
    N_Second=59
    document.getElementById("time").innerHTML='测试剩余时间：'+N_Time+' 分 '+N_Second+' 秒'
    ExamTimeHandle=window.setInterval(examDownTimer,1000)//开始动画
}
function examStartTime()
{
    N_Time=N_Time-1
    N_Second=59
    document.getElementById("time").innerHTML='测试剩余时间：'+N_Time+' 分 '+N_Second+' 秒'
    ExamTimeHandle=window.setInterval(examDownTimer,1000)//开始动画
}
function examDownTimer()
{
    N_Second=N_Second-1
    if (N_Second<0)
    {
        if(N_Time==0)
        {
            //考试结束            
            clearInterval(ExamTimeHandle)
            examStopSubmit()
            return
        }
        //分钟，和秒归位
        N_Time=N_Time-1
        N_Second=59        
    }
    document.getElementById("time").innerHTML='测试剩余时间：'+N_Time+' 分 '+N_Second+' 秒'
}
var N_Subject_Number=1
function examExitSubject(n_number)
{
    N_Subject_Number=N_Subject_Number+1
    $("#number").html('问题 '+N_Subject_Number)
}
function examPrevSubject(n_number)
{
    N_Subject_Number=N_Subject_Number-1
    $("#number").html('问题 '+N_Subject_Number)
}
function hollandReset()
{
    $(".holland a").removeClass('iconnone')
	$(".holland a").addClass('hollandicon');
}
function startExamGuest()
{
    Dialog_Confirm("你不是会员，是否现在就开始注册会员？<br/>注册会员后，可以答题获得积分换好礼！",function(){location='../../register_1.php'})
}
function navShowSection(obj,id)
{
    if ($("#chapter_"+id).is(":hidden"))
    {
        obj.className="add sub"
        obj.parentNode.style.borderRight="0px"
        $(obj).attr("title","收起")
        //obj.parentNode.className="open2"
    }else{
        obj.className="add"
        obj.parentNode.style.borderRight="1px solid #e0e0e0"
        $(obj).attr("title","展开")
        //obj.parentNode.className="open"
    }
    $("#chapter_"+id).slideToggle()    
    obj.parentNode.onclick=function(){}
}
function logout()
{
    var o_ajax_request=new AjaxRequest();
    o_ajax_request.setFunction ('Logout');
    o_ajax_request.setPage('include/it_ajax.svr.php');
    o_ajax_request.SendRequest();
}
function examStopSubmit()
{
    Common_OpenLoading();
    window.alert("对不起，考试已结束，现在必须交卷！")
    document.getElementById('submit_form').submit();
}
function examSubmit()
{
    if (window.confirm('您确定要交卷吗？'))
    {
        Common_OpenLoading();
        document.getElementById('submit_form').submit();
    }    
}