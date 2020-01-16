/*
** Slide up screenings on mobile
*/
const screeningsTitle = (document.querySelector('.single-listing--venue--header') || document.querySelector('.single-listing--screenings--header'));
const screeningsContainer = document.querySelector('.single-listing--sidebar');
const screeningsMobileButton = document.querySelector('.single-listing--mobile--screenings');
if(screeningsMobileButton && screeningsTitle) {
  screeningsMobileButton.addEventListener('click', ()=>{
    toggleScreeningsMenu();
  });
  screeningsTitle.addEventListener('click', ()=>{
    toggleScreeningsMenu();
  });
}

function toggleScreeningsMenu() {
  screeningsContainer.classList.toggle('open');
  document.documentElement.classList.toggle('locked');
  document.body.classList.toggle('locked');
}
