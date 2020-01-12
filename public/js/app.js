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
/******/ ({

/***/ "./node_modules/simple-slider/dist/simpleslider.js":
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;(function (global, factory) {
  if (true) {
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [exports], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else if (typeof exports !== "undefined") {
    factory(exports);
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports);
    global.simpleslider = mod.exports;
  }
})(this, function (exports) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });
  function getdef(val, def) {
    return val == null ? def : val;
  }

  function len(arr) {
    return arr.length;
  }

  function startSlides(containerElem, children, unit, startVal, visVal, trProp) {
    var style = void 0,
        imgs = [];

    if (!children) {
      children = containerElem.children;
    }

    var i = len(children);

    while (--i >= 0) {
      imgs[i] = children[i];
      style = imgs[i].style;
      style.position = 'absolute';
      style.top = style.left = style.zIndex = 0;
      style[trProp] = startVal + unit;
    }

    style[trProp] = visVal + unit;
    style.zIndex = 1;

    return imgs;
  }

  function defaultEase(time, begin, change, duration) {
    return (time = time / (duration / 2)) < 1 ? change / 2 * time * time * time + begin : change / 2 * ((time -= 2) * time * time + 2) + begin;
  }

  function getSlider(options) {
    options = options || {};
    var actualIndex = void 0,
        interval = void 0,
        intervalStartTime = void 0,
        imgs = void 0,
        remainingTime = void 0;

    var containerElem = getdef(options.container, document.querySelector('*[data-simple-slider]'));
    var trProp = getdef(options.prop, 'left');
    var trTime = getdef(options.duration, 0.5) * 1000;
    var delay = getdef(options.delay, 3) * 1000;
    var unit = getdef(options.unit, '%');
    var startVal = getdef(options.init, -100);
    var visVal = getdef(options.show, 0);
    var endVal = getdef(options.end, 100);
    var paused = options.paused;
    var ease = getdef(options.ease, defaultEase);
    var onChange = getdef(options.onChange, 0);
    var onChangeEnd = getdef(options.onChangeEnd, 0);
    var now = Date.now;

    function reset() {
      if (len(containerElem.children) > 0) {
        var style = containerElem.style;
        style.position = 'relative';
        style.overflow = 'hidden';
        style.display = 'block';

        imgs = startSlides(containerElem, options.children, unit, startVal, visVal, trProp);
        actualIndex = 0;
        remainingTime = delay;
      }
    }

    function setAutoPlayLoop() {
      intervalStartTime = now();
      interval = setTimeout(function () {
        intervalStartTime = now();
        remainingTime = delay;

        change(nextIndex());

        setAutoPlayLoop();
      }, remainingTime);
    }

    function resume() {
      if (isAutoPlay()) {
        if (interval) {
          clearTimeout(interval);
        }

        setAutoPlayLoop();
      }
    }

    function isAutoPlay() {
      return !paused && len(imgs) > 1;
    }

    function pause() {
      if (isAutoPlay()) {
        remainingTime = delay - (now() - intervalStartTime);
        clearTimeout(interval);
        interval = 0;
      }
    }

    function reverse() {
      var newEndVal = startVal;
      startVal = endVal;
      endVal = newEndVal;
      actualIndex = Math.abs(actualIndex - (len(imgs) - 1));
      imgs = imgs.reverse();
    }

    function change(newIndex) {
      var count = len(imgs);
      while (--count >= 0) {
        imgs[count].style.zIndex = 1;
      }

      imgs[newIndex].style.zIndex = 3;
      imgs[actualIndex].style.zIndex = 2;

      anim(imgs[actualIndex].style, visVal, endVal, imgs[newIndex].style, startVal, visVal, trTime, 0, 0, ease);

      actualIndex = newIndex;

      if (onChange) {
        onChange(prevIndex(), actualIndex);
      }
    }

    function next() {
      change(nextIndex());
      resume();
    }

    function prev() {
      change(prevIndex());
      resume();
    }

    function nextIndex() {
      var newIndex = actualIndex + 1;
      return newIndex >= len(imgs) ? 0 : newIndex;
    }

    function prevIndex() {
      var newIndex = actualIndex - 1;
      return newIndex < 0 ? len(imgs) - 1 : newIndex;
    }

    function dispose() {
      clearTimeout(interval);
      document.removeEventListener('visibilitychange', visibilityChange);

      imgs = containerElem = interval = trProp = trTime = delay = startVal = endVal = paused = actualIndex = remainingTime = onChange = onChangeEnd = null;
    }

    function currentIndex() {
      return actualIndex;
    }

    function anim(insertElem, insertFrom, insertTo, removeElem, removeFrom, removeTo, transitionDuration, startTime, elapsedTime, easeFunc) {
      function setProp(elem, from, to) {
        elem[trProp] = easeFunc(elapsedTime - startTime, from, to - from, transitionDuration) + unit;
      }

      if (startTime > 0) {
        if (elapsedTime - startTime < transitionDuration) {
          setProp(insertElem, insertFrom, insertTo);
          setProp(removeElem, removeFrom, removeTo);
        } else {
          insertElem[trProp] = insertTo + unit;
          removeElem[trProp] = removeTo + unit;

          if (onChangeEnd) {
            onChangeEnd(actualIndex, nextIndex());
          }
          return;
        }
      }

      requestAnimationFrame(function (time) {
        if (startTime === 0) {
          startTime = time;
        }

        anim(insertElem, insertFrom, insertTo, removeElem, removeFrom, removeTo, transitionDuration, startTime, time, easeFunc);
      });
    }

    function visibilityChange() {
      if (document.hidden) {
        pause();
      } else {
        resume();
      }
    }

    document.addEventListener('visibilitychange', visibilityChange);
    reset();

    if (imgs && len(imgs) > 1) {
      resume();
    }

    return {
      currentIndex: currentIndex,
      pause: pause,
      resume: resume,
      nextIndex: nextIndex,
      prevIndex: prevIndex,
      next: next,
      prev: prev,
      change: change,
      reverse: reverse,
      dispose: dispose
    };
  }

  exports.getSlider = getSlider;
});

/***/ }),

/***/ "./node_modules/smoothScroll/smoothscroll.js":
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;(function (root, smoothScroll) {
  'use strict';

  // Support RequireJS and CommonJS/NodeJS module formats.
  // Attach smoothScroll to the `window` when executed as a <script>.

  // RequireJS
  if (true) {
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (smoothScroll),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

  // CommonJS
  } else if (typeof exports === 'object' && typeof module === 'object') {
    module.exports = smoothScroll();

  } else {
    root.smoothScroll = smoothScroll();
  }

})(this, function(){
'use strict';

// Do not initialize smoothScroll when running server side, handle it in client:
if (typeof window !== 'object') return;

// We do not want this script to be applied in browsers that do not support those
// That means no smoothscroll on IE9 and below.
if(document.querySelectorAll === void 0 || window.pageYOffset === void 0 || history.pushState === void 0) { return; }

// Get the top position of an element in the document
var getTop = function(element, start) {
    // return value of html.getBoundingClientRect().top ... IE : 0, other browsers : -pageYOffset
    if(element.nodeName === 'HTML') return -start
    return element.getBoundingClientRect().top + start
}
// ease in out function thanks to:
// http://blog.greweb.fr/2012/02/bezier-curve-based-easing-functions-from-concept-to-implementation/
var easeInOutCubic = function (t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 }

// calculate the scroll position we should be in
// given the start and end point of the scroll
// the time elapsed from the beginning of the scroll
// and the total duration of the scroll (default 500ms)
var position = function(start, end, elapsed, duration) {
    if (elapsed > duration) return end;
    return start + (end - start) * easeInOutCubic(elapsed / duration); // <-- you can change the easing funtion there
    // return start + (end - start) * (elapsed / duration); // <-- this would give a linear scroll
}

// we use requestAnimationFrame to be called by the browser before every repaint
// if the first argument is an element then scroll to the top of this element
// if the first argument is numeric then scroll to this location
// if the callback exist, it is called when the scrolling is finished
// if context is set then scroll that element, else scroll window
var smoothScroll = function(el, duration, callback, context){
    duration = duration || 500;
    context = context || window;
    var start = context.scrollTop || window.pageYOffset;

    if (typeof el === 'number') {
      var end = parseInt(el);
    } else {
      var end = getTop(el, start);
    }

    var clock = Date.now();
    var requestAnimationFrame = window.requestAnimationFrame ||
        window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame ||
        function(fn){window.setTimeout(fn, 15);};

    var step = function(){
        var elapsed = Date.now() - clock;
        if (context !== window) {
          context.scrollTop = position(start, end, elapsed, duration);
        }
        else {
          window.scroll(0, position(start, end, elapsed, duration));
        }

        if (elapsed > duration) {
            if (typeof callback === 'function') {
                callback(el);
            }
        } else {
            requestAnimationFrame(step);
        }
    }
    step();
}

var linkHandler = function(ev) {
    if (!ev.defaultPrevented) {
        ev.preventDefault();

        if (location.hash !== this.hash) window.history.pushState(null, null, this.hash)
        // using the history api to solve issue #1 - back doesn't work
        // most browser don't update :target when the history api is used:
        // THIS IS A BUG FROM THE BROWSERS.
        // change the scrolling duration in this call
        var node = document.getElementById(this.hash.substring(1))
        if (!node) return; // Do not scroll to non-existing node

        smoothScroll(node, 500, function (el) {
            location.replace('#' + el.id)
            // this will cause the :target to be activated.
        });
    }
}

// We look for all the internal links in the documents and attach the smoothscroll function
document.addEventListener("DOMContentLoaded", function () {
    var internal = document.querySelectorAll('a[href^="#"]:not([href="#"])'), a;
    for(var i=internal.length; a=internal[--i];){
        a.addEventListener("click", linkHandler, false);
    }
});

// return smoothscroll API
return smoothScroll;

});


/***/ }),

/***/ "./resources/js/app.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__util_in_view__ = __webpack_require__("./resources/js/util/in-view.js");

__webpack_require__("./resources/js/components/slideshow.js");
__webpack_require__("./resources/js/components/week-navigation.js");
__webpack_require__("./resources/js/components/fade-image-on-load.js");
__webpack_require__("./resources/js/components/mobile-screenings-menu.js");
__webpack_require__("./resources/js/components/select-screenings.js");
__webpack_require__("./resources/js/components/trailer-player.js");
__webpack_require__("./resources/js/components/search.js");
__webpack_require__("./resources/js/components/mobile-navigation.js");
__webpack_require__("./resources/js/components/bookmark.js");

var smoothScroll = __webpack_require__("./node_modules/smoothScroll/smoothscroll.js");

// let {iframeResizer} = require('iframe-resizer');

/***/ }),

/***/ "./resources/js/components/bookmark.js":
/***/ (function(module, exports) {

var bookmark = document.querySelector('.bookmark');
var header = document.querySelector('.site-header');

document.addEventListener('DOMContentLoaded', function () {
  bookmark.classList.add('active');
  var observer = new IntersectionObserver(callback, options);
  observer.observe(header);
});
var callback = function callback(entries) {
  entries.forEach(function (entry) {
    if (entry.intersectionRatio <= options.threshold) {
      bookmark.classList.add('compact');
    } else {
      bookmark.classList.remove('compact');
    }
  });
};

var options = {
  rootMargin: '0px 0px',
  threshold: 0.25
};

/***/ }),

/***/ "./resources/js/components/fade-image-on-load.js":
/***/ (function(module, exports) {

/*
** Fade selected images on load
*/

var fadeOnloadImage = document.querySelector('.fade-image-onload');
if (fadeOnloadImage) {
  fadeOnloadImage.classList.add('loading');
  fadeOnloadImage.onload = function () {
    fadeOnloadImage.classList.remove('loading');
  };
  var fadeOnloadImageCheck = setTimeout(function () {
    if (fadeOnloadImage.naturalWidth) {
      fadeOnloadImage.classList.remove('loading');
      clearTimeout(fadeOnloadImageCheck);
    }
  }, 100);
}

/***/ }),

/***/ "./resources/js/components/mobile-navigation.js":
/***/ (function(module, exports) {

/*
** Open 'more' menu
*/

var navTrigger = document.getElementById('nav-trigger');
var nav = document.querySelector('.site-footer');
var navBar = document.querySelector('.site-footer--navigation');
navTrigger.addEventListener('click', function (e) {
  e.preventDefault();
  nav.classList.toggle('visible');
  navTrigger.classList.toggle('open');
  navBar.classList.toggle('nav-open');
  document.documentElement.classList.toggle('locked');
  document.body.classList.toggle('locked');
});

/*
** UA sniffing to prevent judder due to navbar movement on iOS
*/

var ua = window.navigator.userAgent;
var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
var webkit = !!ua.match(/WebKit/i);
var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);
var iOSChrome = iOS && webkit && ua.match(/CriOS/i);

if (iOSSafari || iOSChrome) {
  document.addEventListener('DOMContentLoaded', function () {
    // document.documentElement.classList.add('iOSSafari');
    var homeSlider = document.querySelector('.section--home-slider');
    if (homeSlider) {
      // homeSlider.style.height = document.documentElement.clientHeight - navBar.clientHeight + 1 + 'px';
      homeSlider.style.height = document.documentElement.clientHeight;
      homeSlider.classList.add('ios');
    }
  });
}

/***/ }),

/***/ "./resources/js/components/mobile-screenings-menu.js":
/***/ (function(module, exports) {

/*
** Slide up screenings on mobile
*/
var screeningsTitle = document.querySelector('.single-listing--venue--header');
var screeningsContainer = document.querySelector('.single-listing--sidebar');
var screeningsMobileButton = document.querySelector('.single-listing--mobile--screenings');
if (screeningsMobileButton && screeningsTitle) {
  screeningsMobileButton.addEventListener('click', function () {
    toggleScreeningsMenu();
  });
  screeningsTitle.addEventListener('click', function () {
    toggleScreeningsMenu();
  });
}

function toggleScreeningsMenu() {
  screeningsContainer.classList.toggle('open');
  document.documentElement.classList.toggle('locked');
  document.body.classList.toggle('locked');
}

/***/ }),

/***/ "./resources/js/components/search.js":
/***/ (function(module, exports) {


/*
** Search
*/

document.addEventListener('DOMContentLoaded', function () {

  var searchInput = document.querySelector('.search-input'),
      searchOutput = document.querySelector('.search-output'),
      searchButton = document.querySelector('.search-button'),
      searchContainer = document.querySelector('.search-container'),
      siteNavigationFooter = document.querySelector('.site-footer--navigation'),
      searchFooterButton = document.querySelector('.site-footer--navigation--link__search'),
      searchClose = document.querySelector('.search-close');

  searchFooterButton.addEventListener('click', function (e) {
    if (searchFooterButton.classList.contains('open')) {
      closeSearch();
      searchFooterButton.classList.remove('open');
      siteNavigationFooter.classList.remove('navigation--search-open');
    } else {
      openSearch();
      searchFooterButton.classList.add('open');
      siteNavigationFooter.classList.add('navigation--search-open');
    }
  });

  searchButton.addEventListener('click', function () {
    openSearch();
  });

  function openSearch() {
    searchContainer.classList.toggle('active');
    document.body.classList.toggle('locked');
    searchInput.focus();
  }

  function closeSearch() {
    searchContainer.classList.remove('active');
    document.body.classList.remove('locked');
    searchInput.blur();
  }

  searchClose.addEventListener('click', function (e) {
    closeSearch();
  });

  searchInput.addEventListener('keyup', function (e) {
    if (e.keyCode === 27) {
      closeSearch();
    };
    if (e.target.value) {
      var searchValue = e.target.value.toLowerCase();

      var searchResults = window.searchData.filter(function (item) {
        if (item.title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").replace("’", "'").includes(searchValue.replace("’", "'"))) {
          return true;
        } else if (item.alt_language_title && item.alt_language_title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").replace("’", "'").includes(searchValue.replace("’", "'"))) {
          return true;
        } else {
          return false;
        }
      });

      var searchHTML = '';
      if (Object.keys(searchResults).length > 0) {
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = Object.keys(searchResults)[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var key = _step.value;

            searchHTML += '\n            <li>\n              <a href="/film/' + searchResults[key].slug + '">\n                <div class="search-result--title">' + searchResults[key].title + '</div>\n                <div class="search-result--alt-title">' + (searchResults[key].alt_language_title ? searchResults[key].alt_language_title : '') + '</div>\n              </a>\n            </li>\n          ';
          }
        } catch (err) {
          _didIteratorError = true;
          _iteratorError = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion && _iterator.return) {
              _iterator.return();
            }
          } finally {
            if (_didIteratorError) {
              throw _iteratorError;
            }
          }
        }

        searchOutput.innerHTML = searchHTML;
      } else {
        searchOutput.innerHTML = '<em>No results found.</em>';
      }
    } else {
      searchOutput.innerHTML = '';
    }
  });
});

/***/ }),

/***/ "./resources/js/components/select-screenings.js":
/***/ (function(module, exports) {

/*
** Select (or preselect) screenings
*/

var screeningTable = document.querySelector('.screenings-table');
var screeningAnnouncer = document.querySelector('.screenings-table--announcer');
var screeningExplainer = document.querySelector('.screenings-table--explainer');
var screeningWrapper = document.querySelector('.screenings-table--announcer--wrapper');

if (screeningTable && screeningAnnouncer) {
  var selectScreening = function selectScreening(screeningTime, screeningDate, screeningURL) {
    screeningExplainer.style.visibility = 'hidden';
    screeningAnnouncer.innerHTML = '<div class="screenings-table--announcer--text"><h3 class="screenings-table--announcer--heading">Selected showtime:</h3><p>' + screeningDate + ' at ' + screeningTime + '</p></div><button class="button button__gray cancel-button">Cancel</button><a class="button button__yellow book-button" href="' + screeningURL + '">Book \xBB</a>';
    var bookButton = document.querySelector('.book-button');
    var cancelButton = document.querySelector('.cancel-button');
    cancelButton.addEventListener('click', function (e) {
      cancelSelectedScreening();
    });
    // bookButton.addEventListener('click',(e)=>{bookingFormEmbed(e)});
    screeningWrapper.classList.add('active');
  };

  var cancelSelectedScreening = function cancelSelectedScreening() {
    screeningWrapper.classList.remove('active');
    screeningTable.querySelector('input:checked').checked = false;
    screeningExplainer.style.visibility = 'visible';
  };

  screeningTable.addEventListener('click', function (e) {
    if (e.target.nodeName == 'INPUT') {
      selectScreening(e.target.dataset.time, e.target.dataset.date, e.target.dataset.url);
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var screeningID = url.searchParams.get("screeningID");
    if (screeningID) {
      var screeningInput = document.querySelector('input#screening-' + screeningID);
      if (screeningInput) {
        screeningInput.checked = true;
        selectScreening(screeningInput.dataset.time, screeningInput.dataset.date, screeningInput.dataset.url);
      }
    }
  });
}

/***/ }),

/***/ "./resources/js/components/slideshow.js":
/***/ (function(module, exports, __webpack_require__) {

var simpleslider = __webpack_require__("./node_modules/simple-slider/dist/simpleslider.js");

/*
** Homepage slideshow
*/

var slider = document.querySelector('.section--home-slider');
var loadingText = document.querySelector('.loading-text');
var body = document.getElementsByTagName("BODY")[0];

document.addEventListener('DOMContentLoaded', function () {
  if (slider) {
    var onChangeFn = function onChangeFn(prev, next) {
      // slides[prev].classList.remove('in');
      slides[prev].classList.add('out');
      slides[next].classList.add('coming-in');
    };

    var onChangeEndFn = function onChangeEndFn(prev, next) {
      slides[prev].classList.remove('coming-in');
      // slides[prev].classList.add('in');
      slides[next].classList.remove('out');
    };

    var startSlider = function startSlider() {
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
    };

    var firstSlide = slider.querySelector('.home-slider--slide');
    var firstSlideImage = firstSlide.querySelector('.home-slider--image');
    var slides = slider.querySelectorAll('.home-slider--slide');
    if (slides.length) {
      // body.classList.add('slider-loading');
      firstSlide.classList.add('coming-in');
      var firstSlideImageCheck = setInterval(function () {
        if (firstSlideImage.naturalWidth) {
          body.classList.remove('slider-loading');
          startSlider();
          clearInterval(firstSlideImageCheck);
        }
      }, 50);
    }
  }
});

/***/ }),

/***/ "./resources/js/components/trailer-player.js":
/***/ (function(module, exports) {

/*
** Trailer on film pages
*/
var trailerContainer = document.querySelector('.single-listing--trailer');
var trailerIframe = document.querySelector('.single-listing--trailer--iframe');
var trailerButton = document.querySelector('.trailer-button');
var vimeoPlayer;
if (trailerButton) {
  var trailerID = trailerButton.dataset.iframe;
  var trailerProvider = trailerButton.dataset.provider;
}
if (trailerID) {
  if (trailerProvider == 'youtube') {
    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    window.onYouTubeIframeAPIReady = function () {

      youtubePlayer = new YT.Player(trailerIframe, {
        height: '390',
        width: '640',
        videoId: trailerID,
        events: {
          'onReady': onPlayerReady
        }
      });
    };
  }

  if (trailerProvider == 'vimeo') {
    var tag = document.createElement('script');
    tag.src = "//player.vimeo.com/api/player.js";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    tag.addEventListener('load', function () {
      vimeoPlayer = new Vimeo.Player(trailerIframe, {
        id: trailerID
      });
      connectTrailerButton();
      trailerButton.classList.add('loaded');
    });
  }

  if (window.innerHeight > window.innerWidth) {
    trailerIframe.style.width = '100%';
  } else {
    trailerIframe.style.width = '75%';
  }
  trailerIframe.style.height = trailerIframe.clientWidth * (9 / 16) + 'px';
}

// 4. The API will call this function when the video player is ready.
window.onPlayerReady = function (event) {
  connectTrailerButton();
  trailerButton.classList.add('loaded');
};

function connectTrailerButton() {
  var playing = false;

  trailerButton.addEventListener('click', function () {
    var trailerIframe = trailerContainer.querySelector('.single-listing--trailer--iframe');
    if (trailerButton.classList.contains('play')) {
      trailerContainer.classList.add('lights-out');
      if (trailerProvider == 'youtube') {
        youtubePlayer.playVideo();
      }
      if (trailerProvider == 'vimeo') {
        vimeoPlayer.play();
      }
      document.body.classList.add('locked');
      trailerButton.innerText = 'Close trailer';
      trailerButton.blur();
      trailerButton.classList.remove('play');
      playing = true;
    } else {
      closeVideo();
    }
  });
}

function closeVideo() {
  trailerContainer.classList.remove('lights-out');
  document.body.classList.remove('locked');
  if (trailerProvider == 'youtube') {
    youtubePlayer.stopVideo();
  }
  if (trailerProvider == 'vimeo') {
    vimeoPlayer.pause();
  }
  trailerButton.innerText = 'Watch trailer ';
  trailerButton.classList.add('play');
  trailerButton.blur();
  playing = false;
}

// Trigger trailer close when escape is pressed
document.addEventListener('keyup', function (event) {
  if (event.defaultPrevented) {
    return;
  }
  var key = event.key || event.keyCode;
  if (key === 'Escape' || key === 'Esc' || key === 27) {
    closeVideo();
  }
});

/***/ }),

/***/ "./resources/js/components/week-navigation.js":
/***/ (function(module, exports) {

/*
** Weekly navigation menu
*/

var weeklyNavigationMenuTrigger = document.querySelector('.weekly-screenings--navigation--trigger');
var weeklyNavigationMenuTarget = document.querySelector('.weekly-screenings--week-picker');
if (weeklyNavigationMenuTrigger && weeklyNavigationMenuTarget) {
  weeklyNavigationMenuTrigger.addEventListener('click', function () {
    weeklyNavigationMenuTrigger.classList.toggle('active');
    weeklyNavigationMenuTarget.classList.toggle('visible');
  });
  document.body.addEventListener('click', function (e) {
    if (!e.target.classList.contains('weekly-screenings--navigation--trigger')) {
      weeklyNavigationMenuTrigger.classList.remove('active');
      weeklyNavigationMenuTarget.classList.remove('visible');
    }
  });
}

/***/ }),

/***/ "./resources/js/util/in-view.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * Use intersection observer to detect when an element is in view
 */
/* unused harmony default export */ var _unused_webpack_default_export = (function (elem, threshold, rootMargin, parentCallback) {

  if (!(elem instanceof Element || elem instanceof HTMLDocument)) {
    elem = document.querySelectorAll(elem);
  }

  if (!elem) return;

  var callback = function callback(entries) {
    entries.forEach(function (entry) {
      if (entry.intersectionRatio >= options.threshold) {
        if (parentCallback) {
          parentCallback();
        } else {
          entry.target.classList.add('in-view');
        }
      }
    });
  };

  var options = {
    rootMargin: rootMargin || '0px 0px',
    threshold: threshold
  };

  var observer = new IntersectionObserver(callback, options);
  if (elem.length) {
    elem.forEach(function (elem) {
      observer.observe(elem);
    });
  } else {
    observer.observe(elem);
  }
});

/***/ }),

/***/ "./resources/sass/admin.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/app.sass":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/js/app.js");
__webpack_require__("./resources/sass/app.sass");
module.exports = __webpack_require__("./resources/sass/admin.scss");


/***/ })

/******/ });