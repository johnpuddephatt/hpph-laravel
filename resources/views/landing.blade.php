@if(count($home_slides))
  @push('body-classes','home')
@endif

@extends('layouts.app')

@section('content')

  @include('home.hero')
  @include('home.project')
  @include('home.support')
  @include('home.watch')
  @include('home.weekly-listings')
  @include('home.newsletter')
  @include('home.hiding')
  {{-- @include('home.lost') --}}
  {{-- @include('home.shop') --}}
  {{-- @include('home.membership') --}}
  {{-- @include('home.strands') --}}

@stop