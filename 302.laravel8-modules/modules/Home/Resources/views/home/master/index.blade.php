@extends($config['slug'] . '::layouts.' . $config['layout'])
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
@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-8">
        <form action="get">
          <div class="input-group input-group-lg rounded-pill">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-lg">Brands</span>
              <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split px-2"
                data-toggle="dropdown" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">百度一下</a>
                <a class="dropdown-item" href="#">Google</a>
              </div>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="bi bi-search"></i>
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
      @foreach (Module::all() ?? [] as $moduleName => $module)
        @if (Module::isEnabled($moduleName) && !in_array($moduleName, config('home.view_index.ignore_modules') ?? []))
          @php $moduleSlug = config(strtolower($moduleName) . ".slug") ?? strtolower($moduleName) @endphp
          <div class="col @if (in_array($moduleName, config('home.view_index.fixed_modules') ?? [])) order-1 @else order-6 @endif">
            <div class="card tab-content mb-3">
              <div class="card-header p-0 pr-1">
                <ul class="nav nav-tabs border-bottom-0">
                  <li class="nav-item">
                    <a class="nav-link px-1" style="font-size: 24px;" href="#">
                      @if (in_array($moduleName, config('home.view_index.fixed_modules') ?? []))
                        <i class="bi bi-pin-angle-fill text-primary"></i>
                      @else
                        <i class="bi bi-pin-angle"></i>
                      @endif
                    </a>
                  </li>
                  <li class="nav-item mr-auto">
                    <a class="nav-link px-1 pl-0" href="/{{ Config::get($moduleSlug . '.slug') ?? $moduleSlug }}">
                      {{ Config::get($moduleSlug . '.nameCn') ?? Config::get($moduleSlug . '.name') }}
                    </a>
                  </li>
                  @isset($tabs[$moduleSlug . '-latest'])
                    <li class="nav-item" role="presentation">
                      <button class="nav-link px-2 active" id="{{ $moduleSlug }}-latest-tab" data-toggle="tab"
                        data-target="#{{ $moduleSlug }}-latest" type="button" role="tab"
                        aria-controls="{{ $moduleSlug }}-latest" aria-selected="true">最新</button>
                    </li>
                  @endisset
                  @isset($tabs[$moduleSlug . '-hottest'])
                    <li class="nav-item" role="presentation">
                      <button class="nav-link px-2" id="{{ $moduleSlug }}-hottest-tab" data-toggle="tab"
                        data-target="#{{ $moduleSlug }}-hottest" type="button" role="tab"
                        aria-controls="{{ $moduleSlug }}-hottest" aria-selected="false">最热</button>
                    </li>
                  @endisset
                  @isset($tabs[$moduleSlug . '-recommend'])
                    <li class="nav-item" role="presentation">
                      <button class="nav-link px-2" id="{{ $moduleSlug }}-recommend-tab" data-toggle="tab"
                        data-target="#{{ $moduleSlug }}-recommend" type="button" role="tab"
                        aria-controls="{{ $moduleSlug }}-recommend" aria-selected="false">推荐</button>
                    </li>
                  @endisset
                  @isset($tabs[$moduleSlug . '-collection'])
                    <li class="nav-item" role="presentation">
                      <button class="nav-link px-2" id="{{ $moduleSlug }}-collection-tab" data-toggle="tab"
                        data-target="#{{ $moduleSlug }}-collection" type="button" role="tab"
                        aria-controls="{{ $moduleSlug }}-collection" aria-selected="false">合集</button>
                    </li>
                  @endisset
                </ul>
              </div>

              <ul class="list-group list-group-flush tab-pane active" id="{{ $moduleSlug }}-latest" role="tabpanel"
                aria-labelledby="{{ $moduleSlug }}-latest-tab">
                @isset($tabs[$moduleSlug . '-latest'])
                  @foreach ($tabs[$moduleSlug . '-latest'] as $content)
                    <a class="list-group-item list-group-item-action text-truncate p-2"
                      title="{{ $content['content']['title'] ?? $content['title'] }}"
                      href="/{{ $moduleSlug }}/content/{{ $content['cid'] }}">
                      @if ($loop->iteration == 1)
                        <span class="badge badge-danger">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @elseif($loop->iteration == 2)
                        <span class="badge badge-success">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @elseif($loop->iteration == 3)
                        <span class="badge badge-primary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @else
                        <span class="badge badge-secondary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @endif
                      {{ $content['content']['title'] ?? $content['title'] }}
                    </a>
                  @endforeach
                @endisset
              </ul>
              <ul class="list-group list-group-flush tab-pane" id="{{ $moduleSlug }}-hottest" role="tabpanel"
                aria-labelledby="{{ $moduleSlug }}-hottest-tab">
                @isset($tabs[$moduleSlug . '-hottest'])
                  @foreach ($tabs[$moduleSlug . '-hottest'] as $content)
                    <a class="list-group-item list-group-item-action text-truncate p-2"
                      title="{{ $content['content']['title'] ?? $content['title'] }}"
                      href="/{{ $moduleSlug }}/content/{{ $content['cid'] }}">
                      @if ($loop->iteration == 1)
                        <span class="badge badge-danger">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @elseif($loop->iteration == 2)
                        <span class="badge badge-success">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @elseif($loop->iteration == 3)
                        <span class="badge badge-primary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @else
                        <span class="badge badge-secondary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                      @endif
                      {{ $content['content']['title'] ?? $content['title'] }}
                    </a>
                  @endforeach
                @endisset
              </ul>
              <ul class="list-group list-group-flush tab-pane" id="{{ $moduleSlug }}-recommend" role="tabpanel"
                aria-labelledby="{{ $moduleSlug }}-recommend-tab">
                @isset($tabs[$moduleSlug . '-recommend'])
                  @foreach ($tabs[$moduleSlug . '-recommend'] as $content)
                    <a class="list-group-item list-group-item-action text-truncate p-2"
                      title="{{ $content['content']['title'] ?? $content['title'] }}"
                      href="/{{ $moduleSlug }}/content/{{ $content['cid'] }}">
                      {{ $content['content']['title'] ?? $content['title'] }}
                    </a>
                  @endforeach
                @endisset
              </ul>
              <ul class="list-group list-group-flush tab-pane" id="{{ $moduleSlug }}-collection" role="tabpanel"
                aria-labelledby="{{ $moduleSlug }}-collection-tab">
                @isset($tabs[$moduleSlug . '-collection'])
                  @foreach ($tabs[$moduleSlug . '-collection'] as $content)
                    <a class="list-group-item list-group-item-action text-truncate p-2"
                      title="{{ $content['content']['title'] ?? $content['title'] }}"
                      href="/{{ $moduleSlug }}/content/{{ $content['cid'] }}">
                      {{ $content['content']['title'] ?? $content['title'] }}
                    </a>
                  @endforeach
                @endisset
              </ul>
            </div>
          </div>
        @endif
      @endforeach

      <div class="col order-12">
        <div class="card tab-content mb-3">
          <div class="card-header p-0 pr-1">
            <ul class="nav nav-tabs border-bottom-0">
              <li class="nav-item">
                <a class="nav-link px-1" style="font-size: 24px;" href="#">
                  <i class="bi bi-pin-angle"></i>
                </a>
              </li>
              <li class="nav-item mr-auto">
                <a class="nav-link px-1 pl-0" href="/home">
                  无关联
                </a>
              </li>
              @isset($tabs['nofield-latest'])
                <li class="nav-item" role="presentation">
                  <button class="nav-link px-2 active" id="nofield-latest-tab" data-toggle="tab"
                    data-target="#nofield-latest" type="button" role="tab" aria-controls="nofield-latest"
                    aria-selected="true">最新</button>
                </li>
              @endisset
              @isset($tabs['nofield-hottest'])
                <li class="nav-item" role="presentation">
                  <button class="nav-link px-2" id="nofield-hottest-tab" data-toggle="tab"
                    data-target="#nofield-hottest" type="button" role="tab" aria-controls="nofield-hottest"
                    aria-selected="false">最热</button>
                </li>
              @endisset
              @isset($tabs['nofield-recommend'])
                <li class="nav-item" role="presentation">
                  <button class="nav-link px-2" id="nofield-recommend-tab" data-toggle="tab"
                    data-target="#nofield-recommend" type="button" role="tab" aria-controls="nofield-recommend"
                    aria-selected="false">推荐</button>
                </li>
              @endisset
              @isset($tabs['nofield-collection'])
                <li class="nav-item" role="presentation">
                  <button class="nav-link px-2" id="nofield-collection-tab" data-toggle="tab"
                    data-target="#nofield-collection" type="button" role="tab" aria-controls="nofield-collection"
                    aria-selected="false">合集</button>
                </li>
              @endisset
            </ul>
          </div>

          <ul class="list-group list-group-flush tab-pane active" id="nofield-latest" role="tabpanel"
            aria-labelledby="nofield-latest-tab">
            @isset($tabs['nofield-latest'])
              @foreach ($tabs['nofield-latest'] as $content)
                <a class="list-group-item list-group-item-action text-truncate p-2"
                  title="{{ $content['content']['title'] ?? $content['title'] }}"
                  href="/home/content/{{ $content['cid'] }}">
                  @if ($loop->iteration == 1)
                    <span class="badge badge-danger">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @elseif($loop->iteration == 2)
                    <span class="badge badge-success">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @elseif($loop->iteration == 3)
                    <span class="badge badge-primary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @else
                    <span class="badge badge-secondary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @endif
                  {{ $content['content']['title'] ?? $content['title'] }}
                </a>
              @endforeach
            @endisset
          </ul>
          <ul class="list-group list-group-flush tab-pane" id="nofield-hottest" role="tabpanel"
            aria-labelledby="nofield-hottest-tab">
            @isset($tabs['nofield-hottest'])
              @foreach ($tabs['nofield-hottest'] as $content)
                <a class="list-group-item list-group-item-action text-truncate p-2"
                  title="{{ $content['content']['title'] ?? $content['title'] }}"
                  href="/home/content/{{ $content['cid'] }}">
                  @if ($loop->iteration == 1)
                    <span class="badge badge-danger">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @elseif($loop->iteration == 2)
                    <span class="badge badge-success">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @elseif($loop->iteration == 3)
                    <span class="badge badge-primary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @else
                    <span class="badge badge-secondary">{{ \Str::substr('00' . $loop->iteration, -2) }}</span>
                  @endif
                  {{ $content['content']['title'] ?? $content['title'] }}
                </a>
              @endforeach
            @endisset
          </ul>
          <ul class="list-group list-group-flush tab-pane" id="nofield-recommend" role="tabpanel"
            aria-labelledby="nofield-recommend-tab">
            @isset($tabs['nofield-recommend'])
              @foreach ($tabs['nofield-recommend'] as $content)
                <a class="list-group-item list-group-item-action text-truncate p-2"
                  title="{{ $content['content']['title'] ?? $content['title'] }}"
                  href="/home/content/{{ $content['cid'] }}">
                  {{ $content['content']['title'] ?? $content['title'] }}
                </a>
              @endforeach
            @endisset
          </ul>
          <ul class="list-group list-group-flush tab-pane" id="nofield-collection" role="tabpanel"
            aria-labelledby="nofield-collection-tab">
            @isset($tabs['nofield-collection'])
              @foreach ($tabs['nofield-collection'] as $content)
                <a class="list-group-item list-group-item-action text-truncate p-2"
                  title="{{ $content['content']['title'] ?? $content['title'] }}"
                  href="/home/content/{{ $content['cid'] }}">
                  {{ $content['content']['title'] ?? $content['title'] }}
                </a>
              @endforeach
            @endisset
          </ul>
        </div>
      </div>
    </div>
  </div>
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
