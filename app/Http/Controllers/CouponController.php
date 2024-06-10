<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function unUseCoupon()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();

        $products = Product::inRandomOrder()->limit(4)->get();
        
        Session::forget(['id', 'code', 'type', 'coupon_value', 'cart_value']);
    
        return view('cart', compact('cart', 'products'))->with('unUseCoupon', 'Hủy dùng mã giảm giá thành công');
    }
}
