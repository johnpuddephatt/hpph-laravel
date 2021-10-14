<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">

  @if(config('app.analytics'))
  @include('analytics')
  @endif

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} — @yield('title', config('app.description'))</title>
  <meta name="description" content="@yield('description', config('app.description'))">
  <link rel="canonical" href="@yield('canonical', Request::url())" />
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
  <script defer type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

  @stack('scripts')

</head>

<body class="@stack('body-classes') @if(env('SITE_NOTIFICATION'))has-notification @endif">

  @if (\Request::is('/') and (count($screenings_today) or count($screenings)))
  @include('bookmark')
  @endif


  <div class="wrapper">
    @if(env('SITE_NOTIFICATION'))
    @include('notification')
    @endif

    @include('header')
    @include('search')

    <main class="page-content" aria-label="Content" id="main" tabIndex="-1">
      @yield('content')
    </main>

    @include('footer')
  </div>


</body>

</html>