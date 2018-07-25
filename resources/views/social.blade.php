<ul class="header--social">
  @if(env('FACEBOOK_USERNAME'))<li><a title="Facebook" href="//facebook.com/{{ env('FACEBOOK_USERNAME')}}" target="_blank">@include('icons.facebook')</a></li>@endif
  @if(env('INSTAGRAM_USERNAME'))<li><a title="Instagram" href="//instagram.com/{{ env('INSTAGRAM_USERNAME')}}" target="_blank">@include('icons.instagram')</a></li>@endif
  @if(env('TWITTER_USERNAME'))<li><a title="Twitter" href="//twitter.com/{{ env('TWITTER_USERNAME') }}" target="_blank">@include('icons.twitter')</a></li>@endif
  @if(env('FLICKR_USERNAME'))<li><a title="Flickr" href="//flickr.com/photos/{{ env('FLICKR_USERNAME')}}" target="_blank">@include('icons.flickr')</a></li>@endif
</ul>