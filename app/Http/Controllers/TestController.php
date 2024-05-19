<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class TestController extends Controller
{
    public function searchPage()
    {
        return view('search-page');
    }

    public function autoCompleteSearch(Request $request)
    {
        $data = Product::select('name')
            ->where('product_name', 'like', '%' . $request->terms . '%')
            ->get()
            ->pluck('product_name');
        return $data;
    }
}
