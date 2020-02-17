@push('body-classes','page-simple page-simple__' . $page->slug)

@extends('layouts.app')

@section('title', $page->title)

@section('content')

  <div class="container page-standard--container">
    <main class="page-standard--main page-standard--main__simple">
      {!! $page->content !!}
    </main>
  </div>
@stop