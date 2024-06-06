<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SizeProduct;

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
        $data = Product::where('product_slug_name', $slug)->with('thumbnails')->first();

        $more_products = Product::inRandomOrder()->limit(4)->get();

        $size = SizeProduct::all();

        $thumbnails = $data->thumbnails;

        return view('detail', [
            'data' => $data,
            'size' => $size,
            'more_products' => $more_products,
            'thumbnails' => $thumbnails
        ]);
    }
}
