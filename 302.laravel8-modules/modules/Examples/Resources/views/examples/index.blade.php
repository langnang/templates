@extends('examples::layouts.master')


@section('content')
  <ul>
    @foreach ($examples as $template)
      <li><a href="/examples/{{ basename($template) }}">{{ basename($template) }}</a></li>
    @endforeach
  </ul>
@endsection
