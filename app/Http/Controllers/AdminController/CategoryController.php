<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\CategoryRequest;
use App\Models\AdminModel\CategoryModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = CategoryModel::orderBy('id', 'DESC')->get();

            return DataTables::of($categories)
                ->editColumn('parent', function ($category) {
                    return $category->parentCategory->name;
                })
                ->editColumn('status', function ($category) {
                    return $category->status();
                })
                ->editColumn('action', function ($category) {
                    $routeEdit = route('category.edit', $category->slug);
                    $routeDestroy = "'" . route('category.destroy', $category->slug) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['parent', 'status', 'action'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryModel::orderBy('id', 'DESC')->get();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $newCategory = CategoryModel::create($request->validated());
            if ($newCategory) {
                return redirect()->back()->withErrors(['success' => 'Create a new category successfuly!']);
            }
            return redirect()->back()->withErrors(['error' => 'Create new category failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryModel $categoryModel)
    {
        $categories = CategoryModel::where('activated', 1)->orderBy('id', 'DESC')->get();
        return view('admin.category.update', compact('categories', 'categoryModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, CategoryModel $categoryModel)
    {
        try {
            if ($categoryModel->update($request->validated())) {
                return redirect()->route('category.index')->withErrors(['success' => 'Category has been successfully updated!']);
            }
            return redirect()->back()->withErrors(['error' => 'Category update failed!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryModel $categoryModel)
    {
        try {
            if ($categoryModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
