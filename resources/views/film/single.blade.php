@push('body-classes','film')

@extends('layouts.app')

@section('content')

  <div class="single-listing--image">
    @include('utils.cloudinary', [
      'alt' => "Image for" . $film->title,
      'img' => url($film->thumb),
      'class' => "single-listing--header--img fade-image-onload",
      'height' => "500",
      'width' => "500",
      'sizes' => "(orientation: landscape) 85vw, 100vw"
    ])
  </div>

  <div class="container single-listing--heading">
    <div class="single-listing--text">
      <h1 class="single-listing--title">{{ $film->title }}</h1>
      @if($film->alt_language_title)<div class="single-listing--alt-language-title">{{ $film->alt_language_title }}</div>@endif
      <div class="single-listing--meta">
  @if($film->country){{ $film->country }}, @endif
  @if($film->year){{ $film->year }}, @endif
  @if($film->runtime){{ $film->runtime . 'mins' }}, @endif
  @if($film->certificate)Cert.{{ $film->certificate }}@endif
      </div>
      <div class="single-listing--strand">
        @if($film->subtitle)<div class="single-listing--subtitle">{{ $film->subtitle }}</div>@endif
        @foreach($film->strands()->get() as $strand)
          @include('film.strand')
        @endforeach
        @if($film->audio_description)
          @include('film.audio-description')
        @endif
      </div>
    </div>

  </div>


  <div class="container single-listing--content">
    <div class="single-listing--text">
      <div class="single-listing--text--content">
          {!! $film->description !!}
      </div>
      <div class="single-listing--text--footer">
        <table>
          @if( $film->language )<tr><td>Language:</td><td>{{ $film->language }}</td></tr>@endif
          @if( $film->director )<tr><td>Director:</td><td>{{ $film->director }}</td></tr>@endif
          @if( $film->starring )<tr><td>Starring:</td><td>{{ $film->starring }}</td></tr>@endif
          @if( $film->f_rating )<tr><td>F-Rating:</td><td>@if($film->f_rating == 3)Triple @else Single @endif</td></tr>@endif
          @if( $film->association )<tr><td>Association:</td><td>{{ $film->association }}</td></tr>@endif
          @if( $film->format )<tr><td>Format:</td><td>{{ $film->format }}</td></tr>@endif
          @if( $film->tickets && $film->tickets !== '<p><br></p>')<tr><td>Tickets:</td><td>{!! $film->tickets !!}</td></tr>@endif
        </table>
      </div>
    </div>
    <div class="single-listing--screenings">
      <h2 class="single-listing--screenings--header">Screenings</h2>
      @if (count($film->screenings))

        @include('screening.selector')

      {{-- @if($date_count > 1)
        <button class="button__small single-listing--screenings--show-all">More screenings</button>
      @endif --}}
    @else
      <div class="alert">No screenings currently scheduled.</div>
    @endif
    </div>
  </div>

@stop