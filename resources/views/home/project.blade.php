<section class="section section--home-project">
  <div class="container">
    <div class="section--home-project--text">
      <h2 class="section-title">An exciting new chapter has begun!</h2>
      <p>Thanks to backing from the National Lottery Heritage Lottery Fund, Leeds City Council and our valued Friends and partners, work on The Picture House Project is set to begin early next year.</p>
      <a class="button button__ghost button__black section--home-project--link" href="https://www.thepicturehouseproject.com/">Learn more</a>
    </div>

    <div class="section--home-project--slider">
      <div class="section--home-project--slider--inner">
        @foreach([
          "/images/render-daytime.jpg",
          "/images/home-slider-2.jpg",
          "/images/home-slider-3.jpg"
        ] as $image)
          @include('utils.intervention', [
            'alt' => "",
            'img' => $image,
            'class' => "section--home-project--image",
            'height' => "550",
            'width' => "750",
            'quality' => 90,
            'sizes' => "(min-width: 900px) 50vw, 80vw",
          ])
        @endforeach
      </div>
    </div>
  </div>
</section>

