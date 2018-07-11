@extends('layouts.app')

@section('content')
  <div class="container">
    <main>
      <h1>{{ $page->title }}!</h1>
      {!! $page->content !!}
    </main>
    <aside>
      <h2>Section: {{ $parent_page->title }}</h2>
      <ul>
        @foreach ($sibling_pages as $sibling_page)
        <li>{{ $sibling_page->title }}</li>
        @endforeach
      </ul>
    </aside>
  </div>
@stop