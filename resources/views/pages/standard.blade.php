@push('body-classes','page page__' . $page->slug)

@extends('layouts.app')

@section('title', $page->title)

@section('content')
  <div class="page-standard--header">

    @include('utils.intervention', [
      'alt' => "Image for " . $page->title,
      'img' => isset($page->thumb)? $page->thumb : (isset($parent_page->thumb)? $parent_page->thumb : '/images/page-header.jpg'),
      'class' => "page-standard--header--image fade-image-onload",
      'height' => "640",
      'width' => "1280",
      'sizes' => "(orientation: portrait) 150vw, 100vw",
    ])

  </div>

  <div class="container page-standard--container">
    <main class="page-standard--main @if(!count($sibling_pages)) no-aside @endif ">
      <h1 class="page-standard--title">{{ $page->title }}</h1>
      {!! $page->content !!}

      @if(property_exists(json_decode($page->extras), 'iframe') && json_decode($page->extras)->iframe)
        <iframe src="https://tickets.hydeparkpicturehouse.co.uk/leedsheritagetheatres/website/{{ json_decode($page->extras)->iframe }}.aspx?resize=true{{ json_decode($page->extras)->iframe_parameters ? '&' . str_replace(' ', '%20', json_decode($page->extras)->iframe_parameters) : '' }}" class="spectrix-iframe spectrix-{{ json_decode($page->extras)->iframe }}" id="SpektrixIFrame" name="SpektrixIFrame"></iframe>
        <script type="text/javascript" src="https://tickets.hydeparkpicturehouse.co.uk/leedsheritagetheatres/website/scripts/integrate.js"></script>
      @endif

      @if ($page->id == $parent_page->id && count($sibling_pages))
        <nav class="page-standard--grid-nav">
          @foreach ($sibling_pages as $sibling_page)
            <a class="page-standard--grid-nav--link" href="/{{ $parent_page->slug }}/{{ $sibling_page->slug }}/">
              <h3 class="page-standard--grid-nav--title">{{ $sibling_page->title }}</h3>

              {{-- <img src="{{ isset($sibling_page->thumb)? url($sibling_page->thumb) : (isset($parent_page->thumb)? url($parent_page->thumb): url('/images/page-header.jpg')) }}" class="page-standard--grid-nav--image"/> --}}
              @include('utils.intervention', [
                'alt' => "Image for " . $sibling_page->title,
                'img' => isset($sibling_page->thumb)? $sibling_page->thumb : (isset($parent_page->thumb)? $parent_page->thumb: '/images/page-header.jpg'),
                'class' => "page-standard--grid-nav--image",
                'height' => "300",
                'width' => "540",
                'sizes' => "(orientation: portrait) 100vw, 20vw",
              ])
            </a>
          @endforeach
        </nav>
      @endif

      <div class="alert">
        <h3>Can't find what you're looking for?</h3>
        <p>Then please do get in touch and we'll be happy to help.</p>
        <ul>
          <li>Tel: <a href="tel:0113 275 2045">0113 275 2045</a></li>
          <li>Email: <a href="mailto:info@hydeparkpicturehouse.co.uk">info@hydeparkpicturehouse.co.uk</a></li>
        </ul>
      </div>
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