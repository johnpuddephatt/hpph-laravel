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
        @include('film.trailer')
    @endif
  </div>

  <div class="container single-listing--content">
    <div class="single-listing--text">
      <div class="single-listing--heading">
        <div class="single-listing--text">
          @foreach($film->strands as $strand)
            <div class="single-listing--strand">
              @include('labels.strand', ['is_link' => true])
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
      <div class="single-listing--text--content">
        <h2 class="sr-only">Film description</h2>
        {!! $film->description !!}
      </div>
      @foreach($film->strands as $strand)
        <a href="/strand/{{ $strand->slug}}" class="single-listing--strand-details
          @if($strand->color && (hexdec(substr($strand->color,1,2)) + hexdec(substr($strand->color,3,2)) + hexdec(substr($strand->color,5,2))) < 300 ) dark-bg @endif" style="background-color: {{ $strand->color }}">
          <h3 class="single-listing--strand-heading">A {{$strand->title}} screening</h3>
          <div>{!! $strand->short_description !!}</div>
          <div class="single-listing--strand-callout"> View all {{ $strand->title}} screenings</div>
        </a>
      @endforeach
      @foreach($film->seasons()->get() as $season)
        <a href="/season/{{ $season->slug}}" class="single-listing--season-details">
          <h3 class="single-listing--season-heading">Showing as part of {{$season->title}}</h3>
          <div>{!! $season->short_description !!}</div>
          <div class="single-listing--season-callout"> View all {{ $season->title}} screenings</div>
        </a>
      @endforeach
      <div class="single-listing--reviews">
        @if($film->reviews)
          @foreach($film->reviews as $review)
            @if(!empty($review->rating))
              <div class="single-listing--reviews--review">
              @if(!empty($review->url))<a href="{{ $review->url }}" _target="blank">@endif
              @if(!empty($review->text))<div class="single-listing--reviews--review--text">“{{ $review->text }}”</div>@endif
              @if(!empty($review->rating))
                <div class="single-listing--reviews--review--rating">
                  @for ($i = 0; $i < $review->rating; $i++)
                    &starf;
                  @endfor
                </div>
              @endif
              @if(!empty($review->author))
                <div class="single-listing--reviews--review--author">
                  {{ $review->author }}
                </div>
              @endif
              @if(!empty($review->url))</a>@endif
              </div>
            @endif
          @endforeach
        @endif
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
      <h2 class="single-listing--screenings--header">Showtimes</h2>
      @if($film->screenings->contains(function($key, $value) { return $key->url; }))
        <p class="screenings-table--explainer">Select a screening below to book tickets</p>
      @endif
      @if (count($film->screenings))
        @include('screening.selector')
      @elseif ($film->screenings_count)
        <div class="alert alert__empty">
          All scheduled screenings have now passed.
        </div>
      @else
        <div class="alert">
          <h3>{{ $film->custom_coming_soon ?? "Showtimes to be confirmed" }}</h3>
          <p>Please check back again soon for details of specific showtimes and to book tickets.</p>
          @if(config('app.mailchimp'))
            <p>Full listings are confirmed every Monday for the week beginning the following Friday. To receive our weekly listings emails, <a href="{{ config('app.mailchimp') }}">sign up here.</a></p>
          @endif
        </div>
      @endif
    </div>
  </div>

  @if($film->screenings->contains(function($key, $value) { return $key->url; }))
    <div class="screenings-table--announcer--wrapper" role="status">
      <div class="screenings-table--announcer container"></div>
    </div>
  @endif

@stop