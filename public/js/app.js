!function(e){var n={};function t(o){if(n[o])return n[o].exports;var r=n[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,t),r.l=!0,r.exports}t.m=e,t.c=n,t.d=function(e,n,o){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:o})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="/",t(t.s=0)}({0:function(e,n,t){t("sV/x"),e.exports=t("zMGx")},"sV/x":function(e,n){document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".single-listing--screenings--show-all"),n=document.querySelector(".hidden-rows"),t=document.querySelector(".single-listing--screenings--header");e&&n&&(n.classList.remove("shown"),e.addEventListener("click",function(e){n.classList.toggle("shown"),e.target.textContent="Hide"==e.target.textContent?"Show all screenings":"Hide",t.textContent="Upcoming screenings"==t.textContent?"All screenings":"Upcoming screenings"})),disclaimerBox=document.querySelector(".disclaimer");var o=document.querySelector(".disclaimer-close");o&&disclaimerBox&&o.addEventListener("click",function(){o.parentNode.parentNode.removeChild(disclaimerBox)})});var t=document.querySelector(".fade-image-onload");t&&(t.classList.add("loading"),console.log("was-loading"),t.onload=function(){t.classList.remove("loading"),console.log("onload method")},t.naturalWidth&&(setTimeout(function(){t.classList.remove("loading")},200),console.log("natural width method")))},zMGx:function(e,n){}});