<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\StoreEmployeeRequest;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function register()
    {
        // $registerData = session('register_data');
        // if ($registerData) {
        //     return view('auth.register', ['name' => $registerData['name'], 'email' => $registerData['email'], 'avatar' => $registerData['avatar']]);
        // }

        return view('Auth.register');
    }

    public function handleLogin(Request $request)
    {
        $message = [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email của bạn không đúng định dạng',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $message);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user) {
            session()->flash('messages', 'Email của bạn không tồn tại');

            return redirect()->back();
        }

        if (!Hash::check($password, $user->password)) {
            session()->flash('messages', 'Mật khẩu của bạn không đúng');

            return redirect()->back();
        }

        $role = (int)$user->role;

        session()->put('name', $user->name);
        session()->put('email', $user->email);
        session()->put('role', $role);


        if ($role == 0) {
            return redirect()->route('product.product-manager');
        } else {
            return redirect()->route('index');
        }
    }


    public function handleRegister(Request $request)
    {
        $messages = [
            'name.required' => 'Tên phải nhập',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email phải đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 7 ký tự',
            'gender.required' => 'Vui lòng chọn giới tính',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'gender' => 'required',
            'password' => 'required|string|min:7',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = new User;
        $data->fill($request->except('_token'));
        $data->password = Hash::make($request->password);
        $data->save();

        if(session()->has('register_data'))
        {
            session()->forget('register_data');
        }
        
        return redirect()->route('login');
    }

    public function logout()
    {
        session()->forget('name');
        session()->forget('email');
        session()->forget('role');

        return redirect()->route('index');
    }
}