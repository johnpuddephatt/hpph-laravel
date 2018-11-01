@extends('layouts.app')

@section('content')
  <section class="section section--az-listings">
      <h2 class="section-title">What’s On</h2>
      @include('listings.navigation', ['type' => 'az'])
      <div class="az-listings--listings container">
        <div class="az-listings--inner">
          @foreach ($films as $film)
            @include('film.card')
          @endforeach
        </div>
      </div>
    </section>
@stop