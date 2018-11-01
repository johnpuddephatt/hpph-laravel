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
              'height' => "600",
              'width' => "400",
            ])
            <div class="strand--text">
              <h3 class="strand--title">{{$strand->title}}</h3>
              <p class="strand--description">{{ $strand->short_description }}</p>
            </div>
          </a>
        @endforeach

      </div>
      <h3 class="section-title-secondary">Specialist screenings</h3>
      <div class="tag--grid">
        <a href="/tag/captioned/" class="tag--item">Captioned</a>
        <a href="/tag/audio-description" class="tag--item">Audio described</a>
        <a href="/tag/dementia-friendly" class="tag--item">Dementia friendly</a>
        <a href="/tag/bring-your-own-baby " class="tag--item">Bring your own baby</a>
      </div>
    </div>
  </div>
</section>

