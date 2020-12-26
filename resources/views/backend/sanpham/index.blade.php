@extends('backend.layout.master')

@section('title')
Danh sách sản phẩm
@endsection

@section('feature-title')
DANH SÁCH SẢN PHẨM  
@endsection

@section('feature-description')
Danh sách các Sản phẩm có trong Hệ thống.
@endsection

@section('content')
<a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary">Thêm mới</a>
<a href="{{ route('admin.sanpham.print') }}" class="btn btn-primary" target="_blank">In ấn</a>
<a href="{{ route('admin.sanpham.excel') }}" class="btn btn-primary">Xuất Excel</a>
<a href="{{ route('admin.sanpham.pdf') }}" class="btn btn-primary">Xuất PDF</a>
<br><br>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center table-primary">STT</th>
            <th class="text-center table-primary">Hình</th>
            <th class="text-center table-primary">Mã sản phẩm</th>
            <th class="text-center table-primary">Tên sản phẩm</th>
            <th class="text-center table-primary">Giá gốc</th>
            <th class="text-center table-primary">Loại sản phẩm</th>
            <th class="text-center table-primary">Trạng thái</th>
            <th class="text-center table-primary">Chức năng</th>
        </tr>
            
    </thead>
    <tbody>
        <?php
        $stt = 1;
        ?>
        @foreach($danhsachsanpham as $sp)
        <tr>
            <td align="center" ><b>{{ $loop->index + 1 }}</b></td>
            <td>
                <img src="{{ asset('storage/photos/' . $sp->sp_hinh) }}" class="sanpham-thumbnail" />
            </td>
            <td>{{ $sp->sp_ma }}</td>
            <td>{{ $sp->sp_ten }}</td>
            <td>{{ $sp->sp_giaGoc }}</td>
            <td>{{ $sp->loaisanpham->l_ten}}</td>
            <td>@if($sp->sp_trangThai == 2) Khả dụng @else Khóa @endif </td>
                
            <td align="center">
                <a href="{{ route('admin.sanpham.edit', ['id' => $sp->sp_ma]) }}" class="btn btn-success">Sửa</a>
                <form class="d-inline" method="post" action="{{ route('admin.sanpham.destroy', ['id' => $sp->sp_ma]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button class="btn btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        <?php
        $stt++;
        ?>
        @endforeach
    </tbody>
</table>
{{ $danhsachsanpham->links() }}
@endsection
