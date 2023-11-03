<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  @vite(['resources/js/app.js'])
</head>
<body>
@include('layouts.header')

  <main>
    @yield('content')
  </main>

@include('layouts.footer')
</body>
</html>