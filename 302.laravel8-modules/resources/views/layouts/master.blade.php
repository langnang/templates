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
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -.5rem;
        margin-left: -.5rem;
    }
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto{
        padding-left: .5rem;
        padding-right: .5rem;
    }

    @media (min-width: 1900px) {
    .container, .container-lg, .container-md, .container-sm, .container-xl {
        max-width: 1480px;
    }
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
