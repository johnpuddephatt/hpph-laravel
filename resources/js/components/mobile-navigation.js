/*
** Open 'more' menu
*/

var navTrigger = document.getElementById('nav-trigger');
var nav = document.querySelector('.site-footer');
var navBar = document.querySelector('.site-footer--navigation');
if(navTrigger) {
  navTrigger.addEventListener('click',(e)=>{
    e.preventDefault();
    nav.classList.toggle('visible');
    navTrigger.classList.toggle('open');
    navBar.classList.toggle('nav-open');
    document.documentElement.classList.toggle('locked');
    document.body.classList.toggle('locked');
  });
}

/*
** UA sniffing to prevent judder due to navbar movement on iOS
*/

var ua = window.navigator.userAgent;
var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
var webkit = !!ua.match(/WebKit/i);
var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);
var iOSChrome = iOS && webkit && ua.match(/CriOS/i);

if(iOSSafari || iOSChrome) {
  document.addEventListener('DOMContentLoaded', ()=>{
    // document.documentElement.classList.add('iOSSafari');
    var homeSlider = document.querySelector('.section--home-slider');
    if(homeSlider) {
      // homeSlider.style.height = document.documentElement.clientHeight - navBar.clientHeight + 1 + 'px';
      homeSlider.style.height = document.documentElement.clientHeight;
      homeSlider.classList.add('ios');
    }
  });
}
