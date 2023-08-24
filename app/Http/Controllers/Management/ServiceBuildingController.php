<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\ServiceBuilding;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceBuildingRequest;

class ServiceBuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.service-building.index');
    }

    public function getServiceBuildings()
    {
        return Datatables::of(ServiceBuilding::query())
            ->addIndexColumn()
            ->editColumn('location_id', function($sb) {
                return $sb->location->name;
            })
            ->editColumn('area_id', function($sb) {
                return $sb->area->name;
            })
            ->addColumn('actions', function ($sb) {
                $route = '/management/service-buildings/'.$sb->id;
                return '<button class="action-btn show-btn mr-1 showBuildingModalBtn" data-buildingID="'. $sb->id .'" title="View Service Building">
                            <i data-feather="eye"></i>
                        </button>
                    <a class="action-btn edit-btn mr-1" href="/management/service-buildings/'. $sb->id .'/edit" title="Edit Service Building"><i data-feather="edit-3"></i></a>'. 
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
        return view('management.masters.service-building.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceBuildingRequest $request)
    {
        $request->validated();

        $sb = ServiceBuilding::create([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'name' => $request->name,
            'area_covered' => $request->area_covered,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        if ($sb) {
            return back()->with('success', 'Service Building added successfully.');
        }

        return back()->with('error', 'Somthing went wrong. Try Again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ServiceBuilding::with('location', 'area')
        ->where('id', $id)
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service_building = ServiceBuilding::find($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        $area = Area::where('location_id', $service_building->location_id)->first();
        return view('management.masters.service-building.edit', compact('service_building', 'locations', 'area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceBuildingRequest $request, $id)
    {
        $request->validated();

        $sb = ServiceBuilding::find($id);

        $sb->update([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'name' => $request->name,
            'area_covered' => $request->area_covered,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        if ($sb) {
            return back()->with('success', 'Service Building updated successfully.');
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
            ServiceBuilding::destroy($id);
            return back()->with('success', 'Service Building deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Service Building has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
