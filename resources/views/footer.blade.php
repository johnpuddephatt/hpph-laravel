<nav class="site-footer--navigation">
  <a class="site-footer--navigation--link @if(strlen($_SERVER['REQUEST_URI']) === 1 ) current @endif" href="/" >
    @include('icons.home')
    <div>Home</div>
  </a>
  <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/whats-on/') === 0) current @endif" href="/whats-on/">
    @include('icons.whats-on')
    <div>What’s On</div>
  </a>
  <a class="site-footer--navigation--link @if (strpos($_SERVER['REQUEST_URI'], '/visit/') === 0) current @endif" href="/visit/">
    @include('icons.plan-visit')
    <div>Visit</div>
  </a>
  <a class="site-footer--navigation--link" href="#" id="nav-trigger">
    @include('icons.more')
    <div>More</div>
  </a>
</nav>

<footer class="site-footer">
  <a href="{{url('/')}}">
    @include('icons.logo-strapline')
  </a>
  <div class="site-footer--primary">
    <div class="container container__narrow">
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
        <h2 class="site-footer--header sr-only">Learn more</h2>
        <ul class="site-footer--menu-links">
          @foreach($footermenu as $page)
            <li class="site-footer--menu-item"><a class="site-footer--menu-link" href="{{ $page->url}}">{{ $page->title }}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="site-footer--social">
        <h2 class="site-footer--header sr-only">Social</h2>
        @include('social')
      </div>
    </div>
  </div>
  <div class="site-footer--secondary">
    <ul class="container">
      <li class="double">
        <p>Hyde Park Picture House is part of Leeds Grand Theatre & Opera House Ltd.</p>
        <p>Registered Charity No.500408</p>
        {{-- <img src="{{url('/images/logos/city-varieties.png')}}" /> --}}
        {{-- <img src="{{url('/images/logos/leeds-grand-theatre.png')}}" /> --}}
      </li>
      <li class="spacer"></li>
      <li>@include('logos.hlf_white')</li>
      <li>@include('logos.leeds-city-council_white')</li>
      <li>@include('logos.BFI_white')</li>
      <li>@include('logos.GWF_white')</li>
      <li class="andahalf">@include('logos.europa-cinemas_white')</li>

    </ul>
  </div>
</footer>


