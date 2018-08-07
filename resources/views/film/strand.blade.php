<span style="background-color: {{ $strand->color }};
@if((hexdec(substr($strand->color,0,2)) + hexdec(substr($strand->color,2,2)) + hexdec(substr($strand->color,4,2))) < 250 )
 color: #ffffff;
@endif
" title="{{ $strand->description }}" class="label label--{{ str_slug($strand->title) }}">{{ $strand->title }}</span>