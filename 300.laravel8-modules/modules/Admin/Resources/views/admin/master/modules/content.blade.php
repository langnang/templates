@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name='title' value="{{ $detail->title }}">
            </div>
            <div class="form-group">
              <label>Slug</label>
              <input type="text" class="form-control" name='slug' value="{{ $detail->slug }}">
            </div>
            <div class="form-group">
              <label>Text</label>
              <textarea class="form-control" name='text' rows="3">{{ $detail->text }}</textarea>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
