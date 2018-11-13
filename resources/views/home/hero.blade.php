@if(count($slides))
  <script>document.getElementsByTagName("BODY")[0].classList.add('slider-loading');</script>
  <section class="section section--home-hero">
    {{-- <div class="home-slider--loading container">
      <h2 class="loading-text"><span>Your</span><span>friendly</span><span>local</span><span>independent</span><span>cinema</span></h2>
    </div> --}}
    <div class="section section--home-slider">

        @foreach ($slides as $slide)
          <div class="home-slider--slide">
            <!-- Use a 16:9 image, 100w when portrait, (16/9%)w when portrait?? -->
            <!-- Check this in practice on iPhone – image size could be big! -->
            @include('utils.intervention', [
              'alt' => "Image for " . $slide->getHeading(),
              'img' => $slide->getThumb(),
              'class' => "home-slider--image",
              'height' => "720",
              'width' => "1280",
              'quality' => "85",
              'sizes' => "(orientation: portrait) 220vw, 100vw",
            ])
            <div class="home-slider--text">
              <div class="container">
                <a class="home-slider--link" href="{{ url($slide->getUrl())}}">
                  @if($slide->pretitle)<div class="home-slider--preheading">{{ $slide->pretitle }}</div>@endif
                  <h2 class="home-slider--heading"><span>{{ $slide->getHeading() }}</span></h2>
                  <div class="home-slider--subheading">{{ $slide->getSubheading()}}</div>
                </a>
              </div>
            </div>
          </div>
        @endforeach
    </div>
    <a href="#daily-screenings" tabindex="-1" class="section--home-hero--jump">»</a>
  </section>
@endif