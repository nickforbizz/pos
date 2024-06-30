<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Requests\ValuelistRequest;
use App\Models\Valuelist;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ValuelistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return datatable of the makes available
        $data = Cache::remember('valuelists', 60, function () {
            return Valuelist::with('user')->orderBy('created_at', 'desc')->orderBy('index', 'asc')->get();
        });

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()               
                ->editColumn('created_by', function ($row) {
                    return !is_null($row->created_by) ? $row->user->name : null;
                })
                ->editColumn('created_at', function ($row) {
                    return !is_null($row->created_at) ? date_format($row->created_at, 'Y/m/d H:i') : null;
                })
                ->addColumn('action', function ($row) {
                    $btn_edit = $btn_del = null;
                    $canEdit = Gate::allows('edit valuelists');
                    $canDelete = Gate::allows('delete valuelists');
                    if ((auth()->user()->hasAnyRole('superadmin|admin|editor') || auth()->id() == $row->created_by) && $canEdit) {
                        $btn_edit = '<a data-toggle="tooltip" 
                                        href="' . route('valuelists.edit', $row->id) . '" 
                                        class="btn btn-link btn-primary btn-lg" 
                                        data-original-title="Edit Record">
                                    <i class="fa fa-edit"></i>
                                </a>';
                    }

                    if (auth()->user()->hasRole('superadmin') || $canDelete) {
                        $btn_del = '<button type="button" 
                                    data-toggle="tooltip" 
                                    title="" 
                                    class="btn btn-link btn-danger" 
                                    onclick="delRecord(`' . $row->id . '`, `' . route('valuelists.destroy', $row->id) . '`, `#tb_valuelists`)"
                                    data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>';
                    }
                    return $btn_edit . $btn_del;
                })
                ->rawColumns(['action', 'created_by', 'created_at'])
                ->make(true);
        }

        // render view
        return view('cms.valuelists.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.valuelists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValuelistRequest $request)
    {
        Valuelist::create($request->validated());
        return redirect()->back()->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Valuelist $valuelist, Request $request)
    {
        
        return $valuelist;
        return view('cms.valuelist.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valuelist $valuelist)
    {
        return view('cms.valuelist.create', compact('valuelist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValuelistsRequest $request, Valuelist $valuelist)
    {
        $valuelist->update($request->all());

        // Redirect the user to the user's profile page
        return redirect()
            ->route('valuelist.index')
            ->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valuelist $valuelist)
    {
        if ($valuelist->delete()) {
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

    public static function getValuesByType($type)
    {
        return Valuelist::where('type', $type)->get();
    }
}
