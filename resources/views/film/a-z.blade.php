@extends('layouts.app')

@section('content')
  <section class="section section--az-listings">
      <h2 class="section-title">What’s On</h2>
      @include('film.navigation', ['type' => 'az'])
      <div class="az-listings--listings container">
        <div class="az-listings--inner">
          @foreach ($films as $film)
            <a class="az-listings--entry" href="/film/{{ $film->slug }}">
              <div class="az-listings--entry--image">
                @include('utils.cloudinary', [
                  'alt' => "Image for" . $film->title,
                  'img' => url($film->thumb),
                  'width' => "480",
                  'height' => "270",
                  'sizes' => "(min-width: 900px) 30vw, (min-width: 600px) 50vw, 25vw"
                ])
              </div>
              <div class="az-listings--entry--text">
                <div class="az-listings--entry--header">
                  <h3 class="az-listings--entry--title">
                    <span class="az-listings--entry--title--inner">{{ $film->title }}</span>
                    @if($film->certificate)
                      <span class="az-listings--entry--certificate">({{ $film->certificate }})</span>
                    @endif
                  </h3>
                  <div class="az-listings--entry--subtitle">{{ $film->subtitle }}</div>
                </div>
                <div class="az-listings--entry--date">
                  @if (count($film->screenings))
                    {{ $film->getDateRange() }}
                  @else
                    {{ $film->custom_coming_soon ?? "Showtimes TBC" }}
                  @endif

                </div>

                @if($film->short_description)
                  <p class="az-listings--entry--description">{{ $film->short_description }}</p>
                @endif
              </div>
              <div class="az-listings--entry--footer">
                @foreach($film->strands()->get() as $strand)
                  @include('film.strand')
                @endforeach
                @if($film->audio_description)
                  @include('film.audio-description')
                @endif
                @if($film->free)
                  <span class="label label--free">Free</span>
                @endif
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>
@stop