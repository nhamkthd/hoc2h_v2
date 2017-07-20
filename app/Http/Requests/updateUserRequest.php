<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
        $user = $this->route('user');
        return [
        'name'=>'required',
        'role'=>'required',
        'phone'=>'required',
        'class'=>'required',
        'coin'=>'required',
        'user_name'=>'required|min:5|max:255|unique:Users,user_name,'.$user->id,
        'email'=>'required|unique:Users,email,'.$user->id,
        'password'=>'required|min:6|max:255',
        'password_confirmation'=>'required|max:255|same:password',
        'status'=>'required',
        'local'=>'required',
        'code'=>'required',
        ];
    }
    public function messages(){
        return [
        'name.required'=>'Trường này không được để trống',
        'role.required'=>'Trường này không được để trống',
        'phone.required'=>'Trường này không được để trống',
        'class.required'=>'Trường này không được để trống',
        'coin.required'=>'Trường này không được để trống',
        'user_name.required'=>'Trường này không được để trống',
        'email.required'=>'Trường này không được để trống',
        'password.required'=>'Trường này không được để trống',
        'password_confirmation.required'=>'Trường này không được để trống',
        'user_name.unique'=>'Tên người dùng đã tồn tại',
        'user_name.min'=>'Tên người dùng phải từ 5 ký tự',
        'user_name.max'=>'Tên người dùng vượt quá ký tự cho phép',
        'email.required'=>'Vui lòng nhập email',
        'email.unique'=>'Email đã tồn tại',
        'password.required'=>'Vui lòng nhập mật khẩu',
        'password.min'=>'Mật khẩu phải từ 6 ký tự',
        'password.max'=>'Mật khẩu vượt quá ký tự cho phép',
        'password_confirmation.max'=>'Mật khẩu xác minh vượt quá ký tự cho phép',
        'password_confirmation.confirmed'=>'Mật khẩu xác minh không chính xác',
        'password_confirmation.required'=>'Vui lòng nhập mật khẩu xác minh',
        'status.required'=>'Vui lòng chọn trạng thái',
        'local.required'=>'Trường này không được để trống',
        'code.required'=>'Trường này không được để trống',
        ];
    }
}
