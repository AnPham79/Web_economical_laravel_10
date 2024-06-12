<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => 'Bạn phải đánh giá cho sản phẩm',
            'content.required' => 'Bạn phải nhập nội dung bình luận của mình', 
        ];
    }
}
