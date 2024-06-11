<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Mail\Bill;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkOut()
    {
        return view('check-out');
    }

    public function paymentConfirmation(Request $request)
    {
        $user_id = User::where('id', Auth::user()->id)->first();

        $totalPrice = 0;

        $subtotalFixed = 0;

        $cart = Cart::where('user_id', Auth::user()->id)->get();

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();

            foreach ($cart as $item) {
                $priceItem = 0;

                if ($item->product->product_percent_sale !== null) {
                    $priceSale = $item->product->product_regular_price * (1 - $item->product->product_percent_sale / 100);
                    $priceItem = $item->product_quantity * $priceSale;
                } else {
                    $priceItem = $item->product_quantity * $item->product->product_regular_price;
                }

                $totalPrice += $priceItem;
            }

            $subtotalFixed = $totalPrice;
        }

        if(session()->has('code')){
            if(session()->get('type') == 'fixed')
            {
                $totalPrice = $totalPrice - session()->get('coupon_value');
                $discountAmount = session()->get('coupon_value');
            }

            if(session()->get('type') == 'percent')
            {
                $subtotal = $totalPrice * (1 - session()->get('coupon_value') / 100);
                $discountAmount = $totalPrice - $subtotal;
                $totalPrice = $subtotal;
            }
        }

        $orderCode = 'ORD-' . Carbon::now()->format('YmdHis') . '-' . Str::random(5);

        $order = new Order();
        $order->user_id = $user_id->id;
        $order->status_order = 'Placed';
        $order->sub_total = $subtotalFixed;
        $order->discount = session()->get('code');
        $order->total = $totalPrice;
        $order->order_code = $orderCode;
        $order->save();

        $orderDetails = [];

        foreach ($cart as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->product_id;
            $orderDetail->unit_price = $item->product->product_regular_price;
            $orderDetail->quantity = $item->product_quantity;
            $orderDetail->discount_price = $discountAmount ?? null;

            if ($item->product->product_percent_sale !== null) {
                $priceSale = $item->product->product_regular_price * (1 - $item->product->product_percent_sale / 100);
                $orderDetail->totalUnit = $item->product_quantity * $priceSale;
            } else {
                $orderDetail->totalUnit = $item->product_quantity * $item->product->product_regular_price;
            }

            $orderDetail->total = $totalPrice;
            
            $orderDetail->save();

            $orderDetails[] = $orderDetail;

            $product = $item->product;
            $product->product_quantity -= $item->product_quantity;
            $product->save();
        }

        $shipping = new Shipping();
        $shipping->fill($request->except('_token'));
        $shipping->order_id = $order->id;
        $shipping->save();
        
        Cart::where('user_id', Auth::user()->id)->delete();

        Mail::to(Auth::user()->email)->send(new Bill($order, $orderDetails, $totalPrice));

        session()->forget([
            'id',
            'code',
            'type',
            'coupon_value',
            'cart_value'
        ]);

        return view('thank');
    }
}

