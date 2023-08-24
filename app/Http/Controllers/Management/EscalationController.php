<?php

namespace App\Http\Controllers\Management;

use App\Models\Escalation;
use Illuminate\Http\Request;
use App\Models\SuperCategory;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class EscalationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.escalation.index');
    }
    
    public function getEscalations()
    {
        $escalations = Escalation::all();

        return Datatables::of($escalations)
            ->addIndexColumn()
            ->editColumn('department_id', function($escalation) {
                return $escalation->subCategory->name;
            })
            ->addColumn('actions', function ($escalation) {
                $route = '/management/escalations/'.$escalation->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/escalations/'. $escalation->id .'/edit" title="Edit Escalation"><i data-feather="edit-3"></i></a>'. 
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
        $departments = SuperCategory::all();
        
        return view('management.escalation.create', [
            'departments' => $departments    
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|numeric',
            'complaint_status' => 'required|string|max:32',
            'l1_escalation_days' => 'required|numeric',
            'l1_escalation_role' => 'required|string|max:6',
            'l2_escalation_days' => 'required|numeric',
            'l2_escalation_role' => 'required|string|max:6',
            'l3_escalation_days' => 'required|numeric',
            'l3_escalation_role' => 'required|string|max:6',
        ]);
        
        $escalation = Escalation::create([
            'department_id' => $request->department,
            'complaint_status' => $request->complaint_status,
            'l1_escalation_days' => $request->l1_escalation_days,
            'l1_escalation_role' => $request->l1_escalation_role,
            'l2_escalation_days' => $request->l2_escalation_days,
            'l2_escalation_role' => $request->l2_escalation_role,
            'l3_escalation_days' => $request->l3_escalation_days,
            'l3_escalation_role' => $request->l3_escalation_role,
        ]);
        
        if ($escalation) {
            return back()->with('success', 'Escalation added successfully.');
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
        $escalation = Escalation::findOrFail($id);
        
        $departments = SuperCategory::all();
        
        return view('management.escalation.edit', [
            'escalation' => $escalation,
            'departments' => $departments    
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'department' => 'required|numeric',
            'complaint_status' => 'required|string|max:32',
            'l1_escalation_days' => 'required|numeric',
            'l1_escalation_role' => 'required|string|max:6',
            'l2_escalation_days' => 'required|numeric',
            'l2_escalation_role' => 'required|string|max:6',
            'l3_escalation_days' => 'required|numeric',
            'l3_escalation_role' => 'required|string|max:6',
        ]);

        $escalation = Escalation::findOrFail($id);
        
        $escalation->update([
            'department_id' => $request->department,
            'complaint_status' => $request->complaint_status,
            'l1_escalation_days' => $request->l1_escalation_days,
            'l1_escalation_role' => $request->l1_escalation_role,
            'l2_escalation_days' => $request->l2_escalation_days,
            'l2_escalation_role' => $request->l2_escalation_role,
            'l3_escalation_days' => $request->l3_escalation_days,
            'l3_escalation_role' => $request->l3_escalation_role,
        ]);

        if ($escalation) {
            return back()->with('success', 'Escalation updated successfully.');
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
        $escalation = Escalation::findOrFail($id);
        
        $escalation->destroy($id);
            
        return back()->with('success', 'Escalation deleted successfully.');
    }
}
