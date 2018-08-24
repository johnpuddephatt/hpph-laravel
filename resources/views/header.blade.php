<header class="site-header">
  <div class="container">
    <a href="{{ env('APP_URL') }}" class="site-header--home-link">@include('icons.logo-strapline')</a>
    <a class="skip-to-main-content" href="#main">Skip to main content</a>
    @include('navigation')
    {{-- @if(empty($film))
      <a class="button site-header--book-button" href="{{env('JACK_ROE')}}">Book Tickets</a>
    @endif --}}
  </div>
</header>

@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif