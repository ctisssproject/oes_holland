//______________________________________________________________________________________________________________>'Ajax通讯类
function AjaxPostRequest() {
    this.S_Page = 'include/bn_submit.switch.php'; //发送服务器地址
    this.S_Prefix='Ajax_';
    this.S_MainName = 'ajax_post'
    if (!document.getElementById(this.S_MainName)) {
        //如果不存在，那么新建整个form
        //插入一个Div用来装载需要提交的内容
        var o_div = document.createElement('div');
        o_div.setAttribute('id', this.S_MainName)
        $("body").append(o_div)
        //把Div设置成隐藏
        $("#"+this.S_MainName).hide()
        //添加form表单
        var a_arr = [];
        a_arr.push('<form action="" method="post" name="ajax_post_form" id="ajax_post_form" target="ajax_post_frame" enctype="multipart/form-data">');
        a_arr.push('<input name="Ajax_FunName" type="text" id="Ajax_FunName" value=""/>')
        a_arr.push('</form>');
        a_arr.push('<iframe id="ajax_post_frame" name="ajax_post_frame" src="about:blank"></iframe>')
        $("#"+this.S_MainName).html(a_arr.join('\n'))
    }
    this.O_Form = document.getElementById('ajax_post_form')
    this.O_FunName = document.getElementById('ajax_post_form').getElementsByTagName('input')[0]
}
AjaxPostRequest.prototype.SendRequest = function () {
    this.O_Form.action = this.S_Page
    this.O_Form.submit()
}
AjaxPostRequest.prototype.setFunction = function (s_function) {//
    this.O_FunName.value = s_function;
}
AjaxPostRequest.prototype.setParameter = function (s_funname, s_parameter) {//
    if (!document.getElementById(this.S_Prefix + s_funname)) {
        var o_div = document.createElement('input');
        o_div.setAttribute('name', this.S_Prefix + s_funname)
        o_div.setAttribute('id', this.S_Prefix + s_funname)
        o_div.setAttribute('value', s_parameter)
        o_div.setAttribute('type', 'text')
        $("#ajax_post_form").append(o_div)
    } else {
        $("#"+this.S_Prefix + s_funname).val(s_parameter)
    }
}
AjaxPostRequest.prototype.setPage = function (s_page) {//
    this.S_Page = s_page;
}
//______________________________________________________________________________________________________________>'通用回调函数,用于执行服务器发回的JavaScript语句
$(window).load(function(){O_Ajax=new AjaxPostRequest()});
var O_Ajax
