<section class="section section--home-project">
  <div class="container">
    <div class="section--home-project--text">
      <h2 class="section-title">An exciting new chapter has begun!</h2>
      <p>Thanks to backing from the National Lottery Heritage Lottery, Leeds City Council and our valued Friends and partners, work on The Picture House Project is set to begin early next year.</p>
      <a class="button button__ghost button__black section--home-project--link" href="https://www.thepicturehouseproject.com/">Learn more</a>
    </div>

    <div class="section--home-project--slider">
      <div class="section--home-project--slider--inner">
        @include('utils.intervention', [
          'alt' => "",
          'img' => "/images/render-daytime.jpg",
          'class' => "section--home-project--image",
          'height' => "550",
          'width' => "750",
        ])
        @include('utils.intervention', [
          'alt' => "",
          'img' => "/images/home-slider-2.jpg",
          'class' => "section--home-project--image",
          'height' => "550",
          'width' => "750",
        ])
        @include('utils.intervention', [
          'alt' => "",
          'img' => "/images/home-slider-3.jpg",
          'class' => "section--home-project--image",
          'height' => "550",
          'width' => "750",
        ])
      </div>
    </div>
  </div>
</section>

