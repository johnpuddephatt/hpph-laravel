@extends('layouts.app')

@section('content')

  <section class="section section--az-listings">
    <div class="container">
      <h2 class="section-title">What’s On</h2>
      @include('listings.navigation', ['type' => 'weekly'])

    <div class="weekly-screenings--content">

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
              <a class="weekly-screenings--entry" href="/film/{{ $screening->film->slug }}" data-barba="slide">
                <div class="weekly-screenings--entry--date">{{ Carbon\Carbon::parse($screening->time)->format('g.iA') }}</div>
                <div class="weekly-screenings--entry--text">
                  <h3 class="weekly-screenings--entry--title">
                    <span class="weekly-screenings--entry--title-inner">{{ $screening->film->title }}</span>
                    @if($screening->film->certificate)
                      <span class="weekly-screenings--entry--certificate">({{ $screening->film->certificate }})</span>
                    @endif
                  </h3>
                  <div class="weekly-screenings--entry--description">{{ $screening->film->short_description }}</div>

                  @if($screening->labels)
                    <span class="weekly-screenings--entry--labels">
                      @foreach ($screening->labels() as $label)
                        @include ('screening.label')
                      @endforeach
                    </span>
                  @endif
                </div>
                <div class="weekly-screenings--entry--image">
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
    @include('listings.navigation-footer')

  </div>
</section>
@stop