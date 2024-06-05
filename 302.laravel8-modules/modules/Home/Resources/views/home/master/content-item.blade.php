@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  <div class="container">
    <h1>Content</h1>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header p-2">
            <div class="card-title mb-0">{{ $content['title'] }}</div>
          </div>
          <div class="card-body">
            {!! markdown_to_html($content['text']) !!}
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关连分类</div>
          </div>
          <div class="card-body"></div>
        </div>
        <div class="card mb-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关连标签</div>
          </div>
          <div class="card-body"></div>
        </div>
        <div class="card mb-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关连链接</div>
          </div>
          <div class="card-body"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
