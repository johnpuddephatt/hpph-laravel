<section class="section section--home-newsletter">
    @include('utils.intervention', [
      'alt' => "",
      'img' => "/storage/thumbnails/5f5f876b144bcd57944a20d53e6bd710.jpg",
      'class' => "section--home-newsletter--image",
      'height' => "250",
      'width' => "750",
      'quality' => "50",
      'modes' => 'c_fill,g_center,f_auto'
    ])
    <div class="container">
    <div class="section--home-newsletter--text">
      {{-- <h2 class="section-title">Never miss a screening</h2>
      <p>Sign up to our weekly listings newsletter to stay on top of our screenings.</p>
      <a class="button button__ghost button__white" href="{{ config('app.mailchimp')}}">Sign up now</a> --}}
      <h2 class="section-title">Response Fund</h2>
      <p>To continue supporting the Picture House during this exceptionally difficult time, please consider donating to our response fund.</p>
      <a class="button button__ghost button__white" href="/donate/">Learn more</a>
    </div>
  </div>
</section>

