<span style="background-color: {{ $tag->color }};
@if((hexdec(substr($tag->color,0,2)) + hexdec(substr($tag->color,2,2)) + hexdec(substr($tag->color,4,2))) < 250 )
 color: #ffffff;
@endif
" title="{{ $tag->title }}" class="label label--{{ str_slug($tag->abbreviation) }}">{{ $tag->abbreviation }}</span>