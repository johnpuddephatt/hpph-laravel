!function(e){var t={};function n(o){if(t[o])return t[o].exports;var i=t[o]={i:o,l:!1,exports:{}};return e[o].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:o})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=0)}({"/APx":function(e,t){var n=document.querySelector(".single-listing--venue--header")||document.querySelector(".single-listing--screenings--header"),o=document.querySelector(".single-listing--sidebar"),i=document.querySelector(".single-listing--mobile--screenings");function r(){o.classList.toggle("open"),document.documentElement.classList.toggle("locked"),document.body.classList.toggle("locked")}i&&n&&(i.addEventListener("click",function(){r()}),n.addEventListener("click",function(){r()}))},0:function(e,t,n){n("F1kH"),n("0oai"),n("TBUl"),e.exports=n("Fn2L")},"0oai":function(e,t){},"BHo+":function(e,t){var n=document.querySelector(".screenings-table"),o=document.querySelector(".screenings-table--announcer"),i=document.querySelector(".screenings-table--explainer"),r=document.querySelector(".screenings-table--announcer--wrapper");if(n&&o){var a=function(e,t,n){i.style.visibility="hidden",o.innerHTML='<div class="screenings-table--announcer--text"><h3 class="screenings-table--announcer--heading">Selected showtime:</h3><p>'+t+" at "+e+'</p></div><button class="button button__gray cancel-button">Cancel</button><a class="button button__yellow book-button" href="'+n+'">Book »</a>';var a=document.querySelector(".book-button");document.querySelector(".cancel-button").addEventListener("click",function(e){s()}),a.addEventListener("click",function(e){c(e)}),r.classList.add("active")},s=function(){r.classList.remove("active"),n.querySelector("input:checked").checked=!1,i.style.visibility="visible"},c=function(e){if(e.target.href.startsWith("https://tickets.hydeparkpicturehouse.co.uk/")){e.preventDefault(),s();var t=document.createElement("iframe");t.classList.add("spectrix-boxoffice"),t.setAttribute("id","SpektrixIFrame"),t.setAttribute("name","SpektrixIFrame"),t.setAttribute("onload","setTimeout(function(){ document.querySelector('#SpektrixIFrame').scrollIntoView() }, 100)"),t.src=e.target.href;var n=document.createElement("script");n.src="https://tickets.hydeparkpicturehouse.co.uk/hydeparkpicturehouse/website/scripts/integrate.js";var o=document.querySelector(".single-listing--sidebar");o.classList.add("has-spectrix-open"),o.classList.add("open"),o.insertBefore(t,o.childNodes[0]),o.insertBefore(n,o.childNodes[0])}};n.addEventListener("click",function(e){"INPUT"==e.target.nodeName&&a(e.target.dataset.time,e.target.dataset.date,e.target.dataset.url)}),document.addEventListener("DOMContentLoaded",function(){var e=window.location.href,t=new URL(e).searchParams.get("screeningID");if(t){var n=document.querySelector("input#screening-"+t);n&&(n.checked=!0,a(n.dataset.time,n.dataset.date,n.dataset.url))}})}},"DTs+":function(e,t,n){var o,i,r,a;a=function(e){"use strict";function t(e,t){return null==e?t:e}function n(e){return e.length}function o(e,t,n,o){return(e/=o/2)<1?n/2*e*e*e+t:n/2*((e-=2)*e*e+2)+t}Object.defineProperty(e,"__esModule",{value:!0}),e.getSlider=function(e){var i=void 0,r=void 0,a=void 0,s=void 0,c=void 0,l=t((e=e||{}).container,document.querySelector("*[data-simple-slider]")),u=t(e.prop,"left"),d=1e3*t(e.duration,.5),f=1e3*t(e.delay,3),m=t(e.unit,"%"),v=t(e.init,-100),p=t(e.show,0),h=t(e.end,100),g=e.paused,y=t(e.ease,o),L=t(e.onChange,0),b=t(e.onChangeEnd,0),w=Date.now;function S(){k()&&(r&&clearTimeout(r),function e(){a=w(),r=setTimeout(function(){a=w(),c=f,E(x()),e()},c)}())}function k(){return!g&&n(s)>1}function q(){k()&&(c=f-(w()-a),clearTimeout(r),r=0)}function E(e){for(var t=n(s);--t>=0;)s[t].style.zIndex=1;s[e].style.zIndex=3,s[i].style.zIndex=2,function e(t,n,o,r,a,s,c,l,d,f){function v(e,t,n){e[u]=f(d-l,t,n-t,c)+m}if(l>0){if(!(d-l<c))return t[u]=o+m,r[u]=s+m,void(b&&b(i,x()));v(t,n,o),v(r,a,s)}requestAnimationFrame(function(i){0===l&&(l=i),e(t,n,o,r,a,s,c,l,i,f)})}(s[i].style,p,h,s[e].style,v,p,d,0,0,y),i=e,L&&L(_(),i)}function x(){var e=i+1;return e>=n(s)?0:e}function _(){var e=i-1;return e<0?n(s)-1:e}function T(){document.hidden?q():S()}return document.addEventListener("visibilitychange",T),function(){if(n(l.children)>0){var t=l.style;t.position="relative",t.overflow="hidden",t.display="block",s=function(e,t,o,i,r,a){var s=void 0,c=[];t||(t=e.children);for(var l=n(t);--l>=0;)c[l]=t[l],(s=c[l].style).position="absolute",s.top=s.left=s.zIndex=0,s[a]=i+o;return s[a]=r+o,s.zIndex=1,c}(l,e.children,m,v,p,u),i=0,c=f}}(),s&&n(s)>1&&S(),{currentIndex:function(){return i},pause:q,resume:S,nextIndex:x,prevIndex:_,next:function(){E(x()),S()},prev:function(){E(_()),S()},change:E,reverse:function(){var e=v;v=h,h=e,i=Math.abs(i-(n(s)-1)),s=s.reverse()},dispose:function(){clearTimeout(r),document.removeEventListener("visibilitychange",T),s=l=r=u=d=f=v=h=g=i=c=L=b=null}}}},i=[t],void 0===(r="function"==typeof(o=a)?o.apply(t,i):o)||(e.exports=r)},F1kH:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n("TyXU"),n("pzp0"),n("u3Jw"),n("/APx"),n("BHo+"),n("hFJ8"),n("biHv"),n("nHy7"),n("wLSP");n("Vprl")},Fn2L:function(e,t){throw new Error('Module build failed: ModuleBuildError: Module build failed: \n    @extend .button__text\n                        ^\n      Invalid CSS after "...d .button__text": expected "}", was "{"\n      in /Users/johnpuddephatt/Sites/hpph-laravel/resources/sass/spectrix.sass (line 329, column 26)\n    at runLoaders (/Users/johnpuddephatt/Sites/hpph-laravel/node_modules/webpack/lib/NormalModule.js:195:19)\n    at /Users/johnpuddephatt/Sites/hpph-laravel/node_modules/loader-runner/lib/LoaderRunner.js:367:11\n    at /Users/johnpuddephatt/Sites/hpph-laravel/node_modules/loader-runner/lib/LoaderRunner.js:233:18\n    at context.callback (/Users/johnpuddephatt/Sites/hpph-laravel/node_modules/loader-runner/lib/LoaderRunner.js:111:13)\n    at Object.asyncSassJobQueue.push [as callback] (/Users/johnpuddephatt/Sites/hpph-laravel/node_modules/sass-loader/lib/loader.js:55:13)\n    at Object.done [as callback] (/Users/johnpuddephatt/Sites/hpph-laravel/node_modules/neo-async/async.js:8067:18)\n    at options.error (/Users/johnpuddephatt/Sites/hpph-laravel/node_modules/node-sass/lib/index.js:294:32)')},TBUl:function(e,t){},TyXU:function(e,t,n){var o=n("DTs+"),i=document.querySelector(".section--home-slider"),r=(document.querySelector(".loading-text"),document.getElementsByTagName("BODY")[0]);document.addEventListener("DOMContentLoaded",function(){if(i){var e=function(e,t){s[e].classList.add("out"),s[t].classList.add("coming-in")},t=function(e,t){s[e].classList.remove("coming-in"),s[t].classList.remove("out")},n=i.querySelector(".home-slider--slide"),a=n.querySelector(".home-slider--image"),s=i.querySelectorAll(".home-slider--slide");if(s.length){n.classList.add("coming-in");var c=setInterval(function(){a.naturalWidth&&(r.classList.remove("slider-loading"),n.classList.remove("coming-in"),o.getSlider({container:i,duration:1.5,delay:7.5,prop:"opacity",unit:"",init:0,show:1,end:0,onChange:e,onChangeEnd:t}),clearInterval(c))},50)}}})},Vprl:function(e,t,n){var o,i;!function(r,a){"use strict";void 0===(i="function"==typeof(o=a)?o.call(t,n,t,e):o)||(e.exports=i)}(0,function(){"use strict";if("object"==typeof window&&void 0!==document.querySelectorAll&&void 0!==window.pageYOffset&&void 0!==history.pushState){var e=function(e,t,n,o){return n>o?t:e+(t-e)*((i=n/o)<.5?4*i*i*i:(i-1)*(2*i-2)*(2*i-2)+1);var i},t=function(t,n,o,i){n=n||500;var r=(i=i||window).scrollTop||window.pageYOffset;if("number"==typeof t)var a=parseInt(t);else a=function(e,t){return"HTML"===e.nodeName?-t:e.getBoundingClientRect().top+t}(t,r);var s=Date.now(),c=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(e){window.setTimeout(e,15)},l=function(){var u=Date.now()-s;i!==window?i.scrollTop=e(r,a,u,n):window.scroll(0,e(r,a,u,n)),u>n?"function"==typeof o&&o(t):c(l)};l()},n=function(e){if(!e.defaultPrevented){e.preventDefault(),location.hash!==this.hash&&window.history.pushState(null,null,this.hash);var n=document.getElementById(this.hash.substring(1));if(!n)return;t(n,500,function(e){location.replace("#"+e.id)})}};return document.addEventListener("DOMContentLoaded",function(){for(var e,t=document.querySelectorAll('a[href^="#"]:not([href="#"])'),o=t.length;e=t[--o];)e.addEventListener("click",n,!1)}),t}})},biHv:function(e,t){document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".search-input"),t=document.querySelector(".search-output"),n=document.querySelector(".search-button"),o=document.querySelector(".search-container"),i=document.querySelector(".site-footer--navigation"),r=document.querySelector(".site-footer--navigation--link__search"),a=document.querySelector(".search-close");function s(){o.classList.toggle("active"),document.body.classList.toggle("locked"),e.focus()}function c(){o.classList.remove("active"),document.body.classList.remove("locked"),e.blur()}r.addEventListener("click",function(e){r.classList.contains("open")?(c(),r.classList.remove("open"),i.classList.remove("navigation--search-open")):(s(),r.classList.add("open"),i.classList.add("navigation--search-open"))}),n.addEventListener("click",function(){s()}),a.addEventListener("click",function(e){c()}),e.addEventListener("keyup",function(e){if(27===e.keyCode&&c(),e.target.value){var n=e.target.value.toLowerCase(),o=window.searchData.filter(function(e){return!!e.title.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g,"").replace("’","'").includes(n.replace("’","'"))||!(!e.alt_language_title||!e.alt_language_title.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g,"").replace("’","'").includes(n.replace("’","'")))}),i="";if(Object.keys(o).length>0){var r=!0,a=!1,s=void 0;try{for(var l,u=Object.keys(o)[Symbol.iterator]();!(r=(l=u.next()).done);r=!0){var d=l.value;i+='\n            <li>\n              <a href="/film/'+o[d].slug+'">\n                <div class="search-result--title">'+o[d].title+'</div>\n                <div class="search-result--alt-title">'+(o[d].alt_language_title?o[d].alt_language_title:"")+"</div>\n              </a>\n            </li>\n          "}}catch(e){a=!0,s=e}finally{try{!r&&u.return&&u.return()}finally{if(a)throw s}}t.innerHTML=i}else t.innerHTML="<em>No results found.</em>"}else t.innerHTML=""})})},hFJ8:function(e,t){var n,o=document.querySelector(".single-listing--trailer"),i=document.querySelector(".single-listing--trailer--iframe"),r=document.querySelector(".trailer-button");if(r)var a=r.dataset.iframe,s=r.dataset.provider;if(a){var c,l;if("youtube"==s)(c=document.createElement("script")).src="//www.youtube.com/iframe_api",(l=document.getElementsByTagName("script")[0]).parentNode.insertBefore(c,l),window.onYouTubeIframeAPIReady=function(){youtubePlayer=new YT.Player(i,{height:"390",width:"640",videoId:a,events:{onReady:onPlayerReady}})};if("vimeo"==s)(c=document.createElement("script")).src="//player.vimeo.com/api/player.js",(l=document.getElementsByTagName("script")[0]).parentNode.insertBefore(c,l),c.addEventListener("load",function(){n=new Vimeo.Player(i,{id:a}),u(),r.classList.add("loaded")});window.innerHeight>window.innerWidth?i.style.width="100%":i.style.width="75%",i.style.height=i.clientWidth*(9/16)+"px"}function u(){r.addEventListener("click",function(){o.querySelector(".single-listing--trailer--iframe");r.classList.contains("play")?(o.classList.add("lights-out"),"youtube"==s&&youtubePlayer.playVideo(),"vimeo"==s&&n.play(),document.body.classList.add("locked"),r.innerText="Close trailer",r.blur(),r.classList.remove("play"),!0):d()})}function d(){o.classList.remove("lights-out"),document.body.classList.remove("locked"),"youtube"==s&&youtubePlayer.stopVideo(),"vimeo"==s&&n.pause(),r.innerText="Watch trailer ",r.classList.add("play"),r.blur(),playing=!1}window.onPlayerReady=function(e){u(),r.classList.add("loaded")},document.addEventListener("keyup",function(e){if(!e.defaultPrevented){var t=e.key||e.keyCode;"Escape"!==t&&"Esc"!==t&&27!==t||d()}})},nHy7:function(e,t){var n=document.getElementById("nav-trigger"),o=document.querySelector(".site-footer"),i=document.querySelector(".site-footer--navigation");n.addEventListener("click",function(e){e.preventDefault(),o.classList.toggle("visible"),n.classList.toggle("open"),i.classList.toggle("nav-open"),document.documentElement.classList.toggle("locked"),document.body.classList.toggle("locked")});var r=window.navigator.userAgent,a=!!r.match(/iPad/i)||!!r.match(/iPhone/i),s=!!r.match(/WebKit/i),c=a&&s&&!r.match(/CriOS/i),l=a&&s&&r.match(/CriOS/i);(c||l)&&document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".section--home-slider");e&&(e.style.height=document.documentElement.clientHeight,e.classList.add("ios"))})},pzp0:function(e,t){var n=document.querySelector(".weekly-screenings--navigation--trigger"),o=document.querySelector(".weekly-screenings--week-picker");n&&o&&(n.addEventListener("click",function(){n.classList.toggle("active"),o.classList.toggle("visible")}),document.body.addEventListener("click",function(e){e.target.classList.contains("weekly-screenings--navigation--trigger")||(n.classList.remove("active"),o.classList.remove("visible"))}))},u3Jw:function(e,t){var n=document.querySelector(".fade-image-onload");if(n){n.classList.add("loading"),n.onload=function(){n.classList.remove("loading")};var o=setTimeout(function(){n.naturalWidth&&(n.classList.remove("loading"),clearTimeout(o))},100)}},wLSP:function(e,t){var n=document.querySelector(".bookmark"),o=document.querySelector(".site-header");document.addEventListener("DOMContentLoaded",function(){n.classList.add("active"),new IntersectionObserver(i,r).observe(o)});var i=function(e){e.forEach(function(e){e.intersectionRatio<=r.threshold?n.classList.add("compact"):n.classList.remove("compact")})},r={rootMargin:"0px 0px",threshold:.25}}});