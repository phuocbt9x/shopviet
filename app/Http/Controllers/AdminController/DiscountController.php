<?php

namespace App\Http\Controllers\AdminController;

use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\DiscountRequest;
use App\Models\AdminModel\DiscountModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $discounts = DiscountModel::orderBy('id', 'DESC')->get();

            return DataTables::of($discounts)
                ->editColumn('type', function ($discount) {
                    return $discount->getType();
                })
                ->editColumn('value', function ($discount) {
                    return number_format($discount->value);
                })
                ->editColumn('status', function ($discount) {
                    return $discount->status();
                })
                ->editColumn('action', function ($discount) {
                    $routeEdit = route('discount.edit', $discount->slug);
                    $routeDestroy = "'" . route('discount.destroy', $discount->slug) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['type', 'value', 'status', 'action'])
                ->make(true);
        }
        return view('admin.discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypeEnum::asArray();
        return view('admin.discount.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        try {
            if (DiscountModel::create($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Create a new discount successfuly!']);
            }
            return redirect()->back()->withErrors(['error' => 'Create new discount failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountModel $discountModel)
    {
        $types = TypeEnum::asArray();
        return view('admin.discount.update', compact('types', 'discountModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, DiscountModel $discountModel)
    {
        try {
            if ($discountModel->update($request->validated())) {
                return redirect()->route('discount.index')->withErrors(['success' => 'Discount has been successfully updated!']);
            }
            return redirect()->back()->withErrors(['error' => 'Discount update failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountModel $discountModel)
    {
        try {
            if ($discountModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
