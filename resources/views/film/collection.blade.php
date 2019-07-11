@push('body-classes','collection')

@extends('layouts.app')

@section('title', $collection->title)

@section('content')

  <div class="single-listing--image">
    @include('utils.intervention', [
      'alt' => "Image for" . $collection->title,
      'img' => isset($collection->thumb) ? $collection->thumb : url('/images/page-header.jpg'),
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
      @if(isset($screenings) && $screenings->count())
        @foreach ($screenings as $screening)
          @include('screening.weekly-item', ['show_date' => true])
        @endforeach
      @elseif(isset($films) && $films->count())
        <div class="az-listings--listings">
          <div class="az-listings--inner">
            @foreach ($films as $film)
              @include('film.card')
            @endforeach
          </div>
        </div>
      @else
        <div class="alert alert--empty">
          There are no {{ strtolower($collection->title) }} screenings currently scheduled.
        </div>
      @endif
    </div>
  </div>


@stop