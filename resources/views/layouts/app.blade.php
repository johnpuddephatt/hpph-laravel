<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME')}}</title>
        <link rel="stylesheet" href="/css/app.css" />
    </head>
    <body class="{{implode(' ', $body_classes)}}">

    @include('header')

    <main class="page-content" aria-label="Content">
      @yield('content')
    </main>

    @include('footer')


    <script src="/js/app.js"></script>

    <script>
      var disclaimerBox = document.querySelector('.disclaimer');
      var disclaimerButton = document.querySelector('.disclaimer-close');
      if (disclaimerButton && disclaimerBox) {
        disclaimerButton.addEventListener('click', function(){
          disclaimerButton.parentNode.parentNode.removeChild(disclaimerBox);
        });
      }
    </script>
  </body>
</html>