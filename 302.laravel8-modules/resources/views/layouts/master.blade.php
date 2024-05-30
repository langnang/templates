{{-- @extends('home::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('home.name') !!}
    </p>
@endsection --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Modular') | {{ env('APP_NAME') }}</title>

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

  <!-- Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet"> --}}

  <!-- Styles -->
  {{-- <link rel="stylesheet" href="/public/app/css/app.css"> --}}

  <x-styles :props="[
      ['googlefonts', 'Roboto'],
      ['normalize.css', 'normalize'],
      ['bootstrap', 'css/bootstrap.min'],
      //   ['bootstrap', 'css/bootstrap-theme.min'],
      ['bootstrap-icons', 'bootstrap-icons.min'],
      ['@fortawesome/fontawesome-free', 'css/all.min'],
      ['/public/app/css/app'],
  ]">
  </x-styles>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
  @stack('styles')
</head>

<body class="bg-gray-100 dark:bg-gray-900">

  @yield('main')

  @sectionMissing('main')
    @yield('header')
    @yield('sidebar')
    @yield('content')
    @yield('footer')
  @endif

  <x-scripts :props="[
      ['axios', 'axios.min'],
      ['jquery', 'jquery.min'],
      ['popper.js', 'popper.min'],
      ['bootstrap', 'js/bootstrap.min'],
      ['lodash', 'lodash.min'],
      ['holderjs', 'holder.min'],
      ['mockjs', 'mock-min'],
      ['moment', 'moment'],
      ['masonry-layout', 'masonry.pkgd.min'],
      ['/public/app/js/app'],
  ]"></x-scripts>

  @stack('scripts')
</body>

</html>
