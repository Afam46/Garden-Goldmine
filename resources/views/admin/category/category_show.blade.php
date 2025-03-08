@extends('adminlte::page')

@section('content')

<div class="container mt-3">
  <div>
    <h3>ID</h3>
    <p>{{$category->id}}</p>

    <hr>

    <h3>Name</h3>
    <p>{{$category->title}}</p>

    <hr>

    <h3>Flowers</h3>
    @foreach ($flowers as $flower)
      <div class="d-flex">
        <h5 class="ml-3">ID:</h5>
        <p class="ml-2">{{$flower->id}}</p>
        <h5 class="ml-2">| Title:</h5>
        <p class="ml-2">{{$flower->title}}</p> 
      </div>
      <hr>
    @endforeach
  </div>
</div>

@stop