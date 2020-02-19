@extends('layouts.master')
@section('title','Add Company')
@section('companies','active')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
<li class="breadcrumb-item active">Add Company</li>
@endsection
@section('content')
@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif
<div class="">
  <form action="{{ route('companies.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="name">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Type</label>
      <div class="col-sm-10">
        <select class="form-control" name="type">
          <option value="supplier">Supplier</option>
          <option value="costumer">Costumer</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Branch</label>
      <div class="col-sm-10">
        <input name="branch" class="form-control">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <textarea name="address" class="form-control" rows="8" cols="80"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Phone</label>
      <div class="col-sm-10">
        <input type="text" name="phone" class="form-control">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-12 text-right">
        <button type="submit" class="btn btn-success" name="button">Add</button>
      </div>
    </div>
  </form>
</div>
@endsection