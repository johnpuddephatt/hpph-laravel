@push('body-classes','film')

@extends('layouts.app')

{{-- HEAD information --}}
@section('title', $film->title)
@section('canonical', url('/film/' . $film->slug))

@section('content')

  <div class="single-listing--image">
    @include('utils.intervention', [
      'alt' => "Image for" . $film->title,
      'img' => $film->thumb,
      'class' => "single-listing--header--img fade-image-onload",
      'height' => "640",
      'width' => "1280",
      'sizes' => "(orientation: portrait) 150vw, 100vw",
      'modes' => "c_fill,g_auto,f_auto"
    ])
    @if($film->trailer)
        @include('film.single.trailer')
    @endif
  </div>

  <div class="container single-listing--content">
    <div class="single-listing--text">
      <div class="single-listing--heading">
        <h1 class="single-listing--title">
          {{ $film->title }}
          @if(backpack_user())
            <a class="edit-link" href="/admin/film/{{ $film->id }}/edit">Edit</a>
          @endif

        </h1>
        @if($film->alt_language_title)<div class="single-listing--alt-language-title">{{ $film->alt_language_title }}</div>@endif
        <div class="single-listing--meta">
    @if($film->country){{ $film->country }}, @endif
    @if($film->year){{ $film->year }}, @endif
    @if($film->runtime){{ $film->runtime . 'mins' }}, @endif
    @if($film->certificate)Cert.{{ $film->certificate }}@endif
        </div>
        @if($film->subtitle)<div class="single-listing--subtitle">{{ $film->subtitle }}</div>@endif
        @foreach($film->strands as $strand)
          <div class="single-listing--strand">
            @include('labels.strand', ['is_link' => true])
          </div>
        @endforeach
      </div>
      <div class="single-listing--mobile--screenings">
        @if($film->is_online)
          Watch this online
        @else
          Showtimes and location
        @endif
      </div>
      <div class="single-listing--text--content">
        <h2 class="sr-only">Film description</h2>
        {!! $film->description !!}
      </div>

      @include('film.single.reviews')

      @include('film.single.footer')

      @foreach($film->seasons as $season)
        <a href="/season/{{ $season->slug}}" class="single-listing--season-details">
          <h3 class="single-listing--season-heading">Showing as part of {{$season->title}}</h3>
          <div>{!! $season->short_description !!}</div>
          <div class="single-listing--season-callout"> View all {{ $season->title}} screenings</div>
        </a>
      @endforeach

      @foreach($film->strands as $strand)
        @if($strand->venue_name && $strand->secondary_color && $strand->color)
          @include('film.single.strand-details_OTR')
        @else
          @include('film.single.strand-details')
        @endif
      @endforeach
    </div>

    <div class="single-listing--sidebar">

      @if($film->is_online)
        <h3 class="single-listing--watchonline--header is-closable">How to watch</h3>
        @if(substr( $film->embed, 0, 4 ) === "http")
          <p class="single-listing--watchonline--subtitle">This film is being hosted by one of our brilliant partners. To stream the movie and enjoy from home, follow the link below.</p>
          <a class="button button__big button__yellow" href="{{ $film->embed }}" target="_blank">Watch this on {{ parse_url($film->embed, PHP_URL_HOST)}}</a>
        @elseif($film->embed)
          {!! $film->embed !!}
        @else
          <div class="alert">
            This film isn’t currently available to watch online. Please check back soon.
          </div>
        @endif
      @else
        @if($film->venue)
          @include('film.single.venue-details')
        @endif
        @include('film.single.screening-details')
      @endif

    </div>
  </div>

  @if($film->screenings->contains(function($key, $value) { return $key->url; }))
    <div class="screenings-table--announcer--wrapper" role="status">
      <div class="screenings-table--announcer container"></div>
    </div>
  @endif

@stop