<?php
namespace App\Http\Controllers;

use App\User;

use App\MSG91;

use Carbon\Carbon;

use App\Models\Category;

use App\Models\Profile;

use App\Models\Location;

use App\Models\Complaint;

use App\Models\Escalation;

use App\Models\SSE\Vendor;

use App\Models\SubCategory;

use Illuminate\Http\Request;

use App\Exports\ComplaintExport;

use Illuminate\Support\Facades\DB;

use App\Models\SuperCategory;

use App\Models\ServiceBuilding;

use Yajra\Datatables\Datatables;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\ComplaintRequest;

use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        return view('complaint.index');

    }



    public function getComplaints($status)

    {   
        
                if (auth()->user()->hasAnyRole('super-admin')) {
            return Datatables::of(Complaint::query()->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('sse')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('helpdesk')) {

            return Datatables::of(Complaint::query()->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }

    public function getcomplaintReport(Request $request)
    {   
        $from=explode(",",$request->data)[0];
        $to=explode(",",$request->data)[1];
        $status=explode(",",$request->data)[2];
        
        if (auth()->user()->hasAnyRole('super-admin')) {
            return Datatables::of(Complaint::query()->where('status', $status)->where('created_at','>=',$from)->where('created_at','<=',$to)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
        if (auth()->user()->hasAnyRole('sse')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->where('created_at','>=',$from)->where('created_at','<=',$to)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->where('created_at','>=',$from)->where('created_at','<=',$to)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->where('created_at','>=',$from)->where('created_at','<=',$to)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->where('created_at','>=',$from)->where('created_at','<=',$to)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('helpdesk')) {

            return Datatables::of(Complaint::query()->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }

    public function getmonthlycomplaintReport(Request $request)
    {   
        
        $month=explode(",",$request->data)[0];
        $department=explode(",",$request->data)[1];
        
        
         if (auth()->user()->hasAnyRole('super-admin')) {
            return Datatables::of(Complaint::query()->where('sup_cat_id', $department)->whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
        if (auth()->user()->hasAnyRole('sse')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('helpdesk')) {

           // return Datatables::of(Complaint::query()->where('status', $status)->orderBy('created_at', 'DESC')->get())
           return Datatables::of(Complaint::query()->where('sup_cat_id', $department)->whereMonth('created_at', $month)->orderBy('created_at', 'DESC')->get())
                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            //return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())
            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->whereMonth('created_at', $month)->where('department',$department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }

// Get Complaints reports quarter wise created by shubham
    
    // Get Quarter wise complain report By Location
    
    public function getquarterwisecomplaintReportByLocation(Request $request)
    {   
        
        $location_id = $request->data;
        
        
         if (auth()->user()->hasAnyRole('super-admin')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
        if (auth()->user()->hasAnyRole('sse')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('helpdesk')) {

           return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            //return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }
    
    // End get complain by location
    
    // Get Quarter Wise complaint report By Location And HouseType
    
    public function getquarterwisecomplaintReportByLocationAndHouseType(Request $request)
    {   
        
        $location_id = explode(",",$request->data)[0];
        $houseType = explode(",",$request->data)[1];
        
        $user_id = Profile::where('location_id',$location_id)->where('housetype_id',$houseType)->get()->pluck('user_id');
        
         if (auth()->user()->hasAnyRole('super-admin')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
        if (auth()->user()->hasAnyRole('sse')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('helpdesk')) {

           return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            //return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())
            return Datatables::of(Complaint::query()->whereIn('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }
    // End Getting quarter wise report by location and house type

// Get Quarter Wise complaint report By Location And HouseType and Block No
    
    public function getquarterwisecomplaintReportByLocationAndHouseTypeAndBlockNo(Request $request)
    {   
        
        $location_id = explode(",",$request->data)[0];
        $houseType = explode(",",$request->data)[1];
        $blockNo = explode(",",$request->data)[2];
        
        $user_id = Profile::where('location_id',$location_id)->where('housetype_id',$houseType)->where('block_id',$blockNo)->get()->pluck('user_id');
        
         if (auth()->user()->hasAnyRole('super-admin')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
        if (auth()->user()->hasAnyRole('sse')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('helpdesk')) {

           return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            //return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())
            return Datatables::of(Complaint::query()->whereIn('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }
    // End Getting quarter wise report by location and house type and Block NO

// Get Quarter Wise complaint report By Location And HouseType and Block No and quarter no
    
    public function getquarterwisecomplaintReportByLocationAndHouseTypeAndBlockNoAndQuarterNo(Request $request)
    {   
        
        $location_id = explode(",",$request->data)[0];
        $houseType = explode(",",$request->data)[1];
        $blockNo = explode(",",$request->data)[2];
        $qtrno = explode(",",$request->data)[3];
        
        $user_id = Profile::where('location_id',$location_id)->where('housetype_id',$houseType)->where('block_id',$blockNo)->where('qtrno',$qtrno)->get()->pluck('user_id');
        
        if (auth()->user()->hasAnyRole('super-admin')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
        
        if (auth()->user()->hasAnyRole('sse')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('helpdesk')) {

           return Datatables::of(Complaint::query()->where('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            //return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())
            return Datatables::of(Complaint::query()->whereIn('location_id', $location_id)->where('sup_cat_id', Auth::user()->profile->department)->whereIn('user_id',$user_id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }
    // End Getting quarter wise report by location and house type and Block NO and quarter No


// Get Complaints reports quarter wise created by shubham end
    public function getallcomplaintReport(Request $request)
    {   
        $mobile=explode(",",$request->data)[0];
        $date=explode(",",$request->data)[1];
         
        if (auth()->user()->hasAnyRole('sse')) {
            $user = User::where('name', $mobile)->orWhere('mobileno', $mobile)->first();
                $first = $user->id;
               return Datatables::of(Complaint::query()->where('location_id', auth()->user()->locations()->get()->pluck('id'))->where('user_id', $first)->whereDate('created_at', $date)->orderBy('created_at', 'DESC')->get())
                
                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('sden')) {
            $user = User::where('name', $mobile)->orWhere('mobileno', $mobile)->first();
                $first = $user->id;
               return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('user_id', $first)->whereDate('created_at', $date)->orderBy('created_at', 'DESC')->get())
                
                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('aden')) {
            $user = User::where('name', $mobile)->orWhere('mobileno', $mobile)->first();
                $first = $user->id;
               return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('user_id', $first)->whereDate('created_at', $date)->orderBy('created_at', 'DESC')->get())
                
                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('den')) {
            $user = User::where('name', $mobile)->orWhere('mobileno', $mobile)->first();
                $first = $user->id;
               return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('user_id', $first)->whereDate('created_at', $date)->orderBy('created_at', 'DESC')->get())
                
                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('helpdesk')) {

            return Datatables::of(Complaint::query()->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('user')) {

            return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

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
        $users = [];
        if (auth()->user()->hasAnyRole('sse')) {

            $locations = User::with('locations')->where('id', auth()->user()->id)->first();

            $users = User::whereHas('roles', function ($query) {

                    $query->where('slug', 'user');

                })

                ->whereHas('profile', function ($query) {

                    $query->whereIn('location_id', auth()->user()->locations->pluck('id')->toArray());

                })

                ->get();

        } else if (auth()->user()->hasAnyRole('helpdesk')) {

            $locations = Location::orderBy('name', 'ASC')->get();

            $users = User::whereHas('roles', function ($query) {

                    $query->where('slug', 'user');

                })->get();

        } else {

            $locations = Location::orderBy('name', 'ASC')->get();

        }

        $supercategories = SuperCategory::orderby('name', 'ASC')->get(['id', 'name']);

        $categories = Category::orderby('name', 'ASC')->get(['id', 'name']);

        return view('complaint.create', compact('locations', 'users', 'supercategories', 'categories'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(ComplaintRequest $request)
    {        
        $request->validated();

    	$comp_id = 'NRCMS/' . strtoupper(date('M')) . '/' . date('Y') . '/' . sprintf('%04d', (int) Complaint::orderBy('created_at', 'desc')->pluck('id')->first() + 1);
        
    	$images = [];

        if($request->hasfile('images')) {

            foreach($request->file('images') as $file) {

                $name = $file->getClientOriginalName();

                Storage::putFileAs('public/complaint-images/' . str_replace('/', '', $comp_id), $file, $name);
                $images[] = $name;
            }
        }
        $complaint = Complaint::create([
            'user_id' => $request->user_id,
            'comp_type' => $request->comp_type,
            'comp_id' => $comp_id,
            'location_id' => $request->location_id ?? auth()->user()->profile->location_id,
            'area_id' => $request->area_id,
            'service_building_id' => $request->service_building_id,
            'sup_cat_id' => $request->sup_cat_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'description' => $request->description,
            'images' => json_encode($images)
        ]);
        Session::forget('location_id');
        Session::forget('service_building_id');
        if ($complaint)
        {
            // $message = urlencode("GIKSINDIA: Welcome to NRCMS! Your complaint successfully registered with complaint number $comp_id .");
            // $MSG91 = new MSG91();
            // $MSG91->sendSMS($complaint->user->mobileno, $message);
            
            $MSG91 = new MSG91();
            $MSG91->sendDltSms('621a026e5df12c05595e03e4', '91'.$complaint->user->mobileno, 'COM', [$comp_id]);
            
        	return redirect('complaints')->with('success', 'Your complaint successfully registered with ' . $complaint->comp_id);
        }
        return redirect('complaints')->with('error', 'Something went wrong. Try again!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {   
        $vendors =[];
        $complaint = Complaint::find($id);

        $user_id = Complaint::where('id', $id)->get()->pluck('user_id')[0];
        $oldComplaints = Complaint::where('user_id', $user_id)->whereIn('status', ['Initiated','Allocated', 'Duplicate'])->get();
        
        if (auth()->user()->hasAnyRole('sse')) {

            $vendors = Vendor::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->orderBy('name', 'ASC')->get();
        }        
        return view('complaint.show', compact('complaint', 'vendors', 'oldComplaints'));
    }

    public function markDuplicateComp(Request $request, $id){        
        
        $complaint = Complaint::findOrFail($id);
        
        $complaint->update([
            'resolution'        => $request->get('resolution'),
            'resolution_date'   => date('Y-m-d h:m:s'),
            'status'            => "Duplicate"
        ]);
        if ($complaint)
        {
            return redirect('complaints')->with('success', 'Complaint marked duplicate successfully with ' . $complaint->comp_id);
        }
        return redirect('complaints')->with('error', 'Something went wrong. Try again!');
    }

    public function getInitiated()
    {   
        $complaints = "";
        
        if (auth()->user()->hasAnyRole('sse')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
                
        }

        if (auth()->user()->hasAnyRole('user')) {

            $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();

        }

        return view('complaint.initiated', compact('complaints'));

    }
    
    public function getAllocated()
    {
        $complaints = [];
        if (auth()->user()->hasAnyRole('sse')) {

             $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Allocated')->orderBy('created_at', 'DESC')->get();

        }

        if (auth()->user()->hasAnyRole('user')) {

                    $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Allocated')->orderBy('created_at', 'DESC')->get();

        }

        return view('complaint.allocated', compact('complaints'));

    }

    public function getResolved()
    {
        $complaints = [];
        if (auth()->user()->hasAnyRole('sse')) {

         $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Resolved')->orderBy('created_at', 'DESC')->get();

        }

        if (auth()->user()->hasAnyRole('user')) {

            $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Resolved')->orderBy('created_at', 'DESC')->get();
  
        }

        return view('complaint.resolved', compact('complaints'));

    }
    
    
   

    public function complaintReport()
    {   
        $complaints = "";
        if (auth()->user()->hasAnyRole('sse')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
              
        }

        if (auth()->user()->hasAnyRole('sden')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }
        
         if (auth()->user()->hasAnyRole('aden')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }
        
         if (auth()->user()->hasAnyRole('den')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }

        if (auth()->user()->hasAnyRole('user')) {

            $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();

        }

        return view('complaint.complaint-report', compact('complaints'));

    }

    public function monthwisecomplaintReport()
    {   
        $complaints = "";
        if (auth()->user()->hasAnyRole('sse')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();

        }

        if (auth()->user()->hasAnyRole('sden')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }
        if (auth()->user()->hasAnyRole('aden')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }
        if (auth()->user()->hasAnyRole('den')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }

        if (auth()->user()->hasAnyRole('user')) {

            $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();

        }

        return view('complaint.month-wise-complaint-report', compact('complaints'));

    }
    
    // Make QuaterWiseComplaintReport By Shubham
    
    public function quaterwisecomplaintReport()
    {   
        $complaints = "";
        
          if (auth()->user()->hasAnyRole('super-admin')) {
            
            $locations = Location::orderBy('name', 'ASC')->get();
            
            $complaints = Complaint::where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
            
        }
        
        if (auth()->user()->hasAnyRole('sse')) {
            
            $locations = Location::whereIn('id',auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();
            
            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
            
        }

        if (auth()->user()->hasAnyRole('sden')) {
            
            $locations = Location::whereIn('id',auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }
        if (auth()->user()->hasAnyRole('aden')) {
            
            $locations = Location::where('id',auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();

            $complaints = Complaint::where('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }
        if (auth()->user()->hasAnyRole('den')) {

            $locations = Location::whereIn('id',auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();
            
            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->orderBy('created_at', 'DESC')->get();
              
        }

        if (auth()->user()->hasAnyRole('user')) {
            
            $locations = Location::whereIn('id',auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();

            $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();

        }
        return view('complaint.quarter-wise-complaint-report', compact('complaints','locations'));

    }
    
    // Make allComplaintReport By Shubham End
    
    public function allcomplaintReport()
    {   
        $complaints = "";
        if (auth()->user()->hasAnyRole('sse')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
            
        }

        if (auth()->user()->hasAnyRole('sden')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
              
        }
        
         if (auth()->user()->hasAnyRole('aden')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
              
        }
         if (auth()->user()->hasAnyRole('den')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();
              
        }
        if (auth()->user()->hasAnyRole('user')) {

            $complaints = Complaint::where('user_id', auth()->user()->id)->where('status', 'Initiated')->orderBy('created_at', 'DESC')->get();

        }

        return view('complaint.all-complaint-report', compact('complaints'));

    }
    
    public function getAllComp()
    {   

        $complaints = [];
        if (auth()->user()->hasAnyRole('sse')) {

            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->orderBy('created_at', 'DESC')->get();
        }
        if (auth()->user()->hasAnyRole('user')) {

            $complaints = Complaint::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();

        }
        return view('complaint.index', compact('complaints'));
    }

    public function getAllComplaints()
    {   
        
        if (auth()->user()->hasAnyRole('super-admin')) {

            return Datatables::of(Complaint::query()->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        
        if (auth()->user()->hasAnyRole('sse')) {

            return Datatables::of(Complaint::query()->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->orderBy('created_at', 'DESC')->where('sup_cat_id', Auth::user()->profile->department)->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        if (auth()->user()->hasAnyRole('helpdesk')) {

            return Datatables::of(Complaint::query()->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        if (auth()->user()->hasAnyRole('user')) {

            return Datatables::of(Complaint::query()->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="/complaint/'. $complaint->id .'/feedback" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }

                })

                ->rawColumns(['actions'])

                ->make(true);

        }       

    }

    public function getComplaintTypePage(){

        Session::forget('location_id');
        Session::forget('service_building_id');
        return view('user.complaint.complaint-type');
    }

    public function getComplaintLocationPage(){

        $locations = ServiceBuilding::distinct()->get(['location_id']);
        return view('user.complaint.complaint-location', compact('locations'));
    }

    public function getComplaintBuildingPage($loc_id){

        $servicebuildings = ServiceBuilding::where('location_id', $loc_id)->get();
        Session::put('location_id', $loc_id);
        return view('user.complaint.complaint-building', compact('servicebuildings'));
    }

    public function getSuperCategoryPage(){

        $supercategories = SuperCategory::all();
        return view('user.complaint.super-category', compact('supercategories'));
    }
    public function getCategoryPage($id){

        $categories = Category::where('sup_cat_id', $id)->get();
        return view('user.complaint.category', compact('categories'));
    }

    public function getSubCategoryPage($id){

        $subcategories = SubCategory::where('category_id', $id)->get();
        return view('user.complaint.sub-category', compact('subcategories'));
    }
    public function getSubmitComplaint($id){

        $complaintdetails = SubCategory::select("sub_categories.*", "categories.name as cat_name", "categories.sup_cat_id", "super_categories.name as sup_name")->join('categories','categories.id',"=",'sub_categories.category_id')->join('super_categories','super_categories.id',"=",'categories.sup_cat_id')->where('sub_categories.id',"=",$id)->get()[0];

        return view('user.complaint.submit-complaint', compact('complaintdetails'));
    }


    // Reports Exports
    public function ComplaintsExport(Request $request) 
    {
        $from=explode(",",$request->data)[0];
        $to=explode(",",$request->data)[1];
        $status=explode(",",$request->data)[2];
        return Excel::download(new ComplaintExport($from,$to,$status), 'Complaints.xlsx');
    }

// Escalated complaints for different roles coded by Saurabh Negi on 6-7-2022

    public function get_Escalated_complaints(Request $request){

        $status=explode(",",$request->data)[0];
        $days=explode(",",$request->data)[1];
        $department=explode(",",$request->data)[2];

        $query = Complaint::query();
        
        
          if (auth()->user()->hasAnyRole('super-admin')) {

            if($status == $status){
                $query = $query->where('updated_at', '<=', Carbon::now()->subDays($days)->toDateTimeString());
            }
            else{
                $query = $query->where('created_at', '<=', Carbon::now()->subDays($days)->toDateTimeString());
            }

            return Datatables::of($query->where('status', $status)->where('sup_cat_id', $department)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

        
        if (auth()->user()->hasAnyRole('aden')) {

            if($status == $status){
                $query = $query->where('updated_at', '<=', Carbon::now()->subDays($days)->toDateTimeString());
            }
            else{
                $query = $query->where('created_at', '<=', Carbon::now()->subDays($days)->toDateTimeString());
            }

            return Datatables::of($query->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

           
        if (auth()->user()->hasAnyRole('den')) {

            if($status == 'Allocated'){
                $query = $query->where('updated_at', '<=', Carbon::now()->subDays(15)->toDateTimeString());
            }
            else{
                $query = $query->where('created_at', '<=', Carbon::now()->subDays(15)->toDateTimeString());
            }
            
            return Datatables::of($query->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
           
        if (auth()->user()->hasAnyRole('sden')) {

            if($status == 'Allocated'){
                $query = $query->where('updated_at', '<=', Carbon::now()->subDays(25)->toDateTimeString());
            }
            else{
                $query = $query->where('created_at', '<=', Carbon::now()->subDays(25)->toDateTimeString());
            }
            
            return Datatables::of($query->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $status)->orderBy('created_at', 'DESC')->get())

                ->addIndexColumn()

                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }



    }

    public function getEscalated(Request $request)
    {

        $dt = Escalation::where('department_id', Auth::user()->profile->department)->get();
        $rs = Escalation::get();
        return view('complaint.escalated',compact('dt','rs'));

    }
    
    
    public function getlocationwiseComplaint()
    {
        $location_id = DB::table('location_user')->where('user_id',Auth::user()->id)->pluck('location_id');
     
        $locations = Location::whereIn('id',$location_id)->get();
        
        $allLocation = Location::get();
   
        return view('complaint.location-wise-complaint-report',compact('locations','allLocation'));
    }

    public function getalllocationwiseComplaints(Request $request)
    {
        $location=explode(",",$request->data)[0];
        $status=explode(",",$request->data)[1];
     
        
        
        
        if (auth()->user()->hasAnyRole('super-admin')) {
            
            return Datatables::of(Complaint::query()->where('location_id', $location)->where('status',$status)->orderBy('created_at', 'DESC')->get())

            ->addIndexColumn()

                ->editColumn('comp_type', function($complaint) {

                    return $complaint->comp_type;

                })
                
                ->editColumn('comp_id', function($complaint) {

                    return $complaint->comp_id;

                })
                
                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })
                
                ->editColumn('status', function($complaint) {

                    return $complaint->status;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);
                
        }

        if (auth()->user()->hasAnyRole('aden')) {

            return Datatables::of(Complaint::query()->where('location_id', $location)->where('sup_cat_id', Auth::user()->profile->department)->where('status',$status)->orderBy('created_at', 'DESC')->get())
               
            

            ->addIndexColumn()

                ->editColumn('comp_type', function($complaint) {

                    return $complaint->comp_type;

                })
                
                ->editColumn('comp_id', function($complaint) {

                    return $complaint->comp_id;

                })
                
                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })
                
                ->editColumn('status', function($complaint) {

                    return $complaint->status;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })


                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }
        
         if (auth()->user()->hasAnyRole('sden')) {

            return Datatables::of(Complaint::query()->where('location_id', $location)->where('sup_cat_id', Auth::user()->profile->department)->where('status',$status)->orderBy('created_at', 'DESC')->get())
               
            

            ->addIndexColumn()

               ->editColumn('comp_type', function($complaint) {

                    return $complaint->comp_type;

                })
                
                ->editColumn('comp_id', function($complaint) {

                    return $complaint->comp_id;

                })
                
                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })
                
                ->editColumn('status', function($complaint) {

                    return $complaint->status;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })


                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }

            if (auth()->user()->hasAnyRole('den')) {

            return Datatables::of(Complaint::query()->where('location_id', $location)->where('sup_cat_id', Auth::user()->profile->department)->where('status',$status)->orderBy('created_at', 'DESC')->get())
               
            

            ->addIndexColumn()

              ->editColumn('comp_type', function($complaint) {

                    return $complaint->comp_type;

                })
                
                ->editColumn('comp_id', function($complaint) {

                    return $complaint->comp_id;

                })
                
                ->editColumn('category_id', function($complaint) {

                    return $complaint->category->name;

                })

                ->editColumn('sub_category_id', function($complaint) {

                    return $complaint->subcategory->name;

                })
                
                ->editColumn('status', function($complaint) {

                    return $complaint->status;

                })

                ->editColumn('created_at', function($complaint) {

                    return date('d-m-Y h:m A', strtotime($complaint->created_at));

                })

                ->addColumn('actions', function ($complaint) {

                    if ($complaint->status == 'Resolved' && empty($complaint->feedback)) {

                        return '<a class="action-btn show-btn mr-2" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a><a class="action-btn edit-btn" href="javascript:void(0)" title="Show Complaint"><i data-feather="message-square"></i></a>';

                    } else {

                        return '<a class="action-btn show-btn" href="/complaints/'. $complaint->id .'" title="Show Complaint"><i data-feather="eye"></i></a>';

                    }
                })

                ->rawColumns(['actions'])

                ->make(true);

        }



    }


}
