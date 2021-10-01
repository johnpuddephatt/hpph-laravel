@if($home_hydeandseek)
<section class="section section--home-watch">
  <div class="container">
    <div class="section--home-watch--image">
      @include('utils.intervention', [
      'alt' => "",
      'img' => $home_hydeandseek->thumb,
      'class' => "",
      'height' => "750",
      'width' => "750",
      'quality' => "68",
      'modes' => 'c_fill,g_center,f_auto'
      ])
      <a href="/film/{{ $home_hydeandseek->slug }}"
        class="section--home-watch--button button button__yellow button__big">
        <span class="pre">watch:</span>
        <span class="title">{{ $home_hydeandseek->title }}</span>
      </a>
    </div>
    <div class="section--home-watch--text">
      <h2 class="section-title">Hyde and Seek</h2>
      <p>Hyde and Seek screenings are back at the brilliant Heart Centre in Headingley and The Tetley is Leeds City
        Centre. Join us for family-friendly screenings of spellbinding classics, stunning animations and alternative
        gem.</p>
      <a href="/strand/hyde-seek/" class="button button__ghost button__black">Learn more</a>
    </div>
  </div>
</section>
@endif