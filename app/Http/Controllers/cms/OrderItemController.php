<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fk_order' => 'required|exists:orders,id',
            'fk_product' => 'required|exists:products,id',
            'unit_price' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()->route('orders.show', ['order' => $request->fk_order])
                        ->withErrors($validator);
        }
        dd($request);
        OrderItem::create([
            'fk_order' => $request->fk_order,
            'fk_product' => $request->fk_product,
            'unit_price' => $request->price,
            'quantity' => $request->quantity,
            'amount' => $request->total_amount,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
