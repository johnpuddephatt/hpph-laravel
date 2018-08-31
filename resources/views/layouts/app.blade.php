<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">

      @if(config('app.analytics'))
        @include('analytics')
      @endif

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ config('app.name') }}</title>
      <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
    </head>
    <body class="@stack('body-classes')">

    @include('header')

    <main class="page-content" aria-label="Content" id="main" tabIndex="-1">

      @yield('content')
    </main>

    @include('footer')

    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>

  </body>
</html>