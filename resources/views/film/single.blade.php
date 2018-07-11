@extends('layouts.app')

@section('content')

  <div class="single-listing">
    <div class="single-listing--image">
      @include('utils.cloudinary', [
        'alt' => "Image for" . $film->title,
        'img' => url($film->thumb),
        'class' => "fade-image-onload",
        'height' => "500",
        'width' => "500",
        'sizes' => "(orientation: landscape) 85vw, 100vw"
      ])

    </div>

    <div class="single-listing--text">

      <div class="single-listing--header">
        <h1 class="single-listing--title">{{ $film->title }}</h1>
        @if($film->subtitle)<div class="single-listing--subtitle">{{ $film->subtitle }}</div>@endif
        <div class="single-listing--meta">
@if($film->year){{ $film->year }}. @endif
@if($film->certificate){{ 'Cert.' . $film->certificate }}. @endif
@if($film->runtime){{ $film->runtime . 'mins' }}. @endif
@if($film->country){{ $film->country }}. @endif
        </div>
      </div>
      <div class="single-listing--content">

        <div class="single-listing--screenings">
          @if (count($film->screenings))

          <h2 class="single-listing--screenings--header">Next screenings</h2>
          <table>
            <tbody class="initial-rows">
              @php $current_date = ''; $date_count = 0 @endphp
              @foreach ($film->screenings as $screening)

                @if ($current_date != $screening->date)
                  @php $date_count++ @endphp

                  @if ( $date_count > 1 )
                    </td>
                    </tr>
                  @endif
                  @if ( $date_count == 2 )
                    </tbody>
                    <tbody class="hidden-rows shown">
                  @endif
                  <tr>
                  <td>{{ Carbon\Carbon::parse($screening->date)->format('D d F')}}</td><td>
                  @php $current_date = $screening->date @endphp
                @endif
                    <a
                      @if($screening->url && is_numeric($screening->url)) href="http://www.jack-roe.co.uk/websales/sales/hydlee/actual_book?perfcode={{ $screening->url }}"
                      @elseif($screening->url) href="{{ $screening->url }}" @endif
                      class="listings--screenings--book button button__ghost button__small">{{ Carbon\Carbon::parse($screening->time)->format('h.iA') }}
                      @foreach ($screening->labels() as $label)
                        @if ($label)
                          @include ('screening.label')
                        @endif
                      @endforeach
                    </a>
              @endforeach
            </tbody>
          </table>
          @if($date_count > 1)
            <button class="button__small single-listing--screenings--show-all">More screenings</button>
          @endif
        @else
          <div class="alert">No screenings currently scheduled.</div>
        @endif
        </div>


        <div class="single-listing--description">
          {!! $film->description !!}
        </div>
        <div class="single-listing--footer">
          <table>
            @if( $film->language )<tr><td>Language:</td><td>{{ $film->language }}</td></tr>@endif
            @if( $film->director )<tr><td>Director:</td><td>{{ $film->director }}</td></tr>@endif
            @if( $film->starring )<tr><td>Starring:</td><td>{{ $film->starring }}</td></tr>@endif
            @if( $film->f_rating )<tr><td>F-Rating:</td><td>{{ $film->f_rating }}</td></tr>@endif
            @if( $film->association )<tr><td>Association:</td><td>{{ $film->association }}</td></tr>@endif
            @if( $film->format )<tr><td>Format:</td><td>{{ $film->format }}</td></tr>@endif
            @if( $film->tickets && $film->tickets !== '<p><br></p>')<tr><td>Tickets:</td><td>{!! $film->tickets !!}</td></tr>@endif
          </table>
        </div>
      </div>
    </div>
  </div>


@stop