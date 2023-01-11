<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLike;
use Illuminate\Support\Facades\DB;

class ProductApiController extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product->update([
            'view_count' => DB::raw('view_count + 1')
        ]);

        $product = Product::where('slug', $slug)
            ->with('review.user', 'brand', 'category', 'color', 'order.user', 'images')
            ->first();

        if (!$product) {
            return response()->json([
                'message' => false,
                'data' => 'product_not_found'
            ]);
        }

        $randomProducts = Product::count();
        if ($randomProducts < 4) {
            $randomProducts = [];
        } else {
            $randomProducts = Product::all()->random(4);
        }

        return response()->json([
            'message' => true,
            'data' => [
                'product' => $product,
                'randomProducts' => $randomProducts
            ]
        ]);
    }

    public function like()
    {
        $user_id = request()->user_id;
        $product = Product::where('slug', request()->product_slug)->first();
        $product_id = $product->id;

        $productLike = ProductLike::where('user_id', $user_id,)->where('product_id', $product_id)->first();
        if (!$productLike) {
            ProductLike::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'like_count' => 1
            ]);
        }

        if ($productLike->like_count == 1) {
            $productLike->update([
                'like_count' => 0
            ]);
            $css = 'black';
        } else {
            $productLike->update([
                'like_count' => 1
            ]);
            $css = 'red';
        }

        $product->update([
            'like_count' => ProductLike::where('product_id', $product_id)->sum('like_count')
        ]);

        return response()->json([
            'message' => true,
            'data' => $product->like_count,
            'css' => $css
        ]);
    }

    public function getLike()
    {
        if ($user_id = request()->user_id) {
            $product = Product::where('slug', request()->product_slug)->first();
            $product_id = $product->id;

            $productLike = ProductLike::where('user_id', $user_id,)->where('product_id', $product_id)->first();
            $productLike->like_count == 0 ? $css = 'black' : $css = 'red';
        } else {
            $css = 'black';
        }

        return response()->json([
            'css' => $css
        ]);
    }
}
