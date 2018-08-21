<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('film') . '?futureScreenings=1' }}"><i class="fa fa-film"></i> <span>Films</span></a></li>
<li><a href="{{ backpack_url('slide') }}"><i class="fa fa-youtube-play"></i> <span>Slides</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>

<li><a href='{{ backpack_url('strand') }}'><i class='fa fa-tag'></i> <span>Strands</span></a></li>
<li><a href='{{ backpack_url('season') }}'><i class='fa fa-tag'></i> <span>Seasons</span></a></li>
<li><a href='{{ backpack_url('tag') }}'><i class='fa fa-tag'></i> <span>Tags</span></a></li>
