<span style="background-color: {{ $season->color }}" title="{{ $season->short_description }}" class="label label--{{ $season->slug }}
  @if((hexdec(substr($season->color,0,2)) + hexdec(substr($season->color,2,2)) + hexdec(substr($season->color,4,2))) < 300 )
   label__dark-bg
  @endif
">{{ $season->title }}</span>