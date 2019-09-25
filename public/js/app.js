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

/***/ "./node_modules/iframe-resizer/index.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = __webpack_require__("./node_modules/iframe-resizer/js/index.js")


/***/ }),

/***/ "./node_modules/iframe-resizer/js/iframeResizer.contentWindow.js":
/***/ (function(module, exports) {

/*
 * File: iframeResizer.contentWindow.js
 * Desc: Include this file in any page being loaded into an iframe
 *       to force the iframe to resize to the content size.
 * Requires: iframeResizer.js on host page.
 * Doc: https://github.com/davidjbradshaw/iframe-resizer
 * Author: David J. Bradshaw - dave@bradshaw.net
 * Contributor: Jure Mav - jure.mav@gmail.com
 * Contributor: Ian Caunce - ian@hallnet.co.uk
 */

(function(undefined) {
  'use strict';

  if (typeof window === 'undefined') return; // don't run for server side render

  var autoResize = true,
    base = 10,
    bodyBackground = '',
    bodyMargin = 0,
    bodyMarginStr = '',
    bodyObserver = null,
    bodyPadding = '',
    calculateWidth = false,
    doubleEventList = { resize: 1, click: 1 },
    eventCancelTimer = 128,
    firstRun = true,
    height = 1,
    heightCalcModeDefault = 'bodyOffset',
    heightCalcMode = heightCalcModeDefault,
    initLock = true,
    initMsg = '',
    inPageLinks = {},
    interval = 32,
    intervalTimer = null,
    logging = false,
    msgID = '[iFrameSizer]', //Must match host page msg ID
    msgIdLen = msgID.length,
    myID = '',
    observer = null,
    resetRequiredMethods = {
      max: 1,
      min: 1,
      bodyScroll: 1,
      documentElementScroll: 1
    },
    resizeFrom = 'child',
    sendPermit = true,
    target = window.parent,
    targetOriginDefault = '*',
    tolerance = 0,
    triggerLocked = false,
    triggerLockedTimer = null,
    throttledTimer = 16,
    width = 1,
    widthCalcModeDefault = 'scroll',
    widthCalcMode = widthCalcModeDefault,
    win = window,
    messageCallback = function() {
      warn('MessageCallback function not defined');
    },
    readyCallback = function() {},
    pageInfoCallback = function() {},
    customCalcMethods = {
      height: function() {
        warn('Custom height calculation function not defined');
        return document.documentElement.offsetHeight;
      },
      width: function() {
        warn('Custom width calculation function not defined');
        return document.body.scrollWidth;
      }
    },
    eventHandlersByName = {},
    passiveSupported = false,
    onceSupported = false;

  function noop() {}

  try {
    var options = Object.create(
      {},
      {
        passive: {
          get: function() {
            passiveSupported = true;
          }
        },
        once: {
          get: function() {
            onceSupported = true;
          }
        }
      }
    );
    window.addEventListener('test', noop, options);
    window.removeEventListener('test', noop, options);
  } catch (e) {
    /* */
  }

  function addEventListener(el, evt, func, options) {
    /* istanbul ignore else */ // Not testable in phantomJS
    if ('addEventListener' in window) {
      el.addEventListener(evt, func, passiveSupported ? options || {} : false);
    } else if ('attachEvent' in window) {
      //IE
      el.attachEvent('on' + evt, func);
    }
  }

  function removeEventListener(el, evt, func) {
    /* istanbul ignore else */ // Not testable in phantomJS
    if ('removeEventListener' in window) {
      el.removeEventListener(evt, func, false);
    } else if ('detachEvent' in window) {
      //IE
      el.detachEvent('on' + evt, func);
    }
  }

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  //Based on underscore.js
  function throttle(func) {
    var context,
      args,
      result,
      timeout = null,
      previous = 0,
      later = function() {
        previous = getNow();
        timeout = null;
        result = func.apply(context, args);
        if (!timeout) {
          context = args = null;
        }
      };

    return function() {
      var now = getNow();

      if (!previous) {
        previous = now;
      }

      var remaining = throttledTimer - (now - previous);

      context = this;
      args = arguments;

      if (remaining <= 0 || remaining > throttledTimer) {
        if (timeout) {
          clearTimeout(timeout);
          timeout = null;
        }

        previous = now;
        result = func.apply(context, args);

        if (!timeout) {
          context = args = null;
        }
      } else if (!timeout) {
        timeout = setTimeout(later, remaining);
      }

      return result;
    };
  }

  var getNow =
    Date.now ||
    function() {
      /* istanbul ignore next */ // Not testable in PhantonJS
      return new Date().getTime();
    };

  function formatLogMsg(msg) {
    return msgID + '[' + myID + ']' + ' ' + msg;
  }

  function log(msg) {
    if (logging && 'object' === typeof window.console) {
      console.log(formatLogMsg(msg));
    }
  }

  function warn(msg) {
    if ('object' === typeof window.console) {
      console.warn(formatLogMsg(msg));
    }
  }

  function init() {
    readDataFromParent();
    log('Initialising iFrame (' + location.href + ')');
    readDataFromPage();
    setMargin();
    setBodyStyle('background', bodyBackground);
    setBodyStyle('padding', bodyPadding);
    injectClearFixIntoBodyElement();
    checkHeightMode();
    checkWidthMode();
    stopInfiniteResizingOfIFrame();
    setupPublicMethods();
    startEventListeners();
    inPageLinks = setupInPageLinks();
    sendSize('init', 'Init message from host page');
    readyCallback();
  }

  function readDataFromParent() {
    function strBool(str) {
      return 'true' === str ? true : false;
    }

    var data = initMsg.substr(msgIdLen).split(':');

    myID = data[0];
    bodyMargin = undefined !== data[1] ? Number(data[1]) : bodyMargin; //For V1 compatibility
    calculateWidth = undefined !== data[2] ? strBool(data[2]) : calculateWidth;
    logging = undefined !== data[3] ? strBool(data[3]) : logging;
    interval = undefined !== data[4] ? Number(data[4]) : interval;
    autoResize = undefined !== data[6] ? strBool(data[6]) : autoResize;
    bodyMarginStr = data[7];
    heightCalcMode = undefined !== data[8] ? data[8] : heightCalcMode;
    bodyBackground = data[9];
    bodyPadding = data[10];
    tolerance = undefined !== data[11] ? Number(data[11]) : tolerance;
    inPageLinks.enable = undefined !== data[12] ? strBool(data[12]) : false;
    resizeFrom = undefined !== data[13] ? data[13] : resizeFrom;
    widthCalcMode = undefined !== data[14] ? data[14] : widthCalcMode;
  }

  function readDataFromPage() {
    function readData() {
      var data = window.iFrameResizer;

      log('Reading data from page: ' + JSON.stringify(data));

      messageCallback =
        'messageCallback' in data ? data.messageCallback : messageCallback;
      readyCallback =
        'readyCallback' in data ? data.readyCallback : readyCallback;
      targetOriginDefault =
        'targetOrigin' in data ? data.targetOrigin : targetOriginDefault;
      heightCalcMode =
        'heightCalculationMethod' in data
          ? data.heightCalculationMethod
          : heightCalcMode;
      widthCalcMode =
        'widthCalculationMethod' in data
          ? data.widthCalculationMethod
          : widthCalcMode;
    }

    function setupCustomCalcMethods(calcMode, calcFunc) {
      if ('function' === typeof calcMode) {
        log('Setup custom ' + calcFunc + 'CalcMethod');
        customCalcMethods[calcFunc] = calcMode;
        calcMode = 'custom';
      }

      return calcMode;
    }

    if (
      'iFrameResizer' in window &&
      Object === window.iFrameResizer.constructor
    ) {
      readData();
      heightCalcMode = setupCustomCalcMethods(heightCalcMode, 'height');
      widthCalcMode = setupCustomCalcMethods(widthCalcMode, 'width');
    }

    log('TargetOrigin for parent set to: ' + targetOriginDefault);
  }

  function chkCSS(attr, value) {
    if (-1 !== value.indexOf('-')) {
      warn('Negative CSS value ignored for ' + attr);
      value = '';
    }
    return value;
  }

  function setBodyStyle(attr, value) {
    if (undefined !== value && '' !== value && 'null' !== value) {
      document.body.style[attr] = value;
      log('Body ' + attr + ' set to "' + value + '"');
    }
  }

  function setMargin() {
    //If called via V1 script, convert bodyMargin from int to str
    if (undefined === bodyMarginStr) {
      bodyMarginStr = bodyMargin + 'px';
    }

    setBodyStyle('margin', chkCSS('margin', bodyMarginStr));
  }

  function stopInfiniteResizingOfIFrame() {
    document.documentElement.style.height = '';
    document.body.style.height = '';
    log('HTML & body height set to "auto"');
  }

  function manageTriggerEvent(options) {
    var listener = {
      add: function(eventName) {
        function handleEvent() {
          sendSize(options.eventName, options.eventType);
        }

        eventHandlersByName[eventName] = handleEvent;

        addEventListener(window, eventName, handleEvent, { passive: true });
      },
      remove: function(eventName) {
        var handleEvent = eventHandlersByName[eventName];
        delete eventHandlersByName[eventName];

        removeEventListener(window, eventName, handleEvent);
      }
    };

    if (options.eventNames && Array.prototype.map) {
      options.eventName = options.eventNames[0];
      options.eventNames.map(listener[options.method]);
    } else {
      listener[options.method](options.eventName);
    }

    log(
      capitalizeFirstLetter(options.method) +
        ' event listener: ' +
        options.eventType
    );
  }

  function manageEventListeners(method) {
    manageTriggerEvent({
      method: method,
      eventType: 'Animation Start',
      eventNames: ['animationstart', 'webkitAnimationStart']
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Animation Iteration',
      eventNames: ['animationiteration', 'webkitAnimationIteration']
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Animation End',
      eventNames: ['animationend', 'webkitAnimationEnd']
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Input',
      eventName: 'input'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Mouse Up',
      eventName: 'mouseup'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Mouse Down',
      eventName: 'mousedown'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Orientation Change',
      eventName: 'orientationchange'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Print',
      eventName: ['afterprint', 'beforeprint']
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Ready State Change',
      eventName: 'readystatechange'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Touch Start',
      eventName: 'touchstart'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Touch End',
      eventName: 'touchend'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Touch Cancel',
      eventName: 'touchcancel'
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Transition Start',
      eventNames: [
        'transitionstart',
        'webkitTransitionStart',
        'MSTransitionStart',
        'oTransitionStart',
        'otransitionstart'
      ]
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Transition Iteration',
      eventNames: [
        'transitioniteration',
        'webkitTransitionIteration',
        'MSTransitionIteration',
        'oTransitionIteration',
        'otransitioniteration'
      ]
    });
    manageTriggerEvent({
      method: method,
      eventType: 'Transition End',
      eventNames: [
        'transitionend',
        'webkitTransitionEnd',
        'MSTransitionEnd',
        'oTransitionEnd',
        'otransitionend'
      ]
    });
    if ('child' === resizeFrom) {
      manageTriggerEvent({
        method: method,
        eventType: 'IFrame Resized',
        eventName: 'resize'
      });
    }
  }

  function checkCalcMode(calcMode, calcModeDefault, modes, type) {
    if (calcModeDefault !== calcMode) {
      if (!(calcMode in modes)) {
        warn(
          calcMode + ' is not a valid option for ' + type + 'CalculationMethod.'
        );
        calcMode = calcModeDefault;
      }
      log(type + ' calculation method set to "' + calcMode + '"');
    }

    return calcMode;
  }

  function checkHeightMode() {
    heightCalcMode = checkCalcMode(
      heightCalcMode,
      heightCalcModeDefault,
      getHeight,
      'height'
    );
  }

  function checkWidthMode() {
    widthCalcMode = checkCalcMode(
      widthCalcMode,
      widthCalcModeDefault,
      getWidth,
      'width'
    );
  }

  function startEventListeners() {
    if (true === autoResize) {
      manageEventListeners('add');
      setupMutationObserver();
    } else {
      log('Auto Resize disabled');
    }
  }

  function stopMsgsToParent() {
    log('Disable outgoing messages');
    sendPermit = false;
  }

  function removeMsgListener() {
    log('Remove event listener: Message');
    removeEventListener(window, 'message', receiver);
  }

  function disconnectMutationObserver() {
    if (null !== bodyObserver) {
      /* istanbul ignore next */ // Not testable in PhantonJS
      bodyObserver.disconnect();
    }
  }

  function stopEventListeners() {
    manageEventListeners('remove');
    disconnectMutationObserver();
    clearInterval(intervalTimer);
  }

  function teardown() {
    stopMsgsToParent();
    removeMsgListener();
    if (true === autoResize) stopEventListeners();
  }

  function injectClearFixIntoBodyElement() {
    var clearFix = document.createElement('div');
    clearFix.style.clear = 'both';
    clearFix.style.display = 'block'; //Guard against this having been globally redefined in CSS.
    document.body.appendChild(clearFix);
  }

  function setupInPageLinks() {
    function getPagePosition() {
      return {
        x:
          window.pageXOffset !== undefined
            ? window.pageXOffset
            : document.documentElement.scrollLeft,
        y:
          window.pageYOffset !== undefined
            ? window.pageYOffset
            : document.documentElement.scrollTop
      };
    }

    function getElementPosition(el) {
      var elPosition = el.getBoundingClientRect(),
        pagePosition = getPagePosition();

      return {
        x: parseInt(elPosition.left, 10) + parseInt(pagePosition.x, 10),
        y: parseInt(elPosition.top, 10) + parseInt(pagePosition.y, 10)
      };
    }

    function findTarget(location) {
      function jumpToTarget(target) {
        var jumpPosition = getElementPosition(target);

        log(
          'Moving to in page link (#' +
            hash +
            ') at x: ' +
            jumpPosition.x +
            ' y: ' +
            jumpPosition.y
        );
        sendMsg(jumpPosition.y, jumpPosition.x, 'scrollToOffset'); // X&Y reversed at sendMsg uses height/width
      }

      var hash = location.split('#')[1] || location, //Remove # if present
        hashData = decodeURIComponent(hash),
        target =
          document.getElementById(hashData) ||
          document.getElementsByName(hashData)[0];

      if (undefined !== target) {
        jumpToTarget(target);
      } else {
        log(
          'In page link (#' +
            hash +
            ') not found in iFrame, so sending to parent'
        );
        sendMsg(0, 0, 'inPageLink', '#' + hash);
      }
    }

    function checkLocationHash() {
      if ('' !== location.hash && '#' !== location.hash) {
        findTarget(location.href);
      }
    }

    function bindAnchors() {
      function setupLink(el) {
        function linkClicked(e) {
          e.preventDefault();

          /*jshint validthis:true */
          findTarget(this.getAttribute('href'));
        }

        if ('#' !== el.getAttribute('href')) {
          addEventListener(el, 'click', linkClicked);
        }
      }

      Array.prototype.forEach.call(
        document.querySelectorAll('a[href^="#"]'),
        setupLink
      );
    }

    function bindLocationHash() {
      addEventListener(window, 'hashchange', checkLocationHash);
    }

    function initCheck() {
      //check if page loaded with location hash after init resize
      setTimeout(checkLocationHash, eventCancelTimer);
    }

    function enableInPageLinks() {
      /* istanbul ignore else */ // Not testable in phantonJS
      if (Array.prototype.forEach && document.querySelectorAll) {
        log('Setting up location.hash handlers');
        bindAnchors();
        bindLocationHash();
        initCheck();
      } else {
        warn(
          'In page linking not fully supported in this browser! (See README.md for IE8 workaround)'
        );
      }
    }

    if (inPageLinks.enable) {
      enableInPageLinks();
    } else {
      log('In page linking not enabled');
    }

    return {
      findTarget: findTarget
    };
  }

  function setupPublicMethods() {
    log('Enable public methods');

    win.parentIFrame = {
      autoResize: function autoResizeF(resize) {
        if (true === resize && false === autoResize) {
          autoResize = true;
          startEventListeners();
          //sendSize('autoResize','Auto Resize enabled');
        } else if (false === resize && true === autoResize) {
          autoResize = false;
          stopEventListeners();
        }

        return autoResize;
      },

      close: function closeF() {
        sendMsg(0, 0, 'close');
        teardown();
      },

      getId: function getIdF() {
        return myID;
      },

      getPageInfo: function getPageInfoF(callback) {
        if ('function' === typeof callback) {
          pageInfoCallback = callback;
          sendMsg(0, 0, 'pageInfo');
        } else {
          pageInfoCallback = function() {};
          sendMsg(0, 0, 'pageInfoStop');
        }
      },

      moveToAnchor: function moveToAnchorF(hash) {
        inPageLinks.findTarget(hash);
      },

      reset: function resetF() {
        resetIFrame('parentIFrame.reset');
      },

      scrollTo: function scrollToF(x, y) {
        sendMsg(y, x, 'scrollTo'); // X&Y reversed at sendMsg uses height/width
      },

      scrollToOffset: function scrollToF(x, y) {
        sendMsg(y, x, 'scrollToOffset'); // X&Y reversed at sendMsg uses height/width
      },

      sendMessage: function sendMessageF(msg, targetOrigin) {
        sendMsg(0, 0, 'message', JSON.stringify(msg), targetOrigin);
      },

      setHeightCalculationMethod: function setHeightCalculationMethodF(
        heightCalculationMethod
      ) {
        heightCalcMode = heightCalculationMethod;
        checkHeightMode();
      },

      setWidthCalculationMethod: function setWidthCalculationMethodF(
        widthCalculationMethod
      ) {
        widthCalcMode = widthCalculationMethod;
        checkWidthMode();
      },

      setTargetOrigin: function setTargetOriginF(targetOrigin) {
        log('Set targetOrigin: ' + targetOrigin);
        targetOriginDefault = targetOrigin;
      },

      size: function sizeF(customHeight, customWidth) {
        var valString =
          '' +
          (customHeight ? customHeight : '') +
          (customWidth ? ',' + customWidth : '');
        //lockTrigger();
        sendSize(
          'size',
          'parentIFrame.size(' + valString + ')',
          customHeight,
          customWidth
        );
      }
    };
  }

  function initInterval() {
    if (0 !== interval) {
      log('setInterval: ' + interval + 'ms');
      intervalTimer = setInterval(function() {
        sendSize('interval', 'setInterval: ' + interval);
      }, Math.abs(interval));
    }
  } //Not testable in PhantomJS

  /* istanbul ignore next */ function setupBodyMutationObserver() {
    function addImageLoadListners(mutation) {
      function addImageLoadListener(element) {
        if (false === element.complete) {
          log('Attach listeners to ' + element.src);
          element.addEventListener('load', imageLoaded, false);
          element.addEventListener('error', imageError, false);
          elements.push(element);
        }
      }

      if (mutation.type === 'attributes' && mutation.attributeName === 'src') {
        addImageLoadListener(mutation.target);
      } else if (mutation.type === 'childList') {
        Array.prototype.forEach.call(
          mutation.target.querySelectorAll('img'),
          addImageLoadListener
        );
      }
    }

    function removeFromArray(element) {
      elements.splice(elements.indexOf(element), 1);
    }

    function removeImageLoadListener(element) {
      log('Remove listeners from ' + element.src);
      element.removeEventListener('load', imageLoaded, false);
      element.removeEventListener('error', imageError, false);
      removeFromArray(element);
    }

    function imageEventTriggered(event, type, typeDesc) {
      removeImageLoadListener(event.target);
      sendSize(type, typeDesc + ': ' + event.target.src, undefined, undefined);
    }

    function imageLoaded(event) {
      imageEventTriggered(event, 'imageLoad', 'Image loaded');
    }

    function imageError(event) {
      imageEventTriggered(event, 'imageLoadFailed', 'Image load failed');
    }

    function mutationObserved(mutations) {
      sendSize(
        'mutationObserver',
        'mutationObserver: ' + mutations[0].target + ' ' + mutations[0].type
      );

      //Deal with WebKit asyncing image loading when tags are injected into the page
      mutations.forEach(addImageLoadListners);
    }

    function createMutationObserver() {
      var target = document.querySelector('body'),
        config = {
          attributes: true,
          attributeOldValue: false,
          characterData: true,
          characterDataOldValue: false,
          childList: true,
          subtree: true
        };

      observer = new MutationObserver(mutationObserved);

      log('Create body MutationObserver');
      observer.observe(target, config);

      return observer;
    }

    var elements = [],
      MutationObserver =
        window.MutationObserver || window.WebKitMutationObserver,
      observer = createMutationObserver();

    return {
      disconnect: function() {
        if ('disconnect' in observer) {
          log('Disconnect body MutationObserver');
          observer.disconnect();
          elements.forEach(removeImageLoadListener);
        }
      }
    };
  }

  function setupMutationObserver() {
    var forceIntervalTimer = 0 > interval; // Not testable in PhantomJS

    /* istanbul ignore if */ if (
      window.MutationObserver ||
      window.WebKitMutationObserver
    ) {
      if (forceIntervalTimer) {
        initInterval();
      } else {
        bodyObserver = setupBodyMutationObserver();
      }
    } else {
      log('MutationObserver not supported in this browser!');
      initInterval();
    }
  }

  // document.documentElement.offsetHeight is not reliable, so
  // we have to jump through hoops to get a better value.
  function getComputedStyle(prop, el) {
    /* istanbul ignore next */ //Not testable in PhantomJS
    function convertUnitsToPxForIE8(value) {
      var PIXEL = /^\d+(px)?$/i;

      if (PIXEL.test(value)) {
        return parseInt(value, base);
      }

      var style = el.style.left,
        runtimeStyle = el.runtimeStyle.left;

      el.runtimeStyle.left = el.currentStyle.left;
      el.style.left = value || 0;
      value = el.style.pixelLeft;
      el.style.left = style;
      el.runtimeStyle.left = runtimeStyle;

      return value;
    }

    var retVal = 0;
    el = el || document.body; // Not testable in phantonJS

    /* istanbul ignore else */ if (
      'defaultView' in document &&
      'getComputedStyle' in document.defaultView
    ) {
      retVal = document.defaultView.getComputedStyle(el, null);
      retVal = null !== retVal ? retVal[prop] : 0;
    } else {
      //IE8
      retVal = convertUnitsToPxForIE8(el.currentStyle[prop]);
    }

    return parseInt(retVal, base);
  }

  function chkEventThottle(timer) {
    if (timer > throttledTimer / 2) {
      throttledTimer = 2 * timer;
      log('Event throttle increased to ' + throttledTimer + 'ms');
    }
  }

  //Idea from https://github.com/guardian/iframe-messenger
  function getMaxElement(side, elements) {
    var elementsLength = elements.length,
      elVal = 0,
      maxVal = 0,
      Side = capitalizeFirstLetter(side),
      timer = getNow();

    for (var i = 0; i < elementsLength; i++) {
      elVal =
        elements[i].getBoundingClientRect()[side] +
        getComputedStyle('margin' + Side, elements[i]);
      if (elVal > maxVal) {
        maxVal = elVal;
      }
    }

    timer = getNow() - timer;

    log('Parsed ' + elementsLength + ' HTML elements');
    log('Element position calculated in ' + timer + 'ms');

    chkEventThottle(timer);

    return maxVal;
  }

  function getAllMeasurements(dimention) {
    return [
      dimention.bodyOffset(),
      dimention.bodyScroll(),
      dimention.documentElementOffset(),
      dimention.documentElementScroll()
    ];
  }

  function getTaggedElements(side, tag) {
    function noTaggedElementsFound() {
      warn('No tagged elements (' + tag + ') found on page');
      return document.querySelectorAll('body *');
    }

    var elements = document.querySelectorAll('[' + tag + ']');

    if (0 === elements.length) noTaggedElementsFound();

    return getMaxElement(side, elements);
  }

  function getAllElements() {
    return document.querySelectorAll('body *');
  }

  var getHeight = {
      bodyOffset: function getBodyOffsetHeight() {
        return (
          document.body.offsetHeight +
          getComputedStyle('marginTop') +
          getComputedStyle('marginBottom')
        );
      },

      offset: function() {
        return getHeight.bodyOffset(); //Backwards compatability
      },

      bodyScroll: function getBodyScrollHeight() {
        return document.body.scrollHeight;
      },

      custom: function getCustomWidth() {
        return customCalcMethods.height();
      },

      documentElementOffset: function getDEOffsetHeight() {
        return document.documentElement.offsetHeight;
      },

      documentElementScroll: function getDEScrollHeight() {
        return document.documentElement.scrollHeight;
      },

      max: function getMaxHeight() {
        return Math.max.apply(null, getAllMeasurements(getHeight));
      },

      min: function getMinHeight() {
        return Math.min.apply(null, getAllMeasurements(getHeight));
      },

      grow: function growHeight() {
        return getHeight.max(); //Run max without the forced downsizing
      },

      lowestElement: function getBestHeight() {
        return Math.max(
          getHeight.bodyOffset() || getHeight.documentElementOffset(),
          getMaxElement('bottom', getAllElements())
        );
      },

      taggedElement: function getTaggedElementsHeight() {
        return getTaggedElements('bottom', 'data-iframe-height');
      }
    },
    getWidth = {
      bodyScroll: function getBodyScrollWidth() {
        return document.body.scrollWidth;
      },

      bodyOffset: function getBodyOffsetWidth() {
        return document.body.offsetWidth;
      },

      custom: function getCustomWidth() {
        return customCalcMethods.width();
      },

      documentElementScroll: function getDEScrollWidth() {
        return document.documentElement.scrollWidth;
      },

      documentElementOffset: function getDEOffsetWidth() {
        return document.documentElement.offsetWidth;
      },

      scroll: function getMaxWidth() {
        return Math.max(
          getWidth.bodyScroll(),
          getWidth.documentElementScroll()
        );
      },

      max: function getMaxWidth() {
        return Math.max.apply(null, getAllMeasurements(getWidth));
      },

      min: function getMinWidth() {
        return Math.min.apply(null, getAllMeasurements(getWidth));
      },

      rightMostElement: function rightMostElement() {
        return getMaxElement('right', getAllElements());
      },

      taggedElement: function getTaggedElementsWidth() {
        return getTaggedElements('right', 'data-iframe-width');
      }
    };

  function sizeIFrame(
    triggerEvent,
    triggerEventDesc,
    customHeight,
    customWidth
  ) {
    function resizeIFrame() {
      height = currentHeight;
      width = currentWidth;

      sendMsg(height, width, triggerEvent);
    }

    function isSizeChangeDetected() {
      function checkTolarance(a, b) {
        var retVal = Math.abs(a - b) <= tolerance;
        return !retVal;
      }

      currentHeight =
        undefined !== customHeight ? customHeight : getHeight[heightCalcMode]();
      currentWidth =
        undefined !== customWidth ? customWidth : getWidth[widthCalcMode]();

      return (
        checkTolarance(height, currentHeight) ||
        (calculateWidth && checkTolarance(width, currentWidth))
      );
    }

    function isForceResizableEvent() {
      return !(triggerEvent in { init: 1, interval: 1, size: 1 });
    }

    function isForceResizableCalcMode() {
      return (
        heightCalcMode in resetRequiredMethods ||
        (calculateWidth && widthCalcMode in resetRequiredMethods)
      );
    }

    function logIgnored() {
      log('No change in size detected');
    }

    function checkDownSizing() {
      if (isForceResizableEvent() && isForceResizableCalcMode()) {
        resetIFrame(triggerEventDesc);
      } else if (!(triggerEvent in { interval: 1 })) {
        logIgnored();
      }
    }

    var currentHeight, currentWidth;

    if (isSizeChangeDetected() || 'init' === triggerEvent) {
      lockTrigger();
      resizeIFrame();
    } else {
      checkDownSizing();
    }
  }

  var sizeIFrameThrottled = throttle(sizeIFrame);

  function sendSize(triggerEvent, triggerEventDesc, customHeight, customWidth) {
    function recordTrigger() {
      if (!(triggerEvent in { reset: 1, resetPage: 1, init: 1 })) {
        log('Trigger event: ' + triggerEventDesc);
      }
    }

    function isDoubleFiredEvent() {
      return triggerLocked && triggerEvent in doubleEventList;
    }

    if (!isDoubleFiredEvent()) {
      recordTrigger();
      if (triggerEvent === 'init') {
        sizeIFrame(triggerEvent, triggerEventDesc, customHeight, customWidth);
      } else {
        sizeIFrameThrottled(
          triggerEvent,
          triggerEventDesc,
          customHeight,
          customWidth
        );
      }
    } else {
      log('Trigger event cancelled: ' + triggerEvent);
    }
  }

  function lockTrigger() {
    if (!triggerLocked) {
      triggerLocked = true;
      log('Trigger event lock on');
    }
    clearTimeout(triggerLockedTimer);
    triggerLockedTimer = setTimeout(function() {
      triggerLocked = false;
      log('Trigger event lock off');
      log('--');
    }, eventCancelTimer);
  }

  function triggerReset(triggerEvent) {
    height = getHeight[heightCalcMode]();
    width = getWidth[widthCalcMode]();

    sendMsg(height, width, triggerEvent);
  }

  function resetIFrame(triggerEventDesc) {
    var hcm = heightCalcMode;
    heightCalcMode = heightCalcModeDefault;

    log('Reset trigger event: ' + triggerEventDesc);
    lockTrigger();
    triggerReset('reset');

    heightCalcMode = hcm;
  }

  function sendMsg(height, width, triggerEvent, msg, targetOrigin) {
    function setTargetOrigin() {
      if (undefined === targetOrigin) {
        targetOrigin = targetOriginDefault;
      } else {
        log('Message targetOrigin: ' + targetOrigin);
      }
    }

    function sendToParent() {
      var size = height + ':' + width,
        message =
          myID +
          ':' +
          size +
          ':' +
          triggerEvent +
          (undefined !== msg ? ':' + msg : '');

      log('Sending message to host page (' + message + ')');
      target.postMessage(msgID + message, targetOrigin);
    }

    if (true === sendPermit) {
      setTargetOrigin();
      sendToParent();
    }
  }

  function receiver(event) {
    var processRequestFromParent = {
      init: function initFromParent() {
        initMsg = event.data;
        target = event.source;

        init();
        firstRun = false;
        setTimeout(function() {
          initLock = false;
        }, eventCancelTimer);
      },

      reset: function resetFromParent() {
        if (!initLock) {
          log('Page size reset by host page');
          triggerReset('resetPage');
        } else {
          log('Page reset ignored by init');
        }
      },

      resize: function resizeFromParent() {
        sendSize('resizeParent', 'Parent window requested size check');
      },

      moveToAnchor: function moveToAnchorF() {
        inPageLinks.findTarget(getData());
      },
      inPageLink: function inPageLinkF() {
        this.moveToAnchor();
      }, //Backward compatability

      pageInfo: function pageInfoFromParent() {
        var msgBody = getData();
        log('PageInfoFromParent called from parent: ' + msgBody);
        pageInfoCallback(JSON.parse(msgBody));
        log(' --');
      },

      message: function messageFromParent() {
        var msgBody = getData();

        log('MessageCallback called from parent: ' + msgBody);
        messageCallback(JSON.parse(msgBody));
        log(' --');
      }
    };

    function isMessageForUs() {
      return msgID === ('' + event.data).substr(0, msgIdLen); //''+ Protects against non-string messages
    }

    function getMessageType() {
      return event.data.split(']')[1].split(':')[0];
    }

    function getData() {
      return event.data.substr(event.data.indexOf(':') + 1);
    }

    function isMiddleTier() {
      return (
        (!(typeof module !== 'undefined' && module.exports) &&
          'iFrameResize' in window) ||
        ('jQuery' in window && 'iFrameResize' in window.jQuery.prototype)
      );
    }

    function isInitMsg() {
      //Test if this message is from a child below us. This is an ugly test, however, updating
      //the message format would break backwards compatibity.
      return event.data.split(':')[2] in { true: 1, false: 1 };
    }

    function callFromParent() {
      var messageType = getMessageType();

      if (messageType in processRequestFromParent) {
        processRequestFromParent[messageType]();
      } else if (!isMiddleTier() && !isInitMsg()) {
        warn('Unexpected message (' + event.data + ')');
      }
    }

    function processMessage() {
      if (false === firstRun) {
        callFromParent();
      } else if (isInitMsg()) {
        processRequestFromParent.init();
      } else {
        log(
          'Ignored message of type "' +
            getMessageType() +
            '". Received before initialization.'
        );
      }
    }

    if (isMessageForUs()) {
      processMessage();
    }
  }

  //Normally the parent kicks things off when it detects the iFrame has loaded.
  //If this script is async-loaded, then tell parent page to retry init.
  function chkLateLoaded() {
    if ('loading' !== document.readyState) {
      window.parent.postMessage('[iFrameResizerChild]Ready', '*');
    }
  }

  addEventListener(window, 'message', receiver);
  addEventListener(window, 'readystatechange', chkLateLoaded);
  chkLateLoaded();

  
})();


/***/ }),

/***/ "./node_modules/iframe-resizer/js/iframeResizer.js":
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
 * File: iframeResizer.js
 * Desc: Force iframes to size to content.
 * Requires: iframeResizer.contentWindow.js to be loaded into the target frame.
 * Doc: https://github.com/davidjbradshaw/iframe-resizer
 * Author: David J. Bradshaw - dave@bradshaw.net
 * Contributor: Jure Mav - jure.mav@gmail.com
 * Contributor: Reed Dadoune - reed@dadoune.com
 */

(function(undefined) {
  'use strict';

  if (typeof window === 'undefined') return; // don't run for server side render

  var count = 0,
    logEnabled = false,
    hiddenCheckEnabled = false,
    msgHeader = 'message',
    msgHeaderLen = msgHeader.length,
    msgId = '[iFrameSizer]', //Must match iframe msg ID
    msgIdLen = msgId.length,
    pagePosition = null,
    requestAnimationFrame = window.requestAnimationFrame,
    resetRequiredMethods = {
      max: 1,
      scroll: 1,
      bodyScroll: 1,
      documentElementScroll: 1
    },
    settings = {},
    timer = null,
    logId = 'Host Page',
    defaults = {
      autoResize: true,
      bodyBackground: null,
      bodyMargin: null,
      bodyMarginV1: 8,
      bodyPadding: null,
      checkOrigin: true,
      inPageLinks: false,
      enablePublicMethods: true,
      heightCalculationMethod: 'bodyOffset',
      id: 'iFrameResizer',
      interval: 32,
      log: false,
      maxHeight: Infinity,
      maxWidth: Infinity,
      minHeight: 0,
      minWidth: 0,
      resizeFrom: 'parent',
      scrolling: false,
      sizeHeight: true,
      sizeWidth: false,
      warningTimeout: 5000,
      tolerance: 0,
      widthCalculationMethod: 'scroll',
      closedCallback: function() {},
      initCallback: function() {},
      messageCallback: function() {
        warn('MessageCallback function not defined');
      },
      resizedCallback: function() {},
      scrollCallback: function() {
        return true;
      }
    };

  function getMutationObserver() {
    return window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
  }

  function addEventListener(obj, evt, func) {
    /* istanbul ignore else */ // Not testable in PhantonJS
    if ('addEventListener' in window) {
      obj.addEventListener(evt, func, false);
    } else if ('attachEvent' in window) {
      //IE
      obj.attachEvent('on' + evt, func);
    }
  }

  function removeEventListener(el, evt, func) {
    /* istanbul ignore else */ // Not testable in phantonJS
    if ('removeEventListener' in window) {
      el.removeEventListener(evt, func, false);
    } else if ('detachEvent' in window) {
      //IE
      el.detachEvent('on' + evt, func);
    }
  }

  function setupRequestAnimationFrame() {
    var vendors = ['moz', 'webkit', 'o', 'ms'],
      x;

    // Remove vendor prefixing if prefixed and break early if not
    for (x = 0; x < vendors.length && !requestAnimationFrame; x += 1) {
      requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
    }

    if (!requestAnimationFrame) {
      log('setup', 'RequestAnimationFrame not supported');
    }
  }

  function getMyID(iframeId) {
    var retStr = 'Host page: ' + iframeId;

    if (window.top !== window.self) {
      if (window.parentIFrame && window.parentIFrame.getId) {
        retStr = window.parentIFrame.getId() + ': ' + iframeId;
      } else {
        retStr = 'Nested host page: ' + iframeId;
      }
    }

    return retStr;
  }

  function formatLogHeader(iframeId) {
    return msgId + '[' + getMyID(iframeId) + ']';
  }

  function isLogEnabled(iframeId) {
    return settings[iframeId] ? settings[iframeId].log : logEnabled;
  }

  function log(iframeId, msg) {
    output('log', iframeId, msg, isLogEnabled(iframeId));
  }

  function info(iframeId, msg) {
    output('info', iframeId, msg, isLogEnabled(iframeId));
  }

  function warn(iframeId, msg) {
    output('warn', iframeId, msg, true);
  }

  function output(type, iframeId, msg, enabled) {
    if (true === enabled && 'object' === typeof window.console) {
      console[type](formatLogHeader(iframeId), msg);
    }
  }

  function iFrameListener(event) {
    function resizeIFrame() {
      function resize() {
        setSize(messageData);
        setPagePosition(iframeId);
        callback('resizedCallback', messageData);
      }

      ensureInRange('Height');
      ensureInRange('Width');

      syncResize(resize, messageData, 'init');
    }

    function processMsg() {
      var data = msg.substr(msgIdLen).split(':');

      return {
        iframe: settings[data[0]] && settings[data[0]].iframe,
        id: data[0],
        height: data[1],
        width: data[2],
        type: data[3]
      };
    }

    function ensureInRange(Dimension) {
      var max = Number(settings[iframeId]['max' + Dimension]),
        min = Number(settings[iframeId]['min' + Dimension]),
        dimension = Dimension.toLowerCase(),
        size = Number(messageData[dimension]);

      log(
        iframeId,
        'Checking ' + dimension + ' is in range ' + min + '-' + max
      );

      if (size < min) {
        size = min;
        log(iframeId, 'Set ' + dimension + ' to min value');
      }

      if (size > max) {
        size = max;
        log(iframeId, 'Set ' + dimension + ' to max value');
      }

      messageData[dimension] = '' + size;
    }

    function isMessageFromIFrame() {
      function checkAllowedOrigin() {
        function checkList() {
          var i = 0,
            retCode = false;

          log(
            iframeId,
            'Checking connection is from allowed list of origins: ' +
              checkOrigin
          );

          for (; i < checkOrigin.length; i++) {
            if (checkOrigin[i] === origin) {
              retCode = true;
              break;
            }
          }
          return retCode;
        }

        function checkSingle() {
          var remoteHost = settings[iframeId] && settings[iframeId].remoteHost;
          log(iframeId, 'Checking connection is from: ' + remoteHost);
          return origin === remoteHost;
        }

        return checkOrigin.constructor === Array ? checkList() : checkSingle();
      }

      var origin = event.origin,
        checkOrigin = settings[iframeId] && settings[iframeId].checkOrigin;

      if (checkOrigin && '' + origin !== 'null' && !checkAllowedOrigin()) {
        throw new Error(
          'Unexpected message received from: ' +
            origin +
            ' for ' +
            messageData.iframe.id +
            '. Message was: ' +
            event.data +
            '. This error can be disabled by setting the checkOrigin: false option or by providing of array of trusted domains.'
        );
      }

      return true;
    }

    function isMessageForUs() {
      return (
        msgId === ('' + msg).substr(0, msgIdLen) &&
        msg.substr(msgIdLen).split(':')[0] in settings
      ); //''+Protects against non-string msg
    }

    function isMessageFromMetaParent() {
      //Test if this message is from a parent above us. This is an ugly test, however, updating
      //the message format would break backwards compatibity.
      var retCode = messageData.type in { true: 1, false: 1, undefined: 1 };

      if (retCode) {
        log(iframeId, 'Ignoring init message from meta parent page');
      }

      return retCode;
    }

    function getMsgBody(offset) {
      return msg.substr(msg.indexOf(':') + msgHeaderLen + offset);
    }

    function forwardMsgFromIFrame(msgBody) {
      log(
        iframeId,
        'MessageCallback passed: {iframe: ' +
          messageData.iframe.id +
          ', message: ' +
          msgBody +
          '}'
      );
      callback('messageCallback', {
        iframe: messageData.iframe,
        message: JSON.parse(msgBody)
      });
      log(iframeId, '--');
    }

    function getPageInfo() {
      var bodyPosition = document.body.getBoundingClientRect(),
        iFramePosition = messageData.iframe.getBoundingClientRect();

      return JSON.stringify({
        iframeHeight: iFramePosition.height,
        iframeWidth: iFramePosition.width,
        clientHeight: Math.max(
          document.documentElement.clientHeight,
          window.innerHeight || 0
        ),
        clientWidth: Math.max(
          document.documentElement.clientWidth,
          window.innerWidth || 0
        ),
        offsetTop: parseInt(iFramePosition.top - bodyPosition.top, 10),
        offsetLeft: parseInt(iFramePosition.left - bodyPosition.left, 10),
        scrollTop: window.pageYOffset,
        scrollLeft: window.pageXOffset
      });
    }

    function sendPageInfoToIframe(iframe, iframeId) {
      function debouncedTrigger() {
        trigger(
          'Send Page Info',
          'pageInfo:' + getPageInfo(),
          iframe,
          iframeId
        );
      }
      debounceFrameEvents(debouncedTrigger, 32, iframeId);
    }

    function startPageInfoMonitor() {
      function setListener(type, func) {
        function sendPageInfo() {
          if (settings[id]) {
            sendPageInfoToIframe(settings[id].iframe, id);
          } else {
            stop();
          }
        }

        ['scroll', 'resize'].forEach(function(evt) {
          log(id, type + evt + ' listener for sendPageInfo');
          func(window, evt, sendPageInfo);
        });
      }

      function stop() {
        setListener('Remove ', removeEventListener);
      }

      function start() {
        setListener('Add ', addEventListener);
      }

      var id = iframeId; //Create locally scoped copy of iFrame ID

      start();

      if (settings[id]) {
        settings[id].stopPageInfo = stop;
      }
    }

    function stopPageInfoMonitor() {
      if (settings[iframeId] && settings[iframeId].stopPageInfo) {
        settings[iframeId].stopPageInfo();
        delete settings[iframeId].stopPageInfo;
      }
    }

    function checkIFrameExists() {
      var retBool = true;

      if (null === messageData.iframe) {
        warn(iframeId, 'IFrame (' + messageData.id + ') not found');
        retBool = false;
      }
      return retBool;
    }

    function getElementPosition(target) {
      var iFramePosition = target.getBoundingClientRect();

      getPagePosition(iframeId);

      return {
        x: Math.floor(Number(iFramePosition.left) + Number(pagePosition.x)),
        y: Math.floor(Number(iFramePosition.top) + Number(pagePosition.y))
      };
    }

    function scrollRequestFromChild(addOffset) {
      /* istanbul ignore next */ //Not testable in Karma
      function reposition() {
        pagePosition = newPosition;
        scrollTo();
        log(iframeId, '--');
      }

      function calcOffset() {
        return {
          x: Number(messageData.width) + offset.x,
          y: Number(messageData.height) + offset.y
        };
      }

      function scrollParent() {
        if (window.parentIFrame) {
          window.parentIFrame['scrollTo' + (addOffset ? 'Offset' : '')](
            newPosition.x,
            newPosition.y
          );
        } else {
          warn(
            iframeId,
            'Unable to scroll to requested position, window.parentIFrame not found'
          );
        }
      }

      var offset = addOffset
          ? getElementPosition(messageData.iframe)
          : { x: 0, y: 0 },
        newPosition = calcOffset();

      log(
        iframeId,
        'Reposition requested from iFrame (offset x:' +
          offset.x +
          ' y:' +
          offset.y +
          ')'
      );

      if (window.top !== window.self) {
        scrollParent();
      } else {
        reposition();
      }
    }

    function scrollTo() {
      if (false !== callback('scrollCallback', pagePosition)) {
        setPagePosition(iframeId);
      } else {
        unsetPagePosition();
      }
    }

    function findTarget(location) {
      function jumpToTarget() {
        var jumpPosition = getElementPosition(target);

        log(
          iframeId,
          'Moving to in page link (#' +
            hash +
            ') at x: ' +
            jumpPosition.x +
            ' y: ' +
            jumpPosition.y
        );
        pagePosition = {
          x: jumpPosition.x,
          y: jumpPosition.y
        };

        scrollTo();
        log(iframeId, '--');
      }

      function jumpToParent() {
        if (window.parentIFrame) {
          window.parentIFrame.moveToAnchor(hash);
        } else {
          log(
            iframeId,
            'In page link #' +
              hash +
              ' not found and window.parentIFrame not found'
          );
        }
      }

      var hash = location.split('#')[1] || '',
        hashData = decodeURIComponent(hash),
        target =
          document.getElementById(hashData) ||
          document.getElementsByName(hashData)[0];

      if (target) {
        jumpToTarget();
      } else if (window.top !== window.self) {
        jumpToParent();
      } else {
        log(iframeId, 'In page link #' + hash + ' not found');
      }
    }

    function callback(funcName, val) {
      return chkCallback(iframeId, funcName, val);
    }

    function actionMsg() {
      if (settings[iframeId] && settings[iframeId].firstRun) firstRun();

      switch (messageData.type) {
        case 'close':
          if (settings[iframeId].closeRequestCallback)
            chkCallback(
              iframeId,
              'closeRequestCallback',
              settings[iframeId].iframe
            );
          else closeIFrame(messageData.iframe);
          break;
        case 'message':
          forwardMsgFromIFrame(getMsgBody(6));
          break;
        case 'scrollTo':
          scrollRequestFromChild(false);
          break;
        case 'scrollToOffset':
          scrollRequestFromChild(true);
          break;
        case 'pageInfo':
          sendPageInfoToIframe(
            settings[iframeId] && settings[iframeId].iframe,
            iframeId
          );
          startPageInfoMonitor();
          break;
        case 'pageInfoStop':
          stopPageInfoMonitor();
          break;
        case 'inPageLink':
          findTarget(getMsgBody(9));
          break;
        case 'reset':
          resetIFrame(messageData);
          break;
        case 'init':
          resizeIFrame();
          callback('initCallback', messageData.iframe);
          break;
        default:
          resizeIFrame();
      }
    }

    function hasSettings(iframeId) {
      var retBool = true;

      if (!settings[iframeId]) {
        retBool = false;
        warn(
          messageData.type +
            ' No settings for ' +
            iframeId +
            '. Message was: ' +
            msg
        );
      }

      return retBool;
    }

    function iFrameReadyMsgReceived() {
      for (var iframeId in settings) {
        trigger(
          'iFrame requested init',
          createOutgoingMsg(iframeId),
          document.getElementById(iframeId),
          iframeId
        );
      }
    }

    function firstRun() {
      if (settings[iframeId]) {
        settings[iframeId].firstRun = false;
      }
    }

    function clearWarningTimeout() {
      if (settings[iframeId]) {
        clearTimeout(settings[iframeId].msgTimeout);
        settings[iframeId].warningTimeout = 0;
      }
    }

    var msg = event.data,
      messageData = {},
      iframeId = null;

    if ('[iFrameResizerChild]Ready' === msg) {
      iFrameReadyMsgReceived();
    } else if (isMessageForUs()) {
      messageData = processMsg();
      iframeId = logId = messageData.id;
      if (settings[iframeId]) {
        settings[iframeId].loaded = true;
      }

      if (!isMessageFromMetaParent() && hasSettings(iframeId)) {
        log(iframeId, 'Received: ' + msg);

        if (checkIFrameExists() && isMessageFromIFrame()) {
          actionMsg();
        }
      }
    } else {
      info(iframeId, 'Ignored: ' + msg);
    }
  }

  function chkCallback(iframeId, funcName, val) {
    var func = null,
      retVal = null;

    if (settings[iframeId]) {
      func = settings[iframeId][funcName];

      if ('function' === typeof func) {
        retVal = func(val);
      } else {
        throw new TypeError(
          funcName + ' on iFrame[' + iframeId + '] is not a function'
        );
      }
    }

    return retVal;
  }

  function removeIframeListeners(iframe) {
    var iframeId = iframe.id;
    delete settings[iframeId];
  }

  function closeIFrame(iframe) {
    var iframeId = iframe.id;
    log(iframeId, 'Removing iFrame: ' + iframeId);

    try {
      // Catch race condition error with React
      if (iframe.parentNode) {
        iframe.parentNode.removeChild(iframe);
      }
    } catch (e) {}

    chkCallback(iframeId, 'closedCallback', iframeId);
    log(iframeId, '--');
    removeIframeListeners(iframe);
  }

  function getPagePosition(iframeId) {
    if (null === pagePosition) {
      pagePosition = {
        x:
          window.pageXOffset !== undefined
            ? window.pageXOffset
            : document.documentElement.scrollLeft,
        y:
          window.pageYOffset !== undefined
            ? window.pageYOffset
            : document.documentElement.scrollTop
      };
      log(
        iframeId,
        'Get page position: ' + pagePosition.x + ',' + pagePosition.y
      );
    }
  }

  function setPagePosition(iframeId) {
    if (null !== pagePosition) {
      window.scrollTo(pagePosition.x, pagePosition.y);
      log(
        iframeId,
        'Set page position: ' + pagePosition.x + ',' + pagePosition.y
      );
      unsetPagePosition();
    }
  }

  function unsetPagePosition() {
    pagePosition = null;
  }

  function resetIFrame(messageData) {
    function reset() {
      setSize(messageData);
      trigger('reset', 'reset', messageData.iframe, messageData.id);
    }

    log(
      messageData.id,
      'Size reset requested by ' +
        ('init' === messageData.type ? 'host page' : 'iFrame')
    );
    getPagePosition(messageData.id);
    syncResize(reset, messageData, 'reset');
  }

  function setSize(messageData) {
    function setDimension(dimension) {
      if (!messageData.id) {
        log('undefined', 'messageData id not set');
        return;
      }
      messageData.iframe.style[dimension] = messageData[dimension] + 'px';
      log(
        messageData.id,
        'IFrame (' +
          iframeId +
          ') ' +
          dimension +
          ' set to ' +
          messageData[dimension] +
          'px'
      );
    }

    function chkZero(dimension) {
      //FireFox sets dimension of hidden iFrames to zero.
      //So if we detect that set up an event to check for
      //when iFrame becomes visible.

      /* istanbul ignore next */ //Not testable in PhantomJS
      if (!hiddenCheckEnabled && '0' === messageData[dimension]) {
        hiddenCheckEnabled = true;
        log(iframeId, 'Hidden iFrame detected, creating visibility listener');
        fixHiddenIFrames();
      }
    }

    function processDimension(dimension) {
      setDimension(dimension);
      chkZero(dimension);
    }

    var iframeId = messageData.iframe.id;

    if (settings[iframeId]) {
      if (settings[iframeId].sizeHeight) {
        processDimension('height');
      }
      if (settings[iframeId].sizeWidth) {
        processDimension('width');
      }
    }
  }

  function syncResize(func, messageData, doNotSync) {
    /* istanbul ignore if */ //Not testable in PhantomJS
    if (doNotSync !== messageData.type && requestAnimationFrame) {
      log(messageData.id, 'Requesting animation frame');
      requestAnimationFrame(func);
    } else {
      func();
    }
  }

  function trigger(calleeMsg, msg, iframe, id, noResponseWarning) {
    function postMessageToIFrame() {
      var target = settings[id] && settings[id].targetOrigin;
      log(
        id,
        '[' +
          calleeMsg +
          '] Sending msg to iframe[' +
          id +
          '] (' +
          msg +
          ') targetOrigin: ' +
          target
      );
      iframe.contentWindow.postMessage(msgId + msg, target);
    }

    function iFrameNotFound() {
      warn(id, '[' + calleeMsg + '] IFrame(' + id + ') not found');
    }

    function chkAndSend() {
      if (
        iframe &&
        'contentWindow' in iframe &&
        null !== iframe.contentWindow
      ) {
        //Null test for PhantomJS
        postMessageToIFrame();
      } else {
        iFrameNotFound();
      }
    }

    function warnOnNoResponse() {
      function warning() {
        if (settings[id] && !settings[id].loaded && !errorShown) {
          errorShown = true;
          warn(
            id,
            'IFrame has not responded within ' +
              settings[id].warningTimeout / 1000 +
              ' seconds. Check iFrameResizer.contentWindow.js has been loaded in iFrame. This message can be ignored if everything is working, or you can set the warningTimeout option to a higher value or zero to suppress this warning.'
          );
        }
      }

      if (
        !!noResponseWarning &&
        settings[id] &&
        !!settings[id].warningTimeout
      ) {
        settings[id].msgTimeout = setTimeout(
          warning,
          settings[id].warningTimeout
        );
      }
    }

    var errorShown = false;

    id = id || iframe.id;

    if (settings[id]) {
      chkAndSend();
      warnOnNoResponse();
    }
  }

  function createOutgoingMsg(iframeId) {
    return (
      iframeId +
      ':' +
      settings[iframeId].bodyMarginV1 +
      ':' +
      settings[iframeId].sizeWidth +
      ':' +
      settings[iframeId].log +
      ':' +
      settings[iframeId].interval +
      ':' +
      settings[iframeId].enablePublicMethods +
      ':' +
      settings[iframeId].autoResize +
      ':' +
      settings[iframeId].bodyMargin +
      ':' +
      settings[iframeId].heightCalculationMethod +
      ':' +
      settings[iframeId].bodyBackground +
      ':' +
      settings[iframeId].bodyPadding +
      ':' +
      settings[iframeId].tolerance +
      ':' +
      settings[iframeId].inPageLinks +
      ':' +
      settings[iframeId].resizeFrom +
      ':' +
      settings[iframeId].widthCalculationMethod
    );
  }

  function setupIFrame(iframe, options) {
    function setLimits() {
      function addStyle(style) {
        if (
          Infinity !== settings[iframeId][style] &&
          0 !== settings[iframeId][style]
        ) {
          iframe.style[style] = settings[iframeId][style] + 'px';
          log(
            iframeId,
            'Set ' + style + ' = ' + settings[iframeId][style] + 'px'
          );
        }
      }

      function chkMinMax(dimension) {
        if (
          settings[iframeId]['min' + dimension] >
          settings[iframeId]['max' + dimension]
        ) {
          throw new Error(
            'Value for min' +
              dimension +
              ' can not be greater than max' +
              dimension
          );
        }
      }

      chkMinMax('Height');
      chkMinMax('Width');

      addStyle('maxHeight');
      addStyle('minHeight');
      addStyle('maxWidth');
      addStyle('minWidth');
    }

    function newId() {
      var id = (options && options.id) || defaults.id + count++;
      if (null !== document.getElementById(id)) {
        id = id + count++;
      }
      return id;
    }

    function ensureHasId(iframeId) {
      logId = iframeId;
      if ('' === iframeId) {
        iframe.id = iframeId = newId();
        logEnabled = (options || {}).log;
        logId = iframeId;
        log(
          iframeId,
          'Added missing iframe ID: ' + iframeId + ' (' + iframe.src + ')'
        );
      }

      return iframeId;
    }

    function setScrolling() {
      log(
        iframeId,
        'IFrame scrolling ' +
          (settings[iframeId] && settings[iframeId].scrolling
            ? 'enabled'
            : 'disabled') +
          ' for ' +
          iframeId
      );
      iframe.style.overflow =
        false === (settings[iframeId] && settings[iframeId].scrolling)
          ? 'hidden'
          : 'auto';
      switch (settings[iframeId] && settings[iframeId].scrolling) {
        case 'omit':
          break;
        case true:
          iframe.scrolling = 'yes';
          break;
        case false:
          iframe.scrolling = 'no';
          break;
        default:
          iframe.scrolling = settings[iframeId]
            ? settings[iframeId].scrolling
            : 'no';
      }
    }

    //The V1 iFrame script expects an int, where as in V2 expects a CSS
    //string value such as '1px 3em', so if we have an int for V2, set V1=V2
    //and then convert V2 to a string PX value.
    function setupBodyMarginValues() {
      if (
        'number' ===
          typeof (settings[iframeId] && settings[iframeId].bodyMargin) ||
        '0' === (settings[iframeId] && settings[iframeId].bodyMargin)
      ) {
        settings[iframeId].bodyMarginV1 = settings[iframeId].bodyMargin;
        settings[iframeId].bodyMargin =
          '' + settings[iframeId].bodyMargin + 'px';
      }
    }

    function checkReset() {
      // Reduce scope of firstRun to function, because IE8's JS execution
      // context stack is borked and this value gets externally
      // changed midway through running this function!!!
      var firstRun = settings[iframeId] && settings[iframeId].firstRun,
        resetRequertMethod =
          settings[iframeId] &&
          settings[iframeId].heightCalculationMethod in resetRequiredMethods;

      if (!firstRun && resetRequertMethod) {
        resetIFrame({ iframe: iframe, height: 0, width: 0, type: 'init' });
      }
    }

    function setupIFrameObject() {
      if (Function.prototype.bind && settings[iframeId]) {
        //Ignore unpolyfilled IE8.
        settings[iframeId].iframe.iFrameResizer = {
          close: closeIFrame.bind(null, settings[iframeId].iframe),

          removeListeners: removeIframeListeners.bind(
            null,
            settings[iframeId].iframe
          ),

          resize: trigger.bind(
            null,
            'Window resize',
            'resize',
            settings[iframeId].iframe
          ),

          moveToAnchor: function(anchor) {
            trigger(
              'Move to anchor',
              'moveToAnchor:' + anchor,
              settings[iframeId].iframe,
              iframeId
            );
          },

          sendMessage: function(message) {
            message = JSON.stringify(message);
            trigger(
              'Send Message',
              'message:' + message,
              settings[iframeId].iframe,
              iframeId
            );
          }
        };
      }
    }

    //We have to call trigger twice, as we can not be sure if all
    //iframes have completed loading when this code runs. The
    //event listener also catches the page changing in the iFrame.
    function init(msg) {
      function iFrameLoaded() {
        trigger('iFrame.onload', msg, iframe, undefined, true);
        checkReset();
      }

      function createDestroyObserver(MutationObserver) {
        if (!iframe.parentNode) {
          return;
        }

        var destroyObserver = new MutationObserver(function (mutations) {
          mutations.forEach(function (mutation) {
            var removedNodes = Array.prototype.slice.call(mutation.removedNodes); // Transform NodeList into an Array
            removedNodes.forEach(function (removedNode) {
              if (removedNode === iframe) {
                closeIFrame(iframe);
              }
            });
          });
        });
        destroyObserver.observe(iframe.parentNode, {
          childList: true
        });
      }

      var MutationObserver = getMutationObserver();
      if (MutationObserver) {
        createDestroyObserver(MutationObserver);
      }

      addEventListener(iframe, 'load', iFrameLoaded);
      trigger('init', msg, iframe, undefined, true);
    }

    function checkOptions(options) {
      if ('object' !== typeof options) {
        throw new TypeError('Options is not an object');
      }
    }

    function copyOptions(options) {
      for (var option in defaults) {
        if (defaults.hasOwnProperty(option)) {
          settings[iframeId][option] = options.hasOwnProperty(option)
            ? options[option]
            : defaults[option];
        }
      }
    }

    function getTargetOrigin(remoteHost) {
      return '' === remoteHost || 'file://' === remoteHost ? '*' : remoteHost;
    }

    function processOptions(options) {
      options = options || {};
      settings[iframeId] = {
        firstRun: true,
        iframe: iframe,
        remoteHost: iframe.src
          .split('/')
          .slice(0, 3)
          .join('/')
      };

      checkOptions(options);
      copyOptions(options);

      if (settings[iframeId]) {
        settings[iframeId].targetOrigin =
          true === settings[iframeId].checkOrigin
            ? getTargetOrigin(settings[iframeId].remoteHost)
            : '*';
      }
    }

    function beenHere() {
      return iframeId in settings && 'iFrameResizer' in iframe;
    }

    var iframeId = ensureHasId(iframe.id);

    if (!beenHere()) {
      processOptions(options);
      setScrolling();
      setLimits();
      setupBodyMarginValues();
      init(createOutgoingMsg(iframeId));
      setupIFrameObject();
    } else {
      warn(iframeId, 'Ignored iFrame, already setup.');
    }
  }

  function debouce(fn, time) {
    if (null === timer) {
      timer = setTimeout(function() {
        timer = null;
        fn();
      }, time);
    }
  }

  var frameTimer = {};
  function debounceFrameEvents(fn, time, frameId) {
    if (!frameTimer[frameId]) {
      frameTimer[frameId] = setTimeout(function() {
        frameTimer[frameId] = null;
        fn();
      }, time);
    }
  } //Not testable in PhantomJS

  /* istanbul ignore next */ function fixHiddenIFrames() {
    function checkIFrames() {
      function checkIFrame(settingId) {
        function chkDimension(dimension) {
          return (
            '0px' ===
            (settings[settingId] && settings[settingId].iframe.style[dimension])
          );
        }

        function isVisible(el) {
          return null !== el.offsetParent;
        }

        if (
          settings[settingId] &&
          isVisible(settings[settingId].iframe) &&
          (chkDimension('height') || chkDimension('width'))
        ) {
          trigger(
            'Visibility change',
            'resize',
            settings[settingId].iframe,
            settingId
          );
        }
      }

      for (var settingId in settings) {
        checkIFrame(settingId);
      }
    }

    function mutationObserved(mutations) {
      log(
        'window',
        'Mutation observed: ' + mutations[0].target + ' ' + mutations[0].type
      );
      debouce(checkIFrames, 16);
    }

    function createMutationObserver() {
      var target = document.querySelector('body'),
        config = {
          attributes: true,
          attributeOldValue: false,
          characterData: true,
          characterDataOldValue: false,
          childList: true,
          subtree: true
        },
        observer = new MutationObserver(mutationObserved);

      observer.observe(target, config);
    }

    var MutationObserver = getMutationObserver();
    if (MutationObserver) {
      createMutationObserver();
    }
  }

  function resizeIFrames(event) {
    function resize() {
      sendTriggerMsg('Window ' + event, 'resize');
    }

    log('window', 'Trigger event: ' + event);
    debouce(resize, 16);
  } //Not testable in PhantomJS

  /* istanbul ignore next */ function tabVisible() {
    function resize() {
      sendTriggerMsg('Tab Visable', 'resize');
    }

    if ('hidden' !== document.visibilityState) {
      log('document', 'Trigger event: Visiblity change');
      debouce(resize, 16);
    }
  }

  function sendTriggerMsg(eventName, event) {
    function isIFrameResizeEnabled(iframeId) {
      return (
        settings[iframeId] &&
        'parent' === settings[iframeId].resizeFrom &&
        settings[iframeId].autoResize &&
        !settings[iframeId].firstRun
      );
    }

    for (var iframeId in settings) {
      if (isIFrameResizeEnabled(iframeId)) {
        trigger(eventName, event, document.getElementById(iframeId), iframeId);
      }
    }
  }

  function setupEventListeners() {
    addEventListener(window, 'message', iFrameListener);

    addEventListener(window, 'resize', function() {
      resizeIFrames('resize');
    });

    addEventListener(document, 'visibilitychange', tabVisible);
    addEventListener(document, '-webkit-visibilitychange', tabVisible); //Andriod 4.4
    addEventListener(window, 'focusin', function() {
      resizeIFrames('focus');
    }); //IE8-9
    addEventListener(window, 'focus', function() {
      resizeIFrames('focus');
    });
  }

  function factory() {
    function init(options, element) {
      function chkType() {
        if (!element.tagName) {
          throw new TypeError('Object is not a valid DOM element');
        } else if ('IFRAME' !== element.tagName.toUpperCase()) {
          throw new TypeError(
            'Expected <IFRAME> tag, found <' + element.tagName + '>'
          );
        }
      }

      if (element) {
        chkType();
        setupIFrame(element, options);
        iFrames.push(element);
      }
    }

    function warnDeprecatedOptions(options) {
      if (options && options.enablePublicMethods) {
        warn(
          'enablePublicMethods option has been removed, public methods are now always available in the iFrame'
        );
      }
    }

    var iFrames;

    setupRequestAnimationFrame();
    setupEventListeners();

    return function iFrameResizeF(options, target) {
      iFrames = []; //Only return iFrames past in on this call

      warnDeprecatedOptions(options);

      switch (typeof target) {
        case 'undefined':
        case 'string':
          Array.prototype.forEach.call(
            document.querySelectorAll(target || 'iframe'),
            init.bind(undefined, options)
          );
          break;
        case 'object':
          init(options, target);
          break;
        default:
          throw new TypeError('Unexpected data type (' + typeof target + ')');
      }

      return iFrames;
    };
  }

  function createJQueryPublicMethod($) {
    if (!$.fn) {
      info('', 'Unable to bind to jQuery, it is not fully loaded.');
    } else if (!$.fn.iFrameResize) {
      $.fn.iFrameResize = function $iFrameResizeF(options) {
        function init(index, element) {
          setupIFrame(element, options);
        }

        return this.filter('iframe')
          .each(init)
          .end();
      };
    }
  }

  if (window.jQuery) {
    createJQueryPublicMethod(window.jQuery);
  }

  if (true) {
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else if (typeof module === 'object' && typeof module.exports === 'object') {
    //Node for browserfy
    module.exports = factory();
  }
  window.iFrameResize = window.iFrameResize || factory();
})();


/***/ }),

/***/ "./node_modules/iframe-resizer/js/index.js":
/***/ (function(module, exports, __webpack_require__) {

exports.iframeResizer = __webpack_require__("./node_modules/iframe-resizer/js/iframeResizer.js");
exports.iframeResizerContentWindow = __webpack_require__("./node_modules/iframe-resizer/js/iframeResizer.contentWindow.js");


/***/ }),

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
/***/ (function(module, exports, __webpack_require__) {


var smoothScroll = __webpack_require__("./node_modules/smoothScroll/smoothscroll.js");
var simpleslider = __webpack_require__("./node_modules/simple-slider/dist/simpleslider.js");

var _require = __webpack_require__("./node_modules/iframe-resizer/index.js"),
    iframeResizer = _require.iframeResizer;

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
  body.addEventListener('click', function (e) {
    if (!e.target.classList.contains('weekly-screenings--navigation--trigger')) {
      weeklyNavigationMenuTrigger.classList.remove('active');
      weeklyNavigationMenuTarget.classList.remove('visible');
    }
  });
}

/*
** Collapsible key
*/

(function () {
  var screeningsTitle = document.querySelector('.single-listing--screenings--header');
  var keyContent = document.querySelector('.single-listing--screenings--key--content');
  if (screeningsTitle && keyContent) {
    screeningsTitle.innerHTML = screeningsTitle.textContent + '\n      <button class="button button__text button__small" aria-expanded="false">\n        Show key\n      </button>\n    ';
    var btn = screeningsTitle.querySelector('button');
    keyContent.classList.add('accordion-enabled');
    keyContent.hidden = true;

    btn.onclick = function () {
      var expanded = btn.getAttribute('aria-expanded') === 'true' || false;
      btn.setAttribute('aria-expanded', !expanded);
      keyContent.hidden = expanded;
      btn.innerText = btn.innerText == 'show key' ? 'hide key' : 'show key';
      keyContent.scrollIntoView({ behavior: "smooth", block: "center" });
    };
  }
})();

/*
** Select (or preselect) screenings
*/

var screeningTable = document.querySelector('.screenings-table');
var screeningAnnouncer = document.querySelector('.screenings-table--announcer');

if (screeningTable && screeningAnnouncer) {
  var selectScreening = function selectScreening(screeningTime, screeningDate, screeningURL) {
    screeningAnnouncer.innerHTML = '<h3 class="screenings-table--announcer--heading">Selected showtime</h3><p>' + screeningDate + ' at ' + screeningTime + '<a class="button book-button" href="' + screeningURL + '">Book now</a></p>';
    var bookButton = document.querySelector('.book-button');
    bookButton.addEventListener('click', function (e) {
      bookingFormEmbed(e);
    });
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

/*
** TESTING embedding Jack Roe in pages
**/
// @todo: only do this for Jack Roe links. Other booking systems may not work well embedded, e.g. film city

// function bookingFormEmbed(e) {
//   e.preventDefault();
//   var ifrm = document.createElement("iframe");
//    ifrm.setAttribute("src", e.target.getAttribute('href') + '&nodecorators=true&tapos_id=r3b5g0ehmp5aypbnksmmjkyn');
//    ifrm.style.width = "100%";
//    ifrm.setAttribute("id", "jack-roe-box-office");
//    ifrm.setAttribute("frameBorder",0);
//    var screeningsSection = document.querySelector('.single-listing--screenings');
//    screeningsSection.appendChild(ifrm);
//    screeningsSection.classList.add('embed-active');
//    iframeResizer({
//        log:true
//    });}


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
  body.classList.toggle('locked');
});

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
    trailerContainer.classList.toggle('lights-out');
    if (!playing) {
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

/*
** Search
*/

document.addEventListener('DOMContentLoaded', function () {

  searchInput = document.querySelector('.search-input'), searchOutput = document.querySelector('.search-output'), searchButton = document.querySelector('.search-button'), searchContainer = document.querySelector('.search-container'), siteNavigationFooter = document.querySelector('.site-footer--navigation'), searchFooterButton = document.querySelector('.site-footer--navigation--link__search');
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
        if (item.title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(searchValue)) {
          return true;
        } else if (item.alt_language_title && item.alt_language_title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(searchValue)) {
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

/*
** UA sniffing to prevent judder due to navbar movement on iOS
*/

var ua = window.navigator.userAgent;
var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
var webkit = !!ua.match(/WebKit/i);
var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);
var iOSChrome = iOS && webkit && ua.match(/CriOS/i);

if (iOSChrome) {
  document.addEventListener('DOMContentLoaded', function () {
    document.documentElement.classList.add('iOSChrome');
    var homeSlider = document.querySelector('.section--home-slider');
    if (homeSlider) {
      homeSlider.style.height = homeSlider.clientHeight + 'px';
    }
  });
}
if (iOSSafari) {
  document.addEventListener('DOMContentLoaded', function () {
    document.documentElement.classList.add('iOSSafari');
    var homeSlider = document.querySelector('.section--home-slider');
    if (homeSlider) {
      homeSlider.style.height = document.documentElement.clientHeight - navBar.clientHeight + 1 + 'px';
    }
  });
}

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