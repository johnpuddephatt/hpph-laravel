<a class="weekly-screenings--entry" href="/film/{{ $screening->film->slug }}?screeningID={{$screening->id}}">
  <div class="weekly-screenings--entry--date">{{ Carbon\Carbon::parse($screening->time)->format('g.iA') }}</div>
  <div class="weekly-screenings--entry--text">
    <h3 class="weekly-screenings--entry--title">
      <span class="weekly-screenings--entry--title-inner">{{ $screening->film->title }}</span>
      @if($screening->film->certificate)
        <span class="weekly-screenings--entry--certificate">({{ $screening->film->certificate }})</span>
      @endif
    </h3>
    @if($screening->film->subtitle)<div class="weekly-screenings--entry--subtitle">{{ $screening->film->subtitle }}</div>@endif
    <div class="weekly-screenings--entry--description">{{ $screening->film->short_description }}</div>
    <div class="weekly-screenings--entry--footer">
      @foreach($screening->film->strands()->get() as $strand)
        @include ('film.strand')
      @endforeach
      @if($screening->film->audio_description)
        @include('film.audio-description')
      @endif
      @if($screening->tags)
        @foreach ($screening->tags as $tag)
          @include ('screening.tag')
        @endforeach
      @endif
      @if($screening->film->free)
        <span class="label label--free">Free</span>
      @endif
    </div>
  </div>
  <div class="weekly-screenings--entry--image">
    @include('utils.cloudinary', [
      'alt' => "Image for" . $screening->film->title,
      'img' => url($screening->film->thumb),
      'class' => "fade-image-onload",
      'width' => "320",
      'height' => "180",
      'sizes' => "25vw"
    ])
  </div>
</a>