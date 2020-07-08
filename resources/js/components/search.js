
/*
** Search
*/

document.addEventListener('DOMContentLoaded',()=>{

  let searchInput = document.querySelector('.search-input'),
  searchOutput = document.querySelector('.search-output'),
  searchButton = document.querySelector('.search-button'),
  searchContainer = document.querySelector('.search-container'),
  siteNavigationFooter = document.querySelector('.site-footer--navigation'),
  searchFooterButton = document.querySelector('.site-footer--navigation--link__search'),
  searchClose = document.querySelector('.search-close');

  if(searchFooterButton) {
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
  }

  if(searchButton) {
    searchButton.addEventListener('click', ()=>{
      openSearch();
    });
  }

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
  if(searchClose) {
    searchClose.addEventListener('click', (e)=> {
      closeSearch();
    });
  }

  if(searchInput) {
    searchInput.addEventListener('keyup',(e)=>{
      if(e.keyCode === 27) {
        closeSearch();
      };
      if(e.target.value) {
        var searchValue = e.target.value.toLowerCase();

        var searchResults = window.searchData.filter(function(item){
          if(item.title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").replace("’", "'").includes(searchValue.replace("’", "'"))) {
            return true;
          }
          else if(item.alt_language_title && item.alt_language_title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").replace("’", "'").includes(searchValue.replace("’", "'"))) {
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
  }

});
