<?php

namespace App\Http\Controllers\Management;

use App\Models\Location;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.location.index');
    }

    public function getLocations()
    {
        return Datatables::of(Location::query())
            ->addIndexColumn()
            ->addColumn('actions', function ($location) {
                $route = '/management/locations/'.$location->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/locations/'. $location->id .'/edit" title="Edit Location"><i data-feather="edit-3"></i></a>'. 
                view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.masters.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $request->validated();

        $location = Location::create([
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($location) {
            return back()->with('success', 'Location added successfully.');
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
        $location = Location::find($id);
        return view('management.masters.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        $request->validated();

        $location = Location::find($id);

        $location->update([
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($location) {
            return back()->with('success', 'Location updated successfully.');
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
            Location::destroy($id);
            return back()->with('success', 'Location deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Location has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
