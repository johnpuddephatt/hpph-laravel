<header class="site-header">
  <div class="container">
    <div class="site-header--left">
      <!-- Intentionally empty, used as spacer on mobile -->
    </div>
    <a href="{{ url('/') }}" class="site-header--home-link">
      <span class="sr-only">Hyde Park Picture House</span>
      @include('icons.logo-strapline')
    </a>
    <a class="skip-to-main-content" href="#main">Skip to main content</a>
    @include('navigation')
  </div>
</header>
