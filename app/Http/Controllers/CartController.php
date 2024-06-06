<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    public function loadCart()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();

        $products = Product::inRandomOrder()->limit(4)->get();

        return view('cart', compact(['cart','products']));
    }

    public function addToCart(Request $request, $slug)
    {
        if(!$request->size)
        {
            return redirect()->back()->with('error', 'Bạn vui lòng chọn size sản phẩm nhé');
        }
        
        $product = Product::where('product_slug_name', $slug)->first();

        $cart = Cart::where('product_id', $product->id)
                    ->where('user_id', Auth::user()->id)
                    ->where('size_id', $request->size)
                    ->first();

        if($cart) {
            $cart->product_quantity += $request->quantity;
            $cart->save();
        } else {
            $data = new Cart();
            $data->user_id = Auth::user()->id;
            $data->product_id = $product->id;
            $data->size_id = $request->size;
            $data->product_quantity = $request->quantity;
            $data->save();
        }

        return redirect()->back()->with('message', 'Thêm sản phẩm vào giỏ hàng thành công!');
    }


    public function increaseQuantity($slug)
    {
        $findProduct = Product::where('product_slug_name', $slug)->first();

        $findProductOfUser = Cart::where('product_id', $findProduct->id)
                            ->where('user_id', Auth::user()->id)
                            ->first();
        
        if($findProductOfUser->product_quantity < $findProduct->product_quantity)
        {
            $findProductOfUser->product_quantity += 1;
        } else {
            return redirect()->back()->with('message', 'Số lượng hàng trong kho không còn đủ, xin lỗi bạn nhé !!');
        }

        $findProductOfUser->update([
            'product_quantity' => $findProductOfUser->product_quantity,
        ]);

        return redirect()->back();
    }

    public function decreaseQuantity($slug)
    {
        $findProduct = Product::where('product_slug_name', $slug)->first();

        $supperFind = Cart::where('product_id', $findProduct->id)->where('user_id', Auth::user()->id)->first();

        $supperFind->product_quantity -= 1;

        if ($supperFind->product_quantity == 0) {
            $supperFind->delete();
        } else {
            $supperFind->update([
                'product_quantity' => $supperFind->product_quantity,
            ]);
        }

        return redirect()->back();
    }

    public function deleteProductInCart($slug)
    {
        $find = Product::where('product_slug_name', $slug)->first();

        $findProductInCart = Cart::where('user_id', Auth::user()->id)
                                ->where('product_id', $find->id)
                                ->first();

        $findProductInCart->delete();

        return redirect()->back()->with('success', 'Bạn đã xóa sản phẩm khỏi giỏ hàng thành công');
    }
}
