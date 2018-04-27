@extends('layouts.app')

@section('content')



    <div class="single-listing--image">
      <img alt="Image for {{ $film->title }}" src="//res.cloudinary.com/letsdance/image/fetch/w_720,e_colorize:100,q_85,c_fill/{{ url($film->thumb) }}"
       srcset="
         //res.cloudinary.com/letsdance/image/fetch/w_320,q_85,c_fill/{{ url($film->thumb) }} 320w,
         //res.cloudinary.com/letsdance/image/fetch/w_480,q_85,c_fill/{{ url($film->thumb) }} 480w,
         //res.cloudinary.com/letsdance/image/fetch/w_640,q_85,c_fill/{{ url($film->thumb) }} 640w,
         //res.cloudinary.com/letsdance/image/fetch/w_800,q_85,c_fill/{{ url($film->thumb) }} 800w,
         //res.cloudinary.com/letsdance/image/fetch/w_1020,q_85,c_fill/{{ url($film->thumb) }} 1020w,
         //res.cloudinary.com/letsdance/image/fetch/w_1600,q_85,c_fill/{{ url($film->thumb) }} 1600w,
       "
       sizes="
        (orientation: landscape) 100vw,
        50vw
       "
      />
    </div>

    <div class="single-listing--text">

      <div class="single-listing--header">
        <h1 class="single-listing--title">{{ $film->title }}</h1>
        <div class="single-listing--subtitle">{{ $film->subtitle }}</div>
        <div class="single-listing--meta">
@if($film->certificate)Cert.{{ $film->certificate }}@endif
@if($film->runtime), {{ $film->runtime . 'mins' }}@endif
@if($film->country), {{ $film->country }}@endif.
        </div>
      </div>
      <div class="single-listing--content">

        <div class="single-listing--screenings">
          @if (count($screenings))

          <h2 class="single-listing--screenings--header">Next screenings</h2>
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
        @else
          <div class="alert">No screenings currently scheduled.</div>
        @endif
        </div>


        <div class="single-listing--description">
          {!! $film->description !!}
        </div>
        <div class="single-listing--footer">
          <table>
            @if( $film->director )<tr><td>Director:</td><td>{{ $film->director }}</td></tr>@endif
            @if( $film->starring )<tr><td>Starring:</td><td>{{ $film->starring }}</td></tr>@endif
            @if( $film->f_rating )<tr><td>F-Rating:</td><td>{{ $film->f_rating }} <a href="http://f-rated.org/" target="_blank">Find out more</a></td></tr>@endif
            @if( $film->association )<tr><td>Association:</td><td>{{ $film->association }}</td></tr>@endif
            @if( $film->format )<tr><td>Format:</td><td>{{ $film->format }}</td></tr>@endif
            @if( $film->tickets && $film->tickets !== '<br>')<tr><td>Tickets:</td><td>{!! $film->tickets !!}</td></tr>@endif
          </table>
        </div>
      </div>
    </div>



@stop