<div class="container single-listing--trailer">
  <div class="single-listing--trailer--iframe"></div>
  @if($film->trailer->provider == 'youtube')
    <button class="button__text trailer-button play" data-iframe="{{ $film->trailer->id }}">Watch trailer</button>
  @endif
</div>