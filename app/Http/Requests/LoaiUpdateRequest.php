<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Loai;
use Illuminate\Validation\Factory;

class LoaiUpdateRequest extends FormRequest
{
    public function __construct(Factory $factory)
    {
//        $name = 'is_clean_text';
//        $test = function ($attribute, $value, $parameter) {
//            if ($value == '123') {
//                return false;
//            } else return true;
//        };
//        $errorMessage = 'Nội dung phải khác 123.';
//        $factory->extend($name, $test, $errorMessage);
        //kiem tra ten hieu chinh co trung cac loai khac khong
        $name = 'checkuniquename';
        $test = function ($attribute, $value, $parameter) {
            $infoloai = DB::select(' select l_ma from cusc_loai where l_ten = :ten and l_ma <> :ma ', ['ten' => $value, 'ma' => $parameter[0]]);

            if(count($infoloai) > 0) {
                return false;
            } else {
                return true;
            }
        };
        $errorMessage = 'Tên loại đã tồn tại. Vui lòng nhập tên loại khác.';

        $factory->extend($name, $test, $errorMessage);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules(){
        $ma = $this->request->get('l_ma');
        return [
            'l_ten' => "required|min:3|max:50|checkuniquename:$ma", //tên table cusc_chude
        ];
    }

    public function messages(){
        return [
            'l_ten.required' => 'Tên loại bắt buộc nhập',
            'l_ten.min' => 'Tên loại ít nhất phải 3 ký tự trở lên',
            'l_ten.max' => 'Tên loại tối đa chỉ 50 ký tự',
            'l_ten.unique' => ' Tên loại này đã tồn tại. Vui lòng nhập tên loại khác',
            
        ];
    }
}
