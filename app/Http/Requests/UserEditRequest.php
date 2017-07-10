<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'username' =>'required|min:5',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập username',
            'username.min'     => 'Username tối thiểu là 5 ký tự',
        ];
    }
}
