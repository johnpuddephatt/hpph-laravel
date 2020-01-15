@if($is_link ?? false)
  <a href="/strand/{{ $strand->slug}}"
@else
  <span
@endif

style="background-color: {{ $strand->secondary_color }}; color: {{$strand->color}}" title="{{ $strand->title }}" class="label label--{{ $strand->slug }}
  {{-- @if((hexdec(substr($strand->color,0,2)) + hexdec(substr($strand->color,2,2)) + hexdec(substr($strand->color,4,2))) < 300 )
   label__dark-bg
  @endif --}}

">Part of {{ $strand->title }}

@if($is_link ?? false)
  </a>
@else
  </span>
@endif