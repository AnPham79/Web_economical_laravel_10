<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orderHistory()
    {
        $data = Order::where('user_id', Auth::user()->id)->get();
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

    public function cancelOrder($status)
    {
        $order = Order::where('status_order', $status)->first();

        if ($order) {
            $order->status_order = 'cancelled';
            $order->save();

            return redirect()->back();
        }

        return redirect()->back();
    }

}
