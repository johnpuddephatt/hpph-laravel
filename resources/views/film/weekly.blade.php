@extends('layouts.app')

@section('content')

  <section class="section section--az-listings">

    <h2 class="section-title">What’s On</h2>
    @include('film.navigation', ['type' => 'weekly'])

    <div class="weekly-screenings--content">

      <div class="weekly-screenings--screenings container">
        @if( isset($screenings_today) && count($screenings_today))
          <h2 class="weekly-screenings--date">Today</h2>
          <div class="weekly-screenings--entries">
            @foreach ($screenings_today as $screening)
              @include('screening.weekly-item')
            @endforeach
          </div>
        @endif
        @if(count($screenings))
          @php $current_date = '' @endphp
          @foreach ($screenings as $screening)
            @if($screening->film)
              @if ($current_date != $screening->date)
                @if(!$loop->first)
                  </div>
                @endif
                <h2 class="weekly-screenings--date">{{ Carbon\Carbon::parse($screening->date)->format('D jS F') }}</h2>
                @php $current_date = $screening->date @endphp
                <div class="weekly-screenings--entries">
              @endif
              @include('screening.weekly-item')
            @endif
          @endforeach
          </div>
        @if ($week > 1)
          <div class="alert">
            Full listings are confirmed every Monday for the week beginning the following Friday. To receive weekly listings as soon as they're confirmed, <a href="http://eepurl.com/yHJXT" target="_blank">sign up here.</a>
          </div>
        @endif
        @else
          <div class="alert">No screenings currently scheduled for this week.</div>
        @endif


    </div>
    @include('film.navigation-footer')

</section>
@stop