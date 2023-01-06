<?php

namespace App\Http\Controllers\AdminController;

use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\CouponRequest;
use App\Models\AdminModel\CouponModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = CouponModel::orderBy('id', 'DESC')->get();

            return DataTables::of($coupons)
                ->editColumn('type', function ($coupon) {
                    return $coupon->getType();
                })
                ->editColumn('value', function ($coupon) {
                    return number_format($coupon->value);
                })
                ->editColumn('time_start', function ($coupon) {
                    return date('d/m/Y', strtotime($coupon->time_start));
                })
                ->editColumn('time_end', function ($coupon) {
                    return date('d/m/Y', strtotime($coupon->time_end));
                })
                ->editColumn('status', function ($coupon) {
                    return $coupon->status();
                })
                ->editColumn('action', function ($coupon) {
                    $routeEdit = route('coupon.edit', $coupon->slug);
                    $routeDestroy = "'" . route('coupon.destroy', $coupon->slug) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['type', 'value', 'status', 'action'])
                ->make(true);
        }
        return view('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypeEnum::asArray();
        return view('admin.coupon.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        try {
            if (CouponModel::create($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Create a new coupon successfuly!']);
            }
            return redirect()->back()->withErrors(['error' => 'Create new coupon failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CouponModel $couponModel)
    {
        $types = TypeEnum::asArray();
        return view('admin.coupon.update', compact('couponModel', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, CouponModel $couponModel)
    {
        try {
            if ($couponModel->update($request->validated())) {
                return redirect()->route('coupon.index')->withErrors(['success' => 'Coupon has been successfully updated!']);
            }
            return redirect()->back()->withErrors(['error' => 'Coupon update failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouponModel $couponModel)
    {
        try {
            if ($couponModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
