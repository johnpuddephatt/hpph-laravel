!function(e){var t={};function n(i){if(t[i])return t[i].exports;var o=t[i]={i:i,l:!1,exports:{}};return e[i].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:i})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=0)}({"/APx":function(e,t){var n=document.querySelector(".single-listing--venue--header")||document.querySelector(".single-listing--screenings--header"),i=document.querySelector(".single-listing--sidebar"),o=document.querySelector(".single-listing--mobile--screenings");function r(){i.classList.toggle("open"),document.documentElement.classList.toggle("locked"),document.body.classList.toggle("locked")}o&&n&&(o.addEventListener("click",function(){r()}),n.addEventListener("click",function(){r()}))},0:function(e,t,n){n("F1kH"),n("0oai"),n("TBUl"),e.exports=n("Fn2L")},"0oai":function(e,t){},"BHo+":function(e,t){var n=document.querySelector(".screenings-table"),i=document.querySelector(".screenings-table--announcer"),o=document.querySelector(".screenings-table--explainer"),r=document.querySelector(".screenings-table--announcer--wrapper");if(n&&i){var c=function(e,t,n){o.style.visibility="hidden",i.innerHTML='<div class="screenings-table--announcer--text"><h3 class="screenings-table--announcer--heading">Selected showtime:</h3><p>'+t+" at "+e+'</p></div><button class="button button__gray cancel-button">Cancel</button><a class="button button__yellow book-button" href="'+n+'">Book »</a>';var c=document.querySelector(".book-button");document.querySelector(".cancel-button").addEventListener("click",function(e){a()}),c.addEventListener("click",function(e){s(e)}),r.classList.add("active")},a=function(){r.classList.remove("active"),n.querySelector("input:checked").checked=!1,o.style.visibility="visible"},s=function(e){if(e.target.href.startsWith("https://tickets.hydeparkpicturehouse.co.uk/")){e.preventDefault(),a();var t=document.createElement("iframe");t.classList.add("spectrix-boxoffice"),t.setAttribute("id","SpektrixIFrame"),t.setAttribute("name","SpektrixIFrame"),t.setAttribute("onload","setTimeout(function(){ document.querySelector('#SpektrixIFrame').scrollIntoView() }, 100)"),t.src=e.target.href;var n=document.createElement("script");n.src="https://tickets.hydeparkpicturehouse.co.uk/hydeparkpicturehouse/website/scripts/integrate.js";var i=document.querySelector(".single-listing--sidebar");i.classList.add("has-spectrix-open"),i.classList.add("open"),i.insertBefore(t,i.childNodes[0]),i.insertBefore(n,i.childNodes[0])}};n.addEventListener("click",function(e){"INPUT"==e.target.nodeName&&c(e.target.dataset.time,e.target.dataset.date,e.target.dataset.url)}),document.addEventListener("DOMContentLoaded",function(){var e=window.location.href,t=new URL(e).searchParams.get("screeningID");if(t){var n=document.querySelector("input#screening-"+t);n&&(n.checked=!0,c(n.dataset.time,n.dataset.date,n.dataset.url))}})}},"DTs+":function(e,t,n){var i,o,r,c;c=function(e){"use strict";function t(e,t){return null==e?t:e}function n(e){return e.length}function i(e,t,n,i){return(e/=i/2)<1?n/2*e*e*e+t:n/2*((e-=2)*e*e+2)+t}Object.defineProperty(e,"__esModule",{value:!0}),e.getSlider=function(e){var o=void 0,r=void 0,c=void 0,a=void 0,s=void 0,l=t((e=e||{}).container,document.querySelector("*[data-simple-slider]")),u=t(e.prop,"left"),d=1e3*t(e.duration,.5),f=1e3*t(e.delay,3),m=t(e.unit,"%"),v=t(e.init,-100),g=t(e.show,0),y=t(e.end,100),p=e.paused,h=t(e.ease,i),L=t(e.onChange,0),b=t(e.onChangeEnd,0),w=Date.now;function k(){S()&&(r&&clearTimeout(r),function e(){c=w(),r=setTimeout(function(){c=w(),s=f,E(x()),e()},s)}())}function S(){return!p&&n(a)>1}function q(){S()&&(s=f-(w()-c),clearTimeout(r),r=0)}function E(e){for(var t=n(a);--t>=0;)a[t].style.zIndex=1;a[e].style.zIndex=3,a[o].style.zIndex=2,function e(t,n,i,r,c,a,s,l,d,f){function v(e,t,n){e[u]=f(d-l,t,n-t,s)+m}if(l>0){if(!(d-l<s))return t[u]=i+m,r[u]=a+m,void(b&&b(o,x()));v(t,n,i),v(r,c,a)}requestAnimationFrame(function(o){0===l&&(l=o),e(t,n,i,r,c,a,s,l,o,f)})}(a[o].style,g,y,a[e].style,v,g,d,0,0,h),o=e,L&&L(T(),o)}function x(){var e=o+1;return e>=n(a)?0:e}function T(){var e=o-1;return e<0?n(a)-1:e}function I(){document.hidden?q():k()}return document.addEventListener("visibilitychange",I),function(){if(n(l.children)>0){var t=l.style;t.position="relative",t.overflow="hidden",t.display="block",a=function(e,t,i,o,r,c){var a=void 0,s=[];t||(t=e.children);for(var l=n(t);--l>=0;)s[l]=t[l],(a=s[l].style).position="absolute",a.top=a.left=a.zIndex=0,a[c]=o+i;return a[c]=r+i,a.zIndex=1,s}(l,e.children,m,v,g,u),o=0,s=f}}(),a&&n(a)>1&&k(),{currentIndex:function(){return o},pause:q,resume:k,nextIndex:x,prevIndex:T,next:function(){E(x()),k()},prev:function(){E(T()),k()},change:E,reverse:function(){var e=v;v=y,y=e,o=Math.abs(o-(n(a)-1)),a=a.reverse()},dispose:function(){clearTimeout(r),document.removeEventListener("visibilitychange",I),a=l=r=u=d=f=v=y=p=o=s=L=b=null}}}},o=[t],void 0===(r="function"==typeof(i=c)?i.apply(t,o):i)||(e.exports=r)},F1kH:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n("TyXU"),n("pzp0"),n("u3Jw"),n("/APx"),n("BHo+"),n("hFJ8"),n("biHv"),n("nHy7"),n("wLSP");n("Vprl")},Fn2L:function(e,t){},TBUl:function(e,t){},TyXU:function(e,t,n){var i=n("DTs+"),o=document.querySelector(".section--home-slider"),r=(document.querySelector(".loading-text"),document.getElementsByTagName("BODY")[0]);document.addEventListener("DOMContentLoaded",function(){if(o){var e=function(e,t){a[e].classList.add("out"),a[t].classList.add("coming-in")},t=function(e,t){a[e].classList.remove("coming-in"),a[t].classList.remove("out")},n=o.querySelector(".home-slider--slide"),c=n.querySelector(".home-slider--image"),a=o.querySelectorAll(".home-slider--slide");if(a.length){n.classList.add("coming-in");var s=setInterval(function(){c.naturalWidth&&(r.classList.remove("slider-loading"),n.classList.remove("coming-in"),i.getSlider({container:o,duration:1.5,delay:7.5,prop:"opacity",unit:"",init:0,show:1,end:0,onChange:e,onChangeEnd:t}),clearInterval(s))},50)}}})},Vprl:function(e,t,n){var i,o;!function(r,c){"use strict";void 0===(o="function"==typeof(i=c)?i.call(t,n,t,e):i)||(e.exports=o)}(0,function(){"use strict";if("object"==typeof window&&void 0!==document.querySelectorAll&&void 0!==window.pageYOffset&&void 0!==history.pushState){var e=function(e,t,n,i){return n>i?t:e+(t-e)*((o=n/i)<.5?4*o*o*o:(o-1)*(2*o-2)*(2*o-2)+1);var o},t=function(t,n,i,o){n=n||500;var r=(o=o||window).scrollTop||window.pageYOffset;if("number"==typeof t)var c=parseInt(t);else c=function(e,t){return"HTML"===e.nodeName?-t:e.getBoundingClientRect().top+t}(t,r);var a=Date.now(),s=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(e){window.setTimeout(e,15)},l=function(){var u=Date.now()-a;o!==window?o.scrollTop=e(r,c,u,n):window.scroll(0,e(r,c,u,n)),u>n?"function"==typeof i&&i(t):s(l)};l()},n=function(e){if(!e.defaultPrevented){e.preventDefault(),location.hash!==this.hash&&window.history.pushState(null,null,this.hash);var n=document.getElementById(this.hash.substring(1));if(!n)return;t(n,500,function(e){location.replace("#"+e.id)})}};return document.addEventListener("DOMContentLoaded",function(){for(var e,t=document.querySelectorAll('a[href^="#"]:not([href="#"])'),i=t.length;e=t[--i];)e.addEventListener("click",n,!1)}),t}})},biHv:function(e,t){document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".search-input"),t=document.querySelector(".search-output"),n=document.querySelector(".search-button"),i=document.querySelector(".search-container"),o=document.querySelector(".site-footer--navigation"),r=document.querySelector(".site-footer--navigation--link__search"),c=document.querySelector(".search-close");function a(){i.classList.toggle("active"),document.body.classList.toggle("locked"),e.focus()}function s(){i.classList.remove("active"),document.body.classList.remove("locked"),e.blur()}r.addEventListener("click",function(e){r.classList.contains("open")?(s(),r.classList.remove("open"),o.classList.remove("navigation--search-open")):(a(),r.classList.add("open"),o.classList.add("navigation--search-open"))}),n.addEventListener("click",function(){a()}),c.addEventListener("click",function(e){s()}),e.addEventListener("keyup",function(e){if(27===e.keyCode&&s(),e.target.value){var n=e.target.value.toLowerCase(),i=window.searchData.filter(function(e){return!!e.title.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g,"").replace("’","'").includes(n.replace("’","'"))||!(!e.alt_language_title||!e.alt_language_title.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g,"").replace("’","'").includes(n.replace("’","'")))}),o="";if(Object.keys(i).length>0){var r=!0,c=!1,a=void 0;try{for(var l,u=Object.keys(i)[Symbol.iterator]();!(r=(l=u.next()).done);r=!0){var d=l.value;o+='\n            <li>\n              <a href="/film/'+i[d].slug+'">\n                <div class="search-result--title">'+i[d].title+'</div>\n                <div class="search-result--alt-title">'+(i[d].alt_language_title?i[d].alt_language_title:"")+"</div>\n              </a>\n            </li>\n          "}}catch(e){c=!0,a=e}finally{try{!r&&u.return&&u.return()}finally{if(c)throw a}}t.innerHTML=o}else t.innerHTML="<em>No results found.</em>"}else t.innerHTML=""})})},hFJ8:function(e,t){var n,i=document.querySelector(".single-listing--trailer"),o=document.querySelector(".single-listing--trailer--iframe"),r=document.querySelector(".trailer-button");if(r)var c=r.dataset.iframe,a=r.dataset.provider;if(c){var s,l;if("youtube"==a)(s=document.createElement("script")).src="//www.youtube.com/iframe_api",(l=document.getElementsByTagName("script")[0]).parentNode.insertBefore(s,l),window.onYouTubeIframeAPIReady=function(){youtubePlayer=new YT.Player(o,{height:"390",width:"640",videoId:c,events:{onReady:onPlayerReady}})};if("vimeo"==a)(s=document.createElement("script")).src="//player.vimeo.com/api/player.js",(l=document.getElementsByTagName("script")[0]).parentNode.insertBefore(s,l),s.addEventListener("load",function(){n=new Vimeo.Player(o,{id:c}),u(),r.classList.add("loaded")});window.innerHeight>window.innerWidth?o.style.width="100%":o.style.width="75%",o.style.height=o.clientWidth*(9/16)+"px"}function u(){r.addEventListener("click",function(){i.querySelector(".single-listing--trailer--iframe");r.classList.contains("play")?(i.classList.add("lights-out"),"youtube"==a&&youtubePlayer.playVideo(),"vimeo"==a&&n.play(),document.body.classList.add("locked"),r.innerText="Close trailer",r.blur(),r.classList.remove("play"),!0):d()})}function d(){i.classList.remove("lights-out"),document.body.classList.remove("locked"),"youtube"==a&&youtubePlayer.stopVideo(),"vimeo"==a&&n.pause(),r.innerText="Watch trailer ",r.classList.add("play"),r.blur(),playing=!1}window.onPlayerReady=function(e){u(),r.classList.add("loaded")},document.addEventListener("keyup",function(e){if(!e.defaultPrevented){var t=e.key||e.keyCode;"Escape"!==t&&"Esc"!==t&&27!==t||d()}})},nHy7:function(e,t){var n=document.getElementById("nav-trigger"),i=document.querySelector(".site-footer"),o=document.querySelector(".site-footer--navigation");n.addEventListener("click",function(e){e.preventDefault(),i.classList.toggle("visible"),n.classList.toggle("open"),o.classList.toggle("nav-open"),document.documentElement.classList.toggle("locked"),document.body.classList.toggle("locked")});var r=window.navigator.userAgent,c=!!r.match(/iPad/i)||!!r.match(/iPhone/i),a=!!r.match(/WebKit/i),s=c&&a&&!r.match(/CriOS/i),l=c&&a&&r.match(/CriOS/i);(s||l)&&document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".section--home-slider");e&&(e.style.height=document.documentElement.clientHeight,e.classList.add("ios"))})},pzp0:function(e,t){var n=document.querySelector(".weekly-screenings--navigation--trigger"),i=document.querySelector(".weekly-screenings--week-picker");n&&i&&(n.addEventListener("click",function(){n.classList.toggle("active"),i.classList.toggle("visible")}),document.body.addEventListener("click",function(e){e.target.classList.contains("weekly-screenings--navigation--trigger")||(n.classList.remove("active"),i.classList.remove("visible"))}))},u3Jw:function(e,t){var n=document.querySelector(".fade-image-onload");if(n){n.classList.add("loading"),n.onload=function(){n.classList.remove("loading")};var i=setTimeout(function(){n.naturalWidth&&(n.classList.remove("loading"),clearTimeout(i))},100)}},wLSP:function(e,t){var n=document.querySelector(".bookmark"),i=document.querySelector(".site-header");document.addEventListener("DOMContentLoaded",function(){n.classList.add("active"),new IntersectionObserver(o,r).observe(i)});var o=function(e){e.forEach(function(e){e.intersectionRatio<=r.threshold?n.classList.add("compact"):n.classList.remove("compact")})},r={rootMargin:"0px 0px",threshold:.25}}});