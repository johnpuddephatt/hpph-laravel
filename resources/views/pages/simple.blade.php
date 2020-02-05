@push('body-classes','page-simple')

@extends('layouts.app')

@section('title', $page->title)

@section('content')

  <div class="container page-standard--container">
    <main class="page-standard--main page-standard--main__simple">
      {!! $page->content !!}
    </main>
  </div>
@stop