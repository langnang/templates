@extends('website::layouts.master')

@section('content')
  <div class="container-fluid">
    <div class="row row-cols-4">
      @foreach ($contents ?? [] as $content)
        <div class="col">
          <div class="card mb-3">
            <a class="card-header px-3" href="/{{ $config['slug'] }}/content/{{ $content['cid'] }}">
            </a>
            <div class="card-body py-3 px-2">
              <div class="card-title">
                {{ $content['title'] }}
              </div>
            </div>
          </div>

        </div>
      @endforeach

    </div>
  </div>
@endsection
