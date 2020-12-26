<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loai;
use App\SanPham;
class ExampleController extends Controller
{
    public function getDanhSachLoai(){
        $danhsachloai = Loai::all();
        
        return view('page.danhsachloai')
        ->with('ds_loai', $danhsachloai);
    }
    public function getDanhSachSanPham(){
        $danhsachsp = SanPham::all();
        
        return view('page.danhsachsanpham')
        ->with('ds_sp', $danhsachsp);
    }
    public function xinchao(){
        
        $data_all = Loai::all();
        print_r($data_all);
        $hoten = 'Biện Công Nhựt Trường';
        $masv = '1111358';
        $dadangnhap = 0;
        $gioitinh = 1;
        
        $dulieumauJSON = <<<EOT
        [{
            "id": 1,
            "first_name": "Kimberly",
            "last_name": "Eardley",
            "email": "keardley0@yale.edu",
            "gender": "Female",
            "ip_address": "78.107.99.105"
          }, {
            "id": 2,
            "first_name": "Harriette",
            "last_name": "Fiddler",
            "email": "hfiddler1@wix.com",
            "gender": "Female",
            "ip_address": "91.61.112.43"
          }, {
            "id": 3,
            "first_name": "Madelaine",
            "last_name": "Windous",
            "email": "mwindous2@webmd.com",
            "gender": "Female",
            "ip_address": "79.56.244.108"
          }, {
            "id": 4,
            "first_name": "Mitch",
            "last_name": "Bainton",
            "email": "mbainton3@networksolutions.com",
            "gender": "Male",
            "ip_address": "185.75.121.226"
          }, {
            "id": 5,
            "first_name": "Kettie",
            "last_name": "Antos",
            "email": "kantos4@ovh.net",
            "gender": "Female",
            "ip_address": "62.52.219.131"
          }]
EOT;
        
        // Chuyển $dulieumau từ JSON string -> Object
        $data = json_decode($dulieumauJSON);
        return view('page.xinchao')
        ->with('name',$hoten)
        ->with('maso',$masv)
        ->with('dadangnhap',$dadangnhap)
        ->with('data',$data)
                ;
    }
    public function tambiet(){
        $hoten = 'Biện Công Nhựt Trường';
        $masv = '1111358';
        return view('page.tambiet')
            ->with('name',$hoten)
            ->with('maso',$masv)
                ;
    }
    
}
