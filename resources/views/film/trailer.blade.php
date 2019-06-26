<div class="container single-listing--trailer">
  <div class="single-listing--trailer--iframe"></div>
  @if($film->trailer->provider == 'youtube' || $film->trailer->provider == 'vimeo')
    <button class="button__text trailer-button play" data-provider="{{ $film->trailer->provider}}" data-iframe="{{ $film->trailer->id }}">Watch trailer</button>
  @endif
</div>