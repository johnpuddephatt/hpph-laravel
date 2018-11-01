<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="treeview">
  <a href="#"><i class="fa fa-calendar"></i> <span>Programme</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
  <ul class="treeview-menu">
    <li><a href="{{ backpack_url('film') . '?futureScreenings=1' }}"><i class="fa fa-film"></i> <span>Films</span></a></li>
    <li><a href="{{ backpack_url('strand') }}"><i class='fa fa-key'></i> <span>Strands</span></a></li>
    <li><a href="{{ backpack_url('season') }}"><i class='fa fa-clock-o'></i> <span>Seasons</span></a></li>
    <li><a href="{{ backpack_url('tag') }}"><i class='fa fa-tag'></i> <span>Tags</span></a></li>
  </ul>
</li>

<li><a href="{{ backpack_url('slide') }}"><i class="fa fa-youtube-play"></i> <span>Homepage slides</span></a></li>

<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/menu') }}"><i class="fa fa-bars"></i> <span>Menus</span></a></li>

<li class="divider"></li>
<li><a href='{{ url(config(' backpack.base.route_prefix ', 'admin').'/backup ') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a></li>
