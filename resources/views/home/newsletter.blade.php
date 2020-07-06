<section class="section section--home-newsletter">
    @include('utils.intervention', [
      'alt' => "",
      'img' => "/storage/thumbnails/5f5f876b144bcd57944a20d53e6bd710.jpg",
      'class' => "section--home-newsletter--image",
      'height' => "750",
      'width' => "750",
      'quality' => "65",
      'modes' => 'c_fill,g_center,f_auto'
    ])
    <div class="container">
    <div class="section--home-newsletter--text">
      {{-- <h2 class="section-title">Never miss a screening</h2>
      <p>Sign up to our weekly listings newsletter to stay on top of our screenings.</p>
      <a class="button button__ghost button__white" href="{{ config('app.mailchimp')}}">Sign up now</a> --}}
      <h2 class="section-title">Support us</h2>
      <p>Continue supporting the cinema through this difficult period by donating to our Response Fund. Or by purchasing merchandise, virtual tickets or vouchers to use at a later date.</p>
      <a class="button button__ghost button__white" href="/support/">Learn more</a>
    </div>
  </div>
</section>

