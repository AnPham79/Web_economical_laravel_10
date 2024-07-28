<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;

class ProductPageController extends Controller
{

    public function index(Request $request)
    {
        $message = [
            'min_regular_price.min'  => 'Giá thấp nhất của bạn có thể nhập là 0 VND',
            'min_regular_price.numeric' => 'Giá thấp nhất bạn nhập phải là số',
            'max_regular_price.min'  => 'Giá cao nhất của bạn phải lớn hơn giá nhỏ nhất',
            'max_regular_price.numeric' => 'Giá cao nhất bạn nhập phải là số',
        ];

        $request->validate([
            'search' => 'nullable|string',
            'min_regular_price' => 'nullable|numeric|min:0',
            'max_regular_price' => 'nullable|numeric|min:' . ($request->input('min_regular_price') ?? 0),
        ], $message);

        $filter = $request->only([
            'search',
            'min_regular_price',
            'max_regular_price',
            'product_sale_status'
        ]);

        $categories = Category::all();

        return view('product-page', [
            'products' => Product::filter($filter)->CountComments()->paginate(12),
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
        $message = [
            'min_regular_price.min'  => 'Giá thấp nhất của bạn có thể nhập là 0 VND',
            'min_regular_price.numeric' => 'Giá thấp nhất bạn nhập phải là số',
            'max_regular_price.min'  => 'Giá cao nhất của bạn phải lớn hơn giá nhỏ nhất',
            'max_regular_price.numeric' => 'Giá cao nhất bạn nhập phải là số',
        ];

        $request->validate([
            'search' => 'nullable|string',
            'min_regular_price' => 'nullable|numeric|min:0',
            'max_regular_price' => 'nullable|numeric|min:' . ($request->input('min_regular_price') ?? 0),
        ], $message);
        
        $filter = $request->only([
            'search',
            'min_regular_price',
            'max_regular_price'
        ]);

        $categories = Category::all();

        $products = Product::CountComments('product_percent_sale', '>', 0);

        if (isset($filter['search'])) {
            $products->CountComments('product_name', 'like', '%' . $filter['search'] . '%');
        }

        if (isset($filter['min_regular_price'])) {
            $products->CountComments('product_regular_price', '>=', $filter['min_regular_price']);
        }

        if (isset($filter['max_regular_price'])) {
            $products->CountComments('product_regular_price', '<=', $filter['max_regular_price']);
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
