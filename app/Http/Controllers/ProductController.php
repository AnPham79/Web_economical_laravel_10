<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $table = 'products';

    public function index()
    {
        $products = Product::paginate(12);

        view::share('title', ucwords($this->table));

        return view('admin.products.index', compact('products'));
    }

    // public function viewDescriptionProduct($product_name)
    // {
    //     $products = Product::where('product_name', $product_name)->first();

    //     view::share('title', ucwords($this->table));

    //     return view('admin.products.index', compact('products'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
