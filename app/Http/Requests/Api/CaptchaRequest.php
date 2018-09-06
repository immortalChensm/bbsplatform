<?php

namespace App\Http\Requests\Api;

//use Illuminate\Foundation\Http\FormRequest;
use Dingo\Api\Http\FormRequest;
class CaptchaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'phone'=>'required|regex:/^1[34578]\d{9}$/|unique:users',
        ];
    }

    public function messages()
    {
        return [
            "phone.required"=>"手机号不可为空",
            "phone.regex"=>"手机号不正确",
            "phone.unique"=>"手机已经存在"
        ];
    }
}
