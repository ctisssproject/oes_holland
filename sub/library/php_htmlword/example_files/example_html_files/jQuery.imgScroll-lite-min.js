(function(a){a.fn.imgScroll=function(b,e){var d={data:[],template:null,evtType:"click",visible:1,direction:"x",next:"#next",prev:"#prev",disableClass:"disabled",disableClassPerfix:false,speed:300,step:1,loop:false,showControl:false,width:null,height:null,navItems:false,navItmesWrapClass:"scroll-nav-wrap",navItemActivedClass:"current",status:false,statusWrapSelector:".scroll-status-wrap"};var c=a.extend(d,b);return this.each(function(){var E=a(this),D=E.find("ul").eq(0),G,f=D.children("li"),q=f.length,j=null,l=null,Q=typeof c.next=="string"?a(c.next):c.next,u=typeof c.prev=="string"?a(c.prev):c.prev,s=0,C=c.step,v=c.visible,z=Math.ceil((q-v)/C)+1,h=c.loop,O=c.direction,x=c.evtType,B=c.disableClass,t=c.disableClassPerfix?"prev-"+B:B,L=c.disableClassPerfix?"next-"+B:B,o=c.navItems,F=c.navItmesWrapClass,N=a("."+F).length>0,I=c.navItemActivedClass,A=c.status,J=c.statusWrapSelector,w=a(J).length>0,n=false,i=true,M=(q-v)%C===0,p=c.template||'<ul>{for slide in list}<li><a href="${slide.href}" target="_blank"><img src="${slide.src}" alt="${slide.alt}" /></a></li>{/for}</ul>';function g(R){if(q>v&&!h){u.addClass(t);Q.removeClass(L)}else{if(!h){Q.addClass(L)}}if(f.eq(0).css("float")!=="left"){f.css("float","left")}j=c.width||f.eq(0).outerWidth();l=c.height||f.eq(0).outerHeight();E.css({position:E.css("position")=="static"?"relative":E.css("position"),width:R=="x"?j*v:j,height:R=="x"?l:l*v,overflow:"hidden"});D.css({position:"absolute",width:R=="x"?j*q:j,height:R=="x"?l:l*q,top:0,left:0});if(typeof e==="function"){e.apply(E,[s,z,f.slice(s*C,s*C+v),f.slice(s*C+v-C,s*C+v)])}}function P(){q=c.data.length;D=E.find("ul").eq(0);f=D.children("li");z=Math.ceil((q-v)/C)+1;M=(q-v)%C===0}function r(S){var R={list:S};E.html(p.process(R));P()}function H(S,T){if(D.is(":animated")){return false}if(h){if(i&&T){s=z}if(n&&!T){s=-1}S=T?--s:++s}else{if(i&&T||n&&!T){return false}else{S=T?--s:++s}}G=O=="x"?{left:S>=(z-1)?-(q-v)*j:-S*C*j}:{top:S>=(z-1)?-(q-v)*l:-S*C*l};function R(){if(!h){if(q-S*C<=v){Q.addClass(L);n=true}else{Q.removeClass(L);n=false}if(S<=0){u.addClass(t);i=true}else{u.removeClass(t);i=false}}else{if(q-S*C<=v){n=true}else{n=false}if(S<=0){i=true}else{i=false}}if(o||A){m(S)}if(typeof e=="function"){e.apply(E,[S,z,f.slice(S*C,S*C+v),f.slice(S*C+v-C,S*C+v)])}}if(!!c.speed){D.animate(G,c.speed,R)}else{D.css(G);R()}}function K(U,R){var S=N?a("."+U).eq(0):a('<div class="'+U+'"></div>');for(var T=0;T<z;T++){S.append("<em "+(T===0?" class="+R:"")+' title="'+(T+1)+'">'+(T+1)+"</em>")}if(!N){E.after(S)}}function k(){var R=w?a(J).eq(0):a('<div class="'+J.replace(".","")+'"></div>');R.html("<b>1</b>/"+z);if(!w){E.after(R)}}function m(R){if(o){a("."+F).find("em").removeClass(I).eq(R).addClass(I)}if(A){a(J).html("<b>"+(R+1)+"</b>/"+z)}}function y(){u.unbind(x).bind(x,function(){H(s,true)});Q.unbind(x).bind(x,function(){H(s,false)})}if(c.data.length>0){if(!c.width||!c.height){return false}r(c.data)}if(q>v&&v>=C){g(O);y();if(o){K(F,I)}if(A){k(J)}}else{if(c.showControl){Q.add(u).show()}else{Q.add(u).hide()}u.addClass(t);Q.addClass(L)}})}})(jQuery);