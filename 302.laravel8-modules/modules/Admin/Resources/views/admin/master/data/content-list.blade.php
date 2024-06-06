@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pl-3">
              <h3 class="card-title">Content List</h3>

              <form class="form-inline card-tools float-right mb-0">
                <div class="form-group mr-1">
                  <select class="form-control form-control-sm" name="module" placeholder="Module">
                    <option value="">--Module--</option>
                    @foreach (\Module::all() as $moduleName => $module)
                      @php $moduleSlug = strtolower($moduleName); @endphp
                      <option value="{{ $moduleSlug }}" @if (request()->input('module') == $moduleSlug) selected @endif>
                        {{ $moduleName }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-1">
                  <input type="text" name="title" class="form-control form-control-sm" placeholder="Title"
                    value="{{ request()->input('title') }}">
                </div>
                <div class="form-group mr-1">
                  <input type="text" name="slug" class="form-control form-control-sm" placeholder="Slug"
                    value="{{ request()->input('slug') }}">
                </div>
                <div class="form-group mr-1">
                  <select class="form-control form-control-sm" name="type">
                    <option value="">--Type--</option>
                  </select>
                </div>
                <div class="form-group mr-1">
                  <select class="form-control form-control-sm" name="status">
                    <option value="">--Status--</option>
                    <option value="publish" @if (request()->input('status') == 'publish') selected @endif>publish</option>
                    <option value="private" @if (request()->input('status') == 'private') selected @endif>private</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-sm btn-default form-control form-control-sm">
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
              <div class="card-footer__right float-right" style="margin-bottom: -1rem;">
                {{ $contents->withQueryString(['status'])->links() }}
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
