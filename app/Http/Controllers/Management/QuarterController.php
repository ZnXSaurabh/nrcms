<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Block;
use App\Models\Quarter;
use App\Models\Location;
use App\Models\Housetype;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuarterRequest;

class QuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.masters.quarter.index');
    }

    public function getQuarters()
    {
        return Datatables::of(Quarter::query())
            ->addIndexColumn()
            ->editColumn('location_id', function($quarter) {
                return $quarter->location->name;
            })
            ->editColumn('area_id', function($quarter) {
                return $quarter->area->name;
            })
            ->editColumn('housetype_id', function($quarter) {
                return $quarter->housetype->name;
            })
            ->editColumn('block_id', function($quarter) {
                return $quarter->block->name;
            })
            ->addColumn('actions', function ($quarter) {
                $route = '/management/quarters/'.$quarter->id;
                return '<button class="action-btn show-btn mr-1 showQuarterModalBtn" data-quarterID="'. $quarter->id .'" title="View Quarter">
                            <i data-feather="eye"></i>
                        </button>
                    <a class="action-btn edit-btn mr-1" href="/management/quarters/'. $quarter->id .'/edit" title="Edit Quarter"><i data-feather="edit-3"></i></a>'. 
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
        return view('management.masters.quarter.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuarterRequest $request)
    {
        $request->validated();

        $quarter_id = 'NRDL/' . $request->location_id . '/' . $request->area_id . '/' . $request->housetype_id . '/' . $request->block_id . '/' . $request->qtrno;

        $quarter = Quarter::create([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'housetype_id' => $request->housetype_id,
            'block_id' => $request->block_id,
            'qtrno' => $request->qtrno,
            'quarter_id' => $quarter_id,
            'rent' => $request->rent,
            'house_area' => $request->house_area,
            'garages' => $request->garages,
            'remarks' => $request->remarks,
            'status' => $request->status,
        ]);

        if ($quarter) {
            return back()->with('success', 'Quarter added successfully.');
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
        return Quarter::with('location', 'area', 'housetype', 'block')
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
        $quarter = Quarter::find($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        $areas = Area::where('location_id', $quarter->location_id)->orderBy('name', 'ASC')->get();
        $housetypes = Housetype::where('area_id', $quarter->area_id)->orderBy('name', 'ASC')->get();
        $blocks = Block::where('housetype_id', $quarter->housetype_id)->orderBy('name', 'ASC')->get();
        return view('management.masters.quarter.edit', compact('quarter', 'locations', 'areas', 'housetypes', 'blocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuarterRequest $request, $id)
    {
        $request->validated();

        $quarter = Quarter::find($id);

        $quarter_id = 'NRDL/' . $request->location_id . '/' . $request->area_id . '/' . $request->housetype_id . '/' . $request->block_id . '/' . $request->qtrno;

        $quarter->update([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'housetype_id' => $request->housetype_id,
            'block_id' => $request->block_id,
            'qtrno' => $request->qtrno,
            'quarter_id' => $quarter_id,
            'rent' => $request->rent,
            'house_area' => $request->house_area,
            'garages' => $request->garages,
            'status' => $request->status,
            'remarks' => $request->remarks,
        ]);

        if ($quarter) {
            return back()->with('success', 'Quarter updated successfully.');
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
            Quarter::destroy($id);
            return back()->with('success', 'Quarter deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Quarter has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
