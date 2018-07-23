<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'author' => 'required|min:3|max:100|string|regex:/^([A-Z][a-z]+([ ]?[a-z]?[\'-]?[A-Z][a-z]+))$/',
            'content' => 'required',
            'post_id' => 'required_without:category_id|exists:posts,id',
            'category_id' => 'required_without:post_id|exists:categories,id'
        ];
    }
}
