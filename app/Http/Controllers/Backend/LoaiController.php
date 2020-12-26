<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loai;
use Carbon\Carbon;
use Validator;
use Session;
use App\Http\Requests\LoaiCreateRequest;
use App\Http\Requests\LoaiUpdateRequest;
use Illuminate\Support\Facades\DB;

class LoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $dsloai = DB::table('cusc_loai')->paginate(config('app.pagelimit'));
//        $dsloai = DB::table('cusc_loai')->paginate(5);
//        $dsloai = Loai::all()->paginate(config('app.pagelimit'));
        $dsloai = Loai::paginate(config('app.pagelimit'));
       return view('backend.loai.index')->with('dsloai',$dsloai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoaiCreateRequest $request)
    {
        $ten = $request->l_ten;
        $trangthai = $request->l_trangthai;

        $mLoai = new Loai();
        $mLoai->l_ten = $ten;
        $mLoai->l_taoMoi = Carbon::now();
        $mLoai->l_capNhat = Carbon::now();
        $mLoai->l_trangThai = $trangthai;
        
        $mLoai->save();
        Session::flash('alert-info', 'Thêm loại thành công.');
        return redirect(route('admin.loai.index'));
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
        $loai = Loai::find($id);
        
        return view('backend.loai.edit')
            ->with('loai', $loai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LoaiUpdateRequest $request, $id)
    {
        $loai = Loai::find($id);
        
        $loai->l_ten = $request->l_ten;
        $loai->l_trangthai = $request->l_trangthai;
        $loai->l_capNhat = Carbon::now();
        
        $loai->save();

        Session::flash('alert-info', 'Cập nhật loại thành công.');
        return redirect()->route('admin.loai.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loai = Loai::find($id);
        $loai->delete();
        Session::flash('alert-info', 'Xóa loại thành công.');
        return redirect()->route('admin.loai.index');
    }
}
