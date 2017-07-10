<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'name' =>'required|min:6',
            'preview_text' => 'required',
            'picture' => 'mimes:jpeg,jpg,png,gif,avg | max:1000',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập danh mục tin',
            'name.min'     => 'Độ dài tối thiểu là 6 ký tự',
            'preview_text.required' => 'Vui lòng nhập mô tả',
            'picture.mimes'      => 'Định dạng file phải là ảnh',
            'picture.max'      => 'Độ lớn tối đa của ảnh là 1000'
        ];
    }
}
