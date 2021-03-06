<section class="section section--home-listings" id="daily-screenings">
  <div class="container">
    <h2 class="section-title">Now Showing</h2>
    <div class="daily-screenings--content">

      <nav class="daily-screenings--navigation">
        <div class="daily-screenings--navigation--inner">
          @if ($day == 1)
            <span class="daily-screenings--navigation--link current">Today</span>
          @elseif (count($screenings_today))
            <a href="/#daily-screenings" class="daily-screenings--navigation--link">Today</a>
          @endif
          @for ($i = 2; $i < 6; $i++)

            @php $loop_date = date("D jS",$today + ($i - 1) * 86400) @endphp
            @if($i == $day)
              <span class="daily-screenings--navigation--link current">{!! $loop_date !!}</span>
            @else
              <a class="daily-screenings--navigation--link"  href="/day-{{ $i }}#daily-screenings">{!! $loop_date !!}</a>
            @endif
          @endfor
          <a class="button button__ghost daily-screenings--navigation--view-all" href="/whats-on">View all</a>
        </div>
      </nav>

      <div class="daily-screenings--screenings">
        @if(count($screenings))
          @foreach ($screenings as $screening)
            @if($screening->film)
                <a class="daily-screenings--entry" href="/film/{{ $screening->film->slug }}?screeningID={{$screening->id}}" data-barba="slide">
                  <div class="daily-screenings--entry--date" >
                  <time datetime="{{ Carbon\Carbon::parse($screening->date)->format('Y-m-d') }}T{{ Carbon\Carbon::parse($screening->time)->format('H:i') }}">{{ Carbon\Carbon::parse($screening->time)->format('g.ia') }}</time>
                    @if(is_numeric($screening->film->runtime))
                      <div class="daily-screenings--entry--finish-time">Finish {{ Carbon\Carbon::parse($screening->time)->addMinutes($screening->film->runtime + (is_numeric($screening->film->trailer_duration) ? $screening->film->trailer_duration : 23))->format('g.ia') }}</div>
                    @endif
                  </div>
                  <div class="daily-screenings--entry--text">
                    <h3 class="daily-screenings--entry--title">
                      <span class="daily-screenings--entry--title-inner">{{ $screening->film->title }}</span>
                      @if($screening->film->certificate)
                        <span class="daily-screenings--entry--certificate">({{ $screening->film->certificate }})</span>
                      @endif
                    </h3>
                    @if($screening->film->venue)<div class="daily-screenings--entry--venue">{{$screening->film->venue->title}}</div>@endif
                    <div class="daily-screenings--entry--description">{{ $screening->film->short_description }}</div>

                    <div class="daily-screenings--entry--footer">
                      {{-- @foreach($screening->film->strands as $strand)
                        @include('labels.strand')
                      @endforeach --}}
                      @if($screening->film->audio_description)
                        @include('labels.audio-description')
                      @endif
                      @if($screening->tags)
                        @foreach ($screening->tags as $tag)
                          @include ('labels.tag')
                        @endforeach
                      @endif
                      @if($screening->film->free)
                        <span class="label label--free">Free</span>
                      @endif
                    </div>
                  </div>
                  <div class="daily-screenings--entry--image">
                    @include('utils.intervention', [
                      'alt' => "Image for " . $screening->film->title,
                      'img' => $screening->film->thumb,
                      'height' => "180",
                      'width' => "320",
                      'sizes' => "(min-width: 900px) 30vw, (min-width: 600px) 50vw, 25vw"
                    ])
                  </div>
                </a>
              @endif
          @endforeach
        @else
          <div class="alert alert__empty">No screenings currently scheduled for this day.</div>
        @endif
      </div>

    </div>
  </div>
</section>
