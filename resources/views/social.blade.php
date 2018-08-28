<ul class="header--social">
  @if(env('FACEBOOK_USERNAME'))<li><a title="Facebook" href="//facebook.com/{{ env('FACEBOOK_USERNAME')}}" target="_blank">@include('icons.facebook') <span>Facebook</span></a></li>@endif
  @if(env('INSTAGRAM_USERNAME'))<li><a title="Instagram" href="//instagram.com/{{ env('INSTAGRAM_USERNAME')}}" target="_blank">@include('icons.instagram')  <span>Instagram</span></a></li>@endif
  @if(env('TWITTER_USERNAME'))<li><a title="Twitter" href="//twitter.com/{{ env('TWITTER_USERNAME') }}" target="_blank">@include('icons.twitter')  <span>Twitter</span></a></li>@endif
  @if(env('FLICKR_USERNAME'))<li><a title="Flickr" href="//flickr.com/photos/{{ env('FLICKR_USERNAME')}}" target="_blank">@include('icons.flickr')  <span>Flickr</span></a></li>@endif
</ul>