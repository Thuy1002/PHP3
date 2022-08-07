<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                        'ten_banner' => "required | unique:banner", //unique duy nhất 
                        // 'hinh_anh' => "required | file", 
                       
                    ];
                    break;
                    case 'updatebanner':
                        $rules = [
                            'ten_banner' => "required | unique:banner", //unique duy nhất 
                            // 'hinh_anh' => "required | file", 
                           
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
       'ten_banner.required'=>"Chưa nhập tên Banner",
       'ten_banner.unique'=>"Tên banner đã tồn tại",
    //    'hinh_anh.required'=>"Banner chưa có file được chọn",
    //    'hinh_anh.file'=>"Banner phải là file ",
   ];
}
}
