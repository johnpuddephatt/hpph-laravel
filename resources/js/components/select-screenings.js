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
    screeningAnnouncer.innerHTML = `<div class="screenings-table--announcer--text"><h3 class="screenings-table--announcer--heading">Selected showtime:</h3><p>${screeningDate} at ${screeningTime}</p></div><button class="button button__gray cancel-button">Cancel</button><a class="button button__yellow book-button" href="${screeningURL}">Book »</a>`;
    var bookButton = document.querySelector('.book-button');
    var cancelButton = document.querySelector('.cancel-button');
    cancelButton.addEventListener('click',(e)=>{ cancelSelectedScreening() });
    // bookButton.addEventListener('click',(e)=>{bookingFormEmbed(e)});
    screeningWrapper.classList.add('active');
  }

  function cancelSelectedScreening() {
    screeningWrapper.classList.remove('active');
    screeningTable.querySelector('input:checked').checked = false;
    screeningExplainer.style.visibility = 'visible';

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