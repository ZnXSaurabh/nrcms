<?php
namespace App\Http\Controllers\Management;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SuperCategory;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.category.index');
    }

    public function getCategories()
    {
        return Datatables::of(Category::query())
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
            ->editColumn('sup_cat_id', function($category) {
                return $category->supercategory->name;
            })
            ->addColumn('actions', function ($category) {
                $route = '/management/categories/'.$category->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/categories/'. $category->id .'/edit" title="Edit Category"><i data-feather="edit-3"></i></a>'. 
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
        $supcategories = SuperCategory::orderBy('name', 'ASC')->get();
        return view('management.masters.category.create', compact('supcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        $category = Category::create([
            'sup_cat_id' => $request->sup_cat_id,
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
            return back()->with('success', 'Category added successfully.');
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
        $category = Category::find($id);
        $supcategories = SuperCategory::orderBy('name', 'ASC')->get();
        return view('management.masters.category.edit', compact('category', 'supcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $request->validated();

        $category = Category::find($id);

        $category->update([
            'sup_cat_id' => $request->sup_cat_id,
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
            return back()->with('success', 'Category updated successfully.');
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
            Category::destroy($id);
            return back()->with('success', 'Category deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Category has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
