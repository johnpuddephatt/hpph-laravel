<span style="background-color: {{ $strand->color }}" title="{{ $strand->description }}" class="label label--{{ str_slug($strand->title) }}
  @if((hexdec(substr($strand->color,0,2)) + hexdec(substr($strand->color,2,2)) + hexdec(substr($strand->color,4,2))) < 300 )
   label__dark-bg
  @endif
">{{ $strand->title }}</span>