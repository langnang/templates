@extends('website::layouts.master')

@section('content')
  <div class="container-fluid">
    <div class="row row-cols-4">
      @foreach ($contents ?? [] as $content)
        @php
          $content = $content->toArray();
          $field = $content['fields']['module_website']['value'];
        @endphp
        <div class="col">
          <a class="card text-decoration-none mb-3" target="_blank" href="{{ $field['url'] }}">
            <div class="card-body py-3 px-2">
              <div class="media">
                <img src="holder.js/60x60" data-src="{{ $field['ico'] }}" class="mr-3 lazyd" alt="...">
                <div class="media-body" style="width: 50%;">
                  <h5 class="card-title text-nowrap text-truncate" title="{{ $content['title'] }}">{{ $content['title'] }}
                  </h5>
                  <p>{{ $field['description'] }}</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach

    </div>
  </div>
@endsection
