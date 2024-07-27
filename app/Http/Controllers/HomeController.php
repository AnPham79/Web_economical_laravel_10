<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\SizeProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function index()
    {   
        $currentDate = Carbon::now();

        $products_sale = Product::where('product_percent_sale', '>' , 0)->with('comments')->limit(4)->get();

        $products_new = Product::whereRaw('DATE_ADD(created_at, INTERVAL 15 DAY) >= ?', [Carbon::now()])->with('comments')->get();

        return view('index', [
            'products_sale' => $products_sale,
            'products_new' => $products_new,
            'currentDate' => $currentDate
        ]);
    }

    public function show($slug)
    {
        $data = Cache::remember('product_' . $slug, 3600, function() use ($slug) {
            return Product::where('product_slug_name', $slug)
                ->with('thumbnails', 'comments')
                ->firstOrFail();
        });

        $comments = Cache::remember('product_comments_' . $data->id, 3600, function() use ($data) {
            return Comment::where('product_id', $data->id)
                ->where('status', 'is_show')
                ->get();
        });

        $size = Cache::remember('size_', 3600, function() use ($data) {
            return SizeProduct::all();
        });

        $more_products = Cache::remember('more_products', 3600, function() {
            return Product::inRandomOrder()->limit(4)->get();
        });

        $thumbnails = $data->thumbnails;

        $data->increment('views');

        return view('detail', [
            'data' => $data,
            'size' => $size,
            'more_products' => $more_products,
            'thumbnails' => $thumbnails,
            'comments' => $comments
        ]);
    }
}
