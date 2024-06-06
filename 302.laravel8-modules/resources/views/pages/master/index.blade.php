@extends($layout)


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-9">
        @foreach ($contents ?? [] as $content)
          <div class="card mb-3">
            <a class="card-header px-3" href="/{{ $config['slug'] }}/content/{{ $content['cid'] }}">
              {{ $content['title'] }}
            </a>
            <div class="card-body py-3 px-2"></div>
            <div class="card-footer small px-3 py-1">
              作者: {{ $content['user'] }}
              时间: {{ $content['release_at'] ?? $content['updated_at'] }}
              分类: {{ $content['metas'] ?? '' }}
            </div>
          </div>
        @endforeach

        {{ $contents->withQueryString()->links() }}
      </div>

      <div class="col-3">
        <div class="card mb-3">
          <div class="card-header px-3">最新文章</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3">最近回复</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3">目录分类</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3">归档</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3">其它</div>
        </div>
      </div>
    </div>
  </div>
@endsection
