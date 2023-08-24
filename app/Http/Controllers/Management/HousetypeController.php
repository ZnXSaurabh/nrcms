<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Location;
use App\Models\Housetype;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\HousetypeRequest;

class HousetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.housetype.index');
    }

    public function getHousetypes()
    {
        return Datatables::of(Housetype::query())
            ->addIndexColumn()
            ->editColumn('location_id', function($housetype) {
                return $housetype->location->name;
            })
            ->editColumn('area_id', function($housetype) {
                return $housetype->area->name;
            })
            ->addColumn('actions', function ($housetype) {
                $route = '/management/housetypes/'.$housetype->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/housetypes/'. $housetype->id .'/edit" title="Edit Housetype"><i data-feather="edit-3"></i></a>'. 
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
        $areas = Area::orderBy('name', 'ASC')->get();
        return view('management.masters.housetype.create', compact('locations', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HousetypeRequest $request)
    {
        $request->validated();

        $housetype = Housetype::create([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($housetype) {
            return back()->with('success', 'Housetype added successfully.');
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
        $housetype = Housetype::find($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        $areas = Area::where('location_id', $housetype->location_id)->orderBy('name', 'ASC')->get();
        return view('management.masters.housetype.edit', compact('housetype', 'locations', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HousetypeRequest $request, $id)
    {
        $request->validated();

        $housetype = Housetype::find($id);

        $housetype->update([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($housetype) {
            return back()->with('success', 'Housetype updated successfully.');
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
            Housetype::destroy($id);
            return back()->with('success', 'Housetype deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Housetype has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
