<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAddTransition;
use App\Models\ProductRemoveTransition;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PDO;

class TransactionController extends Controller
{
    public function addTransaction()
    {
        $transactions = ProductAddTransition::with('product')->latest()->paginate(5);
        $suppliers = Supplier::all();
        return view('admin.product.transaction.add-transaction', compact('transactions', 'suppliers'));
    }

    public function removeTransaction()
    {
        $transactions = ProductRemoveTransition::with('product')->latest()->paginate(5);
        return view('admin.product.transaction.remove-transaction', compact('transactions'));
    }
}
