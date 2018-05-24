
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// var Barba = require('barba.js');


document.addEventListener('DOMContentLoaded', function(){

  var expandScreeningsButton = document.querySelector('.single-listing--screenings--show-all');
  var hiddenScreenings = document.querySelector('.hidden-rows');
  var screeningsHeader = document.querySelector('.single-listing--screenings--header');
  if(expandScreeningsButton && hiddenScreenings) {
    hiddenScreenings.classList.remove('shown');
    expandScreeningsButton.addEventListener('click', (e)=>{
      hiddenScreenings.classList.toggle('shown');
      e.target.textContent =  e.target.textContent == "Hide" ? "More screenings" : "Hide";
      screeningsHeader.textContent =  screeningsHeader.textContent == "Next screenings" ? "All screenings" : "Next screenings";
    });
  }


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


// document.addEventListener('DOMContentLoaded', function(){
//   Barba.Pjax.start();
//   Barba.Prefetch.init();
//
// });
//
// var body = document.querySelector('body');
// var sliders = document.querySelectorAll('[data-barba=slide]');
// for(var i = 0; i < sliders.length; i++) {
//   sliders[i].addEventListener('click', function(){
//     body.classList.add('slide');
//   })
// }
// var unsliders = document.querySelectorAll('[data-barba=unslide]');
// for(var i = 0; i < unsliders.length; i++) {
//   unsliders[i].addEventListener('click', function(){
//     body.classList.remove('slide');
//   })
// }

// window.Vue = require('vue');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
