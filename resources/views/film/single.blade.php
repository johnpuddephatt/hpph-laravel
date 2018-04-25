@extends('layouts.app')

@section('content')

  <div class="listing--content">


    <div class="listing--image">
      <img src="{{ $film->thumb }}" />
    </div>

    <div class="listing--content--inner">

      <div class="listing--header">
        <h1 class="listing--title">{{ $film->title }}</h1>
        <span>{{ $film->runtime }} mins,
          Cert. {{ $film->certificate }},
          {{ $film->country }},
          {{ $film->language }}
        </span>
      </div>he
      @if (count($film->screenings))
        <div class="listing--screenings">
          <table>

            @foreach ($film->screenings as $screening)
              <tr>
                <td>{{ Carbon\Carbon::parse($screening->date)->format('D d M')}}</td>
                <td>{{ Carbon\Carbon::parse($screening->time)->format('h.iA') }}</td>
                <td>
                  @foreach ($screening->labels() as $label)
                    @include ('screening.label')
                  @endforeach
                </td>
              </tr>
            @endforeach --}}
          </table>
        </div>
      @else
        No screenings scheduled. See description for further information.
      @endif

      <div class="listing--text">
        {!! $film->description !!}
      </div>
      <div class="listing--meta">
        <table>
          @if( $film->director )<tr><td>Director:</td><td>{{ $film->director }}</td></tr>@endif
          @if( $film->starring )<tr><td>Starring:</td><td>{{ $film->starring }}</td></tr>@endif
        </table>
      </div>
    </div>
  </div>


@stop