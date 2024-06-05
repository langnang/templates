@extends('typecho::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 mb-3">
        <h1>Hello World</h1>

        <em>
          This view is loaded from module: {!! config('typecho.name') !!}
        </em>

      </div>
      <div class="col-12 mb-3">
        <ul class="nav nav-tabs container">
          <li class="nav-item">
            <a class="nav-link active" href="/typecho">首页</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/typecho/link">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/typecho/link">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/typecho/link">Disabled</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="card mb-3">
          <div class="card-header px-3 py-2">
            <div class="card-title mb-1"> 1 </div>
            <p class="card-text text-muted small">作者：|
              时间：|
              分类：|
              评论：</p>
          </div>
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3">
          <div class="card-header px-3 py-2"> 最新文章 </div>
          <div class="card-body px-3 py-2">最新文章</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3 py-2"> 最近回复 </div>
          <div class="card-body px-3 py-2">最近回复</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3 py-2"> 分类 </div>
          <div class="card-body px-3 py-2">分类</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3 py-2"> 归档 </div>
          <div class="card-body px-3 py-2">归档</div>
        </div>
        <div class="card mb-3">
          <div class="card-header px-3 py-2"> 其它 </div>
          <div class="card-body px-3 py-2">其它</div>
        </div>
      </div>
    </div>
  </div>
@endsection
