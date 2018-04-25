<header class="site-header">
  <a href="{{ url('/') }}" data-barba="unslide">@include('icons.logo')</a>
  @include('social')
</header>

@if(env('SITE_NOTIFICATION'))
  @include('notification')
@endif