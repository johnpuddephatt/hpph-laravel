var simpleslider = require('simple-slider');
let projectSliderImages = document.querySelector('.section--home-project--slider--inner');

let projectSlider = simpleslider.getSlider({
  container: projectSliderImages,
  duration: 1,
  delay: 1.5,
  prop: 'opacity',
  unit: '',
  init: 0,
  show: 1,
  end: 0,
});

projectSlider.pause();


var options = {
  threshold: [0.95],
};

let callback =  function(entries, observer) {
  entries.forEach(entry => {
    if(entry.intersectionRatio >= 0.95) {
      console.log('io');
      projectSlider.resume();
    }
  });
}

let observer = new IntersectionObserver(callback, options);
observer.observe(projectSliderImages);