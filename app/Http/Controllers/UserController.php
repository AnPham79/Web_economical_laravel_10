<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orderHistory()
    {
        $data = Order::where('user_id', Auth::user()->id)->orderBY('id', 'DESC')->get();
        return view('order-history', [
            'data' => $data
        ]);
    }

    public function orderDetail($id)
    {
        $data = OrderDetail::where('order_id', $id)->get();

        $shipping = Shipping::where('order_id', $id)->first();

        return view('order-detail', [
            'data' => $data,
            'shipping' => $shipping
        ]);
    }

    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->first();

        if ($order) {
            $order->status_order = 'cancelled';
            $order->save();

            return redirect()->back();
        }

        return redirect()->back();
    }

    // ---------------------------------- admin ----------------------------------------
    public function userManager()
    {
        $users = User::paginate(12);

        return view('admin.users.user-manager', compact('users'));
    }

    public function changeStatusAccount($user_name)
    {
        $user = User::where('name', $user_name)->first();

        if ($user) {
            if ($user->status == 'is_active') {
                $user->status = 'is_lock';
            } else {
                $user->status = 'is_active';
            }
            
            $user->save();
        }

        return redirect()->back()->with('status', 'Cập nhật trạng thái tài khoản thành công');
    }

}
