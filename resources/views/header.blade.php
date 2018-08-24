<header class="site-header">
  <div class="container">
    <a href="{{ env('APP_URL') }}" class="site-header--home-link">@include('icons.logo-strapline')</a>
    <a class="skip-to-main-content" href="#main">Skip to main content</a>
    @include('navigation')
  </div>
</header>

@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif