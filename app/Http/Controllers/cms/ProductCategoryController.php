<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return datatable of the makes available
        $data = Cache::remember('productCategories', 60, function () {
            return ProductCategory::with('user')->orderBy('created_at', 'desc')->get();
        });

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return '<a data-toggle="tooltip" 
                            href="' . route('productCategories.show', $row->id) . '" 
                            class="" 
                            data-original-title="Show Record">
                        ' . $row->name . '
                    </a>';
                })
                ->editColumn('created_by', function ($row) {
                    return !is_null($row->created_by) ? $row->user->name : null;
                })
                ->editColumn('created_at', function ($row) {
                    return !is_null($row->created_at) ? date_format($row->created_at, 'Y/m/d H:i') : null;
                })
                ->addColumn('action', function ($row) {
                    $btn_edit = $btn_del = null;
                    $canEdit = Gate::allows('edit product categories');
                    $canDelete = Gate::allows('delete product categories');
                    if ((auth()->user()->hasAnyRole('superadmin|admin|editor') || auth()->id() == $row->created_by) && $canEdit) {
                        $btn_edit = '<a data-toggle="tooltip" 
                                        href="' . route('productCategories.edit', $row->id) . '" 
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
                                    onclick="delRecord(`' . $row->id . '`, `' . route('productCategories.destroy', $row->id) . '`, `#tb_productCategories`)"
                                    data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>';
                    }
                    return $btn_edit . $btn_del;
                })
                ->rawColumns(['action', 'name', 'created_by', 'created_at'])
                ->make(true);
        }

        // render view
        return view('cms.productcategories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create($request->all());
        return redirect()->back()->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory, Request $request)
    {
        // $products = $productCategory->products;
        // $productCategory->products = $products;
        // return response()
        //     ->json([
        //         'productCategory' => $productCategory, 
        //         'products' => Datatables::of($productCategory->products) ->addIndexColumn()
        //     ], 200, ['JSON_PRETTY_PRINT' => JSON_PRETTY_PRINT]);
        
        if ($request->ajax()) {
            $data = Cache::remember('productCategory' . $productCategory->id . '_products', 60, function () use ($productCategory) {
                return $productCategory->products;
            });
            return Datatables::of($data) ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return date_format($row->created_at, 'Y/m/d H:i');
            })
            ->editColumn('photo', function ($row) {
                return '<img class="tb_img" src="' . url('storage/' . $row->photo) . '" alt="' . $row->slug . '" data-toggle="popover" data-placement="top" data-content="<img src=' . url('storage/' . $row->photo) . ' style=\'max-height: 200px; max-width: 200px;\'>">';
            })
            ->editColumn('title', function ($row) {
                return '<a data-toggle="tooltip" 
                        href="' . route('products.show', $row->id) . '" 
                        class="btn btn-link btn-primary btn-lg" 
                        data-original-title="Edit Record">
                    ' . Str::limit($row->title, 18, '...') . '
                </a>';
            })
            ->rawColumns(['photo', 'title'])
            ->make(true);
        }
        return view('cms.productcategories.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('cms.productcategories.create', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        // Redirect the user to the user's profile page
        return redirect()
            ->route('productCategories.index')
            ->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->delete()) {
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
