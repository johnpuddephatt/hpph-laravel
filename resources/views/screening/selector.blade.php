<table>
  <tbody class="initial-rows">
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
        <td>{{ Carbon\Carbon::parse($screening->date)->format('D j F')}}</td><td>
        @php $current_date = $screening->date @endphp
      @endif
        <a
          @if($screening->url && is_numeric($screening->url)) href="http://www.jack-roe.co.uk/websales/sales/hydlee/actual_book?perfcode={{ $screening->url }}"
          @elseif($screening->url) href="{{ $screening->url }}" @endif
          class="listings--screenings--book button button__ghost button__small">{{ Carbon\Carbon::parse($screening->time)->format('h.iA') }}
          @foreach ($screening->tags as $tag)
              @include ('screening.tag')
              @php
              if(!in_array($tag, $tag_array, true)){
                array_push($tag_array,$tag);
              }
              @endphp

          @endforeach
        </a>
    @endforeach
  </tbody>
</table>

@if (count($tag_array))
  @include('screening.selector-key')
@endif