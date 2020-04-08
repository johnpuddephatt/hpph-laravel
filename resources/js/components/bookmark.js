let bookmark = document.querySelector('.bookmark');
let header = document.querySelector('.site-header');

if(bookmark) {
  document.addEventListener('DOMContentLoaded', () => {
    bookmark.classList.add('active');
    let observer = new IntersectionObserver(callback, options);
    observer.observe(header);
  })
  let callback = function (entries) {
    entries.forEach(entry => {
      if(entry.intersectionRatio <= options.threshold) {
        bookmark.classList.add('compact');
      }
      else {
        bookmark.classList.remove('compact');
      }
    });
  };

  let options = {
    rootMargin: '0px 0px',
    threshold: 0.25,
  }
}