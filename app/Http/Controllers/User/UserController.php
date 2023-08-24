<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {   
        $complaints = Complaint::where('user_id', auth()->user()->id)->count(); 
        $civil_complaint = Complaint::where('user_id', auth()->user()->id)->where('sup_cat_id','!=','')->where('sup_cat_id', 1)->count();
        $electrical_complaint = Complaint::where('user_id', auth()->user()->id)->where('sup_cat_id','!=','')->where('sup_cat_id', 2)->count();
        $sandt_complaint = Complaint::where('user_id', auth()->user()->id)->where('sup_cat_id','!=','')->where('sup_cat_id', 3)->count();
        $complaints_initiated = Complaint::where('user_id', auth()->user()->id)->where('status', 'Initiated')->count();
        $complaints_progress = Complaint::where('user_id', auth()->user()->id)->where('status', 'Allocated')->count();
        $complaints_resolved = Complaint::where('user_id', auth()->user()->id)->where('status', 'Resolved')->count();

        return view('user.dashboard', compact('complaints', 'complaints_initiated', 'complaints_progress', 'complaints_resolved','civil_complaint','electrical_complaint','sandt_complaint'));
    }
    
    public function getProfile()
    {
        $user = User::find(Auth::id());
        return view('user.profile', compact('user'));
    }
}
