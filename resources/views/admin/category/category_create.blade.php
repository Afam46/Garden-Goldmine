@extends('adminlte::page')

@section('content_header')
    <h1>Add categories</h1>
@stop

@section('content')

<form action="{{route('categories.store')}}" method="POST">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label>Name</label>
        <input name="title" type="text" class="form-control" placeholder="Name">
        @error('title')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>

@stop