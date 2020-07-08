@if($film->venue)
  <div class="single-listing--venue">
    <h2 class="single-listing--venue--header is-closable">Showing at</h2>
    <p class="single-listing--venue--title">{{$film->venue->title}}</p>

    @if($film->venue->address || $film->venue->access_info || $film->venue->refreshment_info || $film->venue->parking_info)

      <details class="single-listing--venue--details">
          <summary>Venue details</summary>
          @if($film->venue->address)
            <h3>Address</h3>
            <p>
              {{$film->venue->address->value}}<br>
              <a href="https://maps.google.com/?q={{ urlencode($film->venue->address->value) }}" target="_blank">View on map</a>
            </p>
          @endif

          @if($film->venue->access_info)
            <h3>Access info</h3>
            <p>{!! $film->venue->access_info !!}</p>
          @endif

          @if($film->venue->refreshment_info)
            <h3>Refreshment info</h3>
            <p>{!! $film->venue->refreshment_info !!}</p>
          @endif

          @if($film->venue->parking_info)
            <h3>Parking info</h3>
            <p>{!! $film->venue->parking_info !!}</p>
          @endif

      </details>
    @endif
  </div>
@endif