$(document).ready(function() {
	var menus = $(".p-price");
	var skuIds = [];
	var skuid;

	for ( var i = 0; i < menus.length; i++) {
		
		if(typeof menus[i].attributes['sku'] == 'undefined'||typeof menus[i].attributes['sku'] == ''){
			continue;
		}
		skuid = menus[i].attributes['sku'].nodeValue;
		skuIds.push(skuid);
	}
	
	var adlength = Math.floor(skuIds.length/50);
	var adtemp = 0;
	if(adlength>0){
		for(var i=0;i<=adlength;i++){
			if(i==adlength){
				getAdWord(skuIds.slice(adtemp));
			}else{
				getAdWord(skuIds.slice(adtemp,adtemp+50));
				adtemp = adtemp+50;
			}
		}
	}else{
		getAdWord(skuIds);
	}

	
	var plength =  Math.floor(skuIds.length/100);
	var pricetemp = 0;
	if(plength>0){
		for(var i=0;i<=plength;i++){
			if(i==plength){
				getPrice(skuIds.slice(pricetemp));
			}else{
				getPrice(skuIds.slice(pricetemp,pricetemp+100));
				pricetemp = pricetemp+100;
			}
		}
	}else{
		getPrice(skuIds);
	}
});
/**获取价格**/
function getPrice(skuIds) {
    var ipLoc_djd = getCookie("ipLoc-djd");
    var area=null;
    if(ipLoc_djd!=null && ipLoc_djd.length>0){
        area=ipLoc_djd.split("-")[0];
        }else{
        	area=0;
        }
	$.ajax({
		url: 'http://p.3.cn/prices/mgets?skuIds=J_' + skuIds.join(',J_') +'&area='+area+ '&type=1',
		//价格时时调用
		dataType: 'jsonp',
		success: function(r) {
			if (r && r.length > 0) {
				for (var i = 0, j = r.length; i < j; i++) {

					var skuId = r[i].id.replace("J_", "");
					var price = r[i].p;
					var salePrice= r[i].m;

					var priceWrap = $("div[sku='"+skuId+"']");
					var priceWrapStrong = priceWrap.find("strong");
					var priceWrapDel = priceWrap.find("del");

					if (price > 0) {
						if(priceWrapStrong.val() == ""){
							priceWrapStrong.html( "\uffe5" + price + "" );
						}
					} else {
						priceWrapStrong.html("暂无报价");
					}
					if (salePrice > 0) {
						if(priceWrapDel.val() == ""){
							priceWrapDel.html("\uffe5" + salePrice + "");
						}
					} else {
						priceWrapDel.html("暂无报价");
					}
				}
			}
		}
	});
}
/****获取广告词******/
function getAdWord(skuIds) {
	$.getJSONP('http://ad.3.cn/ads/mgets?skuids=AD_'+ skuIds.join(",AD_")
			+ '&callback=adWordCallback');
}
/****广告词回调函数******/
function adWordCallback(data) {
	if (data && data.length > 0) {
		for ( var i = 0; i < data.length; i++) {
			var skuId=data[i].id.replace("AD_","");
				$(".sku" +skuId).html(data[i].ad+"");
			
		}
	}
}
// 获取楼层商品价格
function getFloorPrice(data) {
	var skuIds = [];
	for ( var i = 0, j = data.length; i < j; i++) {
		skuIds[i] = data[i].skuId;
	}
	getPrice(skuIds);
	getAdWord(skuIds);
}
// 传入单个id
function getOnePrice(id) {
	var skuIds = [];
	skuIds[0] = id;
	getPrice(skuIds);
	getAdWord(skuIds);
}
//获取cookie
function getCookie(name) {
    var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if (arr != null) return unescape(arr[2]);
    return null;
}
