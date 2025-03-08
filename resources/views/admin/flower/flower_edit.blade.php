@extends('adminlte::page')

@section('content_header')
    <h1>Update flower</h1>
@stop

@section('content')

<form action="{{route('flower.update', $flower->id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Title</label>
      <input name="title" type="text" class="form-control" placeholder="Title"
      value="{{$flower->title}}">
      @error('title')
        <div class="mt-3 alert alert-danger">{{ $message }}</div>
      @enderror
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea name="descrip" class="form-control" >{{$flower->descrip}}</textarea>
    @error('description')
      <div class="mt-3 alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label>Price</label>
    <input name="price" type="text" class="form-control" placeholder="Price"
    value="{{$flower->price}}">
    @error('price')
        <div class="mt-3 alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label>Use time to water</label>
    <input name="use_time_water" type="number" class="form-control" placeholder="Time"
    value="{{$flower->use_time_water}}">
    @error('use_time_water')
        <div class="mt-3 alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label>Image</label>
    <div class="input-group">
      <div class="custom-file">
        <input name="img" type="file" class="custom-file-input">
        <label class="custom-file-label">Img</label>
      </div>
      <div class="input-group-append">
        <span class="input-group-text">Upload</span>
      </div>
    </div>
  </div>
  <label>Category</label>
  <select name="category_id" class="form-control mb-3">
    @foreach ($categories as $category)
      <option value="{{$category->id}}">{{$category->title}}</option>
    @endforeach
  </select>
  @error('category_id')
    <div class="mt-3 alert alert-danger">{{ $message }}</div>
  @enderror
  <button type="submit" class="btn btn-primary">Update</button>
</form>

@stop