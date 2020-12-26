@extends('backend.layout.master')
@section('title')
Thêm mới loại sản phẩm
@endsection
@section('feature-title')
CẬP NHẬT LOẠI SẢN PHẨM
@endsection

@section('content')
<div class="body">
<form name="frmUpdate" id="frmUpdate" method="post" action="{{ route('admin.loai.update', ['id' => $loai->l_ma]) }}" >
    {{ csrf_field() }}
    <?php
    $value_loai = !is_null(old('l_ten')) ? old('l_ten') : $loai->l_ten;
    $value_trangthai = !is_null(old('l_trangthai')) ? old('l_trangthai') : $loai->l_trangThai;
//    dd($loai);
    ?>
    <input type="hidden" name="_method" value="PUT" />
    <input type="hidden" name="l_ma" value="{{$loai->l_ma}}" />
    <div class="form-group">
        <label for="l_ma">Tên loại sản phẩm</label><br>
        <input class="form-control" type="text" name="l_ten" id="l_ten" value="{{$value_loai}}">
    </div>
    <div class="form-group">
        <label for="l_ma">Trạng thái</label><br>
        <select class="form-control" name="l_trangthai" id="l_trangthai">
            <option value="2" {{ $value_trangthai == '2' ? 'selected' : ''}}>Khả dụng</option>
            <option value="1" {{ $value_trangthai == '1' ? 'selected' : ''}}>Khóa</option>
            </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Lưu</button>

</form>
</div>
@endsection