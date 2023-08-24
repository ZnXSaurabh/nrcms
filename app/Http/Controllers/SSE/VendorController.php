<?php

namespace App\Http\Controllers\SSE;

use App\Models\Location;
use App\Models\SSE\Vendor;
use Illuminate\Http\Request;
use App\Models\SuperCategory;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SSE\VendorRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sse.vendor.index');
    }

    public function getVendors()
    {
        
        
         if (auth()->user()->hasAnyRole('super-admin')) {
        return Datatables::of(Vendor::query()->orderBy('name', 'ASC'))
            ->addIndexColumn()
            ->editColumn('photo', function($vendor) {
                if($vendor->photo) {
                    $url = Storage::url("vendors/" . $vendor->id . "/" . $vendor->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $vendor->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $vendor->name .'">';
                }
            })
            ->editColumn('name', function($vendor) {
                return $vendor->name;
            })
            ->editColumn('email', function($vendor) {
                return $vendor->email;
            })
            ->editColumn('mobile', function($vendor) {
                return $vendor->mobile;
            })
            ->addColumn('actions', function ($vendor) {
                $route = '/sse/vendors/'.$vendor->id;
                return '<button class="action-btn show-btn mr-1 showVendorModalBtn" data-vendorID="'. $vendor->id .'" title="View Vendor">
                            <i data-feather="eye"></i>
                        </button>
                    <a class="action-btn edit-btn mr-1" href="/sse/vendors/'. $vendor->id .'/edit" title="Edit Vendor"><i data-feather="edit-3"></i></a>'. 
                    view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['photo', 'actions'])
            ->make(true);
        }
        
        if (auth()->user()->hasAnyRole('sse')) {
        return Datatables::of(Vendor::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->orderBy('name', 'ASC'))
            ->addIndexColumn()
            ->editColumn('photo', function($vendor) {
                if($vendor->photo) {
                    $url = Storage::url("vendors/" . $vendor->id . "/" . $vendor->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $vendor->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $vendor->name .'">';
                }
            })
            ->editColumn('name', function($vendor) {
                return $vendor->name;
            })
            ->editColumn('email', function($vendor) {
                return $vendor->email;
            })
            ->editColumn('mobile', function($vendor) {
                return $vendor->mobile;
            })
            ->addColumn('actions', function ($vendor) {
                $route = '/sse/vendors/'.$vendor->id;
                return '<button class="action-btn show-btn mr-1 showVendorModalBtn" data-vendorID="'. $vendor->id .'" title="View Vendor">
                            <i data-feather="eye"></i>
                        </button>
                    <a class="action-btn edit-btn mr-1" href="/sse/vendors/'. $vendor->id .'/edit" title="Edit Vendor"><i data-feather="edit-3"></i></a>'. 
                    view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['photo', 'actions'])
            ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $supercategories = SuperCategory ::get();
        $locations = Location::whereIn('id', auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();
        
        return view('sse.vendor.create', compact('locations','supercategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        $request->validated();

        $vendor = Vendor::create([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'sup_cat_id' => $request->sup_cat_id,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'agreement_no' => $request->agreement_no,
            'remarks' => $request->remarks
        ]);

        if ($vendor) {
            // Vendor Photo
            if ($request->hasFile('photo')) {
                Storage::putFileAs('public/vendors/' . $vendor->id .'', $request->file('photo'), 'photo_'. $vendor->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$vendor->id.'.'.$request->file('photo')->extension();

                $vendor->photo = $photo;
                $vendor->save();
            }

            return back()->with('success', 'Vendor created successfully.');
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
        return Vendor::with('location')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $supercategories = SuperCategory ::get();
        $vendor = Vendor::find($id);
        $locations = Location::whereIn('id', [auth()->user()->locations()->get()->pluck('id')])->orderBy('name', 'ASC')->get();
        return view('sse.vendor.edit', compact('vendor', 'locations','supercategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        $request->validated();

        $vendor = Vendor::find($id);
        $vendor->update([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'agreement_no' => $request->agreement_no,
            'photo' => $vendor->photo,
            'remarks' => $request->remarks
        ]);

        if ($vendor) {
            // Vendor Photo
            if ($request->hasFile('photo')) {
                Storage::delete('public/vendors/'.$vendor->id.'/'.$vendor->photo);
                Storage::putFileAs('public/vendors/' . $vendor->id .'', $request->file('photo'), 'photo_'. $vendor->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$vendor->id.'.'.$request->file('photo')->extension();

                $vendor->photo = $photo;
                $vendor->save();
            }

            return back()->with('success', 'Vendor updated successfully.');
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
            Vendor::destroy($id);
            return back()->with('success', 'Vendor deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Vendor has some related data and can not be deleted.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
