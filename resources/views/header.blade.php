<header class="site-header">
  <a href="{{ env('APP_URL') }}" class="site-header--home-link">@include('icons.logo')</a>
  <a class="skip-to-main-content" href="#main">Skip to main content</a>
  @include('navigation')
  @if(empty($film))
    <a class="button site-header--book-button" href="{{env('JACK_ROE')}}">Book now</a>
  @endif

</header>

@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif