<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanphamRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod(); //trỏ đến hàm add
        //   dd($currentAction);
        switch ($this->method()) :
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules = [
                            'ten_sp' => "required | unique:san_pham", //unique duy nhất 
                            'gia' => "required | min 0 ",
                            'so_luong' => "required | min 0 " ,
                            'hinh_anh' => "required | file  ",
                            'id_danhmuc' => "required ",
                        ];
                        break;
                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
            endswitch;
                return $rules;
        
    }
     public function messages()
     {
        return [
            'ten_sp.required'=>"Chưa nhập tên sản phẩm",
            'ten_sp.unique'=>"Tên sẩn phẩm đã tồn tại",
            'gia.required'=>"Chưa nhập giá",
            'gia.min'=>"Giá phải lớn hơn 0",
            'so_luong.required'=>"Chưa nhập số lượng",
            'so_luong.min'=>"Số lượng lớn hơn 0",
            // 'so_luong.min'=>"số lượng lớn hơn 1",
            'hinh_anh.required'=>"chưa có ảnh",
            'hinh_anh.file'=>"phải là file ảnh được tải lên",
            'id_danhmuc.required'=>"Chưa chọn danh mục",
            
        ];
     }
   
}
