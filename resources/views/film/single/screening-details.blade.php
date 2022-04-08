<div class="single-listing--screenings">
  <h2 class="single-listing--screenings--header @if(!$film->venue)is-closable @endif">Showtimes</h2>

  @if($film->screenings->contains(function($key, $value) { return $key->url; }))
    <p class="screenings-table--explainer">Select a screening below to book tickets</p>
  @endif

  @if (count($film->screenings))
    @include('screening.selector')

  @elseif ($film->screenings_count)
    <div class="alert alert__empty">
      All scheduled screenings have now passed.
    </div>

  @else
    <div class="alert">
      <h3>{{ $film->custom_coming_soon ?? "Showtimes to be confirmed" }}</h3>

      @if($film->venue->id != 13)
        <p>Please check back again soon for details of specific showtimes and to book tickets.</p>
        
      @endif
    </div>
  @endif
</div>