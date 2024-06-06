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

  @section('head')
    @if (\View::exists('shared.master.head'))
      @include('shared.master.head')
    @endif
  @show

  @stack('styles')
</head>

<body class="bg-gray-100 dark:bg-gray-900">

  @yield('main')

  @sectionMissing('main')
    @section('header')
      @if (View::exists('shared.master.header'))
        @include('shared.master.header')
      @endif
    @show

    @yield('sidebar')

    <div class="wrapper-content" style="min-height: calc(100vh - 152px)">
      @yield('content')
    </div>

    @section('footer')
      @if (View::exists('shared.master.footer'))
        @include('shared.master.footer')
      @endif
    @show
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
