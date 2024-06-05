@extends('terminal::layouts.master')
@section('content')
  <form action="" method="post">
    @csrf
    <input type="text" name="terminal" value="{{ request()->input('terminal') }}" style="width: 100%; font-size: 1.6rem;">
  </form>
  <textarea name="" id="" cols="30" rows="10" readonly
    style="width: 100%; resize: vertical; font-size: 1rem;">{{ $output }}</textarea>
  {{-- {!! $output !!}. --}}
  {{-- {!! Str::markdown($output) !!} --}}
@endsection
