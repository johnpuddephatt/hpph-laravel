
@if(count($home_slides))

  <script>document.getElementsByTagName("BODY")[0].classList.add('slider-loading');</script>
  <section class="section section--home-hero @if(env('SITE_NOTIFICATION')) section--home-hero__with-notification @endif">

    <div class="section section--home-slider">

        @foreach ($home_slides as $slide)
          <div class="home-slider--slide">

            @include('utils.intervention', [
              'alt' => "Image for " . $slide->title,
              'img' => $slide->related_thumb ? $slide->related_thumb : $slide->thumb,
              'class' => "home-slider--image",
              'height' => "720",
              'width' => "1280",
              'quality' => "70",
              'sizes' => "(orientation: portrait) 220vw, 100vw",
            ])
            <div class="home-slider--text">

              <div class="container">
                <a class="home-slider--link" href="{{ url($slide->url) }}">
                  @if($slide->pretitle)<div class="home-slider--preheading">{{ $slide->pretitle }}</div>@endif
                  <h2 class="home-slider--heading"><span>{{ $slide->heading }}</span></h2>
                  <div class="home-slider--subheading">{{ $slide->subheading }}</div>
                </a>
              </div>
            </div>
          </div>
        @endforeach
    </div>
    <a href="#daily-screenings" tabindex="-1" class="section--home-hero--jump">»</a>
  </section>
@endif