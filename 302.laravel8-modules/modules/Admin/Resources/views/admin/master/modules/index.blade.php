@extends($config['slug'] . '::layouts.' . $config['layout'])

@section('content')
  @if (View::exists($moduleConfig['slug'] . '::' . $config['slug'] . '.index'))
    @include($moduleConfig['slug'] . '::' . $config['slug'] . '.index')
  @endif
@endsection
