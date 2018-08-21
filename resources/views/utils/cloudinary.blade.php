@php
$breakpoints = [90,120,150,180,240,360,480,640,720,960,1080,1200,1440,1600]
@endphp

@if (env('APP_ENV') != 'local')
  @if (isset($pathonly) && $pathonly == true)
    https://res.cloudinary.com/{{ env('CLOUDINARY') }}/image/fetch/w_{{ $width or 500 }},h_{{ $height or 500 }},q_{{ $quality or 80 }},{{ $modes or "c_fill" }}/{{ url($img) }}
  @else
    <img alt="{{ $alt }}" src="https://res.cloudinary.com/{{ env('CLOUDINARY') }}/image/fetch/w_{{ $width or 500 }},h_{{ $height or 500 }},q_{{ $quality or 80 }},{{ $modes or 'c_fill' }}/{{ url($img) }}" width="{{ $width or 500 }}" height="{{ $height or 500 }}" srcset="@foreach ($breakpoints as $breakpoint) https://res.cloudinary.com/{{ env('CLOUDINARY') }}/image/fetch/w_{{ $breakpoint }},h_{{ round($height * $breakpoint / $width) }},q_{{ $quality or 80 }},{{ $modes or 'c_fill' }}/{{ url($img) }} {{ $breakpoint }}w @if (!$loop->last), @endif @endforeach" sizes="{{ $sizes or "100vw" }}" class="{{ $class }}" @if($onload) onload="{{ onload }}" @endif />
  @endif
@else
  @if (isset($pathonly) && $pathonly == true)
    {{  url($img) }}
  @else
    <img alt="{{ $alt }}" class="{{ $class }}" src="{{  url($img) }}" />
  @endif
@endif