<nav class="site-footer--navigation">
  <a class="site-footer--navigation--link current" href="#">
    @include('icons.home')
    <div>Home</div>
  </a>
  <a class="site-footer--navigation--link" href="/whats-on/">
    @include('icons.whats-on')
    <div>What’s On</div>
  </a>
  <a class="site-footer--navigation--link" href="/visit/">
    @include('icons.plan-visit')
    <div>visit</div>
  </a>
  <a class="site-footer--navigation--link" href="#" id="nav-trigger">
    @include('icons.more')
    <div>More</div>
  </a>
</nav>


<footer class="site-footer">
  <div class="site-footer--primary">
    <div class="container container__narrow">
      <div class="site-footer--contact">
        <h2 class="site-footer--strapline">Your friendly, local, independent cinema.
        <span>Est.1914</span></h2>
        <ul class="site-footer--contact-info">
          <li>73 Brudenell Rd, Leeds, LS6 1JD</li>
          <li>Tel: <a href="tel:0113 275 2045">0113 275 2045</a></li>
          <li>Email: <a href="mailto:info@hydeparkpicturehouse.co.uk">info@hydeparkpicturehouse.co.uk</a></li>
        </ul>
      </div>
      <div class="site-footer--menu">
        <h2 class="site-footer--header">Learn more</h2>

        <ul class="site-footer--menu-links">
          <li class="site-footer--menu-item"><a class="site-footer--menu-link" href="#">Contact</a></li>
          <li class="site-footer--menu-item"><a class="site-footer--menu-link" href="#">About</a></li>
          <li class="site-footer--menu-item"><a class="site-footer--menu-link" href="#">Privacy policy</a></li>
        </ul>
      </div>
      <div class="site-footer--social">
        <h2 class="site-footer--header">Social</h2>
        @include('social')
      </div>
    </div>
  </div>
  <div class="site-footer--secondary">
    <ul class="container">
      <li class="double">
        <p>Hyde Park Picture House, is part of Leeds Grand Theatre & Opera House Ltd.</p>
        <p>Registered Charity No. 500408</p>
        {{-- <img src="{{url('/images/logos/city-varieties.png')}}" /> --}}
        {{-- <img src="{{url('/images/logos/leeds-grand-theatre.png')}}" /> --}}
      </li>
      <li></li>
      <li><img src="{{url('/images/logos/lottery-fund.png')}}" /></li>
      <li><img src="{{url('/images/logos/leeds-city-council.png')}}" /></li>
      <li><img src="{{url('/images/logos/bfi.png')}}" /></li>
      <li><img src="{{url('/images/logos/garfield-weston.png')}}" /></li>
      <li><img src="{{url('/images/logos/europa-cinemas.png')}}" /></li>
    </ul>
  </div>
</footer>


