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
                <img alt="Image for {{ $screening->film->title }}" src="{{ url($screening->film->thumb) }}" />
              </div>
              {{-- <img alt="Image for {{ $screening->film->title }}" src="//res.cloudinary.com/letsdance/image/fetch/w_720,f_auto,g_faces,q_85,c_fill/{{ url($screening->film->thumb) }}"
               srcset="
                 //res.cloudinary.com/letsdance/image/fetch/w_100,f_auto,g_faces,q_85,c_fill/{{ url($screening->film->thumb) }} 100w,
                 //res.cloudinary.com/letsdance/image/fetch/w_180,f_auto,g_faces,q_85,c_fill/{{ url($screening->film->thumb) }} 180w,
                 //res.cloudinary.com/letsdance/image/fetch/w_300,f_auto,g_faces,q_85,c_fill/{{ url($screening->film->thumb) }} 300w,
               "
               sizes="25vw"
               class="fade-image-onload"
              /> --}}
            </a>
          @endif
      @endforeach
    @else
      <div class="alert">No screenings currently scheduled for this day.</div>
    @endif
  </div>

</div>