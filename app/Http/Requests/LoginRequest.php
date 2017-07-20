<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username'=>'required|min:3',
            'password'=>'required|min:6',
        ];
    }
    public function messages(){
        return [
            'username.required'=>'Tên đăng nhập không được để trống',
            'username.min'=>'Tên đăng nhập không đúng',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu không đúng',
        ];
    }
}
