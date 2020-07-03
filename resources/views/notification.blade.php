<div class="notification">
  <div class="container">
    {{ env('SITE_NOTIFICATION') }}@if(env('SITE_NOTIFICATION_URL'))<a class="button button__gray button__small" href="{{ env('SITE_NOTIFICATION_URL') }}">Learn more</a>@endif
  </div>
</div>