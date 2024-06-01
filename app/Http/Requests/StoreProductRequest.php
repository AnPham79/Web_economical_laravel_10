<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name' => 'required|string|max:255',
            'product_short_description' => 'nullable|string|max:255',
            'product_description' => 'nullable|string',
            'product_regular_price' => 'required|numeric',
            'product_percent_sale' => 'nullable|numeric',
            'product_SKU' => 'nullable|string|max:255',
            'product_quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm là bắt buộc.',
            'product_slug_name.required' => 'Slug của sản phẩm là bắt buộc.',
            'product_regular_price.required' => 'Giá sản phẩm là bắt buộc.',
            'stock_status.required' => 'Trạng thái sản phẩm là bắt buộc.',
            'product_quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
        ];
    }
}
