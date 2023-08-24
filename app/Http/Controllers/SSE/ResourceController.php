<?php

namespace App\Http\Controllers\SSE;

use App\Models\Category;
use App\Models\SSE\Vendor;
use App\Models\SubCategory;
use App\Models\SSE\Resource;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SSE\ResourceRequest;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sse.resource.index');
    }

    public function getResources()
    {   
        
        
              if (auth()->user()->hasAnyRole('super-admin')) {
        $vendorsId = Vendor::pluck('id')->toArray();

        return Datatables::of(Resource::query()->whereIn('vendor_id', $vendorsId))
            ->addIndexColumn()
            ->editColumn('photo', function($resource) {
                if($resource->photo) {
                    $url = Storage::url("resources/" . $resource->id . "/" . $resource->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $resource->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $resource->name .'">';
                }
            })
            ->editColumn('name', function($resource) {
                return $resource->name;
            })
            ->editColumn('email', function($resource) {
                return $resource->email;
            })
            ->editColumn('mobile', function($resource) {
                return $resource->mobile;
            })
            ->addColumn('actions', function ($resource) {
                $route = '/sse/resources/'.$resource->id;
                return '<button class="action-btn show-btn mr-1 showResourceModalBtn" data-resourceID="'. $resource->id .'" title="View Resource">
                            <i data-feather="eye"></i>
                        </button>
                    <a class="action-btn edit-btn mr-1" href="/sse/resources/'. $resource->id .'/edit" title="Edit Resource"><i data-feather="edit-3"></i></a>'. 
                    view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['photo', 'actions'])
            ->make(true);
        }
        
        
        if (auth()->user()->hasAnyRole('sse')) {
        $vendorsId = Vendor::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->pluck('id')->toArray();

        return Datatables::of(Resource::query()->whereIn('vendor_id', $vendorsId))
            ->addIndexColumn()
            ->editColumn('photo', function($resource) {
                if($resource->photo) {
                    $url = Storage::url("resources/" . $resource->id . "/" . $resource->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $resource->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $resource->name .'">';
                }
            })
            ->editColumn('name', function($resource) {
                return $resource->name;
            })
            ->editColumn('email', function($resource) {
                return $resource->email;
            })
            ->editColumn('mobile', function($resource) {
                return $resource->mobile;
            })
            ->addColumn('actions', function ($resource) {
                $route = '/sse/resources/'.$resource->id;
                return '<button class="action-btn show-btn mr-1 showResourceModalBtn" data-resourceID="'. $resource->id .'" title="View Resource">
                            <i data-feather="eye"></i>
                        </button>
                    <a class="action-btn edit-btn mr-1" href="/sse/resources/'. $resource->id .'/edit" title="Edit Resource"><i data-feather="edit-3"></i></a>'. 
                    view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['photo', 'actions'])
            ->make(true);
        }
    }

    public function resourcesOfAVendor($vendor_id)
    {
        return Resource::select('resources.*', 'categories.name as cat_name')->join('categories','categories.id',"=",'resources.category_id')->where('vendor_id', $vendor_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        // $sub_categories = SubCategory::orderBy('name', 'ASC')->get(); //remove by gaurav baliyan
        return view('sse.resource.create', compact('vendors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceRequest $request)
    {
        $request->validated();

        $resource = Resource::create([
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'pfno' => $request->pfno,
            'esi_no' => $request->esi_no,
            'category_id' => $request->category_id,
            // 'sub_category_id' => $request->sub_category_id, //remove by gaurav baliyan
            'remarks' => $request->remarks,
        ]);

        if ($resource) {
            // Resource Photo
            if ($request->hasFile('photo')) {
                Storage::putFileAs('public/resources/' . $resource->id .'', $request->file('photo'), 'photo_'. $resource->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$resource->id.'.'.$request->file('photo')->extension();

                $resource->photo = $photo;
                $resource->save();
            }

            return back()->with('success', 'Resource created successfully.');
        }

        return back()->with('error', 'Somthing went wrong. Try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Resource::with('vendor', 'category', 'sub_category')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Resource::find($id);
        $vendors = Vendor::whereIn('location_id', [auth()->user()->locations()->get()->pluck('id')])->where('sup_cat_id', Auth::user()->profile->department)->orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        // $sub_categories = SubCategory::orderBy('name', 'ASC')->get(); //remove by gaurav baliyan
        return view('sse.resource.edit', compact('resource', 'vendors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceRequest $request, $id)
    {
        $request->validated();

        $resource = Resource::find($id);
        
        $resource->update([
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'pfno' => $request->pfno,
            'esi_no' => $request->esi_no,
            'category_id' => $request->category_id,
            // 'sub_category_id' => $request->sub_category_id, //remove by gaurav baliyan
            'remarks' => $request->remarks,
        ]);

        if ($resource) {
            // Resource Photo
            if ($request->hasFile('photo')) {
                Storage::delete('public/resources/'.$resource->id.'/'.$resource->photo);
                Storage::putFileAs('public/resources/' . $resource->id .'', $request->file('photo'), 'photo_'. $resource->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$resource->id.'.'.$request->file('photo')->extension();

                $resource->photo = $photo;
                $resource->save();
            }

            return back()->with('success', 'Resource updated successfully.');
        }

        return back()->with('error', 'Somthing went wrong. Try again!');
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
            Resource::destroy($id);
            return back()->with('success', 'Resource deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Resource has some related data and can not be deleted.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
