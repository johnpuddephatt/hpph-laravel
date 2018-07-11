<div class="daily-screenings--content">

  <nav class="daily-screenings--navigation">
    <div class="daily-screenings--navigation--inner">
      @if ($day == 1)
        <span class="daily-screenings--navigation--link current">Today</span>
      @elseif (count($screenings_today))
        <a href="/#daily-screenings" class="daily-screenings--navigation--link">Today</a>
      @endif
      @for ($i = 2; $i < 6; $i++)
        @php $loop_date = date("D j\<\s\u\p\>S\<\/\s\u\p\>",time() + ($i - 1) * 86400) @endphp
        @if($i == $day)
          <span class="daily-screenings--navigation--link current">{!! $loop_date !!}</span>
        @else
          <a class="daily-screenings--navigation--link"  href="/day-{{ $i }}#daily-screenings">{!! $loop_date !!}</a>
        @endif
      @endfor
      <a class="button button__ghost daily-screenings--navigation--view-all" href="/whats-on/">See full listings</a>
    </div>
  </nav>

  <div class="daily-screenings--screenings">
    @if(count($screenings))
      @foreach ($screenings as $screening)
        @if($screening->film)
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
                @include('utils.cloudinary', [
                  'alt' => "Image for " . $screening->film->title,
                  'img' => url($screening->film->thumb),
                  'class' => "fade-image-onload",
                  'height' => "180",
                  'width' => "320",
                  'sizes' => "(min-width: 900px) 30vw, (min-width: 600px) 50vw, 25vw"
                ])
              </div>
            </a>
          @endif
      @endforeach
    @else
      <div class="alert">No screenings currently scheduled for this day.</div>
    @endif
  </div>

</div>