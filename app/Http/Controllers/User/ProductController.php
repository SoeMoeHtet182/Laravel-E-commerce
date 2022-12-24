<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect('/')->with('error', 'Product not found');
        }
        return view('user.productDetail', compact('slug'));
    }
}
