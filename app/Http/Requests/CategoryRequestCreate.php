<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequestCreate extends FormRequest
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
            'title'=>'required|max:191|min:3',
        ];
    }
    public function messages(){
        return [
                'title.required'=>'Trường này không được để trống',
                'title.max'=>'Trường này có độ dài đến 191 ký tự',
                'title.min'=>'Trường này có độ dài từ 3 ký tự',
        ];
    }
}
