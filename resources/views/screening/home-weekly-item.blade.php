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