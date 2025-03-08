@extends('adminlte::page')

@section('content')

<div class="container mt-3">
  <div>
    <h3>ID</h3>
    <p>{{$user->id}}</p>

    <hr>

    <h3>Name</h3>
    <p>{{$user->name}}</p>

    <hr>

    <h3>Password</h3>
    <p>{{$user->password}}</p>

    <hr>

    <h3>Email</h3>
    <p>{{$user->email}}</p>

    <hr>

    <h3>Role</h3>
    <p>{{$user->role->role}}</p>
    
  </div>
</div>

@stop