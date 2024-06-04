@extends('layouts.master')

@push('styles')
  <x-styles :props="[['modules/Admin/Public/admin/master/css/adminlte.min.css']]"></x-styles>
  <style>
    .nav-sidebar .nav-treeview {
      padding-left: .5rem;
    }
  </style>
@endpush

@section('main')
  <div class="wrapper">
    {{-- @section('preloader') @include('adminlte::layouts.preloader') @show --}}
    @section('navbar') @include($config['slug'] . '::shared.' . $config['layout'] . '.navbar') @show
    @section('sidebar') @include($config['slug'] . '::shared.' . $config['layout'] . '.sidebar') @show
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">{{ $config['menu_actives'][0]['title'] ?? 'Dashboard' }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                @foreach ($config['menu_actives'] ?? [] as $menu_item)
                  @if ($loop->last)
                    <li class="breadcrumb-item active">{{ $menu_item['title'] }}</li>
                  @else
                    <li class="breadcrumb-item"><a href="{{ $menu_item['path'] }}">{{ $menu_item['title'] }}</a></li>
                  @endif
                @endforeach
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    @section('footer') @include($config['slug'] . '::shared.' . $config['layout'] . '.footer') @show
    @section('control-sidebar') @include($config['slug'] . '::shared.' . $config['layout'] . '.control-sidebar') @show
  </div>
@endsection

@push('scripts')
  <x-scripts :props="[['modules/Admin/Public/admin/master/js/adminlte.min']]"></x-scripts>
@endpush
