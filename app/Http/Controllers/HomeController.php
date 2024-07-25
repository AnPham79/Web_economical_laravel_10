<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\SizeProduct;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {   
        $currentDate = Carbon::now();

        $products_sale = Product::where('product_percent_sale', '>' , 0)->limit(4)->get();

        $products_new = Product::whereRaw('DATE_ADD(created_at, INTERVAL 15 DAY) >= ?', [Carbon::now()])->get();

        return view('index', [
            'products_sale' => $products_sale,
            'products_new' => $products_new,
            'currentDate' => $currentDate
        ]);
    }

    public function show($slug)
    {
        $data = Product::where('product_slug_name', $slug)->with('thumbnails')->first();

        $comments = Comment::where('product_id', $data->id)
                   ->where('status', 'is_show')
                   ->get();

        $more_products = Product::inRandomOrder()->limit(4)->get();

        $size = SizeProduct::all();

        $thumbnails = $data->thumbnails;

        return view('detail', [
            'data' => $data,
            'size' => $size,
            'more_products' => $more_products,
            'thumbnails' => $thumbnails,
            'comments' => $comments
        ]);
    }
}
