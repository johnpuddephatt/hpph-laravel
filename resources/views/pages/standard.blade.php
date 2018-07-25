@push('body-classes','page')

@extends('layouts.app')

@section('content')
  <div class="page-standard--header">
    <img src="{{ $page->header_image or '/images/page-header.jpg' }}" class="page-standard--header--image">
  </div>

  <div class="container page-standard--container">
    <main class="page-standard--main">
      <h1 class="page-standard--title">{{ $page->title }}!</h1>
      {!! $page->content !!}
    </main>
    <aside class="page-standard--aside">
      <h2 class="page-standard--aside--heading">{{ $parent_page->title }}</h2>
      <nav class="page-standard--aside--nav">
        @foreach ($sibling_pages as $sibling_page)
        <a class="page-standard--aside--link" href="/{{ $parent_page->slug }}/{{ $sibling_page->slug }}">{{ $sibling_page->title }}</a>
        @endforeach
      </nav>
    </aside>
  </div>
@stop