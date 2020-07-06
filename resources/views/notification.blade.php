<div class="notification">
  <div class="container">
    {{ env('SITE_NOTIFICATION') }}@if(env('SITE_NOTIFICATION_URL'))<a href="{{ env('SITE_NOTIFICATION_URL') }}">{{ env('SITE_NOTIFICATION_BUTTON', 'Read more') }}</a>@endif
  </div>
</div>