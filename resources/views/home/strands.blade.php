<section class="section section--home-strands">
  <div class="container container__narrow">
    <div class="section--home-newsletter--text">
      <h2 class="section-title">Discover</h2>
      <div class="strand--grid">

        @foreach ($strands as $strand)
          <a class="strand--item" href="/strand/{{ $strand->slug }}">
            @include('utils.cloudinary', [
              'alt' => "Image for " . $strand->title,
              'img' => isset($strand->thumb)? url($strand->thumb) : '/images/page-header.jpg',
              'class' => "strand--image",
              'height' => "400",
              'width' => "400",
              'sizes' => "(min-width: 900px) 22.5vw, (min-width: 600px) 45vw, 100vw"
            ])
            <div class="strand--text">
              <h3 class="strand--title">{{$strand->title}}</h3>
              <p class="strand--description">{{ $strand->short_description }}</p>
            </div>
          </a>
        @endforeach

      </div>
      <h3 class="section-title-secondary">Specialist Screenings</h3>
      <div class="tag--grid">
        <a href="/tag/captioned/" class="tag--item">Captioned</a>
        <a href="/tag/audio-description" class="tag--item">Audio described</a>
        <a href="/tag/dementia-friendly" class="tag--item">Dementia friendly</a>
        <a href="/tag/bring-your-own-baby " class="tag--item">Bring your own baby</a>
      </div>
    </div>
  </div>
</section>

