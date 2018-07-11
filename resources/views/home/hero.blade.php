<section class="section section--home-hero">

  <div class="home-slider--loading container">
    <h2 class="loading-text"><span>Your</span><span>friendly</span><span>local</span><span>independent</span><span>cinema</span></h2>
  </div>
  <div class="section section--home-slider">
    @if(count($slides))
      @foreach ($slides as $slide)
        <div class="home-slider--slide">
          <!-- Use a 16:9 image, 100w when portrait, (16/9%)w when portrait?? -->
          <!-- Check this in practice on iPhone – image size could be big! -->
          <img class="home-slider--image" src="{{ $slide->getThumb() }}" />
          <div class="home-slider--text">
            <div class="container">
              <div class="home-slider--heading">{{ $slide->getHeading() }}</div>
              <div class="home-slider--subheading">Screening from 6th May</div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</section>