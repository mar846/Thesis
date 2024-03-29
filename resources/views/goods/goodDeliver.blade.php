@extends('layouts.master')
@section('title','Good Deliver')
@section('products','active')
@section('goods','active')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('goods.index') }}">Goods</a></li>
<li class="breadcrumb-item active">Good Deliver</li>
@endsection
@section('content')
<form action="{{ url('goodDeliverSearch') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group row">
   <label class="col-sm-2">Sales Order</label>
   <div class="col-sm-10">
     <input type="text" name="so" class="form-control @error('so') is-invalid @enderror" id="so" placeholder="Sales Order" value="{{ old('so') }}">
     @error('so')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
   </div>
 </div>
   <button type="submit" class="btn btn-success col-sm-10 offset-sm-2" name="button">Search</button>
</form>
@isset($sale)
<div class="row">
  <h5 class="col-sm-2">Sales Order</h5>
  <p class="col-sm-10 col-form-label">{{ $sale->so }}</p>
</div>
<form action="{{ url('goodDeliverFinish') }}" method="post">
  {{ csrf_field() }}
  <table class="table table-hover my-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Item</th>
        <th>QTY</th>
        <th>Receipt</th>
        <th>Memo</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sale->goods as $key => $data)
      <tr>
        <td>
          {{ $data->id }}
          <input type="hidden" name="item{{ $key }}" value="{{ $data->id }}" readonly>
        </td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->pivot->qty }} {{ $data->units->name }}</td>
        <td>
          <div class="input-group mb-2 mr-sm-2">
            <input type="text" class="form-control" name="qty{{ $key }}" placeholder="QTY">
            <div class="input-group-prepend">
              <div class="input-group-text">{{ $data->units->name }}</div>
            </div>
          </div>
        </td>
        <td><input type="text" class="form-control" name="memo{{ $key }}"></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <input type="hidden" name="totalItem" value="{{ $key }}">
  <input type="hidden" name="saleID" value="{{ $sale->id }}">
  <button type="submit" class="btn btn-outline-success col-12" name="button">Submit</button>
</form>
@endisset
@endsection
