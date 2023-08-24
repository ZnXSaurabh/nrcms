<?php

namespace App\Http\Controllers\Management;

use App\User;
use App\Models\Profile;
use App\Models\Complaint;
use App\Models\SSE\Vendor;
use Illuminate\Http\Request;
use App\Models\SSE\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ManagementController extends Controller
{
    public function index()
    {   
        $vendors=0;
        $resources=0;

        if (auth()->user()->hasAnyRoles(['super-admin', 'helpdesk'])) {
            $complaints = Complaint::where('status','!=','Duplicate')->count();
            $complaints_initiated = Complaint::where('status', 'Initiated')->count();
            $complaints_progress = Complaint::where('status', 'Allocated')->count();
            $complaints_resolved = Complaint::where('status', 'Resolved')->count();
            $complaints_latest = Complaint::latest()->take(5)->get();
            return view('management.dashboard', compact('complaints', 'complaints_initiated', 'complaints_progress', 'complaints_resolved', 'complaints_latest','vendors','resources'));
  
        } else if (auth()->user()->hasAnyRole('sse')) {
            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_initiated = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_progress = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Allocated')->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_resolved = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Resolved')->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_latest = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->latest()->take(5)->get(); 
            
            $vendors = Vendor::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->count();

            $vendorsId = Vendor::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->pluck('id')->toArray();

            $resources = Resource::query()->whereIn('vendor_id', $vendorsId)->count();
            return view('management.dashboard', compact('complaints', 'complaints_initiated', 'complaints_progress', 'complaints_resolved', 'complaints_latest','vendors','resources'));
  
            
        } 
         else if (auth()->user()->hasanyRole('sden')){
            $total_users = Profile::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->count();
            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_progress = 0;
            $complaints_initiated = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_resolved = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Resolved')->where('sup_cat_id', Auth::user()->profile->department)->count(); 
            $complaints_latest = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->latest()->take(5)->get();
            return view('management.dashboard',  compact('total_users', 'complaints', 'complaints_initiated', 'complaints_progress', 'complaints_resolved', 'complaints_latest','vendors','resources'));
           
        }
        else if (auth()->user()->hasanyRole('den')){
            $total_users = User::count();
            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_progress = 0;
            $complaints_initiated = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_resolved = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Resolved')->where('sup_cat_id', Auth::user()->profile->department)->count(); 
            $complaints_latest = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->latest()->take(5)->get();
            return view('management.dashboard',  compact('total_users', 'complaints', 'complaints_initiated', 'complaints_progress', 'complaints_resolved', 'complaints_latest','vendors','resources'));
           
        }
        else if (auth()->user()->hasanyRole('aden')){
            $total_users = User::count();
            $complaints = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_progress = 0;
            $complaints_initiated = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Initiated')->where('sup_cat_id', Auth::user()->profile->department)->count();
            $complaints_resolved = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('status', 'Resolved')->where('sup_cat_id', Auth::user()->profile->department)->count(); 
            $complaints_latest = Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->latest()->take(5)->get();
            return view('management.dashboard',  compact('total_users', 'complaints', 'complaints_initiated', 'complaints_progress', 'complaints_resolved', 'complaints_latest','vendors','resources'));
        
        
          }
    }
}
