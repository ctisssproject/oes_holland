/*********************焦点*************************/
pageConfig.TPL_MSlide={
    itemsWrap:"<ul class=\"slide-items\">{innerHTML}</ul>",
    itemsContent:"{for item in json}"
        +"<li data-tag=\"${item.aid}\">"
            +"{var v=item.data}"
            +"<a href=\"${v.href}\" target=\"_blank\" title=\"${v.alt}\" >"
                +"<img height=\"${v.height}\" width=\"${v.width}\" src=\"${v.src}\" data-img=\"2\" />"
            +"</a>"
        +"</li>"
    +"{/for}",
    controlsWrap:"<div class=\"slide-controls\">{innerHTML}</div>",
    controlsContent:"{for item in json}"
        +"<span class=\"{if parseInt(item_index)==0}curr{/if}\">${parseInt(item_index)+1}</span>"
    +"{/for}"
};

jQuery("#slide").Jslider({
    data:pageConfig.DATA_MSlide,
    auto:true,
    reInit:true,
    slideWidth:(screen.width>=1210)?730:550,
    slideHeight:270,
    maxAmount:8,
    slideDirection:2,
    template:pageConfig.TPL_MSlide
},function(object){
    pageConfig.FN_ImgError(object.get(0));
});



/********今日特价、新品首发、应季热卖、寻宝清仓*********/
var jiaodianhtml='<ul>'
    +'{for item in data }'
    + '<li class="fore${item.ranKing}">'
    +  '${item.iCDesc}<div class="p-img">'
    +   '<a target="_blank" href="http://item.jd.com/${item.skuId}.html" title="${item.skuName}">'
    +	 '<img width="160" height="160" src="${item.imageUrl}" alt="${item.skuName}" data-img="1"/>'
    +	'</a>'
    +  '</div>'
    +  '<div class="p-name">'
    +  	'<a href="http://item.jd.com/${item.skuId}.html" target="_blank" title="${item.skuName}">${item.skuName}<font color="#ff6600" class="sku${item.skuId}">${item.wareTitle}</font> </a>'
    +  '</div>'
    +   '<div class="p-price" sku="${item.skuId}">京东价：<strong></strong></div>'
    + '</li>'
    +'{/for}'
    +'</ul>';
jQuery('#bargain').Jtab({compatible: true},
    function( source, obj, n ) {
    if ( n != 0 && obj.find('li').length==0) {
        var data = null;
        if (n == 1 && recommendList2){
            data = recommendList2;
        }
        else if (n == 2 && recommendList3){
            data = recommendList3;
        }
        else if (n == 3 && recommendList4){
        	data = recommendList4;
            
        }
        if (data){
			var itemJson = {"1":"限量","2":"清仓","3":"首发","4":"满减","5":"满赠","6":"直降","7":"新品","8":"独家","9":"人气 ","10":"热卖","11":"抢"};
			for(var i=0,j=data.length;i<j;i++){
				if (itemJson[data[i].itemContent+""]){
					data[i].iCDesc = '<b class="pi pix1">'+itemJson[data[i].itemContent+""]+'</b>';
				}
				else{
					data[i].iCDesc = "";
				}
			}
            obj.html( jiaodianhtml.process( {"data":data} ));
            getFloorPrice(data);
        }
        pageConfig.FN_ImgError(obj[0]);
    }
});
/*********限时抢购************/
var timer = {};
var timerContainer = {};
var timerTool = {};
var restTime = function(t) {
        if (t <= 0)
                return [0, 0, 0];
        var h = Math.floor(t / 3600000);
        var mt = t % 3600000;
        var m = Math.floor(mt / 60000);
        var st = t % 60000;
        var s = Math.floor(st / 1000);
        return [h, m, s];
};
var changeShow = function(id) {
        timer[id] = timer[id] - 1000;
        var t = restTime(timer[id]);
        if (t[0] == 0 && t[1] == 0 && t[2] == 0) {
                timerContainer["t" + id].html("抢购结束!<a href='#none' onclick='contentInit()'>刷新</a>");
                clearInterval(timerTool[id]);
        } else {
                timerContainer["t" + id].html("剩余<b>" + t[0] + "</b>小时<b>" + t[1] + "</b>分<b>" + t[2] + "</b>秒");
        }
};
var freshTime = function(tb, te, tn, id) {
        tn = Date.parse(tn.replace(/-/g, "/"));
        te = Date.parse(te.replace(/-/g, "/"));
        timer[id] = te - tn;
        changeShow(id);
        timerTool[id]=setInterval("changeShow('" + id + "')", 1000);
};
var contentInit = function() {
        jQuery.ajax({
                url: "http://qiang.jd.com/HomePageNewLimitBuy.ashx?callback=?",
                data: { ids: limitBuyRfid },
                dataType: "jsonp",
                success: function(r) {
                        if (r && r.data && r.data.length > 0) {
                                var data = r.data[0];
                                var content = [];
                                var product = null;
                                for (var i = 0, j = data.pros.length; i < j; i++) {
                                        product = data.pros[i];
                                        content.push('<li>'
                                                        +'<div class="clock" id="t' + product.id + '"></div>'
                                                        +'<div class="p-img">'
                                                            +'<a href="http://item.jd.com/' + product.id + '.html" title="'+unescape(product.mc)+'" target="_blank">'
                                                                +'<img width="130" height="130" src="'+product.tp+'" alt="'+unescape(product.mc)+'">'
                                                            +'</a>'
                                                        +'</div>'
                                                        +'<div class="p-name">'
                                                            +'<a href="http://item.jd.com/' + product.id + '.html" title="'+unescape(product.mc)+'" target="_blank">'+unescape(product.mc)+'</a>'
                                                        +'</div>'
                                                        +'<div class="p-price">京东价：<strong>￥'+product.qg+'</strong></div>'
                                                    +'</li>');
                                }
                                jQuery("#limitbuy .mc ul").html(content.join(""));
                                for (var i = 0, j = data.pros.length; i < j; i++) {
                                        product = data.pros[i];
                                        timerContainer["t" + product.id] = $("#t" + product.id);
                                        freshTime(product.tb, product.te, product.st, product.id);
                                }
                                $("#limitbuy .mc").imgScroll({
                                    visible: 1,
                                    speed: 244,
                                    step: 1,
                                    direction: 'x',
                                    loop: false,
                                    evtType: 'click',
                                    next: '#next',
                                    prev: '#prev',
                                    disableClass: 'disabled'
                                });
                        }
                }
        });
};
contentInit();
/*********楼层广告************/
(function($){
    var slideTPL={
        main:{
            itemsWrap:'<ul class="slide-items">{innerHTML}</ul>',
            itemsContent:'{for item in json}<li><a href="${item["href"]}" target="_blank"><img src="${item["src"]}" width="${item["width"]}" height="310" alt="${item["alt"]}" data-img="2" /></a></li>{/for}',
            controlsWrap:'<div class="gc-sco-control slide-controls">{innerHTML}</div>',
            controlsContent:'{for item in json}<span class="{if parseInt(item_index)==0}curr{/if}">${parseInt(item_index)+1}</span>{/for}'
        }
    };
    var j = 0;
    for (var i=0,fuck=7;i<fuck ;i++ )
    {
        var curData = (pageConfig.gcGetData1&&pageConfig.gcGetData1.length>i)?pageConfig.gcGetData1[i]:null;
        $('#floor'+(i+1)+' .activity-ads').Jslider({
            auto: false,
            defaultIndex: 0,
            data: curData?curData:[pageConfig.gcGetData[j],pageConfig.gcGetData[j+1],pageConfig.gcGetData[j+2]],
            slideWidth:210,
            slideHeight:310,
            speed: 'fast',
            template: slideTPL['main'],
            slideDirection: 3
        });
        j = j+3;
    }
})(jQuery);
var curTimeMod = (new Date()).getTime()%3;
function topListMapBind(key,obj,kao){
	 if(topListMap&&topListMap[key]&&topListMap[key].length>0){
		 var html = "";
		 for(var k=0,h=topListMap[key].length;k<h;k++){
			 html += '<li class="fore'+(k+1)+(k==0?" fore":"")+'">'
						+'<span class="i'+(k+1)+'">'+(k+1)+'</span>'
						+'<div class="p-img">'
						+'<a href="http://item.jd.com/'+topListMap[key][k].skuId+'.html" target="_blank" title="'+topListMap[key][k].skuName+'"><img width="50" height="50" '+kao+'="'+topListMap[key][k].imageUrl
						+'" alt="'+topListMap[key][k].skuName+'" data-img="1"></a>'                        
						+'</div>'
						+'<div class="p-name"><a href="http://item.jd.com/'+topListMap[key][k].skuId+'.html" target="_blank" title="'+topListMap[key][k].skuName+'">'+topListMap[key][k].skuName+'</a><font color="#ff6600" class="sku'+topListMap[key][k].skuId+'"></font></div>'
						+'<div class="p-price" sku='+topListMap[key][k].skuId+'><strong></strong></div>'
						+'</li>';
		 }
		 obj.html(html);
		 getFloorPrice(topListMap[key]);
		 pageConfig.FN_ImgError(obj[0]);
		 var objid=obj.parent().parent().attr("id");
		 if (objid != "floor1-top" && objid != "floor2-top" && objid != "floor3-top"){
			 obj.find("li").mouseover(function(){
				jQuery(this).siblings().removeClass("fore").end().addClass("fore");
				jQuery(this).find("img").each(function(){
					var src=jQuery(this).attr("src2");
					if (src){
					jQuery(this).removeAttr("src2").attr("src",src);
					}
				});
			});
		 }
	 }
}
for (var i=0,j=7;i<j ;i++ ){
    var tempobj = $("#floor"+(i+1)+"-top .mt li");
    var temp = tempobj.eq(curTimeMod);
    tempobj.eq(curTimeMod).remove();
    temp.insertBefore("#floor"+(i+1)+"-top .mt li:first");
    $("#floor"+(i+1)+"-top .mt .curr").attr("class","");
    $("#floor"+(i+1)+"-top .mt li").eq(0).attr("class","curr");
	 topListMapBind($("#floor"+(i+1)+"-top .mt li").eq(0).attr("dataKey"),$("#floor"+(i+1)+"-top .mc ul").eq(0),"data-lazyload");
	 $("#floor"+(i+1)+"-top img[data-lazyload]").Jlazyload({type:"image",placeholderClass:"err-product"});
    $("#floor"+(i+1)+"-top").Jtab({compatible:true},
        function( source, obj, n ) {
			 if (obj.find('li').length==0) {
				var key=obj.parent().parent().find(".mt li").eq(n).attr("dataKey");
				 topListMapBind(key,obj,"src");
			 }
        });
}
jQuery("#single-choice .mc .con").imgScroll({
    visible:(screen.width>1210)?4:3,
    speed:300,
    step:(screen.width>1210)?4:3,
    direction: 'x',
    loop: false,
    evtType: 'click',
    next: '#next2',
    prev: '#prev2',
    disableClass: 'disabled'
});

var IE_low_version=jQuery.browser.msie&&parseInt(jQuery.browser.version)<9;
function setColor(){
    var r=Math.floor(Math.random()*200),
        g=Math.floor(Math.random()*200),
        b=Math.floor(Math.random()*200);
    return IE_low_version ? {
        "color":"rgb("+r+","+g+","+b+")",
        "invert":"rgb("+Math.abs(255-r)+","+Math.abs(255-g)+","+Math.abs(255-b)+")"
    } : {
        "color": 'rgba('+r+','+g+','+b+',0.5)',
        "invert":"rgba("+Math.abs(255-r)+","+Math.abs(255-g)+","+Math.abs(255-b)+",0.5)"
    };
}
$('.crowd li').hover(function() {
    if(IE_low_version){
        $(this).children('.p-name').css({
            "backgroundColor":"transparent",
            "filter":"progid:DXImageTransform.Microsoft.gradient(startColorstr=#7F3794C2,endColorstr=#7F3794C2)"
        }).stop().animate({
                "bottom": 0
            }, 200);
    }else{
        $(this).children('.p-name').css({
            "backgroundColor":(new setColor()).color
        }).stop().animate({
                "bottom": 0
            }, 200);
    };
    $(this).children('span').hide();
}, function() {
    $(this).children('.p-name').stop().animate({
        bottom: '-100px'
    }, 200);
    $(this).children('span').show();
});

$(function(){
	if(window.pageConfig){
		var sidePanle=new pageConfig.FN_InitSidebar();
		sidePanle.addItem("<div class='foll'><a href='javascript: void(0)' data-href='floor1'><span>1F</span>电视家影</a><a href='javascript: void(0)' data-href='floor2'><span>2F</span>空调厨卫</a><a href='javascript: void(0)' data-href='floor3'><span>3F</span>冰箱洗衣机</a><a href='javascript: void(0)' data-href='floor4'><span>4F</span>生活电器</a><a href='javascript: void(0)' data-href='floor5'><span>5F</span>厨房电器</a><a href='javascript: void(0)' data-href='floor6'><span>6F</span>个护健康</a><a href='javascript: void(0)' data-href='floor7'><span>7F</span>五金家装</a></div>"); 
		sidePanle.scroll();
		$('.foll a').click(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		var el = $(this).attr('data-href');
		var elWrapped = $("#"+el);
		scrollToDiv(elWrapped,10);
		return false;
		});
		
		function scrollToDiv(element,navheight){
			var offset = element.offset();
			var offsetTop = offset.top;
			var totalScroll = offsetTop-navheight;
			$('body,html').animate({
					scrollTop: totalScroll
			}, 800);
		}
		$('.foll').hover(function() {
			$(this).addClass('foll-hover');
		}, function() {
			$(this).removeClass('foll-hover');
		});
	}
});