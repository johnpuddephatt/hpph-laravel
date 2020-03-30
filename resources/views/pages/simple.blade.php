@push('body-classes','page-simple page-simple__' . $page->slug)

@extends('layouts.app')

@section('title', $page->title)

@section('content')

  <div class="container page-standard--container">
    <main class="page-standard--main page-standard--main__simple">
      {!! $page->content !!}

      @if(property_exists(json_decode($page->extras), 'iframe'))
        <iframe src="https://tickets.hydeparkpicturehouse.co.uk/hydeparkpicturehouse/website/{{ json_decode($page->extras)->iframe }}.aspx?resize=true{{ json_decode($page->extras)->iframe_parameters ? '&' . str_replace(' ', '%20', json_decode($page->extras)->iframe_parameters) : '' }}" class="spectrix-iframe spectrix-{{ json_decode($page->extras)->iframe }}" id="SpektrixIFrame" name="SpektrixIFrame"></iframe>
        <script type="text/javascript" src="https://tickets.hydeparkpicturehouse.co.uk/hydeparkpicturehouse/website/scripts/integrate.js"></script>
      @endif

    </main>
  </div>
@stop