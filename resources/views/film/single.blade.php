@extends('layouts.app')

@section('content')



    <div class="single-listing--image">
      <img src="{{ $film->thumb }}" />
    </div>

    <div class="single-listing--text">

      <div class="single-listing--header">
        <h1 class="single-listing--title">{{ $film->title }}</h1>
        <span class="single-listing--meta">
          Cert. {{ $film->certificate }},
          {{ $film->runtime }}mins,
          {{ $film->country }},
          {{ $film->language }}
        </span>
      </div>
      <div class="single-listing--content">

      @if (count($screenings))
        <div class="single-listing--screenings">
          <h2 class="single-listing--screenings--header">Screenings</h2>
          <table>
            <tbody class="initial-rows">
              @php $current_date = ''; $date_count = 0 @endphp
              @foreach ($screenings as $screening)

                @if ($current_date != $screening->date)
                  @php $date_count++ @endphp

                  @if ( $date_count > 1 )
                    </td>
                    </tr>
                  @endif
                  @if ( $date_count == 2 )
                    </tbody>
                    <tbody class="hidden-rows">
                  @endif
                  <tr>
                  <td>{{ Carbon\Carbon::parse($screening->date)->format('D d F')}}</td><td>
                  @php $current_date = $screening->date @endphp
                @endif
                    <a href="http://www.jack-roe.co.uk/websales/sales/hydlee/actual_book?perfcode={{ $screening->url }}" class="listings--screenings--book button button__ghost button__small">{{ Carbon\Carbon::parse($screening->time)->format('h.iA') }}
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
            <button class="button__small single-listing--screenings--show-all">show all screenings</button>
          @endif
        </div>
      @else
        <div class="alert">No screenings currently scheduled.</div>
      @endif

        <div class="single-listing--description">
          {!! $film->description !!}
        </div>
        <div class="single-listing--footer">
          <table>
            @if( $film->director )<tr><td>Director:</td><td>{{ $film->director }}</td></tr>@endif
            @if( $film->starring )<tr><td>Starring:</td><td>{{ $film->starring }}</td></tr>@endif
          </table>
        </div>
      </div>
    </div>



@stop