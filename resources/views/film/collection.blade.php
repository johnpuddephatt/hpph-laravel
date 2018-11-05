@push('body-classes','collection')

@extends('layouts.app')

@section('title', $collection->title)

@section('content')

  <div class="single-listing--image">
    @include('utils.cloudinary', [
      'alt' => "Image for" . $collection->title,
      'img' => url($collection->thumb),
      'img' => isset($collection->thumb) ? url($collection->thumb) : url('/images/page-header.jpg'),

      'class' => "single-listing--header--img fade-image-onload",
      'height' => "640",
      'width' => "1280",
      'sizes' => "(orientation: portrait) 150vw, 100vw",
      'modes' => "c_fill,g_auto,f_auto"
    ])
  </div>

  <div class="container single-listing--heading">
    <div class="single-listing--text single-listing--text__centered">
      <h1 class="single-listing--title">{{ $collection->title }}</h1>
      <div class="single-listing--description">{!! $collection->description !!}</div>
    </div>
  </div>

  <div class="container single-listing--related">
    <div class="single-listing--related--inner">
      @if($screenings->count())
        @foreach ($screenings as $screening)
          @include('screening.weekly-item', ['show_date' => true])
        @endforeach
      @else
        <div class="alert">
          There are no {{ strtolower($collection->title) }} screenings currently scheduled.
        </div>
      @endif
    </div>
  </div>


@stop