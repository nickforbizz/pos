<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember('order_items', 200, function () {
            return OrderItem::with('product')->orderBy('created_at', 'desc')->get();
        });
        
        if ($request->ajax()) {
            $user = auth()->user();
            $userRoles = Cache::get("user_roles_{$user->id}", []); // Default to empty array if null
            $userPermissions = Cache::get("user_permissions_{$user->id}", []);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    if(is_null($row->created_at)){
                        return 'N/A';
                    }
                    return date_format($row->created_at, 'Y/m/d H:i');
                })
                ->editColumn('fk_product', function ($row) {
                    if(is_null($row->fk_product)){
                        return 'N/A';
                    }
                    return $row->product->title;
                })
                ->addColumn('action', function ($row) use ($user, $userRoles, $userPermissions) {
                    $btn_edit = $btn_del = null;
                    if (in_array('superadmin', $userRoles) || in_array('admin', $userRoles) || in_array('editor', $userRoles) || $user->id == $row->created_by) {
                        $btn_edit = '<a data-toggle="tooltip" 
                                        href="' . route('orders.edit', $row->id) . '" 
                                        class="btn btn-link btn-primary btn-lg" 
                                        data-original-title="Edit Record">
                                    <i class="fa fa-edit"></i>
                                </a>';
                    }

                    if (in_array('superadmin', $userRoles)) {
                        $btn_del = '<button type="button" 
                                    data-toggle="tooltip" 
                                    title="" 
                                    class="btn btn-link btn-danger" 
                                    onclick="delRecord(`' . $row->id . '`, `' . route('orders.destroy', $row->id) . '`, `#tb_orders`)"
                                    data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>';
                    }
                    return $btn_edit . $btn_del;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
            'price' => 'required',
            'quantity' => 'required',
            'total_amount' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()->route('orders.show', ['order' => $request->fk_order])
                        ->with('errors', 'Some fields failed validation');
        }

        OrderItem::create([
            'fk_order' => $request->fk_order,
            'fk_product' => $request->fk_product,
            'unit_price' => $request->price,
            'quantity' => $request->quantity,
            'amount' => $request->total_amount,
        ]);

        // update order
        $order = Order::find($request->fk_order);
        $order->total_amount += (float) $request->total_amount;
        $order->save();

        // reduce stock
        $product = Product::find($request->fk_product);
        $product->quantity -= (int) $request->quantity;
        $product->save();

        return redirect()->route('orders.show', ['order' => $request->fk_order])
        ->with('success', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        return response()
            ->json([
                'orderItem' => $orderItem, 
            ], 200, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
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
        if($request->filled('fk_product')){
            $orderItem->fk_product = $request->fk_product;
        }

        if($request->filled('quantity')){
            $orderItem->quantity = $request->quantity;
        }

        if($request->filled('price')){
            $orderItem->unit_price = $request->price;
        }

        if($request->filled('total_amount')){
            $item_total_amount = $orderItem->amount;
            $orderItem->amount = $request->total_amount;
        }

        if($orderItem->save()){
            // update order
            $order = Order::find($request->fk_order);
            $total_amount = $order->total_amount;
            $order->total_amount = (float)(($total_amount -  $item_total_amount) + $request->total_amount);
            $order->save();


            // reduce stock
            $product = Product::find($request->fk_product);
            $product->quantity = ($product->quantity - (int) $orderItem->quantity) + (int) $request->quantity;
            $product->save();


            return redirect()->route('orders.show', ['order' => $order->id])->with('success', 'Order successfully updated');
        }
        return redirect()->back()->with('error', 'Error while updating your Order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
