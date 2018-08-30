@push('body-classes','page')

@extends('layouts.app')

@section('content')
  <div class="page-standard--header">

    @include('utils.cloudinary', [
      'alt' => "Image for " . $page->title,
      'img' => isset($page->thumb)? url($page->thumb) : (isset($parent_page->thumb)? url($parent_page->thumb): '/images/page-header.jpg'),
      'class' => "page-standard--header--image",
      'height' => "450",
      'width' => "1280",
      'sizes' => "100vw"
    ])

  </div>

  <div class="container page-standard--container">
    <main class="page-standard--main @if(!count($sibling_pages)) no-aside @endif ">
      <h1 class="page-standard--title">{{ $page->title }}</h1>
      {!! $page->content !!}
      @if ($page->id == $parent_page->id && count($sibling_pages))
        <nav class="page-standard--grid-nav">
          @foreach ($sibling_pages as $sibling_page)
            <a class="page-standard--grid-nav--link" href="/{{ $parent_page->slug }}/{{ $sibling_page->slug }}/">
              <h3 class="page-standard--grid-nav--title">{{ $sibling_page->title }}</h3>

              <img src="{{ isset($sibling_page->thumb)? url($sibling_page->thumb) : (isset($parent_page->thumb)? url($parent_page->thumb): '/images/page-header.jpg') }}" class="page-standard--grid-nav--image"/>
            </a>
          @endforeach
        </nav>
      @endif
    </main>
    @if(count($sibling_pages))
      <aside class="page-standard--aside">

        <h2 class="page-standard--aside--heading"><a @if(Request::is( $parent_page->slug)) class="current" @endif href="/{{ $parent_page->slug }}">{{ $parent_page->title }}</a></h2>
        <nav class="page-standard--aside--nav">
          @foreach ($sibling_pages as $sibling_page)
            <a class="page-standard--aside--link @if(Request::is( $parent_page->slug . '/' . $sibling_page->slug ))current @endif" href="/{{ $parent_page->slug }}/{{ $sibling_page->slug }}/">{{ $sibling_page->title }}</a>
          @endforeach
        </nav>
      </aside>
    @endif
  </div>
@stop