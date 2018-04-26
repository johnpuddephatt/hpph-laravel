@extends('layouts.app')

@section('content')

  <div class="home-image">
  </div>

  <div class="listings">
    @include('screening.weekly')
  </div>

@stop