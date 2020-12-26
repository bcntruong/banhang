<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SanPham;
use App\Loai;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use File;
use App\HinhAnh;
use App\Http\Requests\SanPhamCreateRequest;
use Storage;

use App\Exports\SanPhamExport;
use Maatwebsite\Excel\Facades\Excel as Excel;

use Barryvdh\DomPDF\Facade as PDF;
class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request);
//        $dssp = DB::table('cusc_sanpham')->paginate(config('app.pagelimit'));
        $dssp = SanPham::paginate(config('app.pagelimit'));
        return view('backend.sanpham.index')
            ->with('danhsachsanpham', $dssp);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dsloai = Loai::all();
        return view('backend.sanpham.create')
        ->with('danhsachloai', $dsloai);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SanPhamCreateRequest $request)
    {
//        $validation = $request->validate([
//            'sp_hinh' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
//            // Cú pháp dùng upload nhiều file
//            'sp_hinhanhlienquan.*' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
//        ]);
        $sp = new SanPham();
        $sp->sp_ten = $request->sp_ten;
        $sp->sp_giaGoc = $request->sp_giaGoc;
        $sp->sp_giaBan = $request->sp_giaBan;
        $sp->sp_thongTin = $request->sp_thongTin;
        $sp->sp_danhGia = $request->sp_danhGia;
        $sp->sp_taoMoi = Carbon::now();
        $sp->sp_capNhat = Carbon::now();
        $sp->sp_trangThai = $request->sp_trangThai;
        $sp->l_ma = $request->l_ma;

        if($request->hasFile('sp_hinh'))
        {
            $file = $request->sp_hinh;
            //lấy đuôi file
            $ext = File::extension($file->getClientOriginalName());
            // Lưu tên hình vào column sp_hinh
//            $sp->sp_hinh = $file->getClientOriginalName();
            $sp->sp_hinh = 'hinh_'.time().".$ext";

            // Chép file vào thư mục "photos"
            $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
        }
        
        $sp->save();
        // Lưu hình ảnh liên quan
        if($request->hasFile('sp_hinhanhlienquan')) {
//            $files = $request->sp_hinhanhlienquan;
            // duyệt từng ảnh và thực hiện lưu
            foreach ($request->sp_hinhanhlienquan as $index => $file) {
                //lấy đuôi file
                $ext = File::extension($file->getClientOriginalName());
                $file->storeAs('public/photos', 'hinh'.($index+1).'_'.time().'.'.$ext);

                // Tạo đối tưọng HinhAnh
                $hinhAnh = new HinhAnh();
                $hinhAnh->sp_ma = $sp->sp_ma;
                $hinhAnh->ha_stt = ($index + 1);
                $hinhAnh->ha_ten = 'hinh'.($index+1).'_'.time().'.'.$ext;
                $hinhAnh->save();
            }
        }

        Session::flash('alert-info', 'Thêm sản phẩm thành công.');
        return redirect(route('admin.sanpham.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Sử dụng Eloquent Model để truy vấn dữ liệu 
        $sp = SanPham::where("sp_ma", $id)->first(); 
        $ds_loai = Loai::all(); 

        // Đường dẫn đến view được quy định như sau: <FolderName>.<ViewName> 
        // Mặc định đường dẫn gốc của method view() là thư mục `resources/views` 
        // Hiển thị view `backend.sanpham.edit` 
        return view('backend.sanpham.edit')
            // với dữ liệu truyền từ Controller qua View, được đặt tên là `sp` và `danhsachloai`
            ->with('sp', $sp)
            ->with('danhsachloai', $ds_loai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Bổ sung ràng buộc Validate
//        $validation = $request->validate([
//            'sp_hinh' => 'file|image|mimes:jpeg,png,gif,webp|max:2048',
//        ]);

//        dd($request);
        // Tìm object Sản phẩm theo khóa chính
        $sp = SanPham::where("sp_ma",  $id)->first();
        $sp->sp_ten = $request->sp_ten;
        $sp->sp_giaGoc = $request->sp_giaGoc;
        $sp->sp_giaBan = $request->sp_giaBan;
        $sp->sp_thongTin = $request->sp_thongTin;
        $sp->sp_danhGia = $request->sp_danhGia;
        $sp->sp_taoMoi = $request->sp_taoMoi;
        $sp->sp_capNhat = $request->sp_capNhat;
        $sp->sp_trangThai = $request->sp_trangThai;
        $sp->l_ma = $request->l_ma;

        // Kiểm tra xem người dùng có upload hình ảnh Đại diện hay không?
        if($request->hasFile('sp_hinh'))
        {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/photos/' . $sp->sp_hinh);
            // Upload hình mới
            // Lưu tên hình vào column sp_hinh
            $file = $request->sp_hinh;
            //lấy đuôi file
            $ext = File::extension($file->getClientOriginalName());
            // Lưu tên hình vào column sp_hinh
//            $sp->sp_hinh = $file->getClientOriginalName();
            $sp->sp_hinh = 'hinh_'.time().".$ext";

            // Chép file vào thư mục "photos"
            $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
        }
        $sp->save();

        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Cập nhật thành công!!!');

        // Điều hướng về trang index
        return redirect()->route('admin.sanpham.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tìm object Sản phẩm theo khóa chính
        $sp = SanPham::where("sp_ma",  $id)->first();

        // Nếu tìm thấy được sản phẩm thì tiến hành thao tác DELETE
        if(empty($sp) == false)
        {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/photos/' . $sp->sp_hinh);
        }
        $sp->delete();

        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Xóa sản phẩm thành công ^^~!!!');

        // Điều hướng về trang index
        return redirect()->route('admin.sanpham.index');
    }
    
    public function print(){
        $ds_sanpham = Sanpham::all();
        $ds_loai    = Loai::all();

        return view('backend.sanpham.print')
        ->with('danhsachsanpham', $ds_sanpham)
        ->with('danhsachloai', $ds_loai);
    }
    
    /**
    * Action xuất Excel
    */
   public function excel() 
   {
       /* Code dành cho việc debug
       - Khi debug cần hiển thị view để xem trước khi Export Excel
       */
       // $ds_sanpham = Sanpham::all();
       // $ds_loai    = Loai::all();
       // return view('backend.sanpham.excel')
       //     ->with('danhsachsanpham', $ds_sanpham)
       //     ->with('danhsachloai', $ds_loai);

       return Excel::download(new SanPhamExport, 'danhsachsanpham.xlsx');
   }
   
   public function pdf() 
   {
       $ds_sanpham = Sanpham::all();
       $ds_loai    = Loai::all();
       $data = [
           'danhsachsanpham' => $ds_sanpham,
           'danhsachloai'    => $ds_loai,
       ];

       /* Code dành cho việc debug
       - Khi debug cần hiển thị view để xem trước khi Export PDF
       */
//        return view('backend.sanpham.pdf')
//            ->with('danhsachsanpham', $ds_sanpham)
//            ->with('danhsachloai', $ds_loai);
       $pdf = PDF::loadView('backend.sanpham.pdf', $data);
       return $pdf->download('DanhMucSanPham.pdf');
   }
}
