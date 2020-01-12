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
    if(trailerButton.classList.contains('play')) {
      trailerContainer.classList.add('lights-out');
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
  trailerContainer.classList.remove('lights-out');
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
