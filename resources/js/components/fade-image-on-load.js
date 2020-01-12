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