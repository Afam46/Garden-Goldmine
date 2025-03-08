@extends('adminlte::page')

@section('content_header')
    <h1>Update categories</h1>
@stop

@section('content')

<form action="{{route('category.update', $category->id)}}" method="POST">
  @csrf
    <div class="card-body">
      <div class="form-group">
        <label>Name</label>
        <input name="title" type="text" class="form-control"
        placeholder="Name" value="{{$category->title}}">
        @error('title')
          <div class="mt-3 alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@stop