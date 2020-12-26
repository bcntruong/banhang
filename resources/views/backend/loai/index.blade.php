@extends('backend.layout.master')
@section('title')
Danh sách Loại sản phẩm
@endsection
@section('feature-title')
DANH SÁCH LOẠI SẢN PHẨM
@endsection

@section('content')
<a href="{{ route('admin.loai.create') }}" class="btn btn-primary">Thêm mới</a>
<br><br>

<table class="table table-striped table-bordered">
    <!--<thead>-->
        <tr>
            <th class="text-center table-primary">STT</th>
            <th class="text-center table-primary">Mã loại</th>
            <th class="text-center table-primary">Tên loại</th>
            <th class="text-center table-primary">Ngày tạo</th>
            <th class="text-center table-primary">Ngày cập nhật</th>
            <th class="text-center table-primary">Trạng thái</th>
            <th class="text-center table-primary">Chức năng</th>
        </tr>
    <!--</thead>-->
    <tbody>
        <?php
        $stt = $dsloai->firstItem();
        
        ?>
        @foreach($dsloai as $v)
        <?php print_r($v->get123); ?>
        <tr>
            <td align="center" ><b>{{ $stt++ }}</b></td>
            <td>{{ $v->l_ma }}</td>
            <td>{{ $v->l_ten }}</td>
            <td>{{ $v->l_taoMoi }}</td>
            <td>{{ $v->l_capNhat }}</td>
            <td>@if($v->l_trangThai == 2) Khả dụng @else Khóa @endif</td>
            <td align="center">
                <form name="frmDelete" method="post" class="frmDelete" action="{{ route('admin.loai.destroy', ['id' => $v->l_ma]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <a class="btn btn-success" href="{{ route('admin.loai.edit', ['id' => $v->l_ma]) }}">Sửa</a> 
                    
                    <input type="button" class="btn btn-danger btn_delete" value="Xóa" 
                           
                    >
                
                </form>                            
            </td>
                                        
            
        </tr>
        @endforeach
    </tbody>
</table>

<?php $paginator = $dsloai; ?>
{{ $paginator->render("pagination::bootstrap-4") }}
@endsection

@section('custom-scripts')
<script>
    $(".btn_delete").click(function(){
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Khi xóa sẽ không thể phục hồi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Vâng, sẽ xóa'
          }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
//                $.ajax({
//                    type:$(this).parent().attr('method'),
//                    url: $(this).parent().attr('action'),
//                    data: $(this).parent().serialize(),
//                    success: function(data){
//                        location.href = '{{ route('admin.loai.index') }}';
//                    }
//                });

            }
          });
    });
</script>
@endsection