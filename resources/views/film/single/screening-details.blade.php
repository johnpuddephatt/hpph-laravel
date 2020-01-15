<h2 class="single-listing--screenings--header">Showtimes</h2>

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
    <p>Please check back again soon for details of specific showtimes and to book tickets.</p>

    @if(config('app.mailchimp'))
      <p>Full listings are confirmed every Monday for the week beginning the following Friday. To receive our weekly listings emails, <a href="{{ config('app.mailchimp') }}">sign up here.</a></p>
    @endif
  </div>
@endif