<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function updateOrder(Request $request)
    {
        $user_id = $request->user_id;
        $carts = ProductCart::where('user_id', $user_id)->get();

        foreach ($carts as $cart) {
            ProductOrder::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'total_quantity' => $cart->total_quantity,
                'total_amount' => $cart->total_price
            ]);
            $cart->delete();
        }

        return response([
            'message' => true,
            'data' => null
        ]);
    }

    public function order()
    {
        $user_id = request()->user_id;
        $order = ProductOrder::where('user_id', $user_id)->with('product')->latest()->paginate(2);
        return response([
            'message' => true,
            'data' => $order
        ]);
    }
}
