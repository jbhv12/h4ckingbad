TODO:do some ui. display more info abt problem
@extends('layouts.app')
<div>
@section('content')
  @foreach ($problems as $problem)
  <div class="container">
      <a href="/problems/{{$problem->id}}">
      {{$problem -> name}} </a>
	{{$problem -> points}}
  </div>
  @endforeach
</div>
@endsection
