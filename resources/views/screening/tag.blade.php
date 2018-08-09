<span @if($tag->color) style="background-color: {{ $tag->color }}" @endif title="{{ $tag->title }}" class="label label--{{ str_slug($tag->abbreviation) }}
@if($tag->color && (hexdec(substr($tag->color,0,2)) + hexdec(substr($tag->color,2,2)) + hexdec(substr($tag->color,4,2))) < 100 )
 label__dark-bg
@endif
">{{ $tag->abbreviation }}</span>