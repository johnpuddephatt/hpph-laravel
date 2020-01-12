var simpleslider = require('simple-slider');

/*
** Homepage slideshow
*/

var slider = document.querySelector('.section--home-slider');
var loadingText = document.querySelector('.loading-text');
var body = document.getElementsByTagName("BODY")[0];

document.addEventListener('DOMContentLoaded', ()=>{
  if(slider) {
    const firstSlide = slider.querySelector('.home-slider--slide');
    const firstSlideImage = firstSlide.querySelector('.home-slider--image');
    const slides = slider.querySelectorAll('.home-slider--slide');
    if( slides.length ) {
      // body.classList.add('slider-loading');
      firstSlide.classList.add('coming-in');
      var firstSlideImageCheck = setInterval(()=>{
        if(firstSlideImage.naturalWidth) {
          body.classList.remove('slider-loading');
          startSlider();
          clearInterval(firstSlideImageCheck);
        }
      }, 50);
    }
    function onChangeFn(prev,next) {
      // slides[prev].classList.remove('in');
      slides[prev].classList.add('out');
      slides[next].classList.add('coming-in');
    }
    function onChangeEndFn(prev,next) {
      slides[prev].classList.remove('coming-in');
      // slides[prev].classList.add('in');
      slides[next].classList.remove('out');
    }
    function startSlider() {
      firstSlide.classList.remove('coming-in');
      simpleslider.getSlider({
        container: slider,
        duration: 1.5,
        delay: 7.5,
        prop: 'opacity',
        unit: '',
        init: 0,
        show: 1,
        end: 0,
        onChange: onChangeFn,
        onChangeEnd: onChangeEndFn
      });
    }
  }
});
