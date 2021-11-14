@push('scripts')
<link rel="stylesheet" href="{{ mix('/css/fundraising.css') }}" />
@endpush


@if(count($home_slides))
@push('body-classes','home')
@endif

@extends('layouts.app')

@section('content')

{{-- @include('home.donate_hero') --}}
@include('home.hero')
@include('home.weekly-listings')
@include('home.hyde_and_seek')

@include('home.project')
@include('home.support')
{{-- @include('home.watch') --}}
@include('home.pick')
@include('home.newsletter')
@include('home.hiding')
{{-- @include('home.lost') --}}
{{-- @include('home.shop') --}}
{{-- @include('home.membership') --}}
{{-- @include('home.strands') --}}

@stop