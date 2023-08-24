<?php

namespace App\Http\Controllers\Management;

use App\Models\SuperCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SuperCategoryRequest;

class SuperCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.super-category.index');
    }

    public function getSuperCategories()
    {
        return Datatables::of(SuperCategory::query())
            ->addIndexColumn()
            ->editColumn('icons', function($category) {
                if($category->icons) {
                    $url = Storage::url("category-icons/" . $category->name . "/" . $category->icons);
                    return '<img height="50" src="'. $url .'" alt="'. $category->name .'" class="img-wrap">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $category->name .'">';
                }
            })
            ->addColumn('actions', function ($category) {
                $route = '/management/super-categories/'.$category->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/super-categories/'. $category->id .'/edit" title="Edit Category"><i data-feather="edit-3"></i></a>'. 
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
        return view('management.masters.super-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuperCategoryRequest $request)
    {
        $request->validated();

        $category = SuperCategory::create([
            'name' => $request->name,
            'description' => $request->desc
        ]);
        
        if ($category) {

            if ($request->hasFile('icons')) {
                Storage::putFileAs('public/category-icons/' . $category->name .'', $request->file('icons'), 'icon_'. $category->id.'.'.$request->file('icons')->extension());
                $icons = 'icon_'.$category->id.'.'.$request->file('icons')->extension();
                
                $category->icons = $icons;
                $category->save();
            }
            return back()->with('success', 'Super Category added successfully.');
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = SuperCategory::find($id);
        return view('management.masters.super-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuperCategoryRequest $request, $id)
    {
        $request->validated();

        $category = SuperCategory::find($id);
        
        $category->update([
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($category) {
            
            if ($request->hasFile('icons')) {
                Storage::putFileAs('public/category-icons/' . $category->name .'', $request->file('icons'), 'icon_'. $category->id.'.'.$request->file('icons')->extension());
                $icons = 'icon_'.$category->id.'.'.$request->file('icons')->extension();
                
                $category->icons = $icons;
                $category->save();
            }
            return back()->with('success', 'Super Category updated successfully.');
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
            SuperCategory::destroy($id);
            return back()->with('success', 'Super Category deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Super Category has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}