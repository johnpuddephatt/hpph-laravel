<ul class="header--social">
  @if(config('app.facebook'))<li><a title="Facebook" href="//facebook.com/{{ config('app.facebook') }}" target="_blank">@include('icons.facebook') <span>Facebook</span></a></li>@endif
  @if(config('app.instagram'))<li><a title="Instagram" href="//instagram.com/{{ config('app.instagram') }}" target="_blank">@include('icons.instagram')  <span>Instagram</span></a></li>@endif
  @if(config('app.twitter'))<li><a title="Twitter" href="//twitter.com/{{ config('app.twitter') }}" target="_blank">@include('icons.twitter')  <span>Twitter</span></a></li>@endif
  @if(config('app.flickr'))<li><a title="Flickr" href="//flickr.com/photos/{{ config('app.flickr') }}" target="_blank">@include('icons.flickr')  <span>Flickr</span></a></li>@endif
</ul>