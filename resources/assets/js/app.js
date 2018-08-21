
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// var Barba = require('barba.js');

var smoothScroll = require ('smoothScroll');

var simpleslider = require('simple-slider');
// var imagesLoaded = require('imagesLoaded');

var slider = document.querySelector('.section--home-slider');
var loadingText = document.querySelector('.loading-text');
var body = document.querySelector('body');
// newVisitor = !sessionStorage.getItem('oldVisitor');

document.addEventListener('DOMContentLoaded', ()=>{

  if(slider) {
    var firstSlide = slider.querySelector('.home-slider--slide');
    var slides = slider.querySelectorAll('.home-slider--slide');

    body.classList.add('slider-loading');
    firstSlide.classList.add('coming-in');
    // firstSlide.addEventListener('load', ()=>{
    // imagesLoaded( firstSlide, function( instance ) {
    startSlider();
    // });
    function onChangeFn(prev,next) {
      slides[prev].classList.remove('in');
      slides[prev].classList.add('out');
      slides[next].classList.add('coming-in');
    }

    function onChangeEndFn(prev,next) {
      slides[prev].classList.remove('coming-in');
      slides[prev].classList.add('in');
      slides[next].classList.remove('out');
    }

    function startSlider() {
      firstSlide.classList.remove('coming-in');
      body.classList.remove('slider-loading');

      // imagesLoaded( slides, function( instance ) {
        simpleslider.getSlider({
          container: slider,
          duration: 2,
          delay: 5,
          prop: 'opacity',
          unit: '',
          init: 0,
          show: 1,
          end: 0,
          onChange: onChangeFn,
          onChangeEnd: onChangeEndFn
        });
      // });
    }
  }
});




document.addEventListener('DOMContentLoaded', function(){

  // var expandScreeningsButton = document.querySelector('.single-listing--screenings--show-all');
  // var hiddenScreenings = document.querySelector('.hidden-rows');
  // var screeningsHeader = document.querySelector('.single-listing--screenings--header');
  // if(expandScreeningsButton && hiddenScreenings) {
  //   hiddenScreenings.classList.remove('shown');
  //   expandScreeningsButton.addEventListener('click', (e)=>{
  //     hiddenScreenings.classList.toggle('shown');
  //     e.target.textContent =  e.target.textContent == "Hide" ? "More screenings" : "Hide";
  //     screeningsHeader.textContent =  screeningsHeader.textContent == "Next screenings" ? "All screenings" : "Next screenings";
  //   });
  // }


   disclaimerBox = document.querySelector('.disclaimer');
  var disclaimerButton = document.querySelector('.disclaimer-close');
  if (disclaimerButton && disclaimerBox) {
    disclaimerButton.addEventListener('click', function(){
      disclaimerButton.parentNode.parentNode.removeChild(disclaimerBox);
    });
  }

});

var fadeOnloadImage = document.querySelector('.fade-image-onload');
if(fadeOnloadImage) {
  fadeOnloadImage.classList.add('loading')

  fadeOnloadImage.onload = function() {
    fadeOnloadImage.classList.remove('loading');

  }
  if(fadeOnloadImage.naturalWidth) {
    setTimeout(()=>{
      fadeOnloadImage.classList.remove('loading');
    }, 200);

  }
}



var weeklyNavigationMenuTrigger = document.querySelector('.weekly-screenings--navigation--trigger');
var weeklyNavigationMenuTarget = document.querySelector('.weekly-screenings--week-picker');
if(weeklyNavigationMenuTrigger && weeklyNavigationMenuTarget) {
  weeklyNavigationMenuTrigger.addEventListener('click', ()=>{
    weeklyNavigationMenuTrigger.classList.toggle('active');
    weeklyNavigationMenuTarget.classList.toggle('visible');
  });
  body.addEventListener('click', (e)=> {
    if(!e.target.classList.contains('weekly-screenings--navigation--trigger')) {
      weeklyNavigationMenuTrigger.classList.remove('active');
      weeklyNavigationMenuTarget.classList.remove('visible');
    }
  })
}



(function() {
  // Get all the <h2> headings
  const keyTitle = document.querySelector('.single-listing--screenings--key--heading');
  const keyContent = document.querySelector('.single-listing--screenings--key--content');

  if(keyTitle && keyContent) {
    // Give each <h2> a toggle button child
    // with the SVG plus/minus icon
    keyTitle.innerHTML = `${keyTitle.textContent}
      <button class="button button__small button__text" aria-expanded="false">
        Show key
      </button>
    `

    // Assign the button
    let btn = keyTitle.querySelector('button')
    keyContent.classList.add('accordion-enabled')
    keyContent.hidden = true

    btn.onclick = () => {
      console.log(btn)
      // Cast the state as a boolean
      let expanded = btn.getAttribute('aria-expanded') === 'true' || false

      // Switch the state
      btn.setAttribute('aria-expanded', !expanded)
      // Switch the content's visibility
      keyContent.hidden = expanded
      console.log(keyContent)
    }
  }
})()

const screeningTable = document.querySelector('.screenings-table');
const screeningAnnouncer = document.querySelector('.screenings-table--announcer');

if(screeningTable && screeningAnnouncer) {

  function selectScreening(screeningTime,screeningDate,screeningURL) {

    screeningAnnouncer.innerHTML = `<h3 class="screenings-table--announcer--heading">Selected showtime</h3><p>${screeningDate} at ${screeningTime}<a class="button" href="{screeningURL}">Book now</a></p>`;
  }

  screeningTable.addEventListener('click',(e)=>{
    if(e.target.nodeName == 'INPUT') {
      selectScreening(e.target.dataset.time,e.target.dataset.date,e.target.dataset.url);
    }
  })

  document.addEventListener('DOMContentLoaded',()=>{
    var url_string = window.location.href;
    var url = new URL(url_string);
    var screeningID = url.searchParams.get("screeningID");
    if(screeningID) {

      var screeningInput = document.querySelector('input#screening-' + screeningID);
      if(screeningInput) {
        screeningInput.checked = true;
        selectScreening(screeningInput.dataset.time,screeningInput.dataset.date,screeningInput.dataset.url)
      }
    }
  })
}

