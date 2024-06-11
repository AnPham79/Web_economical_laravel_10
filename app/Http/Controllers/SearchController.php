<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $searchResults = Product::where('product_name', 'LIKE', '%' . $search . '%')->get();

        return view('search_results', compact('searchResults'));
    }
}
