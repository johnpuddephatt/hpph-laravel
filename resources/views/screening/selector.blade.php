<table class="screenings-table">
  <tbody>
    @php
      $current_date = '';
      $date_count = 0;
      $tag_array = [];
      $paidScreeningCount = 0;
    @endphp
    @foreach ($film->screenings as $screening)

      @if ($current_date != $screening->date)
      </td>
      </tr>

        <tr>
        <td>{{ Carbon\Carbon::parse($screening->date)->format('D jS F')}}</td><td>
        @php
          $current_date = $screening->date;
        @endphp
      @endif
        <div class="screenings-table--screening">
          @if ($screening->getUrl() )
            <input type="radio" id="screening-{{$screening->id}}" name="screening" data-time="{{ Carbon\Carbon::parse($screening->time)->format('g.ia') }}" data-date="{{ Carbon\Carbon::parse($screening->date)->format('D jS F')}}" data-url="{{$screening->getUrl()}}" />
            @php $paidScreeningCount++ @endphp
          @endif

          <label for="screening-{{$screening->id}}">
            {{ Carbon\Carbon::parse($screening->time)->format('g.ia') }}
          </label>
          @foreach ($screening->tags as $tag)
              @include ('screening.tag')
              @php array_push($tag_array,$tag) @endphp
          @endforeach
          @if($film->audio_description)
            @include('film.audio-description')
          @endif
          @if($film->free)
            <span class="label">Free</span>
          @endif
        </div>
    @endforeach
  </tbody>
</table>

@if($paidScreeningCount)
  <div class="screenings-table--announcer"><p class="info"><i>i</i>Select a screening above to purchase tickets</p></div>
@endif


@if (count($tag_array) || $film->audio_description)
  @php $tag_array = $tag_array @endphp
  @include('screening.selector-key')
@endif