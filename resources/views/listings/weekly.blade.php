@extends('layouts.app') @section('content')

<section class="section section--az-listings">
  <h2 class="section-title">What’s On</h2>
  @include('listings.navigation', ['type' => 'weekly'])

  <div class="weekly-screenings--content">
    <div class="container weekly-screenings--screenings">
      @if( isset($screenings_today) && count($screenings_today))
      <h2 class="weekly-screenings--date">Today</h2>
      <div class="weekly-screenings--entries">
        @foreach ($screenings_today as $screening)
        @include('screening.weekly-item') @endforeach
      </div>
      @endif @if(count($screenings)) @php $current_date = '' @endphp @foreach
      ($screenings as $screening) @if($screening->film) @if ($current_date !=
      $screening->date) @if(!$loop->first)
    </div>
    @endif
    <h2 class="weekly-screenings--date">
      {{ Carbon\Carbon::parse($screening->date)->format('D jS F') }}
    </h2>
    @php $current_date = $screening->date @endphp
    <div class="weekly-screenings--entries">
      @endif @include('screening.weekly-item') @endif @endforeach
    </div>
    @if ($week > 1)
    <div class="alert">
      Full listings are confirmed every Monday for the week beginning the
      following Friday.
    </div>
    @endif @else
    <div class="alert alert__empty">
      No screenings currently scheduled for this week.
    </div>
    @endif
  </div>
  @include('listings.navigation-footer')
</section>
@stop
