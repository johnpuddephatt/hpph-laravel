@extends('layouts.app')

@section('content')

  <section class="section section--az-listings">
    <div class="container">
      <h2 class="section-title">What’s On</h2>
      @include('listings.navigation')

<div class="weekly-screenings--content">

  <nav class="weekly-screenings--navigation">
    <div class="weekly-screenings--navigation--inner">
      @if($week == 1)
        <span class="weekly-screenings--navigation--arrow disabled">&laquo;</span>
        <span class="weekly-screenings--navigation--date">Showing this week</span>
      @else
        <a class="weekly-screenings--navigation--arrow" href="/whats-on/weekly/week-{{$week - 1}}">&laquo;</a>
        <span class="weekly-screenings--navigation--date">{{ Carbon\Carbon::parse($week_commencing)->format('D d F') }} &mdash; {{ Carbon\Carbon::parse($week_ending)->format('D d F') }}</span>
      @endif
      @if($week == 8)
        <span class="weekly-screenings--navigation--arrow disabled">&raquo;</span>
      @else
        <a class="weekly-screenings--navigation--arrow" href="/whats-on/weekly/week-{{$week + 1}}">&raquo;</a>
      @endif
    </div>
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
            <h2 class="weekly-screenings--date">{{ Carbon\Carbon::parse($screening->date)->format('D d F') }}</h2>
            @php $current_date = $screening->date @endphp
            <div class="weekly-screenings--entries">
          @endif
          <a class="daily-screenings--entry" href="/film/{{ $screening->film->slug }}" data-barba="slide">
            <div class="daily-screenings--entry--date">{{ Carbon\Carbon::parse($screening->time)->format('g.iA') }}</div>
            <div class="daily-screenings--entry--text">
              <h3 class="daily-screenings--entry--title">
                <span class="daily-screenings--entry--title-inner">{{ $screening->film->title }}</span>
                @if($screening->film->certificate)
                  <span class="daily-screenings--entry--certificate">{{ $screening->film->certificate }}</span>
                @endif
              </h3>
              <div class="daily-screenings--entry--description">{{ $screening->film->short_description }}</div>

              @if($screening->labels)
                <span class="daily-screenings--entry--labels">
                  @foreach ($screening->labels() as $label)
                    @include ('screening.label')
                  @endforeach
                </span>
              @endif
            </div>
            <div class="daily-screenings--entry--image">
              <img alt="Image for {{ $screening->film->title }}" src="{{ url($screening->film->thumb) }}" />
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
</div>
</section>
@stop