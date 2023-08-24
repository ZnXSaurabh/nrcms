<?php

namespace App\Http\Controllers\Management;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.sub-category.index');
    }

    public function getSubCategories()
    {
        return Datatables::of(SubCategory::query()->orderBy('name', 'ASC')->orderBy('category_id', 'ASC'))
            ->addIndexColumn()
            ->editColumn('icons', function($subcategory) {
                if($subcategory->icons) {
                    $url = Storage::url("category-icons/" . $subcategory->name . "/" . $subcategory->icons);
                    return '<img height="50" src="'. $url .'" alt="'. $subcategory->name .'" class="img-wrap">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $subcategory->name .'">';
                }
            })
            ->editColumn('category_id', function($subcategory) {
                return $subcategory->category->name;
            })
            ->addColumn('actions', function ($subcategory) {
                $route = '/management/sub-categories/'.$subcategory->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/sub-categories/'. $subcategory->id .'/edit" title="Edit Sub Category"><i data-feather="edit-3"></i></a>'. 
                view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['icons', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('sup_cat_id', 'ASC')->get();
        return view('management.masters.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        $request->validated();

        $sub_category = SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($sub_category) {
            if ($request->hasFile('icons')) {
                Storage::putFileAs('public/category-icons/' . $sub_category->name .'', $request->file('icons'), 'icon_'. $sub_category->id.'.'.$request->file('icons')->extension());
                $icons = 'icon_'.$sub_category->id.'.'.$request->file('icons')->extension();
                
                $sub_category->icons = $icons;
                $sub_category->save();
            }
            return back()->with('success', 'Sub Category added successfully.');
        }

        return back()->with('error', 'Somthing went wrong. Try Again!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category = SubCategory::find($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('management.masters.sub-category.edit', compact('sub_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        $request->validated();

        $sub_category = SubCategory::find($id);

        $sub_category->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($sub_category) {

            if ($request->hasFile('icons')) {
                Storage::putFileAs('public/category-icons/' . $sub_category->name .'', $request->file('icons'), 'icon_'. $sub_category->id.'.'.$request->file('icons')->extension());
                $icons = 'icon_'.$sub_category->id.'.'.$request->file('icons')->extension();
                
                $sub_category->icons = $icons;
                $sub_category->save();
            }
            return back()->with('success', 'Sub Category updated successfully.');
        }

        return back()->with('error', 'Somthing went wrong. Try Again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            SubCategory::destroy($id);
            return back()->with('success', 'Sub Category deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Category has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
