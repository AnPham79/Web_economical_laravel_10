<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductPageController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->only([
            'search',
            'min_regular_price',
            'max_regular_price',
            'product_sale_status'
        ]);

        $categories = Category::all();

        return view('product-page', [
            'products' => Product::filter($filter)->paginate(12),
            'categories' => $categories,
        ]);
    }

    public function productsByCategory($slug)
    {
        $categories = Category::all();

        $category = Category::where('category_slug_name', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)->paginate(12);

        return view('product-page', [
            'products' => $products,
            'categories' => $categories,
            'orderBy' => null,
            'search' => '',
        ]);
    }

    public function pageProductSale(Request $request)
    {
        $filter = $request->only([
            'search',
            'min_regular_price',
            'max_regular_price'
        ]);

        $categories = Category::all();

        $products = Product::where('product_percent_sale', '>', 0);

        if (isset($filter['search'])) {
            $products->where('product_name', 'like', '%' . $filter['search'] . '%');
        }

        if (isset($filter['min_regular_price'])) {
            $products->where('product_regular_price', '>=', $filter['min_regular_price']);
        }

        if (isset($filter['max_regular_price'])) {
            $products->where('product_regular_price', '<=', $filter['max_regular_price']);
        }

        $filteredProducts = $products->get();

        return view('product-sale-page', [
            'products' => $filteredProducts,
            'categories' => $categories
        ]);
    }

    public function productsSaleByCategory($slug)
    {
        $categories = Category::all();

        $category = Category::where('category_slug_name', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)->where('product_percent_sale', '>', '0')->get();

        return view('product-sale-page', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
