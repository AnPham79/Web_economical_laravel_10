<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'gender' => 'required',
            'password' => 'required|string|min:7',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên phải nhập',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email phải đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 7 ký tự',
            'gender.required' => 'Vui lòng chọn giới tính',
        ];
    }
}