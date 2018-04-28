<div class="weekly-screenings--content">
  <div class="weekly-screenings--header">
    <h1 class="weekly-screenings--title">Your friendly, local, independent <span>cinema <span>Est.<span>1914</span></span></span></h1>
  </div>

  <nav class="weekly-screenings--navigation">
    @if($week == 1)
      <span class="weekly-screenings--navigation--arrow disabled">&laquo;</span>
      <span class="weekly-screenings--navigation--date">Showing this week</span>
    @else
      <a class="weekly-screenings--navigation--arrow" href="/week-{{$week - 1}}">&laquo;</a>
      <span class="weekly-screenings--navigation--date">{{ Carbon\Carbon::parse($week_commencing)->format('D d F') }} &mdash; {{ Carbon\Carbon::parse($week_ending)->format('D d F') }}</span>
    @endif
    @if($week == 8)
      <span class="weekly-screenings--navigation--arrow disabled">&raquo;</span>
    @else
      <a class="weekly-screenings--navigation--arrow" href="/week-{{$week + 1}}">&raquo;</a>
    @endif
  </nav>

  <div class="weekly-screenings--screenings">
    @if(count($screenings))
      @php $current_date = '' @endphp
      @foreach ($screenings as $screening)
        @if($screening->film)
          @if ($current_date != $screening->date)
            @if(!$loop->first)
              </div>
            @endif
            <h2 class="weekly-screenings--date">{{ Carbon\Carbon::parse($screening->date)->format('D d F')}}</h2>
            @php $current_date = $screening->date @endphp
            <div class="weekly-screenings--entries">
          @endif
            <a class="weekly-screenings--entry" href="/film/{{ $screening->film->slug }}" data-barba="slide">
              <div class="weekly-screenings--entry--date">{{ Carbon\Carbon::parse($screening->time)->format('h.iA') }}:</div>
              <div class="weekly-screenings--entry--title">
                {{ $screening->film->title }}
                @if($screening->film->certificate)
                  <span class="weekly-screenings--entry--certificate">({{ $screening->film->certificate }})</span>
                @endif
                @if($screening->labels)
                  <span class="weekly-screenings--entry--labels">
                    @foreach ($screening->labels() as $label)
                      @include ('screening.label')
                    @endforeach
                  </span>
                @endif
              </div>
            </a>
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