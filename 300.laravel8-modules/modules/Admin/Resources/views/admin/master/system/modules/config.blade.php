@extends($config['slug'] . '::layouts.' . $config['layout'])
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        @empty($alert)
        @else
          <div class="col-md-12">
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
              <h4 class="alert-heading">{{ Str::ucfirst($alert['type']) }}</h4>
              <hr>
              <p class="mb-0"> {{ $alert['message'] }} </p>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>
          </div>
        @endempty

        <div class="col-md-12">
          <ul class="nav nav-pills nav-justified mb-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="pills-basic-tab" data-toggle="pill" data-target="#pills-basic" type="button"
                role="tab" aria-controls="pills-basic" aria-selected="true">Config</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-navbar-tab" data-toggle="pill" data-target="#pills-navbar" type="button"
                role="tab" aria-controls="pills-navbar" aria-selected="true">Navbar</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-sidebar-tab" data-toggle="pill" data-target="#pills-sidebar" type="button"
                role="tab" aria-controls="pills-sidebar" aria-selected="true">Sidebar</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-composer-tab" data-toggle="pill" data-target="#pills-composer" type="button"
                role="tab" aria-controls="pills-composer" aria-selected="true">Composer</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-module-tab" data-toggle="pill" data-target="#pills-module" type="button"
                role="tab" aria-controls="pills-module" aria-selected="true">Module</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-package-tab" data-toggle="pill" data-target="#pills-package" type="button"
                role="tab" aria-controls="pills-package" aria-selected="true">Package</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-make-tab" data-toggle="pill" data-target="#pills-make" type="button"
                role="tab" aria-controls="pills-make" aria-selected="true">Make</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-market-tab" data-toggle="pill" data-target="#pills-market" type="button"
                role="tab" aria-controls="pills-market" aria-selected="true">Market</a>
            </li>
          </ul>
        </div>


        <div class="col-md-12">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab">
              @include('admin::admin.system.modules.config-basic')
            </div>
            <div class="tab-pane fade" id="pills-navbar" role="tabpanel" aria-labelledby="pills-navbar-tab">
            </div>
            <div class="tab-pane fade" id="pills-sidebar" role="tabpanel" aria-labelledby="pills-sidebar-tab">
            </div>
            <div class="tab-pane fade" id="pills-composer" role="tabpanel" aria-labelledby="pills-composer-tab">
            </div>
            <div class="tab-pane fade" id="pills-module" role="tabpanel" aria-labelledby="pills-module-tab">
            </div>
            <div class="tab-pane fade" id="pills-package" role="tabpanel" aria-labelledby="pills-package-tab">
            </div>
            <div class="tab-pane fade" id="pills-make" role="tabpanel" aria-labelledby="pills-make-tab">
              @include('admin::admin.system.modules.config-make')
            </div>
            <div class="tab-pane fade" id="pills-market" role="tabpanel" aria-labelledby="pills-market-tab">
            </div>
          </div>
        </div>




      </div>
    </div>
  </section>
@endsection
