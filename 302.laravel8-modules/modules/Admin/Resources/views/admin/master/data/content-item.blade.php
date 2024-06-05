@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  <section class="content">
    <div class="container-fluid">
      <form class="row" method="post">
        @csrf
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Content</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name='title' value="{{ $content['title'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name='slug' value="{{ $content['slug'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>Text</label>
                <textarea class="form-control" name='text' rows="3">{{ $content['text'] ?? '' }}</textarea>
              </div>
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col">
                  <h3 class="card-title">Fields</h3>
                </div>
                <div class="col-auto ml-auto">
                  <button class="btn btn-primary" type="button" name="insert-field">
                    <i class="bi bi-patch-plus-fill "></i>
                  </button>
                </div>
              </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              @foreach ($content['fields'] ?? [] as $field)
                <div class="form-row">
                  <div class="col">
                    <div class="row">
                      <input type="hidden" name="fields[{{ $loop->index }}][action]" value="update">
                      <div class="form-group col-md-3">
                        <input type="text" class="form-control" name="fields[{{ $loop->index }}][name]"
                          placeholder="Name" value="{{ $field['name'] }}">
                      </div>
                      <div class="form-group col-md-2">
                        <select class="form-control" name="fields[{{ $loop->index }}][type]" placeholder="Type">
                          <option value="str_value" @if ($field['type'] == 'str_value') selected @endif>str</option>
                          <option value="int_value" @if ($field['type'] == 'int_value') selected @endif>int</option>
                          <option value="float_value" @if ($field['type'] == 'float_value') selected @endif>float</option>
                          <option value="text_value" @if ($field['type'] == 'text_value') selected @endif>text</option>
                          <option value="object_value" @if ($field['type'] == 'object_value') selected @endif>object</option>
                        </select>
                      </div>
                      <div class="form-group col-md-7">
                        @switch($field['type'])
                          @case('text_value')
                          @case('object_value')
                            <textarea class="form-control" name="fields[{{ $loop->index }}][value]" placeholder="Value" rows="1">{{ $field[$field['type']] ?? '' }}</textarea>
                          @break

                          @default
                            <input type="text" class="form-control" name="fields[{{ $loop->index }}][value]"
                              placeholder="Value" value="{{ $field[$field['type']] ?? '' }}">
                          @break
                        @endswitch
                      </div>
                    </div>
                  </div>
                  <div class="col-auto ml-auto">
                    <button class="btn btn-danger form-control" type="button" name="delete-field">
                      <i class="bi bi-patch-minus-fill "></i>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categories</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tags</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Links</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">

            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </form>

    </div>
  </section>
@endsection


@push('scripts')
  <script>
    $(document).on('click', '[name="insert-field"]', function(e) {
      console.log(e, $(this))
    })
    $(document).on('click', '[name="delete-field"]', function(e) {
      console.log(e, $(this))
    })
  </script>
@endpush
