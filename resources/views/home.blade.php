@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')

<h3>Home</h3>

@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$userCount}}</h3>

          <p>Users</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="{{route('users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$flowerCount}}</h3>

          <p>Flowers</p>
        </div>
        <div class="icon">
          <i class="far fa-fw fa-file"></i>
        </div>
        <a href="{{route('flowers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{$categoryCount}}</h3>
  
            <p>Categories</p>
          </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
        <a href="{{route('categories')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
@stop