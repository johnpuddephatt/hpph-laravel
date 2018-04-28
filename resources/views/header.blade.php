<header class="site-header">
  <a href="{{ env('APP_URL') }}" class="site-header--home-link">@include('icons.logo')</a>
  @include('social')
  @if(empty($film))
    <a class="button site-header--book-button" href="{{env('JACK_ROE')}}">Book now</a>
  @endif

</header>

@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif