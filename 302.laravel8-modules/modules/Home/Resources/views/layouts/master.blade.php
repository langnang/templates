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
