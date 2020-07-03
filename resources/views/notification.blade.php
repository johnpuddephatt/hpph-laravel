<div class="notification">
  <div class="container">
    {{ env('SITE_NOTIFICATION') }}@if(env('SITE_NOTIFICATION_URL'))<a href="{{ env('SITE_NOTIFICATION_URL') }}">Learn more</a>@endif
  </div>
</div>