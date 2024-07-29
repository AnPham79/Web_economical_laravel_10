<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Mail\Welcome;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

        $user = Auth::user();
        if ($user->status == 'is_lock') {
            Auth::logout();
            return redirect()->back()->withErrors(['messages' => 'Tài khoản của bạn đã bị khóa.']);
        }

        if ($user->role == 0) {
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

        $email = $data->email;
        $name = $data->name;

        $when = Carbon::now()->addSeconds(30);

        Mail::to($email)->later($when, new Welcome($name));

        session()->forget('register_data');

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

    // -------------------------------------------------------------------------------

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        $token = mt_rand(100000, 999999);
        session(['reset_token' => $token, 'reset_email' => $user->email]);

        Mail::raw("Mã xác nhận của bạn là: $token", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Mã xác nhận đặt lại mật khẩu');
        });

        return redirect()->route('reset-password')->with('success', 'Một email chứa mã xác nhận đã được gửi đến địa chỉ email của bạn.');
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function processResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed'
        ]);

        $token = session('reset_token');
        $email = session('reset_email');

        if ($request->input('token') != $token) {
            return redirect()->back()->withErrors(['token' => 'Mã xác nhận không chính xác.']);
        }

        $user = User::where('email', $email)->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        session()->forget(['reset_token', 'reset_email']);

        return redirect()->route('login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
