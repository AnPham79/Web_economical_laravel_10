<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function orderManager()
    {
        $orders = Order::orderBy('id', 'DESC')->get();

        return view('admin.orders.order-manager', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_order = $request->input('status_order');
        $order->save();

        return redirect()->back()->with('message', 'Cập nhật trạng thái đơn hàng thành công');
    }

    public function orderDetailManager($id)
    {
        $data = OrderDetail::where('order_id', $id)->get();

        $shipping = Shipping::where('order_id', $id)->first();

        return view('admin.orders.order-detail-manager', [
            'data' => $data,
            'shipping' => $shipping
        ]);
    }
}
