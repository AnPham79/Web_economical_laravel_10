<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
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

    public function index()
    {
        $coupons = Coupon::all();

        return view('admin.coupons.coupon-manager', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create-coupon-manager');
    }

    public function store(StoreCouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->fill($request->except('_token'));
        $coupon->save();

        return redirect()->route('coupon-manager')->with('message', 'Thêm mã giảm giá thành công');
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit-coupon-manager', compact('coupon'));
    }
    
    public function update(StoreCouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->fill($request->except('_token', '_method'));
        $coupon->save();

        return redirect()->route('coupon-manager')->with('message', 'Cập nhật mã giảm giá thành công');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        $coupon->delete();

        return redirect()->route('coupon-manager')->with('message', 'Xóa mã giảm giá thành công');
    }
}
