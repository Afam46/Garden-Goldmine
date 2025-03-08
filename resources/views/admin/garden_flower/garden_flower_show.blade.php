@extends('adminlte::page')

@section('content_header')
    <h1>{{$garden_flower->title}}</h1>
@stop

@section('content')

<div class="container">
  <div>
    <h3>ID</h3>
    <p>{{$garden_flower->id}}</p>

    <hr>

    <h3>Title</h3>
    <p>{{$garden_flower->title}}</p>

    <hr>

    
    <h3>User ID</h3>
    <p>{{$garden_flower->user_id}}</p>

    <hr>

    
    <h3>Stage</h3>
    <p>{{$garden_flower->stage}}</p>

    <hr>

    <h3>Description</h3>
    <p>{{$garden_flower->descrip}}</p>

    <hr>

    <h3>Price</h3>
    <p>{{$garden_flower->price}}</p>

    <hr>

    <h3>Category</h3>
    <p>{{$garden_flower->category->title}}</p>

    <hr>

    <h3>Image</h3>
    <img style="width: 25%" src="/storage/app/public/{{$garden_flower->img}}" alt="garden_flower don't have img">
  </div>
</div>

@stop