<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function handleLogin(UserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors(['messages' => 'Email hoặc mật khẩu của bạn không đúng']);
        }

        if (Auth::user()->role == 0) {
            return redirect()->route('product.product-manager');
        } else {
            return redirect()->route('index');
        }

    }

    public function handleRegister(StoreUserRequest $request)
    {
        $data = new User;
        $data->fill($request->except('_token'));
        $data->password = Hash::make($request->password);
        $data->save();
        
        return redirect()->route('login');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    // ----------------------------------------------------------------

    public function processChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(['message' => 'Mật khẩu hiện tại của bạn không đúng']);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('change-password')->with('message', 'Đổi mật khẩu thành công');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}