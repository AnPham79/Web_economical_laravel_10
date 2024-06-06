<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TotalPriceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $totalPrice = 0;

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
            }

            $view->with('totalPrice', $totalPrice);
        });
    }
}
