<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function all(Request $request)
    {
        $orders = ProductOrder::with('user', 'product');
        if ($request->status) {
            $orders->where('status', $request->status);
        }
        $orders = $orders->latest()->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function changeOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        //change status in order and user ui
        $order = ProductOrder::where('id', $id)->first();
        $order->update([
            'status' => $status
        ]);

        if ($status === 'success') {
            //reduce product quantity
            $product = Product::where('id', $order->product_id)->first();
            $product->update([
                'total_quantity' => DB::raw("total_quantity - $order->total_quantity")
            ]);

            //add user total_amount & define level
            $user = UserLevel::where('user_id', $order->user_id)->first();
            $user->update([
                'total_amount' => $order->total_amount
            ]);

            if ($user->total_amount > 10000) {
                $user->update([
                    'level' => 'VIP user'
                ]);
            } else if ($user->total_amount > 50000) {
                $user->update([
                    'level' => 'VVIP user'
                ]);
            }
        }

        return redirect('/admin/order')->with('success', 'Order Status Changed');
    }
}
