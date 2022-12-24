<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    public function makeReview(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response([
                'message' => false,
                'data' => 'slug_not_found',
            ]);
        }

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => $request->user_id,
            'review' => $request->comment,
            'rating' => $request->rating
        ]);

        $resData = ProductReview::where('product_id', $product->id)->with('user')->latest()->first();
        return response([
            'message' => true,
            'data' => $resData
        ]);
    }
}
