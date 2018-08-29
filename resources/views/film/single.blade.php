@push('body-classes','film')

@extends('layouts.app')

@section('content')

  <div class="single-listing--image">
    @include('utils.cloudinary', [
      'alt' => "Image for" . $film->title,
      'img' => url($film->thumb),
      'class' => "single-listing--header--img fade-image-onload",
      'height' => "450",
      'width' => "1280",
      'sizes' => "(orientation: portrait) 178vw, 100vw",
      'modes' => "c_fill,g_auto"
    ])
  </div>

  <div class="container single-listing--heading">
    <div class="single-listing--text">
      @foreach($film->strands()->get() as $strand)
        <div class="single-listing--strand">
          @include('film.strand')
        </div>
      @endforeach
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


      </div>
    </div>

  </div>


  <div class="container single-listing--content">
    <div class="single-listing--text">
      <div class="single-listing--text--content">
        <h2 class="sr-only">Film description</h2>
        {!! $film->description !!}
      </div>
      @foreach($film->strands()->get() as $strand)
        <div class="single-listing--strand-details
          @if($strand->color && (hexdec(substr($strand->color,1,2)) + hexdec(substr($strand->color,3,2)) + hexdec(substr($strand->color,5,2))) < 300 ) dark-bg @endif" style="background-color: {{ $strand->color }}">
          <h3 class="single-listing--strand-heading">{{$strand->title}}</h3>
          {!! $strand->description !!}
        </div>
      @endforeach
      @foreach($film->seasons()->get() as $season)
        <div class="single-listing--season-details">
          <h3 class="single-listing--season-heading">{{$season->title}}</h3>
          {!! $season->short_description !!}
        </div>
      @endforeach
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
      <h2 class="single-listing--screenings--header">Showtimes</h2>
      @if (count($film->screenings))
        @include('screening.selector')
      @else
        <div class="alert">
          <h3>{{ $film->custom_coming_soon ?? "Showtimes will be confirmed soon" }}</h3>
          @if(getenv('MAILCHIMP'))
            <p>Full listings are confirmed every Monday for the week beginning the following Friday.</p>
            <p>To receive weekly listings as soon as they're confirmed, <a href="{{ getenv('MAILCHIMP')}}">sign up here.</a></p>
          @endif
        </div>
      @endif
    </div>
  </div>

@stop