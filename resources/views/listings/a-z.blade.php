@extends('layouts.app')

@section('content')

  <section class="section section--az-listings">
    <div class="container">
      <h2 class="section-title">What’s On</h2>
      @include('listings.navigation')

      <div class="az-listings--listings">
        @foreach ($films as $film)
          <a class="az-listings--entry" href="/film/{{ $film->slug }}">
            <div class="az-listings--entry--image">
              @include('utils.cloudinary', [
                'alt' => "Image for" . $film->title,
                'img' => url($film->thumb),
                'class' => "fade-image-onload",
                'width' => "320",
                'height' => "180",
                'sizes' => "(min-width: 900px) 30vw, (min-width: 600px) 50vw, 25vw"
              ])
            </div>
            <div class="az-listings--entry--text">
              <div class="az-listings--entry--header">
                <h3 class="az-listings--entry--title">
                  <span class="az-listings--entry--title--inner">
                    {{ $film->title }}
                  </span>
                  @if($film->certificate)
                    <span class="az-listings--entry--certificate">{{ $film->certificate }}</span>
                  @endif
                </h3>
                <div class="az-listings--entry--subtitle">{{ $film->subtitle }}</div>
              </div>

              <div class="az-listings--entry--date">
                {{ $film->getDateRange() }}
              </div>

              @if($film->short_description)
                <p class="az-listings--entry--description">{{ $film->short_description }}</p>
              @endif
            </div>
          </a>

        @endforeach
      </div>
    </div>
  </section>

@stop