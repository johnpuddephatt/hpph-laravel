<a class="weekly-screenings--entry" href="/film/{{ $screening->film->slug }}?screeningID={{$screening->id}}">
  <div class="weekly-screenings--entry--date" >
    <time datetime="{{ Carbon\Carbon::parse($screening->date)->format('Y-m-d') }}T{{ Carbon\Carbon::parse($screening->time)->format('H:i') }}">
      @if($show_date ?? false)<span class="day">{!! Carbon\Carbon::parse($screening->date)->format('D jS\<\b\r\> F') !!}</span>@endif
      <span class="time">{{ Carbon\Carbon::parse($screening->time)->format('g.iA') }}</span>
    </time>
  </div>
  <div class="weekly-screenings--entry--text">
    <h3 class="weekly-screenings--entry--title">
      <span class="weekly-screenings--entry--title-inner">{{ $screening->film->title }}</span>
      @if($screening->film->certificate)
        <span class="weekly-screenings--entry--certificate">({{ $screening->film->certificate }})</span>
      @endif
    </h3>
    @if($screening->film->venue)<div class="weekly-screenings--entry--venue">{{$screening->film->venue->title}}</div>@endif
    @if($screening->film->subtitle)<div class="weekly-screenings--entry--subtitle">{{ $screening->film->subtitle }}</div>@endif
    <div class="weekly-screenings--entry--description">{{ $screening->film->short_description }}</div>
    <div class="weekly-screenings--entry--footer">
      {{-- @foreach($screening->film->strands as $strand)
        @include ('labels.strand')
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
  <div class="weekly-screenings--entry--image">
    @include('utils.intervention', [
      'alt' => "Image for " . $screening->film->title,
      'img' => $screening->film->thumb,
      'width' => "320",
      'quality' => "65",
      'height' => "180",
      'sizes' => "25vw",
      'class' => 'fade-image-onload'
    ])
  </div>
</a>