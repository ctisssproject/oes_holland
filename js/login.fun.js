function changeBackground(o_obj,s_path)
{
    o_obj.style.backgroundImage="url('"+s_path+"')"
}
function inputOnfocus(o_obj)
{
    o_obj.focus()
    o_obj.select();
    o_obj.style.backgroundImage="none"
}
function checkInputUserName(o_obj)
{
    if (o_obj.value=="")
    {
        o_obj.style.backgroundImage="url('images/login_username_text.png')"
    }
}
function checkInputPassword(o_obj)
{
    if (o_obj.value=="")
    {
        o_obj.style.backgroundImage="url('images/login_password_text.png')"
    }
}