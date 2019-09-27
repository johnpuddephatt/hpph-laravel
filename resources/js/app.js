
var smoothScroll = require ('smoothScroll');
var simpleslider = require('simple-slider');

let {iframeResizer} = require('iframe-resizer');

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


/*
** Fade selected images on load
*/

var fadeOnloadImage = document.querySelector('.fade-image-onload');
if(fadeOnloadImage) {
  fadeOnloadImage.classList.add('loading')
  fadeOnloadImage.onload = function() {
    fadeOnloadImage.classList.remove('loading');
  }
  var fadeOnloadImageCheck = setTimeout(()=>{
    if(fadeOnloadImage.naturalWidth) {
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


/*
** Collapsible key
*/

// (function() {
//   const screeningsTitle = document.querySelector('.single-listing--screenings--header');
//   const keyContent = document.querySelector('.single-listing--screenings--key--content');
//   if(screeningsTitle && keyContent) {
//     screeningsTitle.innerHTML = `${screeningsTitle.textContent}
//       <button class="button button__text button__small" aria-expanded="false">
//         Show key
//       </button>
//     `
//     let btn = screeningsTitle.querySelector('button')
//     keyContent.classList.add('accordion-enabled')
//     keyContent.hidden = true
//
//     btn.onclick = () => {
//       let expanded = btn.getAttribute('aria-expanded') === 'true' || false
//       btn.setAttribute('aria-expanded', !expanded)
//       keyContent.hidden = expanded
//       btn.innerText = (btn.innerText == 'show key') ? 'hide key' : 'show key';
//       keyContent.scrollIntoView({behavior: "smooth", block: "center"});
//
//     }
//   }
// })()


/*
** Slide up screenings on mobile
*/
const screeningsTitle = document.querySelector('.single-listing--screenings--header');
const screeningsContainer = document.querySelector('.single-listing--screenings');

if(screeningsTitle && screeningsContainer) {
  screeningsTitle.addEventListener('click', ()=>{
    screeningsContainer.classList.toggle('open');
    document.documentElement.classList.toggle('locked');
    body.classList.toggle('locked');
  });
}



/*
** Select (or preselect) screenings
*/

const screeningTable = document.querySelector('.screenings-table');
const screeningAnnouncer = document.querySelector('.screenings-table--announcer');
const screeningExplainer = document.querySelector('.screenings-table--explainer');
const screeningWrapper = document.querySelector('.screenings-table--announcer--wrapper');

if(screeningTable && screeningAnnouncer) {

  function selectScreening(screeningTime,screeningDate,screeningURL) {
    screeningExplainer.style.visibility = 'hidden';
    screeningAnnouncer.innerHTML = `<div class="screenings-table--announcer--text"><h3 class="screenings-table--announcer--heading">Selected showtime:</h3><p>${screeningDate} at ${screeningTime}</p></div><a class="button button__ghost book-button" href="${screeningURL}">Book now »</a>`;
    var bookButton = document.querySelector('.book-button');
    bookButton.addEventListener('click',(e)=>{bookingFormEmbed(e)});
    screeningWrapper.classList.add('active');
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
navTrigger.addEventListener('click',(e)=>{
  e.preventDefault();
  nav.classList.toggle('visible');
  navTrigger.classList.toggle('open');
  navBar.classList.toggle('nav-open');
  document.documentElement.classList.toggle('locked');
  body.classList.toggle('locked');
})


/*
** Trailer on film pages
*/
var trailerContainer = document.querySelector('.single-listing--trailer');
var trailerIframe = document.querySelector('.single-listing--trailer--iframe');
var trailerButton = document.querySelector('.trailer-button');
var vimeoPlayer;
if(trailerButton) {
  var trailerID = trailerButton.dataset.iframe;
  var trailerProvider = trailerButton.dataset.provider;
}
if(trailerID) {
  if(trailerProvider == 'youtube') {
    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    window.onYouTubeIframeAPIReady = function() {

      youtubePlayer = new YT.Player(trailerIframe, {
        height: '390',
        width: '640',
        videoId: trailerID,
        events: {
          'onReady': onPlayerReady,
        }
      });
    }
  }

  if(trailerProvider == 'vimeo') {
    var tag = document.createElement('script');
    tag.src = "//player.vimeo.com/api/player.js";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    tag.addEventListener('load', ()=>{
      vimeoPlayer = new Vimeo.Player(trailerIframe, {
        id: trailerID,
      });
      connectTrailerButton();
      trailerButton.classList.add('loaded');
    });

  }

  if(window.innerHeight > window.innerWidth) {
    trailerIframe.style.width = '100%';
  }
  else {
    trailerIframe.style.width = '75%';
  }
  trailerIframe.style.height = (trailerIframe.clientWidth) * (9/16) + 'px';

}

// 4. The API will call this function when the video player is ready.
window.onPlayerReady = function(event) {
  connectTrailerButton();
  trailerButton.classList.add('loaded');
};

function connectTrailerButton() {
  var playing = false;

  trailerButton.addEventListener('click',()=>{
    var trailerIframe = trailerContainer.querySelector('.single-listing--trailer--iframe');
    trailerContainer.classList.toggle('lights-out');
    if(!playing) {
      if(trailerProvider == 'youtube') {
        youtubePlayer.playVideo();
      }
      if(trailerProvider == 'vimeo') {
        vimeoPlayer.play();
      }
      document.body.classList.add('locked');
      trailerButton.innerText = 'Close trailer';
      trailerButton.blur();
      trailerButton.classList.remove('play');
      playing = true;
    }
    else {
      closeVideo()
    }

  });
}

function closeVideo() {
  document.body.classList.remove('locked');
  if(trailerProvider == 'youtube') {
    youtubePlayer.stopVideo();
  }
  if(trailerProvider == 'vimeo') {
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

document.addEventListener('DOMContentLoaded',()=>{

  searchInput = document.querySelector('.search-input'),
  searchOutput = document.querySelector('.search-output'),
  searchButton = document.querySelector('.search-button'),
  searchContainer = document.querySelector('.search-container'),
  siteNavigationFooter = document.querySelector('.site-footer--navigation'),
  searchFooterButton = document.querySelector('.site-footer--navigation--link__search');
  searchClose = document.querySelector('.search-close');

  searchFooterButton.addEventListener('click', (e)=>{
    if(searchFooterButton.classList.contains('open')) {
      closeSearch()
      searchFooterButton.classList.remove('open');
      siteNavigationFooter.classList.remove('navigation--search-open');
    }
    else {
      openSearch();
      searchFooterButton.classList.add('open');
      siteNavigationFooter.classList.add('navigation--search-open');
    }
  });

  searchButton.addEventListener('click', ()=>{
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

  searchClose.addEventListener('click', (e)=> {
    closeSearch();
  });

  searchInput.addEventListener('keyup',(e)=>{
    if(e.keyCode === 27) {
      closeSearch();
    };
    if(e.target.value) {
      var searchValue = e.target.value.toLowerCase();

      var searchResults = window.searchData.filter(function(item){
        if(item.title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(searchValue)) {
          return true;
        }
        else if(item.alt_language_title && item.alt_language_title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(searchValue)) {
          return true;
        }
        else {
          return false;
        }
      });

      var searchHTML = '';
      if(Object.keys(searchResults).length > 0) {
        for (const key of Object.keys(searchResults)) {
          searchHTML += `
            <li>
              <a href="/film/${ searchResults[key].slug }">
                <div class="search-result--title">${searchResults[key].title}</div>
                <div class="search-result--alt-title">${searchResults[key].alt_language_title ? searchResults[key].alt_language_title : '' }</div>
              </a>
            </li>
          `;
        }
        searchOutput.innerHTML = searchHTML;
      }
      else {
        searchOutput.innerHTML = '<em>No results found.</em>';
      }
    }
    else {
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

// if(iOSChrome) {
//   document.addEventListener('DOMContentLoaded', ()=>{
//     document.documentElement.classList.add('iOSChrome');
//     var homeSlider = document.querySelector('.section--home-slider');
//     if(homeSlider) {
//       homeSlider.style.height = homeSlider.clientHeight + 'px';
//     }
//   });
// }
if(iOSSafari || iOSChrome) {
  document.addEventListener('DOMContentLoaded', ()=>{
    document.documentElement.classList.add('iOSSafari');
    var homeSlider = document.querySelector('.section--home-slider');
    if(homeSlider) {
      homeSlider.style.height = document.documentElement.clientHeight - navBar.clientHeight + 1 + 'px';
    }
  });
}

