<nav class="weekly-screenings--footer-navigation container">

  <div class="weekly-screenings--footer-navigation--inner ">
    @if($week == 1)
      <span class="weekly-screenings--footer-navigation--arrow disabled"><i>&lsaquo;</i>Previous week</span>
    @else
      <a class="weekly-screenings--footer-navigation--arrow" href="/whats-on/weekly/week-{{$week - 1}}"><i>&lsaquo;</i>Previous week</a>
    @endif
    @if($week == 8)
      <span class="weekly-screenings--footer-navigation--arrow disabled">Next week<i>&rsaquo;</i></span>
    @else
      <a class="weekly-screenings--footer-navigation--arrow" href="/whats-on/weekly/week-{{$week + 1}}">Next week<i>&rsaquo;</i></a>
    @endif
  </div>
</nav>