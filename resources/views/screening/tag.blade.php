<span style="background-color: {{ $tag->color }}" title="{{ $tag->title }}" class="label label--{{ str_slug($tag->abbreviation) }}
@if((hexdec(substr($tag->color,0,2)) + hexdec(substr($tag->color,2,2)) + hexdec(substr($tag->color,4,2))) < 100 )
 label__dark-bg
@endif
">{{ $tag->abbreviation }}</span>