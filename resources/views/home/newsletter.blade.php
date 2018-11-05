<section class="section section--home-newsletter">
    @include('utils.cloudinary', [
      'alt' => "",
      'img' => "/images/home-newsletter.jpg",
      'class' => "section--home-newsletter--image",
      'height' => "250",
      'width' => "750",
    ])
    <div class="container container__narrow">
    <div class="section--home-newsletter--text">
      <h2 class="section-title">Never miss a screening</h2>
      <p>Sign up to our weekly listings newsletter to stay on top of our screenings.</p>
      <a class="button button__ghost button__white" href="{{ config('app.mailchimp')}}">Sign up now</a>
    </div>
  </div>
</section>
