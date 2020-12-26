@extends('backend.layout.master')
@section('title')
Thêm mới loại sản phẩm
@endsection
@section('feature-title')
THÊM MỚI LOẠI SẢN PHẨM
@endsection

@section('content')
<div class="body">
<form name="frmCreate" id="frmCreate" method="post" action="{{ route('admin.loai.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="l_ma">Tên loại sản phẩm</label><br>
        <input class="form-control" type="text" name="l_ten" id="l_ten" value="{{ old('l_ten') }}">
    </div>
    <div class="form-group">
        <label for="l_ma">Trạng thái</label><br>
        <select class="form-control" name="l_trangthai" id="l_trangthai">
            <option value="2" {{ old('l_trangthai') == '2' ? 'selected' : ''}}>Khả dụng</option>
            <option value="1" {{ old('l_trangthai') == '1' ? 'selected' : ''}}>Khóa</option>
            </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>

@endsection