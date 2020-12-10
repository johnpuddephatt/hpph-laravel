<div class="search-container">

  <div class="search-inner">

    <label for="searchInput" class="sr-only">Search this website for:</label>
    <input id="searchInput" class="search-input" type="text" placeholder="Search for a film title...">
    <div class="search-output-container">
      <div class="search-output"></div>
    </div>
    <button class="search-close">Close</button>
  </div>
</div>

<script>
  window.searchData = {!! $searchData !!}
</script>