<div class="single-listing--venue">
  <h2 class="single-listing--venue--header is-closable">Showing at</h2>
  <p class="single-listing--venue--title">{{$film->venue->title}}</p>

  <details class="single-listing--venue--details">
      <summary>Venue details</summary>

      <h3>Address</h3>
      <p>
        {{$film->venue->address->value}}<br>
        <a href="https://maps.google.com/?q={{ urlencode($film->venue->address->value) }}" target="_blank">View on map</a>
      </p>

      <h3>Access info</h3>
      <p>{{ $film->venue->access_info }}</p>

      <h3>Refreshment info</h3>
      <p>{{ $film->venue->refreshment_info }}</p>

  </details>
</div>