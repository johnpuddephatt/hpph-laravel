@if($home_online)
  <section class="section section--home-watch">
    <div class="container">
      <div class="section--home-watch--image">
        @include('utils.intervention', [
          'alt' => "",
          'img' => $home_online->thumb,
          'class' => "",
          'height' => "750",
          'width' => "750",
          'quality' => "68",
          'modes' => 'c_fill,g_center,f_auto'
        ])
        <a href="/film/{{ $home_online->slug }}" class="section--home-watch--button button button__yellow button__big">
          <span class="pre">watch:</span>
          <span class="title">{{ $home_online->title }}</span>
        </a>
      </div>
      <div class="section--home-watch--text">
        <h2 class="section-title">Watch online</h2>
        <p>From dazzling new dramas to award-winning docs, we’re proud to be supporting a number of exciting new film releases – all available to enjoy online.</p>
        <a href="/strand/watch-online/" class="button button__ghost button__black">Learn more</a>
      </div>
    </div>
  </section>
@endif