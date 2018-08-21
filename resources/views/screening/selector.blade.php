<table class="screenings-table">
  <tbody>
    @php
      $current_date = '';
      $date_count = 0;
      $tag_array = [];
    @endphp
    @foreach ($film->screenings as $screening)

      @if ($current_date != $screening->date)
      </td>
      </tr>
        {{-- @php $date_count++ @endphp

        @if ( $date_count > 1 )
          </td>
          </tr>
        @endif
        @if ( $date_count == 2 )
          </tbody>
          <tbody class="hidden-rows shown">
        @endif --}}
        <tr>
        <td>{{ Carbon\Carbon::parse($screening->date)->format('D jS F')}}</td><td>
        @php
          $current_date = $screening->date;
        @endphp
      @endif
        <div class="screenings-table--screening">
        <input type="radio" id="screening-{{$screening->id}}" name="screening" data-time="{{ Carbon\Carbon::parse($screening->time)->format('g.ia') }}" data-date="{{ Carbon\Carbon::parse($screening->date)->format('D jS F')}}" data-url="{{$screening->url}}" />

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
        </div>
    @endforeach
  </tbody>

</table>
<div class="screenings-table--announcer"><p class="info"><i>i</i>Select a screening above to purchase tickets</p></div>


@if (count($tag_array) || $film->audio_description)
  @php $tag_array = $tag_array @endphp
  @include('screening.selector-key')
@endif