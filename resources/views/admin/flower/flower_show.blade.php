@extends('adminlte::page')

@section('content_header')
    <h1>{{$flower->name}}</h1>
@stop

@section('content')

<div class="container">
  <div>
    <h3>ID</h3>
    <p>{{$flower->id}}</p>

    <hr>

    <h3>Title</h3>
    <p>{{$flower->title}}</p>

    <hr>

    <h3>Price</h3>
    <p>{{$flower->price}}</p>

    <hr>

    <h3>Category</h3>
    <p>{{$flower->category->title}}</p>

    <hr>

    <h3>Image</h3>
    <img style="width: 25%" src="/storage/app/public/{{$flower->img}}" alt="flower don't have img">
  </div>
</div>

@stop