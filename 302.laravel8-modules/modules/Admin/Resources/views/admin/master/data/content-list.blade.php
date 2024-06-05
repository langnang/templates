@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Fixed Header Table</h3>

              <form class="form-inline card-tools float-right mb-0">
                <div class="form-group mr-1">
                  <select class="form-control form-control-sm" name="module" placeholder="Module">
                    <option value="">--Module--</option>
                    @foreach (\Module::all() as $moduleName => $module)
                      <option value="{{ strtolower($moduleName) }}">{{ $moduleName }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-1">
                  <input type="text" name="title" class="form-control form-control-sm" placeholder="Title">
                </div>
                <div class="form-group mr-1">
                  <input type="text" name="slug" class="form-control form-control-sm" placeholder="Slug">
                </div>
                <div class="form-group mr-1">
                  <select class="form-control form-control-sm" name="type">
                    <option value="">--Type--</option>
                  </select>
                </div>
                <div class="form-group mr-1">
                  <select class="form-control form-control-sm" name="status">
                    <option value="">--Status--</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-sm btn-default">
                  <i class="fas fa-search"></i>
                </button>

              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: calc(100vh - 321px);">
              <table class="table table-sm table-striped table-hover table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th width="14px">#</th>
                    <th>ID</th>
                    <th>title</th>
                    <th>type</th>
                    <th>status</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>release_at</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($contents ?? [] as $content)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="{{ $content['cid'] }}">
                        </div>
                      </td>
                      <td><a class="" href="contents/{{ $content['cid'] }}">{{ $content['cid'] }}</a></td>
                      <td>{{ $content['title'] }}</td>
                      <td>{{ $content['type'] }}</td>
                      <td>{{ $content['status'] }}</td>
                      <td>{{ $content['created_at'] }}</td>
                      <td>{{ $content['updated_at'] }}</td>
                      <td>{{ $content['release_at'] }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <div class="card-footer__left float-left">
                <a type="button" class="btn btn-sm btn-info" href="contents/insert">新增</a>
                <button type="button" class="btn btn-sm btn-danger">删除</button>
                <button type="button" class="btn btn-sm btn-secondary">Right</button>
              </div>
              <div class="card-footer__right float-right">
                <ul class="pagination m-0">
                  <li class="page-item">
                    <a class="page-link" href="{{ $contents->previousPageUrl() }}">
                      <i class="fas fa-angles-left"></i>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="{{ $contents->nextPageUrl() }}">
                      <i class="fas fa-angles-right"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.card-footer -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
