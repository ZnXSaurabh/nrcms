<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Block;
use App\Models\Location;
use App\Models\Housetype;
use App\Models\Quarter;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\BlockRequest;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blocks = Block::where('location_id',42)->get();
        
        // foreach($blocks as $block){
        //     $quarters = Quarter::where('block_id',$block->id)->get();
        //     foreach($quarters as $quarter){
        //         $quarter->location_id = $block->location_id;
        //         $quarter->area_id = $block->area_id;
        //         $quarter->housetype_id = $block->housetype_id;
        //         $quarter->update();
        //     }
        // }
        return view('management.masters.block.index');
    }

    public function getBlocks()
    {
        return Datatables::of(Block::query())
            ->addIndexColumn()
            ->editColumn('location_id', function($block) {
                return $block->location->name;
            })
            ->editColumn('area_id', function($block) {
                return $block->area->name;
            })
            ->editColumn('housetype_id', function($block) {
                return $block->housetype->name;
            })
            ->addColumn('actions', function ($block) {
                $route = '/management/blocks/'.$block->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/blocks/'. $block->id .'/edit" title="Edit Block"><i data-feather="edit-3"></i></a>'. 
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
        $housetypes = Housetype::orderBy('name', 'ASC')->get();
        return view('management.masters.block.create', compact('locations', 'areas', 'housetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockRequest $request)
    {
        $request->validated();

        $block = Block::create([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'housetype_id' => $request->housetype_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($block) {
            return back()->with('success', 'Block added successfully.');
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
        $block = Block::find($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        $areas = Area::where('location_id', $block->location_id)->orderBy('name', 'ASC')->get();
        $housetypes = Housetype::where('area_id', $block->area_id)->orderBy('name', 'ASC')->get();
        return view('management.masters.block.edit', compact('block', 'locations', 'areas', 'housetypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlockRequest $request, $id)
    {
        $request->validated();

        $block = Block::find($id);

        $block->update([
            'location_id' => $request->location_id,
            'area_id' => $request->area_id,
            'housetype_id' => $request->housetype_id,
            'name' => $request->name,
            'description' => $request->desc
        ]);

        if ($block) {
            return back()->with('success', 'Block updated successfully.');
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
            Block::destroy($id);
            return back()->with('success', 'Block deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Block has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
