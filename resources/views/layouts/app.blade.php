<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{asset('img/logonano.png')}}">
  @vite('resources/css/app.css')
  {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script> --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">
    @if (!request()->routeIs('login','register','register.showStep', 'password.verify' , 'password.request', 'password.reset'))
        @include('layouts.header')
    @endif

    <div class="@if (!request()->routeIs('login','register','register.showStep', 'password.verify' , 'password.request', 'password.reset')) mt-16 @endif">
        @yield('content')
    </div>

    @if (!request()->routeIs('login','register','register.showStep', 'password.verify' , 'password.request', 'password.reset'))
        @include('layouts.footer')
    @endif
</body>
</html>
