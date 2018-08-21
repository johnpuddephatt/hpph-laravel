<span @if($tag->color) style="background-color: {{ $tag->color }}" @endif title="{{ $tag->title }}" class="label label--{{ str_slug($tag->abbreviation) }}
@if($tag->color && (hexdec(substr($tag->color,1,2)) + hexdec(substr($tag->color,3,2)) + hexdec(substr($tag->color,5,2))) < 300 )
 label__dark-bg
@endif
">{{ $tag->abbreviation }}</span>