@extends('layouts.master')
@section('title','Edit Designer')
@section('designers','active')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('designers.index') }}">Designers</a></li>
<li class="breadcrumb-item active">Edit Designers</li>
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('designers.update',$designer->id) }}" method="post" enctype="multipart/form-data">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label>Project</label>
          <label class="form-control">{{ $designer->projects->name }}</label>
        </div>
        <div class="form-group d-flex flex-column">
          <label for="exampleInputFile">File input</label>
          <input type="file" name="files[]" multiple>
          <label for="exampleInputFile">Files</label>
          <div class="form-group">
            @foreach($designer->projects->files as $data)
              @if($data->type == 'designer')
              <div class="card float-left mr-3" style="width: 10rem;">
                <i class="fas fa-file-image col-12 pt-3 pl-4" style="font-size: 130px;"></i>
                <div class="card-body">
                  <h5 class="card-text">{{ $data->name }}</h5>
                   <a href="{{ url('storage/'.$data->name) }}" class="btn btn-primary">Preview</a>
                   <button type="button" name="button{{ $data->id }}" id="{{ $data->id }}" onclick="deleteFile(this)" class="btn btn-outline-danger">Delete</button>
                </div>
              </div>
              @endif
            @endforeach
          </div>
        </div>
        <label>Items</label>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Item</th>
              <th>Qty</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="tableItem">
            @isset($designer->goods)
            @foreach($designer->goods as $key => $data)
              <tr id="row{{ $data->id }}">
                <td>
                  <label class="form-control">{{ $data->name }}</label>
                  <input type="hidden" name="item{{ $key }}" class="form-control" list="dataGoods" value="{{ old('item.$key',$data->name) }}">

                </td>
                <td>
                  <div class="input-group mb-2">
                    <input type="number" class="form-control" name="qty{{ $key }}" onkeyup="calculate(this)" id="qty{{ $key }}" value="{{ old('qty.$key',$data->pivot->qty) }}">
                    <div class="input-group-prepend">
                      <label class="input-group-text">{{ $data->units->name }}</label>
                      <input type="hidden" name="unit{{ $key }}" class="input-group-text" id="unit{{ $key }}" list="dataUnits" value="{{ old('unit.$key',$data->units->name) }}">
                    </div>
                  </div>
                </td>
                <td>
                  <input type="hidden" name="designer{{$key}}" id="designer" value="{{ $designer->id }}">
                  <button type="button" class="btn btn-danger btn-sm" id="button{{ $data->id }}" name="button{{ $data->id }}" onclick="deleteRow(this)" value="{{ $data->id }}">X</button>
                </td>
              </tr>
            @endforeach
            @endisset
          </tbody>
        </table>
        <button type="button" name="button" class="btn btn-secondary" onclick="addRow()">Add Item</button>
        <div class="form-group row">
          <div class="col-12">
            <input type="hidden" name="totalItem" id="totalItem" value="{{ $key+1 }}">
            <button type="submit" class="btn btn-success col-12">Submit</button>
          </div>
        </div>
      </div>
  </div>
</form>
<datalist id="dataGoods">
  @foreach($good as $data)
  <option value="{{ $data->name }}">
  @endforeach
</datalist>
<datalist id="dataUnits">
  @foreach($unit as $data)
  <option value="{{ $data->name }}">
  @endforeach
</datalist>
@endsection
@section('script')
<script type="text/javascript">
var i = {{ $key+1 }};
function addRow() {
  $('#tableItem').append("<tr><td><input type='text' name='item" + i + "' class='form-control' placeholder='@foreach($good as $key => $data)@if($key > 0),  @endif{{ $data->name }}@endforeach' list='dataGoods' onchange='getGoodUnit(this)'></td><td><div class='input-group mb-2'><input type='number' class='form-control' name='qty" + i + "' placeholder='1' onkeyup='calculate(this)' id='qty" + i + "'><div class='input-group-prepend'><input type='text' name='unit" + i + "' class='input-group-text' placeholder='@foreach($unit as $key => $data)@if($key > 0),  @endif{{ $data->name }}@endforeach' id='unit" + i + "'></div></div></td><td><button type='button' class='btn btn-danger btn-sm' id='button" + i + "' name='button" + i + "' onclick='deleteRow(this)'>X</button></td></tr>");
  i+=1;
  $('#totalItem').val(i);
}
function deleteRow(id) {
  $.post("{{ route('deleteDesignerGood') }}",{id:id.value,designer:$('#designer').val(),_token:'{{ Session::token() }}'},function(data){
    console.log(id);
    var row = id.name.substring(6,id.name.length);
    $('#row'+row).remove();
  });
}
function deleteFile(id) {
  $.post("{{ route('deleteFile') }}",{id:id.id, _token:'{{ Session::token() }}'},function(data){
    if (data == 1){
      window.location.reload(); // This is not jQuery but simple plain ol' JS
    }
  });
}
function getGoodUnit(id) {
  var row = id.name.substring(id.name.length-1,id.name.length);
  $.post("{{ route('getGoodUnit') }}",{id:id.value, _token:'{{ Session::token() }}'},function(data){
      $('#unit'+row).val(data);
      $('#unit'+row).attr('readonly','true');
  });
}
</script>
@endsection
