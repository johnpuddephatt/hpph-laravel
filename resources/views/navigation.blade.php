<ul class="site-header--navigation">
  <li><a href="/whats-on">What’s on</a></li>
  <li><a href="/support/">Support us</a></li>
  <li><a href="/news/">News</a></li>
  <li><a href="/on_the_road">On the road</a></li>
  {{-- <li><a href="https://leedsheritagetheatres.bigcartel.com/category/hyde-park-picture-house">Shop</a></li> --}}
  <li><button class="button button__text search-button">@include('icons.search')Search</button></li>

  {{-- <li><a href="/strand/watch-online">Watch online</a></li> --}}
  {{-- <li><a href="/strand/digital-releases">What’s on</a></li> --}}
  {{-- <li><a href="/membership/">Membership</a></li> --}}
  {{-- <li><a href="/visit">Visit</a></li> --}}
</ul>

<ul class="site-header--right">
  {{-- <li class="pull-right"><button class="button button__text search-button">@include('icons.search')Search</button>
  </li> --}}
  {{-- Also uncomment scripts in header... --}}
  @include('basket')
</ul>