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

  <div @if($collection->venue_name && $collection->secondary_color && $collection->color) class="collection-wrapper__OTR" style="background-color: {{  $collection->secondary_color ?? 'inherit' }} !important; color:  {{  $collection->color ?? 'inherit' }} !important; fill:  {{  $collection->color ?? 'inherit' }}; stroke:  {{  $collection->color ?? 'inherit' }};" @endif >
    <div class="container container__narrow">
      <div class="collection--header">
        @if($collection->venue_name && $collection->secondary_color && $collection->color)
          @include('icons.on-the-road')
        @endif

        <div class="collection--text">
          <h1 class="single-listing--title">{{ $collection->title }}</h1>
          @if($collection->venue_name)<p class="single-listing--venue">{{ $collection->venue_name }}</p> @endif
          <div class="single-listing--description">{!! $collection->description !!}</div>
        </div>
      </div>

      <div class="single-listing--related">
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
            <div class="alert alert__empty">
              There are no {{ $collection->title }} screenings currently scheduled.
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

@stop