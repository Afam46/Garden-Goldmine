@extends('adminlte::page')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')

<a href="{{route('category.create')}}" class="btn btn-primary mb-3">Add</a>

<div class="col-12">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
              <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td>
                  <a href="{{route('category.show', $category->id)}}">
                    View
                  </a>
                  <a 
                    href="{{route('category.edit', $category->id)}}"
                    class="mr-1 ml-1">
                    Edit
                  </a>
                  <a href="{{route('category.delete', $category->id)}}">Delete</a>
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