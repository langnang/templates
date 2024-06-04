@extends('layouts.master')


@push('styles')
  <style>
    .min-h-screen {
      min-height: calc(100vh - 56px);
    }

    .card>.card-header .nav-link {
      border-top-color: transparent;
    }

    .card>.card-header~.list-group {
      border-top: 0;
      height: 368px;
      overflow-y: auto;
    }

    .card>.list-group {
      border-bottom-width: 0;
      border-bottom-right-radius: calc(.25rem - 1px);
      border-bottom-left-radius: calc(.25rem - 1px);
    }
  </style>
@endpush
@section('main')
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
    <a class="navbar-brand" href="#">
      <img src="/favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="">
      {{ env('APP_NAME') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Modules
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            @foreach (Module::all() ?? [] as $moduleName => $module)
              @if (Module::isEnabled($moduleName))
                <a class="dropdown-item"
                  href="/{{ Config::get(strtolower($moduleName) . '.prefix') ?? strtolower($moduleName) }}">{{ $moduleName }}</a>
              @endif
            @endforeach
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/login">Sign In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sign-up">Sign Up</a>
        </li>
      </ul>
    </div>
  </nav>
  @yield('content')
  
@endsection
