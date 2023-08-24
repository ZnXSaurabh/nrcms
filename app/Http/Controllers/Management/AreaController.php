<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\AreaRequest;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.area.index');
    }

    public function getAreas()
    {
        return Datatables::of(Area::query())
            ->addIndexColumn()
            ->editColumn('location_id', function($area) {
                return $area->location->name;
            })
            ->addColumn('actions', function ($area) {
                $route = '/management/areas/'.$area->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/areas/'. $area->id .'/edit" title="Edit Area"><i data-feather="edit-3"></i></a>'. 
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
        $locations = Location::orderBy('name', 'ASC')->get();
        return view('management.masters.area.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $request->validated();

        $area = Area::create([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($area) {
            return back()->with('success', 'Area added successfully.');
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
        $area = Area::find($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        return view('management.masters.area.edit', compact('area', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $request->validated();

        $area = Area::find($id);

        $area->update([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($area) {
            return back()->with('success', 'Area updated successfully.');
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
            Area::destroy($id);
            return back()->with('success', 'Area deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Area has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
