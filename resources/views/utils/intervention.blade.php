@php
$breakpoints = isset($breakpoints) ? $breakpoints : [90,120,150,180,240,360,480,640,720,960,1080,1280,1440,1600]
@endphp

<img alt="{{ $alt }}"
  src="/imager/w_{{ $width ?? 500 }},h_{{ $height ?? 500 }},q_{{ $quality ?? config('imagecache.quality') }},f_jpg,g_center{{ $img }}"
  width="{{ $width ?? 500 }}"
  height="{{ $height ?? 500 }}"
  srcset="@foreach ($breakpoints as $breakpoint) /imager/w_{{ $breakpoint }},h_{{ round($height * $breakpoint / $width) }},q_{{ $quality ?? config('imagecache.quality') }},f_jpg,g_center/{{ $img }} {{ $breakpoint }}w @if (!$loop->last), @endif @endforeach" sizes="{{ $sizes ?? "100vw" }}" class="{{ $class ?? '' }}" @if(isset($onload)) onload="{{ $onload }}" @endif />