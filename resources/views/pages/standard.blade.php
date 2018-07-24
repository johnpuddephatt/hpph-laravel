@push('body-classes','page')

@extends('layouts.app')

@section('content')
  <img src="{{ $page->header_image or '/images/page-header.jpg' }}" class="page-standard--header">

  <div class="container page-standard--container">
    <main class="page-standard--main">
      <h1 class="page-standard--title">{{ $page->title }}!</h1>
      {!! $page->content !!}
    </main>
    <aside class="page-standard--aside">
      <ul>
        @foreach ($sibling_pages as $sibling_page)
        <li><a class="page-standard--aside--link" href="/{{ $parent_page->slug }}/{{ $sibling_page->slug }}">{{ $sibling_page->title }}</li>
        @endforeach
      </ul>
    </aside>
  </div>
@stop