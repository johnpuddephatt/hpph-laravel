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
    bookButton.addEventListener('click',(e)=>{ bookSelectedScreening(e) });

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

  function bookSelectedScreening(e) {
   if(e.target.href.startsWith('https://tickets.hydeparkpicturehouse.co.uk/')) {
     e.preventDefault();
     cancelSelectedScreening();
     let iframe = document.createElement('iframe');
     iframe.classList.add('spectrix-boxoffice');
     iframe.setAttribute('id','SpektrixIFrame');
     iframe.setAttribute('name','SpektrixIFrame');
     iframe.src = e.target.href;
     iframe.setAttribute('onload', 'setTimeout(function(){ window.scrollTo(0,0);}, 100)');

     let script = document.createElement('script');
     script.src = 'https://tickets.hydeparkpicturehouse.co.uk/hydeparkpicturehouse/website/scripts/integrate.js';

     let sidebar = document.querySelector('.single-listing--sidebar');
     sidebar.classList.add('has-spectrix-open');
     sidebar.classList.add('open');
     sidebar.insertBefore(iframe, sidebar.childNodes[0]);
     sidebar.insertBefore(script, sidebar.childNodes[0]);

   }
  };

}