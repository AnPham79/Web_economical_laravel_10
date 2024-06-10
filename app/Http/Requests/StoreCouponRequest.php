<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code' => 'required|unique:coupons,code',
            'cart_value' => 'required|numeric|min:0',
            'type' => 'required|in:percent,fixed',
            'coupon_value' => 'required|numeric|min:0'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Tên mã giảm giá là bắt buộc',
            'code.unique' => 'Tên mã giảm giá đã tồn tại',
            'cart_value.required' => 'Giá trị tối thiểu của giỏ hàng là bắt buộc',
            'cart_value.numeric' => 'Giá trị tối thiểu của giỏ hàng phải là một số',
            'cart_value.min' => 'Giá trị tối thiểu của giỏ hàng phải lớn hơn hoặc bằng 0',
            'type.required' => 'Kiểu giảm giá là bắt buộc',
            'type.in' => 'Kiểu giảm giá không hợp lệ',
            'coupon_value.required' => 'Giá trị của mã giảm giá là bắt buộc',
            'coupon_value.numeric' => 'Giá trị của mã giảm giá phải là một số',
            'coupon_value.min' => 'Giá trị của mã giảm giá phải lớn hơn hoặc bằng 0',
        ];
    }
}
