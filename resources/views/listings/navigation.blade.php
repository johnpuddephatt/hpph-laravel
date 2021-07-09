<nav class="listings-navigation container">
  <div class="listings-navigation--inner">
    <a href="/whats-on/weekly" class=" @if(isset($screenings))current @endif">By date</a>
    <a href="/whats-on/a-z" class=" @if(isset($films))current @endif">By film (A&ndash;Z)</a>
    <a href="/strand/watch-online">Watch online</a>

    @if($type == 'weekly')
    <div class="weekly-screenings--navigation">
      @if($week == 1)
      <button class="weekly-screenings--navigation--trigger button button__ghost">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        This week</button>
      @else
      <button class="weekly-screenings--navigation--trigger button button__ghost">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ Carbon\Carbon::parse($week_commencing)->format('D jS M') }} &ndash;
        {{ Carbon\Carbon::parse($week_ending)->format('D jS M') }}</button>
      @endif

      <nav class="weekly-screenings--week-picker">
        <a href="/whats-on/weekly/" class="weekly-screenings--week-picker--date @if ($week == 1) current @endif">This
          week</a>
        @for ($i = 2; $i < 8; $i++) <a href="/whats-on/weekly/week-{{ $i }}"
          class="weekly-screenings--week-picker--date @if ($week == $i) current @endif">
          From {{ date("D jS F",time() + (($i - 1) * 7) * 86400) }}
          </a>
          @endfor
      </nav>
    </div>
    @else
    <div class="weekly-screenings--navigation">
      @if($venue == null)
      <button class="weekly-screenings--navigation--trigger button button__ghost">
        All locations</button>
      @else
      <button class="weekly-screenings--navigation--trigger button button__ghost">
        {{ $venue->title }}
      </button>
      @endif

      <nav class="weekly-screenings--week-picker">
        @foreach(App\Models\Venue::all() as $current_venue)
        <a class="weekly-screenings--week-picker--date" href="/whats-on/a-z">
          All locations
        </a>
        <a href="/whats-on/{{ $current_venue->slug }}"
          class="weekly-screenings--week-picker--date @if ($venue && $venue->id == $current_venue->id) current @endif">
          {{ $current_venue->title }}
        </a>
        @endforeach
      </nav>
    </div>
    @endif
  </div>
</nav>