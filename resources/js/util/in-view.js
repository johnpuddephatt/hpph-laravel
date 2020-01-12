/**
 * Use intersection observer to detect when an element is in view
 */
export default (elem,threshold,rootMargin,parentCallback) => {

  if(!(elem instanceof Element || elem instanceof HTMLDocument)) {
    elem = document.querySelectorAll(elem);
  }

  if(!elem) return;

  let callback = function (entries) {
    entries.forEach(entry => {
      if(entry.intersectionRatio >= options.threshold) {
        if(parentCallback) {
          parentCallback();
        }
        else {
          entry.target.classList.add('in-view');
        }
      }
    });
  };

  let options = {
    rootMargin: rootMargin || '0px 0px',
    threshold: threshold,
  }

  let observer = new IntersectionObserver(callback, options);
  if(elem.length) {
    elem.forEach(elem => {
      observer.observe(elem);
    });
  } else {
    observer.observe(elem);
  }
}
