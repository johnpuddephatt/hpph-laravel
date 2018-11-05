<div class="container single-listing--trailer">
  <div class="single-listing--trailer--iframe"></div>
  @if($film->trailer->provider == 'youtube')
    <button class="trailer-button" data-iframe="{{ $film->trailer->id }}">Play trailer</button>
  @endif
</div>