<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\User;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    // add to cart
    public function addCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response([
                'message' => false,
                'data' => 'Product_not_found'
            ]);
        }

        //check discount or not
        $product->discount_price ? $price = $product->sale_price - $product->discount_price : $price = $product->sale_price;

        //check whether product exist in cart
        $checkInCart = ProductCart::where('user_id', $request->user_id)->where('product_id', $product->id)->first();
        if ($checkInCart) {
            $total_quantity = $checkInCart->total_quantity + $request->quantity;
            $total_price = $price * $total_quantity;

            $checkInCart->update([
                'total_quantity' => $total_quantity,
                'total_price' => $total_price
            ]);
        } else {
            ProductCart::create([
                'product_id' => $product->id,
                'user_id' => $request->user_id,
                'total_quantity' => $request->quantity,
                'total_price' => $price * $request->quantity
            ]);
        }

        $cartCount = ProductCart::where('user_id', $request->user_id)->count();
        return response([
            'message' => true,
            'data' => $cartCount
        ]);
    }

    // show cart
    public function cart($id)
    {
        $user = User::where('id', $id)->first();
        $cart = ProductCart::where('user_id', $user->id)->with('product')->get();
        if (!$cart) {
            return response([
                'message' => false,
                'data' => 'cart not found'
            ]);
        }

        return response([
            'message' => true,
            'data' => $cart
        ]);
    }

    public function updateQty(Request $request)
    {
        $cart_id = $request->cart_id;
        $cart_total_qty = $request->cart_qty;
        $cart_total_price = $request->cart_total_price;
        $cart = ProductCart::where('id', $cart_id)->first();
        if (!$cart) {
            return response([
                'message' => false,
                'data' => 'cart not found'
            ]);
        }
        $cart->update([
            'total_quantity' => $cart_total_qty,
            'total_price' => $cart_total_price
        ]);

        return response([
            'message' => true,
            'data' => 'cart saved successfully'
        ]);
    }

    public function removeCart(Request $request)
    {
        $cart_id = $request->cart_id;
        $user_id = $request->user_id;

        $cart = ProductCart::where('id', $cart_id)->first();
        if (!$cart) {
            return response([
                'message' => false,
                'data' => 'cart not found'
            ]);
        }
        $cart->delete();

        $cartCount = ProductCart::where('user_id', $user_id)->with('product')->count();
        return response([
            'message' => true,
            'data' => $cartCount
        ]);
    }
}
