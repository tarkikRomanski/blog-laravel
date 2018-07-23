<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'content' => 'required',
            'file' => 'max:2048|file|nullable',
            'categories' => 'required'
        ];
    }

    /**
     * Get validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'categories.required' => 'Pls select one or more categories',
            'file.max' => 'File is very big (maximum size 2Mb)',
        ];
    }
}
