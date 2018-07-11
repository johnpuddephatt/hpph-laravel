@push('body-classes','home')

@extends('layouts.app')

@section('content')

  @include('home.hero')
  @include('home.listings')
  @include('home.shop')

@stop