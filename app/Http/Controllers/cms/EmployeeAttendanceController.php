<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Tenant;
use App\Http\Requests\EmployeeAttendanceRequest;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return datatable of the makes available
        $data = Cache::remember('employees_attendances', 60, function () {
            return EmployeeAttendance::orderBy('created_at', 'desc')->get();
        });
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    if(is_null($row->created_at)){
                        return 'N/A';
                    }
                    return date_format($row->created_at, 'Y/m/d H:i');
                })
                ->editColumn('clock_in', function ($row) {
                    if(is_null($row->clock_in)){
                        return 'N/A';
                    }
                    return date_format($row->clock_in, 'Y/m/d');
                })
                ->editColumn('clock_out', function ($row) {
                    if(is_null($row->clock_out)){
                        return 'N/A';
                    }
                    return date_format($row->clock_out, 'Y/m/d');
                })
                ->editColumn('date', function ($row) {
                    if(is_null($row->date)){
                        return 'N/A';
                    }
                    return date_format($row->date, 'Y/m/d');
                })
                ->editColumn('employee', function ($row) {
                    if(is_null($row->fk_employee)){
                        return 'N/A';
                    }
                    return $row->employee->name;
                })
                ->addColumn('action', function ($row) {
                    $btn_edit = $btn_del = null;
                    if (auth()->user()->hasAnyRole('superadmin|admin|editor') || auth()->id() == $row->created_by) {
                        $btn_edit = '<a data-toggle="tooltip" 
                                        href="' . route('employee_attendance.edit', $row->id) . '" 
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
                                    onclick="delRecord(`' . $row->id . '`, `' . route('employee_attendance.destroy', $row->id) . '`, `#tb_employee_attendance`)"
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
        return view('cms.employee_attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get active tenants
        $tenants = Tenant::where('active',1)->get();
        $employees = Employee::where('active',1)->get();
        return view('cms.employee_attendance.create', compact('tenants', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeAttendanceRequest $request)
    {
        EmployeeAttendance::create($request->validated());
        return redirect()->back()->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeAttendance $employee_attendance)
    {
        return response()
            ->json($employee_attendance, 200, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeAttendance $employee_attendance)
    {
        $tenants = Tenant::where('active',1)->get();
        $employees = Employee::where('active',1)->get();
        $employee_attendance->pay_date = Carbon::create($employee_attendance->pay_date)->format('Y-m-d');
        return view('cms.employee_attendance.create', compact('employee_attendance','tenants', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeAttendanceRequest $request, EmployeeAttendance $employee_attendance)
    {
        $employee_attendance->update($request->validated());

        // Redirect the user to the user's profile page
        return redirect()
            ->route('employee_attendance.index')
            ->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeAttendance $employee_attendance)
    {
        if ($employee_attendance->delete()) {
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
