<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteProductController extends Controller
{
    public function index(Request $request)
    {
        $frd = $request->all();
        $products = Product::filter($frd)->get();
        // $products = Product::get();
        return view('site.site-products', compact('products'));
    }
}
