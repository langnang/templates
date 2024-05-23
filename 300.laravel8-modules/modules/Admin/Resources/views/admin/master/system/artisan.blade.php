@extends($config['slug'] . '::layouts.' . $config['layout'])


@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row row-cols-2 masonry" data-masonry='{ "itemSelector": ".masonry-item" }'>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 核心架构 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 基础架构 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 前端开发 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 安全相关 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 综合话题 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 核心架构 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 数据库 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
              <div class="col">
                <a class="card my-2" href="artisan/migration">
                  <div class="card-body py-2">
                    数据库迁移
                  </div>
                </a>
              </div>
              <div class="col">
                <a class="card my-2" href="artisan/seeding">
                  <div class="card-body py-2">
                    数据填充
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 模型关联 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 测试相关 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
        <div class="col masonry-item">
          <div class="card">
            <div class="card-header py-2"> 框架拓展 </div>
            <div class="card-body row row-cols-2 px-2 py-0">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <form method="post">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @csrf
              <div class="card-body bg-dark pl-1 pr-1">
                <div class="d-flex">
                  <i class="fas fa-layer-group"></i>
                </div>
                <p class="text-light">{{ $commands }}</p>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </section>
@endsection

@push('scripts')
  <script></script>
@endpush
