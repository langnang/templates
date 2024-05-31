@extends('home.index')

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
      </ul>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
      @foreach (Module::all() ?? [] as $moduleName => $module)
        @if (Module::isEnabled($moduleName))
          <div class="col">
            <div class="card tab-content mb-3">
              <div class="card-header p-0">
                <ul class="nav nav-tabs border-bottom-0">
                  <li class="nav-item mr-auto">
                    <a class="nav-link px-2"
                      href="/{{ Config::get(strtolower($moduleName) . '.prefix') ?? strtolower($moduleName) }}">{{ $moduleName }}</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link px-2 active" id="{{ strtolower($moduleName) }}-latest-tab" data-toggle="tab"
                      data-target="#{{ strtolower($moduleName) }}-latest" type="button" role="tab"
                      aria-controls="{{ strtolower($moduleName) }}-latest" aria-selected="true">最新</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link px-2" id="{{ strtolower($moduleName) }}-hottest-tab" data-toggle="tab"
                      data-target="#{{ strtolower($moduleName) }}-hottest" type="button" role="tab"
                      aria-controls="{{ strtolower($moduleName) }}-hottest" aria-selected="false">最热</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link px-2" id="{{ strtolower($moduleName) }}-recommend-tab" data-toggle="tab"
                      data-target="#{{ strtolower($moduleName) }}-recommend" type="button" role="tab"
                      aria-controls="{{ strtolower($moduleName) }}-recommend" aria-selected="false">推荐</button>
                  </li>

                </ul>
              </div>


              <ul class="list-group list-group-flush tab-pane active" id="{{ strtolower($moduleName) }}-latest"
                role="tabpanel" aria-labelledby="{{ strtolower($moduleName) }}-latest-tab">
                <li class="list-group-item p-2">01. An item1</li>
                <li class="list-group-item p-2">02. A second item</li>
                <li class="list-group-item p-2">03. A third item</li>
                <li class="list-group-item p-2">05</li>
                <li class="list-group-item p-2">06</li>
                <li class="list-group-item p-2">07</li>
                <li class="list-group-item p-2">08</li>
                <li class="list-group-item p-2">09</li>
                <li class="list-group-item p-2">10</li>
                <li class="list-group-item p-2">11</li>
              </ul>
              <ul class="list-group list-group-flush tab-pane" id="{{ strtolower($moduleName) }}-hottest"
                role="tabpanel" aria-labelledby="{{ strtolower($moduleName) }}-hottest-tab">
                <li class="list-group-item p-2">01. An item2</li>
                <li class="list-group-item p-2">02. A second item</li>
                <li class="list-group-item p-2">03. A third item</li>
                <li class="list-group-item p-2">05</li>
                <li class="list-group-item p-2">06</li>
                <li class="list-group-item p-2">07</li>
                <li class="list-group-item p-2">08</li>
                <li class="list-group-item p-2">09</li>
                <li class="list-group-item p-2">10</li>
              </ul>
              <ul class="list-group list-group-flush tab-pane" id="{{ strtolower($moduleName) }}-recommend"
                role="tabpanel" aria-labelledby="{{ strtolower($moduleName) }}-recommend-tab">
                <li class="list-group-item p-2">01. An item3</li>
                <li class="list-group-item p-2">02. A second item</li>
                <li class="list-group-item p-2">03. A third item</li>
                <li class="list-group-item p-2">05</li>
                <li class="list-group-item p-2">06</li>
                <li class="list-group-item p-2">07</li>
                <li class="list-group-item p-2">08</li>
                <li class="list-group-item p-2">09</li>
              </ul>

            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
@endsection

@section('content')
  <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 ml:-1 mr:-1 d-none">
    @foreach (Module::all() ?? [] as $moduleName => $module)
      @if (Module::isEnabled($moduleName))
        <a class="m-1 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
          href="/{{ Config::get(strtolower($moduleName) . '.prefix') ?? strtolower($moduleName) }}">
          <div class="p-4 px-6">
            <div class="flex items-center">
            @empty(Config::get(strtolower($moduleName) . '.ico'))
              <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 1024 1024" class="w-8 h-8 text-gray-500 d-none">
                <path
                  d="M871.9 259.8L552 75.9c-24-16-56-16-80 0L152.1 259.8c-24 16-40 40-40 68v367.9c0 28 16 56 40 68L472 947.6c24 16 56 16 80 0l319.9-183.9c24-16 40-40 40-68V327.8c0-28-16-56-40-68z m-1.1 418c0 25.1-14.4 46.7-35.9 61L547.8 904c-21.5 14.4-50.3 14.4-71.8 0L188.8 738.9c-21.5-10.8-35.9-35.9-35.9-61V347.6c0-25.1 14.4-46.7 35.9-61L476 121.4c21.5-14.4 50.3-14.4 71.8 0L835 286.5c21.5 10.8 35.9 35.9 35.9 61v330.3z"
                  p-id="4277"></path>
                <path
                  d="M793.6 345.8c-5.8-10.1-18.6-13.5-28.5-7.5L512.2 489.6l-257.6-150c-10.2-5.9-23.3-2.6-29.2 7.5-6 10.1-2.6 23 7.6 29l260.2 151.6-2.4 288.1c-0.1 11 8.8 20.1 19.8 20.2 11 0.1 20.1-8.8 20.2-19.8l2.4-289.7L786.3 375c9.9-6.1 13.2-19.1 7.3-29.2z"
                  p-id="4278"></path>
              </svg>
            @endempty
            <div class="ml-4 text-lg leading-7 font-semibold">
              <span class="underline text-gray-900 dark:text-white">{{ $moduleName }}</span>
            </div>
          </div>
        </div>
      </a>
    @endif
  @endforeach
</div>
@endsection
