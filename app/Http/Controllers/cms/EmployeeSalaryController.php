<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Tenant;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Models\EmployeeSalary;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return datatable of the makes available
        $data = EmployeeSalary::orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    if(is_null($row->created_at)){
                        return 'N/A';
                    }
                    return date_format($row->created_at, 'Y/m/d H:i');
                })
                ->addColumn('action', function ($row) {
                    $btn_edit = $btn_del = null;
                    if (auth()->user()->hasAnyRole('superadmin|admin|editor') || auth()->id() == $row->created_by) {
                        $btn_edit = '<a data-toggle="tooltip" 
                                        href="' . route('employee_salaries.edit', $row->id) . '" 
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
                                    onclick="delRecord(`' . $row->id . '`, `' . route('employee_salaries.destroy', $row->id) . '`, `#tb_employee_salaries`)"
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
        return view('cms.employee_salaries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get active tenants
        $tenants = Tenant::where('active',1)->get();
        return view('cms.employee_salaries.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeSalaryRequest $request)
    {
        EmployeeSalary::create($request->validated());
        return redirect()->back()->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeSalary $employee_salary)
    {
        return response()
            ->json($employee_salary, 200, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSalary $employee_salary)
    {
        $tenants = Tenant::where('active',1)->get();
        return view('cms.employee_salaries.create', compact('employee_salary','tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeSalaryRequest $request, EmployeeSalary $employee_salary)
    {
        $employee_salary->update($request->validated());

        // Redirect the user to the user's profile page
        return redirect()
            ->route('employee_salaries.index')
            ->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSalary $employee_salary)
    {
        if ($employee_salary->delete()) {
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
