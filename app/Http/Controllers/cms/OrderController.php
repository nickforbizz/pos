<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Tenant;
use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return datatable of the makes available
        $data = Order::orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    if(is_null($row->created_at)){
                        return 'N/A';
                    }
                    return date_format($row->created_at, 'Y/m/d H:i');
                })
                ->editColumn('order_date', function ($row) {
                    if(is_null($row->order_date)){
                        return 'N/A';
                    }
                    return date_format($row->order_date, 'Y/m/d');
                })
                ->editColumn('employee', function ($row) {
                    if(is_null($row->fk_employee)){
                        return 'N/A';
                    }
                    return $row->employee->name;
                })
                ->editColumn('customer', function ($row) {
                    if(is_null($row->fk_customer)){
                        return 'N/A';
                    }
                    return $row->customer->email;
                })
                ->addColumn('action', function ($row) {
                    $btn_edit = $btn_del = null;
                    if (auth()->user()->hasAnyRole('superadmin|admin|editor') || auth()->id() == $row->created_by) {
                        $btn_edit = '<a data-toggle="tooltip" 
                                        href="' . route('orders.edit', $row->id) . '" 
                                        class="btn btn-link btn-primary btn-lg" 
                                        data-original-title="Edit Record">
                                    <i class="fa fa-edit"></i>
                                </a>';
                    }

                    if (auth()->user()->hasRole('superadmin')) {
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

        // render view
        return view('cms.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get active tenants
        $tenants = Tenant::where('active',1)->get();
        $employees = Employee::where('active',1)->get();
        $customers = Customer::where('active',1)->get();
        return view('cms.orders.create', compact('tenants', 'employees', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        Order::create($request->validated());
        return redirect()->back()->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()
            ->json($order, 200, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $tenants = Tenant::where('active',1)->get();
        $employees = Employee::where('active',1)->get();
        $customers = Customer::where('active',1)->get();
        return view('cms.orders.create', compact('order','tenants', 'employees', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        // Redirect the user to the user's profile page
        return redirect()
            ->route('orders.index')
            ->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if ($order->delete()) {
            return response()->json([
                'code' => 1,
                'msg' => 'Record deleted successfully'
            ], 200, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
        }

        return response()->json([
            'code' => -1,
            'msg' => 'Record did not delete'
        ], 422, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
    }
}
