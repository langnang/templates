@extends($layout)


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-9">
        <h3>{{ $content['title'] }}</h3>
        <p class="small">
          作者：{{ $content['user'] ?? '' }}
          时间：{{ $content['release_at'] ?? $content['updated_at'] }}
          分类：{{ $content['categories'] ?? '' }}
        </p>
        <div class="card mb-3">
          <div class="card-body px-2">
            {!! markdown_to_html($content['text']) !!}
          </div>
        </div>
        <p class="small">标签：{{ $content['tags'] ?? '' }}</p>
      </div>
      <div class="col-3">
        <div class="card my-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关联分类</div>
          </div>
          <div class="card-body"></div>
          <div class="card-footer"></div>
        </div>
        <div class="card mb-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关联标签</div>
          </div>
          <div class="card-body"></div>
          <div class="card-footer"></div>
        </div>
        <div class="card mb-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关联链接</div>
          </div>
          <div class="card-body"></div>
          <div class="card-footer"></div>
        </div>
        <div class="card mb-3">
          <div class="card-header p-2">
            <div class="card-title mb-0">关联模块</div>
          </div>
          <ul class="list-group list-group-flush">
            @foreach ($content['fields'] ?? [] as $moduleSlug => $field)
              @if (substr($moduleSlug, 0, 7) === 'module_' && $moduleSlug !== 'module_' . $config['slug'])
                @php $module =substr($moduleSlug, 7);  @endphp
                <a href="/{{ $module }}/content/{{ $content['cid'] }}"
                  class="list-group-item list-group-item-action p-2">{{ config($module . '.nameCn') ?? config($module . '.name') }}</a>
              @endif
            @endforeach
          </ul>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
