<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products_sale = Product::where('product_percent_sale', '>' , 0)->limit(4)->get();

        $products_new = Product::orderBy('id', 'DESC')->limit(4)->get();

        return view('index', [
            'products_sale' => $products_sale,
            'products_new' => $products_new
        ]);
    }

    public function show($slug)
    {
        $data = Product::where('product_slug_name', $slug)->first();

        $more_products = Product::inRandomOrder()->limit(4)->get();

        return view('detail', [
            'data' => $data,
            'more_products' => $more_products
        ]);
    }
}
