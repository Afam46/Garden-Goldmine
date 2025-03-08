@extends('adminlte::page')

@section('content_header')
    <h1>Garden Flowers</h1>
@stop

@section('content')

<a href="{{route('garden_flower.create')}}" class="btn btn-primary mb-3">Add</a>

<div class="col-12">
    <div class="card">
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Category</th>
              <th>User ID</th>
              <th>Stage</th>
              <th>Price</th>
              <th>Use time water</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($garden_flowers as $garden_flower)
                <tr>
                  <td>{{$garden_flower->id}}</td>
                  <td>{{$garden_flower->title}}</td>
                  <td>{{$garden_flower->category->title}}</td>
                  <td>{{$garden_flower->user_id}}</td>
                  <td>{{$garden_flower->stage}}</td>
                  <td>{{$garden_flower->price}}</td>
                  <td>{{$garden_flower->use_time_water}}</td>
                  <td>
                    <a href="{{route('garden_flower.show', $garden_flower->id)}}">
                      View
                    </a>
                    <a 
                      href="{{route('garden_flower.edit', $garden_flower->id)}}"
                      class="mr-1 ml-1">
                      Edit
                    </a>
                    <a href="{{route('garden_flower.delete', $garden_flower->id)}}">Delete</a>
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