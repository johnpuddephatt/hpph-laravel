@push('body-classes','page page-simple page-simple__picks')

@extends('layouts.app')

@section('title', 'Picks')

@section('content')

  <div class="page-standard--header">

    @include('utils.intervention', [
      'alt' => "Hyde Park Picks",
      'img' => '/images/picks-header.png',
      'class' => "page-standard--header--image fade-image-onload",
      'height' => "640",
      'width' => "1280",
      'sizes' => "(orientation: portrait) 150vw, 100vw",
    ])

  </div>

  <div class="container page-standard--container">
    <main class="page-standard--main no-aside">

        @foreach($picks as $pick)
          <div class="pick--item" id="{{ str_slug($pick->title) }}">
            @include('utils.intervention', [
              'alt' => "Image for " . $pick->image,
              'img' => $pick->image ?? '/images/page-header.jpg',
              'class' => "",
              'height' => "240",
              'width' => "720",
              'sizes' => "100vw",
            ])

            <div class="pick--date">{{ $pick->date->format('jS F Y') }}</div>
            <h2 class="pick--header"><a href="#{{ str_slug($pick->title) }}">{{ $pick->title }}</a></h2>

            {!! implode(array_slice(explode('</p>',$pick->description),0,2)) !!}

            @php $extended_description = implode(array_slice(explode('</p>',$pick->description),2)); @endphp
            @if($extended_description)
            <div class="pick--extended">
              {!! $extended_description !!}
            </div>
            <button class="button button__link pick--extended--button">Read more</button>

            @endif



          </div>
        @endforeach


      {{ $picks->links() }}

    </main>
  </div>
@stop