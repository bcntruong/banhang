<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Loai;
use Illuminate\Validation\Factory;
class SanPhamCreateRequest extends FormRequest
{
//    public function __construct(Factory $factory)
//    {
//        $name = 'checkuniquename';
//        $test = function ($attribute, $value, $parameter) {
//            $infoloai = DB::select(' select l_ma from cusc_loai where l_ten = :ten and l_ma <> :ma ', ['ten' => $value, 'ma' => $parameter[0]]);
//
//            if(count($infoloai) > 0) {
//                return false;
//            } else {
//                return true;
//            }
//        };
//        $errorMessage = 'Tên loại đã tồn tại. Vui lòng nhập tên loại khác.';
//
//        $factory->extend($name, $test, $errorMessage);
//    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'l_ma' => "required|exists:cusc_loai,l_ma",
            'sp_ten' => "required|min:3|max:250|unique:cusc_sanpham", //tên table cusc_chude
            'sp_giaGoc' => "required|numeric|between:0,999999999", //tên table cusc_chude
            'sp_giaBan' => "required|numeric|between:0,999999999", //tên table cusc_chude
        ];
    }

    public function messages(){
        return [
            'l_ma.required' => 'Vui lòng chọn loại sản phẩm.',
            'l_ma.exists' => 'Loại sản phẩm không tồn tại.',
            'sp_ten.required' => 'Vui lòng nhập tên sản phẩm',
            'sp_ten.min' => 'Tên sản phẩm ít nhất phải 3 ký tự trở lên',
            'sp_ten.max' => 'Tên sản phẩm tối đa 250 ký tự',
            'sp_ten.unique' => ' Tên sản phẩm này đã tồn tại. Vui lòng nhập tên khác',
            'sp_giaGoc.required' => 'Vui lòng nhập giá gốc.',
            'sp_giaGoc.numeric' => 'Giá gốc phải là số.',
            'sp_giaGoc.between' => 'Giá gốc trong khoảng từ 0-999999999.',
            
            'sp_giaBan.required' => 'Vui lòng nhập giá bán.',
            'sp_giaBan.numeric' => 'Giá bán phải là số.',
            'sp_giaBan.between' => 'Giá bán trong khoảng từ 0-999999999.',
        ];
    }
}
