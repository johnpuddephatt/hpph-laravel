
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// var Barba = require('barba.js');

var expandScreeningsButton = document.querySelector('.single-listing--screenings--show-all');
var hiddenScreenings = document.querySelector('.hidden-rows');
if(expandScreeningsButton && hiddenScreenings) {
  expandScreeningsButton.addEventListener('click', (e)=>{
    hiddenScreenings.classList.toggle('shown');
    if (e.target.textContent=="Hide") e.target.textContent = "Show all screenings";
      else e.target.textContent = "Hide";
    });
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
