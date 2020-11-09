<section class="section section--az-listings" id="daily-screenings">

  <h2 class="section-title">On the Road</h2>
  <p class="section-subtitle">Our On the Road programme is a year of exciting film screenings and live events, held across Leeds.</p>

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
      @else
        <div class="alert alert__empty">No screenings currently scheduled for this week.</div>
      @endif
  </div>
</section>
