<?php

namespace App\Http\Controllers;

use App\Models\SizeProduct;
use App\Http\Requests\StoreSizeProductRequest;
use App\Http\Requests\UpdateSizeProductRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

class SizeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $table = 'size_products';

    public function index()
    {
        $sizes = SizeProduct::all();

        view::share('title', ucwords($this->table));

        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeProductRequest $request)
    {
        $size = new SizeProduct();
        $size->fill($request->except('_token'));
        $size->save();

        session()->flash('message', 'Thêm kích thước sản phẩm thành công');

        return redirect()->route('size.product-manager.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SizeProduct $sizeProduct, $id)
    {
        $data = SizeProduct::find($id)->first();

        return view('admin.sizes.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = SizeProduct::find($id);

        $data->fill($request->except('_token', '_method'))->save();

        session()->flash('message', 'Sửa kích thước sản phẩm thành công');

        return redirect()->route('size.product-manager.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SizeProduct $sizeProduct, $id)
    {
        $data = SizeProduct::find($id);

        $data->delete();

        session()->flash('message', 'Xóa kích thước sản phẩm thành công');

        return redirect()->route('size.product-manager.index');
    }
}
