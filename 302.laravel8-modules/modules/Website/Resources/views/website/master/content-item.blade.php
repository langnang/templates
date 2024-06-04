@extends($config['slug'] . '::layouts.' . $config['layout'])

{{-- @php var_dump($content); @endphp --}}
@php $module_field = $content['fields']['module_'.$config['slug']]; @endphp
{{-- @php var_dump($module_field); @endphp --}}

@section('content')
  <div class="container d-flex align-items-center" style="height: 100vh;">
    @isset($content)
      <div class="row justify-content-center">
        <div class="col-8">
          <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
              <div class="media">
                <img src="{{ !empty($module_field['value']['ico']) ? $module_field['value']['ico'] : 'holder.js/60x60' }}"
                  class="align-self-center mr-3 lazy-load" alt="...">

                <div class="media-body">
                  <h5 class="mt-0">{{ $content['title'] }}</h5>
                  <p class="mb-0">{{ $module_field['description'] ?? '' }}</p>
                </div>
              </div>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
    @endisset
  </div>
@endsection
