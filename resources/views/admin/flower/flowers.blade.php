@extends('adminlte::page')

@section('content_header')
    <h1>Flowers</h1>
@stop

@section('content')

<a href="{{route('flower.create')}}" class="btn btn-primary mb-3">Add</a>

<div class="col-12">
    <div class="card">
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Category</th>
              <th>Price</th>
              <th>Use time water</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($flowers as $flower)
                <tr>
                  <td>{{$flower->id}}</td>
                  <td>{{$flower->title}}</td>
                  <td>{{$flower->category->title}}</td>
                  <td>{{$flower->price}}</td>
                  <td>{{$flower->use_time_water}}</td>
                  <td>
                    <a href="{{route('flower.show', $flower->id)}}">
                      View
                    </a>
                    <a 
                      href="{{route('flower.edit', $flower->id)}}"
                      class="mr-1 ml-1">
                      Edit
                    </a>
                    <a href="{{route('flower.delete', $flower->id)}}">Delete</a>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}">
@stop