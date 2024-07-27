<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\SizeProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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
        $cacheKey = 'product_' . $slug;

        $data = Cache::remember($cacheKey, 3600, function() use ($slug) {
            return Product::where('product_slug_name', $slug)
                        ->with('thumbnails')
                        ->firstOrFail();
        });

        $viewCacheKey = 'product_view_' . $data->id . '_' . request()->ip();

        if (!Cache::has($viewCacheKey)) {
            // Tăng lượt xem trong cơ sở dữ liệu
            $data->increment('views');

            // Lưu vào cache với thời gian sống (TTL) là 1 giờ
            Cache::put($viewCacheKey, true, 3600);
        }

        // Lấy các comment của sản phẩm
        $comments = Comment::where('product_id', $data->id)
                        ->where('status', 'is_show')
                        ->get();

        // Lấy các sản phẩm ngẫu nhiên để hiển thị thêm
        $more_products = Product::inRandomOrder()->limit(4)->get();

        // Lấy tất cả các size sản phẩm
        $size = SizeProduct::all();

        // Lấy các thumbnails của sản phẩm
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
