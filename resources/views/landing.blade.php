@if(count($home_slides))
  @push('body-classes','home')
@endif

@extends('layouts.app')

@section('content')

  @include('home.hero')
  @include('home.listings')
  @include('home.newsletter')
  @include('home.shop')
  @include('home.membership')
  @include('home.strands')
  @include('home.project')

@stop