<a class="film-card" href="/film/{{ $film->slug }}">

  <div class="film-card--image">
    @include('utils.intervention', [ 'alt' => "Image for " . $film->title, 'img' => $film->thumb, 'width' => "480", 'height' => "270", 'quality' => "65", 'sizes' => "(min-width: 900px) 30vw, (min-width: 600px) 50vw, 25vw", 'class' => 'fade-image-onload' ])
  </div>
  <div class="film-card--text">
    <div class="film-card--header">
      <h3 class="film-card--title">
        <span class="film-card--title--inner">{{ $film->title }}</span>
        @if($film->certificate)
          <span class="film-card--certificate">({{ $film->certificate }})</span>
        @endif
      </h3>
      @if(!isset($compact))
        @if($film->venue)<div class="film-card--venue">At {{$film->venue->title}}</div>@endif
        <div class="film-card--subtitle">{{ $film->subtitle }}</div>
      @endif
    </div>
    <div class="film-card--date">
      @if (count($film->screenings)) {{ $film->getDateRange() }}
      @else {{ $film->custom_coming_soon ?? "Showtimes TBC" }}
      @endif
    </div>

    @if(!isset($compact) && $film->short_description)
      <p class="film-card--description">{{ $film->short_description }}</p>
    @endif
  </div>

  @if(!isset($compact))
    <div class="film-card--footer">
      {{-- @foreach($film->strands as $strand)
        @include('labels.strand')
      @endforeach --}}
      @if($film->audio_description)
        @include('labels.audio-description')
      @endif
      @if($film->free)
        <span class="label label--free">Free</span>
      @endif
    </div>
  @endif

</a>