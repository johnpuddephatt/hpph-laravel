@php
$breakpoints = [90,120,150,180,240,360,480,640,720,960,1080,1200,1440,1600]
@endphp

@if (config('app.env') != 'local')
  @if (isset($pathonly) && $pathonly == true)
    https://res.cloudinary.com/{{ config('app.cloudinary') }}/image/fetch/w_{{ $width ?? 500 }},h_{{ $height ?? 500 }},q_{{ $quality ?? 80 }},{{ $modes ?? "c_fill,g_auto,f_auto" }}/{{ url($img) }}
  @else
    <img alt="{{ $alt }}" src="https://res.cloudinary.com/{{ config('app.cloudinary') }}/image/fetch/w_{{ $width ?? 500 }},h_{{ $height ?? 500 }},q_{{ $quality ?? 75 }},{{ $modes ?? 'c_fill,g_auto,f_auto' }}/{{ url($img) }}" width="{{ $width ?? 500 }}" height="{{ $height ?? 500 }}" srcset="@foreach ($breakpoints as $breakpoint) https://res.cloudinary.com/{{ config('app.cloudinary') }}/image/fetch/w_{{ $breakpoint }},h_{{ round($height * $breakpoint / $width) }},q_{{ $quality ?? 80 }},{{ $modes ?? 'c_fill,g_auto,f_auto' }}/{{ url($img) }} {{ $breakpoint }}w @if (!$loop->last), @endif @endforeach" sizes="{{ $sizes ?? "100vw" }}" class="{{ $class ?? '' }}" @if(isset($onload)) onload="{{ $onload }}" @endif />
  @endif
@else
  @if (isset($pathonly) && $pathonly == true)
    {{  url($img) }}
  @else
    <img alt="{{ $alt }}" class="{{ $class ?? '' }}" src="{{  url($img) }}" />
  @endif
@endif