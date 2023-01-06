<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\ValueRequest;
use App\Models\AdminModel\OptionModel;
use App\Models\AdminModel\ValueModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $option = OptionModel::where('slug', $request->optionModel)->first()->id;
            $values = ValueModel::where('option_id', $option)->orderBy('id', 'DESC')->get();
            return DataTables::of($values, $request)
                ->editColumn('option', function ($value) {
                    return $value->getOption->name;
                })
                ->editColumn('status', function ($value) {
                    return $value->status();
                })
                ->editColumn('action', function ($value) use ($request) {
                    $routeEdit = route('value.edit', [$request->optionModel, $value->slug]);
                    $routeDestroy = "'" . route('value.destroy', [$request->optionModel, $value->slug]) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['option', 'status', 'action'])
                ->make(true);
        }
        return view('admin.option.value.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.option.value.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValueRequest $request, OptionModel $optionModel)
    {
        try {
            if (ValueModel::create($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Create a new value option successfuly!']);
            }
            return redirect()->back()->withErrors(['error' => 'Create new value option failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\ValueModel  $valueModel
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionModel $optionModel, ValueModel $valueModel)
    {
        return view('admin.option.value.update', compact('optionModel', 'valueModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\ValueModel  $valueModel
     * @return \Illuminate\Http\Response
     */
    public function update(ValueRequest $request, OptionModel $optionModel, ValueModel $valueModel)
    {
        try {
            if ($valueModel->update($request->validated())) {
                return redirect()->route('value.index', $optionModel)->withErrors(['success' => 'Value has been successfully updated!']);
            }
            return redirect()->back()->withErrors(['error' => 'Value update failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\ValueModel  $valueModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionModel $optionModel, ValueModel $valueModel)
    {
        try {
            if ($valueModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
