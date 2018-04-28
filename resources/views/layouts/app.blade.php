<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      @if(env('GOOGLE_ANALYTICS'))
        @include('analytics')
      @endif
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ env('APP_NAME')}}</title>
      <link rel="stylesheet" href="{{url('/css/app.css')}}" />
    </head>
    <body class="{{implode(' ', $body_classes)}}">

    @include('header')

    <main class="page-content" aria-label="Content">
      @yield('content')
    </main>

    @include('footer')

    <script src="{{ url('/js/app.js') }}"></script>

  </body>
</html>