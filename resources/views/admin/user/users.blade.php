@extends('adminlte::page')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

<a href="{{route('user.create')}}" class="btn btn-primary mb-3">Add</a>

<div class="col-12">
  <div class="card">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Balance</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->balance}}</td>
                <td>
                  <a href="{{route('user.show', $user->id)}}">
                    View
                  </a>
                  <a 
                    href="{{route('user.edit', $user->id)}}"
                    class="mr-1 ml-1">
                    Edit
                  </a>
                  <a href="{{route('user.delete', $user->id)}}">Delete</a>
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