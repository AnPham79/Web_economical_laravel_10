<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $table = 'categories';

    public function index()
    {
        $categories = Category::all();

        view::share('title', ucwords($this->table));

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->except('_token'));
        $category->category_slug_name = Str::slug($request->category_name);
        $category->save();

        session()->flash('message', 'Thêm danh mục sản phẩm thành công');

        return redirect()->route('category.category-manager');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $category_slug_name)
    {
        $data = Category::where('category_slug_name', $category_slug_name)->first();

        return view('admin.categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category_slug_name)
    {
        $data = Category::where('category_slug_name', $category_slug_name)->firstOrFail();

        $data->fill($request->except('_token', '_method'))->save();

        session()->flash('message', 'Sửa danh mục sản phẩm thành công');

        return redirect()->route('category.category-manager');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_slug_name)
    {
        $data = Category::where('category_slug_name', $category_slug_name)->firstOrFail();

        if ($data->products()->count() > 0) {

            session()->flash('error', 'Không thể xóa danh mục vì danh mục này có sản phẩm.');
        } else {
            $data->delete();
            session()->flash('message', 'Xóa Danh mục sản phẩm thành công');
        }

        return redirect()->route('category.category-manager');
    }

}
