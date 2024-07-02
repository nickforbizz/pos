<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create(Order $order)
    {
        return view('transactions.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,mpesa',
        ]);

        dd([$request, $order]);
        $transaction = new Transaction($request->all());
        $order->transactions()->save($transaction);

        return redirect()->route('orders.show', $order)->with('success', 'Transaction recorded successfully.');
    }
}
