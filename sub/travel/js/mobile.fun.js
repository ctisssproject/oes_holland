function days_click(obj,id)
{
    $(obj).css('background-color', '#F08311');
    setTimeout("$('.day').css('background-color', '#F7F7F7');",300)
    $('#day_content_' + id).slideToggle()
}
function region_click(obj,id)
{
    //$(obj).css('background-color', '#F08311');
    //$(obj).css('color', '#ffffff');
    //setTimeout("$('.t1').css('background-color', '#F7F7F7');$('.t1').css('color', '#55CDE7');",300)
    $('#region_' + id).slideToggle()
    document.getElementById('region_'+id+'_photo').src="content_mobile_photo.php?id="+id;
    
}
function nav_click(obj,id)
{
    $('.nav div').removeClass('on')
    $(obj).addClass('on')
    if ($('#nav_menu_' + id).is(":hidden") == false) {
        $('#nav_menu_' + id).slideToggle()
        return
    }
    $('.nav_menu').hide();
    $('#nav_menu_' + id).slideToggle()

}
function qqWeibo(content,url,picurl)  
{  
    var shareqqstring='http://v.t.qq.com/share/share.php?title='+content+'&url='+url+'&pic='+picurl;  
    window.open(shareqqstring,'newwindow','height=399,width=618,top=100,left=100');  
}  
function qqZone(title,url,picurl)  
{  
    var shareqqzonestring='http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?summary='+title+'&url='+url+'&pics='+picurl;  
    window.open(shareqqzonestring,'newwindow','height=450,width=650,top=100,left=100');  
} 
function sinaWeibo(title,url,picurl)  
{  
    var sharesinastring='http://v.t.sina.com.cn/share/share.php?title='+title+'&url='+url+'&content=utf-8&sourceUrl='+url+'&pic='+picurl; 
    window.open(sharesinastring,'newwindow','height=533,width=810,top=100,left=100');  
}
//$(function(){
//    orient();
//});
//$(window).bind( 'orientationchange', function(e){
//    orient();
//});
//function orient() {
//    if (window.orientation == 90 || window.orientation == -90) {
//        //ipad、iphone竖屏；Andriod横屏
//        $("body").attr("class", "landscape");
//        orientation = 'landscape';
//        window.alert('横')
//        return
//    }else if (window.orientation == 0 || window.orientation == 180) {
//        //ipad、iphone横屏；Andriod竖屏
//        $("body").attr("class", "portrait");
//        orientation = 'portrait';
//        window.alert('竖')
//        return
//    }
//}
$(window).load(function(){resizeLayout()});
 $(window).resize(function(){resizeLayout();});
 function resizeLayout()
 {
    var ch = document.compatMode == "BackCompat"?document.body.clientHeight:document.documentElement.clientHeight;
    var cw = document.compatMode == "BackCompat"?document.body.clientWidth:document.documentElement.clientWidth;
    var st = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    var sl = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
var width=cw+sl-10-45
var height=ch+st-10-45
var iheight=Math.round((cw+sl)*411/654)-1
$('.go_top').css('margin-top', height+'px');
$('.go_top').css('margin-left', width+'px');
$('iframe').css('height', iheight+'px');
 }