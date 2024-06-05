@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  <div class="container">
    <h1>Content</h1>
    @isset($content)
      <div class="row">
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <div class="card-title mb-0">{{ $content['title'] }}</div>
            </div>
            <div class="card-body">
              {!! markdown_to_html($content['text']) !!}
            </div>
          </div>
        </div>
      </div>
    @endisset
  </div>
@endsection
