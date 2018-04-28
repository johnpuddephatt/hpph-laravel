/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// var Barba = require('barba.js');


document.addEventListener('DOMContentLoaded', function () {

  var expandScreeningsButton = document.querySelector('.single-listing--screenings--show-all');
  var hiddenScreenings = document.querySelector('.hidden-rows');
  var screeningsHeader = document.querySelector('.single-listing--screenings--header');
  if (expandScreeningsButton && hiddenScreenings) {
    expandScreeningsButton.addEventListener('click', function (e) {
      hiddenScreenings.classList.toggle('shown');
      e.target.textContent = e.target.textContent == "Hide" ? "Show all screenings" : "Hide";
      screeningsHeader.textContent = screeningsHeader.textContent == "Upcoming screenings" ? "All screenings" : "Upcoming screenings";
    });
  }

  disclaimerBox = document.querySelector('.disclaimer');
  var disclaimerButton = document.querySelector('.disclaimer-close');
  if (disclaimerButton && disclaimerBox) {
    disclaimerButton.addEventListener('click', function () {
      disclaimerButton.parentNode.parentNode.removeChild(disclaimerBox);
    });
  }
});

var fadeOnloadImage = document.querySelector('.fade-image-onload');
if (fadeOnloadImage) {
  fadeOnloadImage.classList.add('loading');
  if (fadeOnloadImage.naturalWidth) {
    fadeOnloadImage.classList.remove('loading');
  }
  fadeOnloadImage.onload = function () {
    fadeOnloadImage.classList.remove('loading');
  };
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

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);