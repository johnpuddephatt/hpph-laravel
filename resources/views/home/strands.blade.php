<section class="section section--home-strands">
  <div class="container">
    <div class="section--home-newsletter--text">
      <h2 class="section-title">Discover</h2>
      <div class="strand--grid">

        @foreach ($home_strands as $strand)
          <a class="strand--item" href="/strand/{{ $strand->slug }}">
            @include('utils.intervention', [
              'alt' => "Image for " . $strand->title,
              'img' => isset($strand->thumb)? $strand->thumb : '/images/page-header.jpg',
              'class' => "strand--image",
              'height' => "400",
              'width' => "400",
              'quality' => "50",
              'sizes' => "(min-width: 900px) 22.5vw, (min-width: 600px) 45vw, 100vw"
            ])
            <div class="strand--text">
              <h3 class="strand--title">{{$strand->title}}</h3>
              <p class="strand--description">{{ $strand->short_description }}</p>
            </div>
          </a>
        @endforeach

      </div>
      <h3 class="section-title-secondary sr-only">Specialist Screenings</h3>
      <div class="tag--grid">
        @foreach ($home_tags as $tag)
          <a href="/tag/{{ $tag->slug }}/" class="tag--item">{{ $tag->title }}</a>
        @endforeach
      </div>
    </div>
  </div>
</section>

