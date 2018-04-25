<div class="listings--content">
  <h1 class="listings--title">Film schedule</h1>
  @php $current_date = '' @endphp
  @foreach ($screenings as $screening)
    @if ($current_date != $screening->date)
      <h2 class="listings--date">{{ Carbon\Carbon::parse($screening->date)->format('l d M')}}</h2>
      @php $current_date = $screening->date @endphp
    @endif
    <div class="listings--entries">
      <a class="listings--entry" href="/film/{{ $screening->film->slug }}" data-barba="slide">
      <span class="listings--entry--date">{{ Carbon\Carbon::parse($screening->time)->format('h.iA') }}:</span>
      <span class="listings--entry--title">{{ $screening->film->title }}</span>
      @if($screening->film->certificate)
        <span class="listings--entry--certificate">({{ $screening->film->certificate }})</span>
      @endif
      @foreach ($screening->labels() as $label)
        @include ('screening.label')
      @endforeach
      </a>
    </div>
  @endforeach
</div>