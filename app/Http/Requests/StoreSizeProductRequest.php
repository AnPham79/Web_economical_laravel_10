<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSizeProductRequest extends FormRequest
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
            'size' => 'required|unique:size_products,size',
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'Kích thước sản phẩm là bắt buộc',
            'size.unique' => 'Kích thước sản phẩm đã tồn tại'
        ];
    }
}
