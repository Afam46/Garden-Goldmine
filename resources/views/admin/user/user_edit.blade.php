@extends('adminlte::page')

@section('content_header')
    <h1>Update user</h1>
@stop

@section('content')

<form action="{{route('user.update', $user->id)}}" method="POST">
  @csrf
    <div class="card-body">
      <div class="form-group">
        <label>Name</label>
        <input name="name" type="text" class="form-control"
        placeholder="Name" value="{{$user->name}}">
        @error('name')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
      <div class="form-group">
        <label>Email</label>
        <input name="email" type="email" class="form-control"
        placeholder="email" value="{{$user->email}}">
        @error('email')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input name="password" type="text" class="form-control"
        placeholder="password" value="{{$user->password}}">
        @error('password')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label>Balance</label>
        <input name="balance" type="number" class="form-control"
        placeholder="Balance" value="{{$user->balance}}">
        @error('balance')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
        <label>Roles</label>
        <select name="role_id" class="form-control mb-3">
          @foreach ($roles as $role)
            <option value="{{$role->id}}">{{$role->role}}</option>
          @endforeach
        </select>
        @error('role_id')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>

@stop