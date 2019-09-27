<table class="screenings-table">
  <tbody>
    @php
      $current_date = '';
      $tag_array = [];
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
          @endif

          <label for="screening-{{$screening->id}}">
            {{ Carbon\Carbon::parse($screening->time)->format('g.ia') }}
          </label>
          @foreach ($screening->tags as $tag)
              @include ('labels.tag', ['is_link' => true])
              @php array_push($tag_array,$tag) @endphp
          @endforeach
          @if($film->audio_description)
            @include('labels.audio-description', ['is_link' => true])
          @endif
          @if($film->free)
            <span class="label label--free">Free</span>
          @endif
        </div>
    @endforeach
  </tbody>
</table>


@if (count($tag_array) || $film->audio_description)
  @php $tag_array = $tag_array @endphp
  @include('screening.selector-key')
@endif