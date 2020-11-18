@if($home_pick)
  <section class="section section--home-picks">
    <div class="container">
      <div class="section--home-picks--text">
        <img class="section--home-picks--logo" src="/images/picks-logo.png" />
        <p>Continue discovering brilliant films from home with Hyde Park Picks – friendly movie recommendations from your local indie cinema.</p>
        <a href="/picks/" class="button button__ghost button__black">Learn more</a>
      </div>
      <div class="section--home-picks--image">
        @include('utils.intervention', [
          'alt' => "",
          'img' => $home_pick->image,
          'class' => "",
          'height' => "750",
          'width' => "750",
          'quality' => "68",
          'modes' => 'c_fill,g_center,f_auto'
        ])
        <a href="/picks#{{ str_slug($home_pick->title) }}" class="section--home-picks--button button button__yellow button__big">
          <span class="pre">our latest pick:</span>
          <span class="title">{{ $home_pick->title }}</span>
        </a>
      </div>
    </div>
  </section>
@endif