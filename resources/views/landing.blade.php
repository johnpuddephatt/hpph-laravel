@if(count($slides))
  @push('body-classes','home')
@endif

@extends('layouts.app')

@section('content')

  @include('home.hero')
  @include('home.listings')
  @include('home.newsletter')
  @include('home.strands')
  @include('home.membership')
  @include('home.shop')
  @include('home.project')

@stop