<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\Support\Facades\Storage;


use App\Models\Category;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Str;

use Database\Seeders\ProductSeeder;

use App\Models\Thumbnail;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productService;

    private $table = 'products';

    public function index()
    {
        $product = Product::all();
        $products = Product::orderBy('id', 'DESC')->paginate(12);

        view::share('title', ucwords($this->table));

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $image = $request->file('product_image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/product'), $image_name);


        $product = Product::create([
            'product_name' => $request->product_name,
            'product_slug_name' => Str::slug($request->product_name),
            'product_short_description' => $request->product_short_description,
            'product_description' => $request->product_description,
            'product_regular_price' => $request->product_regular_price,
            'product_percent_sale' => $request->product_percent_sale,
            'product_SKU' => $request->product_SKU,
            'product_quantity' => $request->product_quantity,
            'product_image' => $image_name,
            'category_id' => $request->category_id
        ]);

        $product_id = $product->id;

        $thumbnail = $request->file('thumbnails_product');
        $thumbnail_name = time() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move(public_path('img/thumbnail'), $thumbnail_name);

        Thumbnail::create([
            'thumbnails_product' => $thumbnail_name,
            'product_id' => $product_id
        ]);

        session()->flash('message', 'Thêm sản phẩm thành công');

        return redirect()->route('product.product-manager');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $slug)
    {
        $data = Product::where('product_slug_name', $slug)->first();

        $categories = Category::all();

        return view('admin.products.edit', [
            'data' => $data,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // Tìm sản phẩm theo slug
        $product = Product::where('product_slug_name', $slug)->firstOrFail();

        // Cập nhật thông tin sản phẩm
        $product->fill($request->except('_token', '_method'));

        // Tạo slug mới từ tên sản phẩm
        $product->product_slug_name = Str::slug($request->product_name);

        // Xử lý upload ảnh sản phẩm
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $image_name);
            $product->product_image = $image_name;
        }

        $product_id = $product->id;

        if($request->hasFile('thumbnails_product')) {
            $thumbnail = $request->file('thumbnails_product');
            $thumbnail_name = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('img/thumbnail'), $thumbnail_name);

            Thumbnail::create([
                'thumbnails_product' => $thumbnail_name,
                'product_id' => $product_id
            ]);
        }
        

        $product->save();

        return redirect()->route('product.product-manager')->with('message', 'Cập nhật sản phẩm thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $slug)
    {
        $product = Product::where('product_slug_name', $slug)->first();

        if ($product) {
            Storage::delete('img/product/' . $product->product_image);
        }

        $product->delete();

        session()->flash('message', 'Xóa sản phẩm thành công !!');

        return redirect()->route('product.product-manager');
    }
}
