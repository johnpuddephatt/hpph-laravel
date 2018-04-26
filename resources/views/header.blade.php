<header class="site-header">
  <a href="{{ url('/') }}" class="site-header--home-link">@include('icons.logo')</a>
  @include('social')
  <a class="button site-header--book-button" href="{{env('JACK_ROE')}}">Book now</a>

</header>

@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif