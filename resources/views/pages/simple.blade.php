@push('body-classes','page')

@extends('layouts.app')

@section('title', $page->title)

@section('content')

  <div class="container page-standard--container">
    <main class="page-standard--main no-aside">
      <h1 class="page-standard--title">{{ $page->title }}</h1>
      {!! $page->content !!}
    </main>
  </div>
@stop