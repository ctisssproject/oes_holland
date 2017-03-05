function modifyInfoSubmit()
{
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        try{
            a_input[i].onfocus()
            a_input[i].onblur()
         }catch(e)
        {
        }
    }
    if (B_Vcl_Sex==false||B_Vcl_Birthday==false||B_Vcl_Name==false||B_Vcl_Company==false||B_Vcl_Job==false||B_Vcl_Dept==false||B_Vcl_Phone==false||B_Vcl_Address==false)
    {
        Dialog_Message("请您完善个人信息后，再提交！")
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function modifyPasswordSubmit()
{
    var o_form=document.getElementById('form')
    var a_input=o_form.getElementsByTagName('input')
    for(var i=0;i<a_input.length;i++)
    {
        try{
            a_input[i].onfocus()
            a_input[i].onblur()
         }catch(e)
        {
        }
    }
    if (B_Vcl_Password_Old==false||B_Vcl_Password==false||B_Vcl_Password2==false)
    {
        Dialog_Message("请您填写正确后，再提交！")
        return
    }
    document.getElementById('submit_form').onsubmit();    
}
function examSubmit()
{
    parent.Dialog_Confirm("您确定要交卷吗？",function(){setTimeout('document.getElementById("submit_form").onsubmit()',300);})
}
function examStopSubmit()
{
    parent.Dialog_Message("对不起，考试已结束，现在必须交卷！",function(){setTimeout('document.getElementById("submit_form").onsubmit()',300);})
}