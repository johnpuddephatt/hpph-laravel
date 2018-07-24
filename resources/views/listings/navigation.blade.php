<nav class="listings-navigation">
  <a href="/whats-on/a-z" class=" @if(isset($films))current @endif">A-Z</a>
  <a href="/whats-on/weekly" class=" @if(isset($screenings))current @endif">Weekly</a>
  @if($type == 'weekly')
    <div class="weekly-screenings--navigation">

        @if($week == 1)
          <button class="weekly-screenings--navigation--trigger button__text">This week</button>
        @else
          <button class="weekly-screenings--navigation--trigger button__text">{{ Carbon\Carbon::parse($week_commencing)->format('D d F') }} &mdash; {{ Carbon\Carbon::parse($week_ending)->format('D d F') }}</button>
        @endif

      <nav class="weekly-screenings--week-picker">
        <a href="/whats-on/weekly/" class="weekly-screenings--week-picker--date @if ($week == 1) current @endif">This week</a>
        @for ($i = 2; $i < 8; $i++)
          <a href="/whats-on/weekly/week-{{ $i }}" class="weekly-screenings--week-picker--date @if ($week == $i) current @endif">
            From {{ date("D d F",time() + (($i - 1) * 7) * 86400) }}
          </a>
        @endfor
      </nav>
    </div>
  @endif
</nav>