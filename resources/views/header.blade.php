@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif

<header class="site-header">
  <div class="container">
    <a href="{{ url('/') }}" class="site-header--home-link">
      <span class="sr-only">Hyde Park Picture House</span>
      @include('icons.logo-strapline')
    </a>
    <a class="skip-to-main-content" href="#main">Skip to main content</a>
    @include('navigation')
  </div>
</header>