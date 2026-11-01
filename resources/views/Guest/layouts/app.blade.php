<!doctype html>
<html lang="id">
<head>
  <script>document.documentElement.classList.add('js')</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="DulAuto: temukan kendaraan pilihan untuk perjalanan Anda.">
  <title>@yield('title', 'Beranda') | DulAuto</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('guest/autohaus/css/vendor/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('guest/autohaus/css/style.css') }}">
</head>
<body>
  @include('Guest.partials.navigation')
  <main id="main">
    @yield('content')
  </main>
  @include('Guest.partials.footer')
  @include('Guest.partials.lightbox')
  <script src="{{ asset('guest/autohaus/js/vendor/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('guest/autohaus/js/main.js') }}"></script>
</body>
</html>