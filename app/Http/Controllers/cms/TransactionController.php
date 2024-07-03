<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Order;
use App\Models\Transaction;

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

        if($order->total_amount < 1){
            return redirect()->route('orders.show', $order)->with('error', 'Error, Transaction cant be completed with 0 amount.');
        }

        $mpesa_transaction_id = $cash_transaction_id = null;

        if( $request->payment_method == 'cash'){
            $cash_transaction_id =  'CSH'.date('Ymd').'/'.sprintf("%03d",$order->id).'/'.strtoupper(Str::random(3));
        }

        $transaction = Transaction::create([
            'fk_order' => $order->id,
            'payment_method' => $request->payment_method,
            'mpesa_transaction_id' => $mpesa_transaction_id,
            'cash_transaction_id' => $cash_transaction_id,
            'amount' => $order->total_amount,
        ]);

        if( $transaction){
            $order->status = 'completed';
            $order->save();
            return redirect()->route('orders.show', $order)->with('success', 'Transaction recorded successfully.');
        }

        return redirect()->route('orders.show', $order)->with('error', 'Error, Transaction could not be completed successfully.');
    }
}
