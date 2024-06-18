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
                <input type="text" class="form-control form-control-sm" name='title'
                  value="{{ $content['title'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control form-control-sm" name='slug'
                  value="{{ $content['slug'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>Text</label>
                <textarea class="form-control form-control-sm" name='text' rows="3">{!! $content['text'] ?? '' !!}</textarea>

              </div>
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <div class="row">
                <div class="col mr-auto">
                  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                  <button type="button" class="btn btn-sm btn-warning">Release</button>
                </div>
                <div class="col col-auto">
                  <button type="button" class="btn btn-sm btn-secondary">Draft</button>
                  <button type="button" class="btn btn-sm btn-danger">Faker</button>
                </div>
              </div>
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
                      <div class="form-group form-group-sm col-md-3">
                        <input type="text" class="form-control form-control-sm"
                          name="fields[{{ $loop->index }}][name]" placeholder="Name" disabled
                          value="{{ $field['name'] }}">
                      </div>
                      <div class="form-group form-group-sm col-md-2">
                        <select class="form-control form-control-sm" name="fields[{{ $loop->index }}][type]"
                          placeholder="Type" disabled>
                          <option value="str_value" @if ($field['type'] == 'str_value') selected @endif>str</option>
                          <option value="int_value" @if ($field['type'] == 'int_value') selected @endif>int</option>
                          <option value="float_value" @if ($field['type'] == 'float_value') selected @endif>float</option>
                          <option value="text_value" @if ($field['type'] == 'text_value') selected @endif>text</option>
                          <option value="object_value" @if ($field['type'] == 'object_value') selected @endif>object</option>
                        </select>
                      </div>
                      <div class="form-group form-group-sm col-md-7">
                        @switch($field['type'])
                          @case('text_value')
                          @case('object_value')
                            <textarea class="form-control form-control-sm" name="fields[{{ $loop->index }}][value]" placeholder="Value" disabled
                              rows="1">{{ $field[$field['type']] ?? '' }}</textarea>
                          @break

                          @default
                            <input type="text" class="form-control form-control-sm"
                              name="fields[{{ $loop->index }}][value]" disabled placeholder="Value"
                              value="{{ $field[$field['type']] ?? '' }}">
                          @break
                        @endswitch
                      </div>
                    </div>
                  </div>
                  <div class="col-auto ml-auto">
                    <div class="btn-group form-control-sm p-0" role="group" aria-label="Basic example">
                      <button class="btn btn-primary" type="button" name="update-field" data-toggle="modal"
                        data-target="#exampleModal">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                      <button class="btn btn-danger" type="button" name="delete-field">
                        <i class="bi bi-patch-minus-fill"></i>
                      </button>
                    </div>
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
    <div>
      <div id="editor">
        {!! $content['text'] ?? '' !!}
      </div>
    </div>
  </section>

  <section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form></form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


  </section>
@endsection


@push('scripts')
  {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/ckeditor5@41.4.2/dist/browser/index.umd.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ckeditor5@41.4.2/dist/browser/index.min.css">
  <script>
    $(document).on('click', '[name="insert-field"]', function(e) {
      console.log(e, $(this))
    })
    $(document).on('click', '[name="delete-field"]', function(e) {
      console.log(e, $(this))
    })
  </script>
  <script>
    $(document).ready(() => {
      ckeditor5.ClassicEditor
        .create(document.querySelector('#editor'), {
          toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
          heading: {
            options: [{
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
              },
              {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
              },
              {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
              }
            ]
          }
        })
        .catch(error => {
          console.error(error);
        });
    })
  </script>
@endpush
