<?php

namespace App\Http\Controllers\Management;

use App\Role;
use App\User;
use App\MSG91;
use App\Models\Area;
use App\Models\Profile;
use App\Models\Location;
use App\Models\Housetype;
use App\Models\SuperCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.admin.index');
    }

    public function getAdmins()
    {
        $admins = User::whereHas('roles', function ($query) {
                    $query->whereIn('slug', ['sse', 'aden', 'den', 'sden', 'helpdesk']);
                })->orderBy('name', 'ASC')->get();

        return Datatables::of($admins)
            ->addIndexColumn()
            ->editColumn('photo', function($admin) {
                if($admin->profile->photo) {
                    $url = Storage::url("users/" . $admin->id . "/" . $admin->profile->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $admin->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $admin->name .'">';
                }
            })
            ->editColumn('role', function($admin) {
                return implode(', ', $admin->roles()->get()->pluck('name')->toArray());
            })
             ->editColumn('department', function($admin) {
                $user_id = $admin->profile()->get()->pluck('user_id');
                $department = Profile::where('user_id',$user_id)->get()->pluck('department');
                $supercategory = SuperCategory::where('id',$department)->get()->pluck('name');
                return implode(', ', $supercategory->toArray());
            })
            ->editColumn('location_area', function($admin) {
                $output = '';
                foreach ($admin->locations as $value) {
                    if ($value->pivot->area_id) {
                        $output .= $value->name ." -> ". Area::find($value->pivot->area_id)->first()->name ."<br>";
                    } else {
                        $output .= "$value->name <br>";
                    }
                }
                return $output;
            })
            ->addColumn('actions', function ($admin) {
                $route = '/management/admins/'.$admin->id;
                return '<a class="action-btn edit-btn mr-1" href="/management/admins/'. $admin->id .'/edit" title="Edit Admin"><i data-feather="edit-3"></i></a>'. 
                    view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['photo', 'location_area', 'actions'])
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
        $supercategories = SuperCategory::get();
        $roles = Role::whereNotIn('slug', ['super-admin', 'user'])->orderBy('name', 'ASC')->get();
        return view('management.admin.create', compact('locations', 'areas', 'roles','supercategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $request->validated();

        $password = mt_rand(000000, 999999);
        //$password = "India@123";

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobileno' => $request->mobile,
            'password' => bcrypt($password),
            'is_account_verified' => 1,
            'is_mobile_verified' => 1
        ]);

        if ($user) {
            $role = Role::where('id', $request->role)->first();

            $user->roles()->attach($role);
            
            // Member Photo
            if ($request->hasFile('photo')) {
                Storage::putFileAs('public/users/' . $user->id .'', $request->file('photo'), 'photo_'. $user->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$user->id.'.'.$request->file('photo')->extension();
            } else {
                $photo = null;
            }

            $profile = Profile::create([
                'user_id' => $user->id,
                'department' => $request->department,
                'designation' => $request->designation,
                'location_id' => json_encode($request->location_id),
                'area_id' => json_encode($request->area_id),
                'housetype_id' => $request->housetype_id,
                'block_id' => $request->block_id,
                'qtrno' => $request->qtrno,
                'photo' => $photo
            ]);

            if ($profile) {
                foreach ($request->location_id as $key => $location) {
                    $user->locations()->detach($location, ['area_id' => $request->area_id[$key]]);
                }
                foreach ($request->location_id as $key => $location) {
                    $user->locations()->attach($location, ['area_id' => $request->area_id[$key]]);
                }
            }
            
            // $message = urlencode("Welcome to NRCMS. You are registered as $role->name privileges in NRCMS. You can login with your mobile number $user->mobileno and your password is $password.");
            // $MSG91 = new MSG91();
            // $MSG91->sendSMS($user->mobileno, $message);
            
            $MSG91 = new MSG91();
            $MSG91->sendDltSms('621a0305b353761c3333fd72', '91'.$user->mobileno, 'ADMIN', [$role->name, $user->mobileno, $password]);

            return back()->with('success', 'Admin created successfully and a notification message has been sent.');
        }

        return back()->with('error', 'Somthing went wrong. Try again!');
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
        $admin = User::find($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        $areas = Area::orderBy('name', 'ASC')->get();
        $supercategories = SuperCategory::get();
        $roles = Role::whereNotIn('slug', ['super-admin', 'user'])->orderBy('name', 'ASC')->get();
        
        return view('management.admin.edit', compact('admin', 'locations', 'areas', 'roles','supercategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobileno' => $request->mobile,
        ]);

        if ($user) {
            $role = Role::where('id', $request->role)->first();
            $user->roles()->sync($role);

            // Member Photo
            if ($request->hasFile('photo')) {
                Storage::delete('users/'.$user->id.'/'.$user->profile->photo);
                $storage = Storage::putFileAs('public/users/' . $user->id .'', $request->file('photo'), 'photo_'. $user->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$user->id.'.'.$request->file('photo')->extension();
            } else {
                $photo = $user->profile->photo;
            }

            $profile = Profile::where('user_id', $user->id)->first();
            $profile->update([
                'department' => $request->department,
                'designation' => $request->designation,
                'location_id' => json_encode($request->location_id),
                'area_id' => json_encode($request->area_id),
                'housetype_id' => $request->housetype_id,
                'block_id' => $request->block_id,
                'qtrno' => $request->qtrno,
                'photo' => $photo
            ]);

            if ($profile) {
                $user->locations()->detach();
            
                foreach ($request->location_id as $key => $location) {
                    $user->locations()->attach($location, ['area_id' => $request->area_id[$key]]);
                }
            }

            return back()->with('success', 'Admin update successfully.');
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
        try {
            $user = User::find($id);
            $user->profile->delete();
            $user->roles()->detach();
            $user->destroy($id);
            return back()->with('success', 'User deleted successfully.');            
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'User has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }
}
