<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Thumbnail;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ProductController extends Controller
{
    protected $productService;

    private $table = 'products';

    public $thumbnails;

    public function index()
    {
        $product = Product::all();
        $products = Product::orderBy('id', 'DESC')->paginate(12);

        view::share('title', ucwords($this->table));

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::query()->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $image_name);
        } else {
            $image_name = null;
        }

        $product = new Product();
        $product->fill($request->except('_token', 'thumbnails_product'));
        $product->product_slug_name = Str::slug($request->product_name);
        $product->product_image = $image_name;
        $product->save();

        if ($request->hasFile('thumbnails_product')) {
            foreach ($request->file('thumbnails_product') as $key => $image) {
                if ($image) {
                    $thumbnail_name = time() . $key . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('img/thumbnail'), $thumbnail_name);

                    Thumbnail::create([
                        'thumbnails_product' => $thumbnail_name,
                        'product_id' => $product->id
                    ]);
                }
            }
        }

        session()->flash('message', 'Thêm sản phẩm thành công');

        return redirect()->route('product.product-manager');
    }

    public function edit($slug)
    {
        $data = Product::where('product_slug_name', $slug)->with('thumbnails')->first();

        $categories = Category::all();

        $thumbnails = $data->thumbnails;

        return view('admin.products.edit', [
            'data' => $data,
            'categories' => $categories,
            'thumbnails' => $thumbnails
        ]);
    }

    public function update(Request $request, $slug)
    {
        $product = Product::where('product_slug_name', $slug)->firstOrFail();

        $product->fill($request->except('_token', '_method', 'thumbnails_product'));

        $product->product_slug_name = Str::slug($request->product_name);

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $image_name);
            $product->product_image = $image_name;
        }

        $product->save();
        if($request->hasFile('thumbnails_product')) {
            foreach ($request->file('thumbnails_product') as $key => $thumbnail) {
                if ($thumbnail) {
                    $thumbnail_name = time() . $key . '.' . $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(public_path('img/thumbnail'), $thumbnail_name);

                    Thumbnail::create([
                        'thumbnails_product' => $thumbnail_name,
                        'product_id' => $product->id
                    ]);
                }
            }
        }

        return redirect()->route('product.product-manager')->with('message', 'Cập nhật sản phẩm thành công');
    }


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
