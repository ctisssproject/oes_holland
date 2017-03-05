    var a_div=document.getElementById('photo')
    a_div=a_div.getElementsByTagName('img')
    $('#photo').width(a_div.length*735)
    var N_Count=a_div.length-2
    var N_Number=1
    if (N_Count==0)
    {
        N_Number=0
    }
    var B_Press=false
    $('.count').html(N_Number+' / '+N_Count)
    //$('#photo1').show()
    $('#text1').show()
    for(var i=1;i<=N_Count;i++)
    {

        //eval('$.extend({photo'+i+'_out:function(){$("#photo'+i+'").fadeOut()}});')
        //eval('$.extend({photo'+i+'_in:function(){$("#photo'+i+'").fadeIn()}});')
        eval('$.extend({text'+i+'_out:function(){$("#text'+i+'").fadeOut()}});')
        eval('$.extend({text'+i+'_in:function(){$("#text'+i+'").fadeIn()}});')
    }
    function next()
    {
        if(B_Press)
        {
            return
        }
        //判断是否到头了，如果到结尾了，就归位
        var a_div=document.getElementById('photo')
        a_div=a_div.getElementsByTagName('img')
        $('#photo').width(a_div.length*735)
        var n_width=0-a_div.length*735+735
        //window.alert($("#photo").offset().left)
        if ($("#photo").offset().left<=n_width)
        {
            //到底了，归位
            document.getElementById('photo').style.left="-735px"
            //$("#photo").offset().left=-375
        }
        
        B_Press=true
        //eval('$.photo'+N_Number+'_out();')
        eval('$.text'+N_Number+'_out();')
        N_Number=N_Number+1
        if(N_Number>N_Count)
        {
            N_Number=1
        }
        $('.count').html(N_Number+' / '+N_Count)
        var left=$("#photo").offset().left-735
        $("#photo").animate({left:left+'px'},"slow");
        setTimeout('$.text'+N_Number+'_in();',500)
        setTimeout('B_Press=false',1000)
    }
    function prev()
    {
        if(B_Press)
        {
            return
        }
        //判断是否到头了，如果到结尾了，就归位
        var a_div=document.getElementById('photo')
        a_div=a_div.getElementsByTagName('img')
        if ($("#photo").offset().left>=0)
        {
            //到底了，归位
            document.getElementById('photo').style.left="-"+(a_div.length-2)*735+"px"
            //$("#photo").offset().left=-375
        }
        
        B_Press=true
        eval('$.text'+N_Number+'_out();')
        N_Number=N_Number-1
        if(N_Number<=0)
        {
            N_Number=N_Count
        }
        $('.count').html(N_Number+' / '+N_Count)
        var left=$("#photo").offset().left+735
        $("#photo").animate({left:left+'px'},"slow");
        setTimeout('$.text'+N_Number+'_in();',500)
        setTimeout('B_Press=false',1000)
    }
    setInterval(next,5000)
function setMoveXById(s_id,n_left){
    O_MoveById=document.getElementById(s_id)
    N_MoveByIdLeft=n_left
    window.clearInterval(N_MoveByIdTimeHandle);
    N_MoveByIdTimeHandle=window.setInterval(timerMoveXById,30)//开始动画 
}