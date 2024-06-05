@extends($moduleConfig['slug'] . '::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @foreach ($contentPaginator as $item)
          <div class="card mb-2">
            <div class="card-body">
              <p class="card-text">{{ $item->title }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
