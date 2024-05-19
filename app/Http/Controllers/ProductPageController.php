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
        $search = $request->get('q', '');

        $categories = Category::all();

        $productsQuery = Product::query();

        if (!empty($search)) {
            $productsQuery->where('product_name', 'like', '%' . $search . '%');
        }

        $orderBy = $request->get('orderBy');

        switch ($orderBy) {
            case 'price_asc':
                $productsQuery->orderBy('product_regular_price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('product_regular_price', 'desc');
                break;
            case 'price_sale':
                $productsQuery->where('product_percent_sale', '>', 0)
                    ->orderBy('product_percent_sale', 'desc');
                break;
            default:
                break;
        }

        $products = $productsQuery->paginate(12);

        return view('product-page', [
            'products' => $products,
            'categories' => $categories,
            'orderBy' => $orderBy,
            'search' => $search,
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

    public function pageProductSale()
    {
        $products = Product::where('product_percent_sale' , '>' , '0')->get();

        $categories = Category::all();

        return view('product-sale-page', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function productsSaleByCategory($slug)
    {
        $categories = Category::all();

        $category = Category::where('category_slug_name', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('product_percent_sale' , '>' , '0')
            ->get();

        return view('product-sale-page', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
