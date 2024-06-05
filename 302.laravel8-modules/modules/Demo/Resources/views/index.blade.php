@extends('demo::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Hello World</h1>

        <p>
          This view is loaded from module: {!! config('demo.name') !!}
        </p>
      </div>
      <div class="col-8">
        <div class="card mb-3">
          <div class="card-body px-3 py-2">1</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">2</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">3</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">4</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">5</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">6</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">7</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">8</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">9</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">10</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">11</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">12</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">13</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card mb-3">
          <div class="card-body px-3 py-2">最新文章</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">最近回复</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">分类</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">归档</div>
        </div>
        <div class="card mb-3">
          <div class="card-body px-3 py-2">其它</div>
        </div>
      </div>
    </div>
  </div>
@endsection
