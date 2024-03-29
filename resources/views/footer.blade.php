<nav class="site-footer--navigation">
  <a class="site-footer--navigation--link @if(strlen($_SERVER['REQUEST_URI']) === 1 ) current @endif" href="/">
    @include('icons.home')
    <div>Home</div>
  </a>
  <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/whats-on/') === 0) current @endif"
    href="/whats-on/">
    @include('icons.whats-on')
    <div>What’s On</div>
  </a>
  <button class="site-footer--navigation--link site-footer--navigation--link__search">
    @include('icons.search')
    <div>Search</div>
  </button>
  <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/support/') === 0) current @endif"
    href="/support/">
    @include('icons.plan-visit')
    <div>Support</div>
  </a>
  <a class="site-footer--navigation--link" href="#" id="nav-trigger">
    @include('icons.more')
    <div>More</div>
  </a>

  {{-- <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/news/') === 0) current @endif"
    href="/news/">
    @include('icons.news')
    <div>News</div>
  </a> --}}
  {{-- <a
    class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/strand/digital-releases') === 0) current @endif"
    href="/strand/digital-releases/">
    @include('icons.whats-on')
    <div>Digital releases On</div>
  </a> --}}
  {{-- <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/visit/') === 0) current @endif"
    href="/visit/">
    @include('icons.plan-visit')
    <div>Visit</div>
  </a> --}}
  {{-- <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/picks/') === 0) current @endif"
    href="/picks/">
    @include('icons.search')
    <div>Picks</div>
  </a> --}}
</nav>

<footer class="site-footer">
  <a href="{{url('/')}}">
    <span class="sr-only">Your friendly, local, independent cinema</span>
    @include('icons.logo-strapline')
  </a>
  <div class="site-footer--primary">
    <div class="container">
      <div class="site-footer--contact">
        <div class="site-footer--strapline">
          <img alt="Your friendly, local, independent cinema" src="/images/friendly-local-independent.svg" />
        </div>
        <ul class="site-footer--contact-info">
          <li>73 Brudenell Rd, Leeds, LS6 1JD</li>
          <li>Tel: <a href="tel:01132752045">0113 275 2045</a></li>
          <li>Email: <a href="mailto:info@hydeparkpicturehouse.co.uk">info@hydeparkpicturehouse.co.uk</a></li>
        </ul>
      </div>
      <div class="site-footer--menu">
        <h2 class="site-footer--header">Learn more</h2>

        <ul class="site-footer--menu-links">
          <li class="site-footer--menu-item hide-on-desktop"><a class="site-footer--menu-link" href="/news/">News</a>
          </li>
          <li class="site-footer--menu-item hide-on-desktop"><a class="site-footer--menu-link"
              href="https://leedsheritagetheatres.bigcartel.com/category/hyde-park-picture-house">Shop</a></li>

          @if(isset($footermenu))
          @foreach($footermenu as $page)
          <li class="site-footer--menu-item"><a class="site-footer--menu-link" href="{{ url($page->slug) }}">{{
              $page->title }}</a></li>
          @endforeach
          @endif
        </ul>

      </div>
      <div class="site-footer--social">
        <h2 class="sr-only" class="site-footer--header">Social</h2>
        @include('social')
      </div>
    </div>
  </div>
  <div class="site-footer--secondary">
    <ul class="container">
      <li class="double">
        <p>Hyde Park Picture House is part of <a target="_blank" href="https://leedsheritagetheatres.com/">Leeds
            Heritage Theatres</a></p>
        <p>Registered Charity No.500408</p>
        {{-- <img src="{{url('/images/logos/city-varieties.png')}}" /> --}}
        {{-- <img src="{{url('/images/logos/leeds-grand-theatre.png')}}" /> --}}
      </li>
      <li class="spacer"></li>
      <li>@include('logos.LHT')</li>
      <li>@include('logos.hlf_white')</li>
      <li>@include('logos.leeds-city-council_white')</li>
      <li>@include('logos.bfi_white')</li>
      {{-- <li>@include('logos.GWF_white')</li> --}}
      <li class="andahalf">@include('logos.europa-cinemas_white')</li>
      <li class="andahalf">@include('logos.fundraising_regulator')</li>
    </ul>
  </div>
</footer>