@if(count($slides))
  @push('body-classes','home')
@endif

@extends('layouts.app')

@section('content')

  @include('home.hero')
  @include('home.listings')
  @include('home.shop')

@stop