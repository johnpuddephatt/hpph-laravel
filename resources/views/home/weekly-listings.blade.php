@if(count($screenings_today) or count($screenings))

  <section class="section section--home--listings section--az-listings" id="daily-screenings">
    @include('icons.on-the-road')
    <h2 class="section-title">On the Road</h2>
    <div class="weekly-screenings--content">

      <div class="weekly-screenings--screenings daily-screenings--screenings container">
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
              @include('screening.home-weekly-item')
            @endif
          @endforeach
          </div>
        @endif
        <div class="more-screenings">
          <a class="button button__ghost button__black" href="{{ route('screenings.weekly')}}">See the full programme</a>
        </div>
    </div>
  </section>
@endif