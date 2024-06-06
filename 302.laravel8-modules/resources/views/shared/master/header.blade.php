<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
  <a class="navbar-brand" href="/">
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
        <a class="nav-link" href="/{{ $config['slug'] }}">{{ $config['nameCn'] ?? $config['name'] }} <span
            class="sr-only">(current)</span></a>
      </li>
      @foreach ($config['navbar'] ?? [] as $navbar)
        @if (sizeof($navbar['children'] ?? []) > 0)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        @endif
      @endforeach
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
