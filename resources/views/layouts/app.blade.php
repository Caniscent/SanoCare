<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('img/logonano.png') }}">
  @vite('resources/css/app.css')
</head>
<body class="text-white">
    @include('layouts.header')
    <div class="">
        @yield('content')
    </div>
    @include('layouts.footer')
</body>
</html>
