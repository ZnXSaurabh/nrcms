<?php
namespace App\Http\Controllers\Management;

use App\Role;
use App\User;
use App\MSG91;
use App\Models\Area;
use App\Models\Block;
use App\Models\Profile;
use App\Models\Quarter;
use App\Models\Location;
use App\Models\Housetype;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRegisterRequest;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.user.index');
    }

    public function getUsers()
    {
        if (auth()->user()->hasAnyRole('sse')) {
            $users = User::whereHas('roles', function ($query) {
                    $query->whereIn('slug', ['user']);
                })
                ->where('is_account_verified', 1)
                ->whereHas('profile', function ($query) {
                    $query->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'));
                })
                ->orderBy('name', 'ASC')->get();
        }
        if (auth()->user()->hasAnyRole('helpdesk')) {
            $users = User::whereHas('roles', function ($query) {
                        $query->whereIn('slug', ['user']);
                })
                ->where('is_account_verified', 1)
                ->orderBy('name', 'ASC')->get();
        }
       if (auth()->user()->hasAnyRole('super-admin')) {
            $users = User::whereHas('roles', function ($query) {
                        $query->whereIn('slug', ['user']);
                })
                ->where('is_account_verified', 1)
                ->orderBy('name', 'ASC')->get();
        }    
        return Datatables::of($users)
            ->addIndexColumn()
            ->editColumn('photo', function($user) {
                if($user->profile->photo) {
                    $url = Storage::url("users/" . $user->id . "/" . $user->profile->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $user->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $user->name .'">';
                }
            })
            ->editColumn('created_at', function($user) {
                return date('d-m-Y h:m A', strtotime($user->created_at));
            })
            ->addColumn('actions', function ($user) {
                $route = '/management/users/'.$user->id;
                return '<button class="action-btn show-btn mr-1 showUserModalBtn" data-userID="'. $user->id .'" title="View User Details">
                            <i data-feather="eye"></i>
                        </button>
                        <a class="action-btn edit-btn mr-1" href="/management/users/'. $user->id .'/edit" title="Edit User"><i data-feather="edit-3"></i></a>'. 
                        view('partials.common.delete-form', compact('route'))->render();
            })
            ->rawColumns(['photo', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasAnyRole('sse')){
            
            $locations = Location::whereIn('id', auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->where('isActive','=','1')->get();    
        }
        
        if (auth()->user()->hasAnyRole('super-admin')) {
            $locations = Location::orderBy('name', 'ASC')->where('isActive','=','1')->get();
        }
        
        if (auth()->user()->hasAnyRole('helpdesk')) {
            $locations = Location::orderBy('name', 'ASC')->where('isActive','=','1')->get();
        }
        return view('management.user.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $request->validated();

        $password = mt_rand(000000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobileno' => $request->mobile,
            'password' => bcrypt($password),
            'is_account_verified' => 1,
            'is_mobile_verified' => 1
        ]);

        if ($user) {
            $user->roles()->attach(Role::where('slug', 'user')->first());

            // Member Photo
            if ($request->hasFile('photo')) {
                Storage::putFileAs('public/users/' . $user->id .'', $request->file('photo'), 'photo_'. $user->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$user->id.'.'.$request->file('photo')->extension();
            } else {
                $photo = null;
            }

            $profile = Profile::create([
                'user_id' => $user->id,
                'fathername' => $request->fathername,
                'pfno' => $request->pfno,
                'department' => $request->department,
                'designation' => $request->designation,
                'location_id' => $request->location_id,
                'area_id' => $request->area_id,
                'housetype_id' => $request->housetype_id,
                'block_id' => $request->block_id,
                'qtrno' => $request->qtrno,
                'photo' => $photo
            ]);

            // $message = urlencode("GIKSINDIA: Thank you for registration with NRCMS. Your username is $user->mobileno and your password is $password.");
            // $MSG91 = new MSG91();
            // $MSG91->sendSMS($user->mobileno, $message);
            
            $MSG91 = new MSG91();
            $MSG91->sendDltSms('621a03629b02cf387538fab4', '91'.$user->mobileno, 'UP', [$user->mobileno, $password]);

            return back()->with('success', 'User registered successfully and a notification message has been sent.');
        }

        return back()->with('error', 'Something went wrong. Try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::with(['profile' => function($query) {
            $query->with('location', 'area', 'housetype', 'block', 'quarter');
        }])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
         
        if (auth()->user()->hasAnyRole('sse')) {
            $locations = Location::whereIn('id', auth()->user()->locations()->get()->pluck('id'))->orderBy('name', 'ASC')->get();
        }
        if (auth()->user()->hasAnyRole('helpdesk')) {
            $locations = Location::orderBy('name', 'ASC')->get();
        }
        if (auth()->user()->hasAnyRole('super-admin')) {
            $locations = Location::orderBy('name', 'ASC')->get();
        }
        
        $areas = Area::where('location_id', $user->profile->location_id)->orderBy('name', 'ASC')->get();
        $housetypes = Housetype::where('area_id', $user->profile->area_id)->orderBy('name', 'ASC')->get();
        $blocks = Block::where('housetype_id', $user->profile->housetype_id)->orderBy('name', 'ASC')->get();
        $quarters = Quarter::where('block_id', $user->profile->block_id)->orderBy('qtrno', 'ASC')->get();
        return view('management.user.edit', compact('user', 'locations', 'areas', 'housetypes', 'blocks', 'quarters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegisterRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
       
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobileno' => $request->mobile,
        ]);

        if ($user) {
            // Member Photo
            if ($request->hasFile('photo')) {
                Storage::delete('public/users/'.$user->id.'/'.$user->photo);
                Storage::putFileAs('public/users/' . $user->id .'', $request->file('photo'), 'photo_'. $user->id.'.'.$request->file('photo')->extension());
                $photo = 'photo_'.$user->id.'.'.$request->file('photo')->extension();
            } else {
                $photo = $user->profile->photo;
            }

            $user->profile->update([
                'user_id' => $user->id,
                'fathername' => $request->fathername,
                'pfno' => $request->pfno,
                'department' => $request->department,
                'designation' => $request->designation,
                'location_id' => $request->location_id,
                'area_id' => $request->area_id,
                'housetype_id' => $request->housetype_id,
                'block_id' => $request->block_id,
                'qtrno' => $request->qtrno,
                'photo' => $photo
            ]);

            return back()->with('success', 'User information updated successfully.');
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
                return back()->with('warning', 'User has some related data. First delete those.');
            }
        }

        return back()->with('error', 'Something went wrong. Try Again!');
    }

    /**
     * Display the list of unverified users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVerifyUsers()
    {
        return view('management.user.verify-users');
    }

    public function getVerifyUsersList()
    {
        $users = User::whereHas('roles', function ($query) {
                    $query->whereIn('slug', ['user']);
                })
                ->where('is_account_verified', 0)
                ->whereHas('profile', function ($query) {
                    $query->whereIn('location_id', auth()->user()->locations()->get()->pluck('id'));
                })
                ->orderBy('name', 'ASC')->get();

        return Datatables::of($users)
            ->addIndexColumn()
            ->editColumn('photo', function($user) {
                if($user->profile->photo) {
                    $url = Storage::url("users/" . $user->id . "/" . $user->profile->photo);
                    return '<img height="50" src="'. $url .'" alt="'. $user->name .'">';
                } else {
                    $url = asset("images/no-pic.png");
                    return '<img height="50" src="'. $url .'" alt="'. $user->name .'">';
                }
            })
            ->editColumn('created_at', function($user) {
                return date('d-m-Y h:m A', strtotime($user->created_at));
            })
            ->addColumn('actions', function ($user) {
                $route = '/management/users/'.$user->id;
                return '<button class="action-btn show-btn mr-1 showUserModalBtn" data-userID="'. $user->id .'" title="View User Details">
                            <i data-feather="eye"></i>
                        </button>
                        <a class="action-btn edit-btn mr-1" href="/management/users/'. $user->id .'/edit" title="Edit User"><i data-feather="edit-3"></i></a>'. 
                    view('partials.common.delete-form', compact('route'))->render(); // -- code written by Ashish Purohit on 03-03-2022 to add delete button to delete verified users from SSE account.
            })
            ->rawColumns(['photo', 'actions'])
            ->make(true);
    }

    public function verifyUser($id)
    {
        $user = User::find($id);

        $password = mt_rand(000000, 999999);
        // $password= "India@123";

        $user->update([
            'password' => bcrypt($password),
            'is_account_verified' => 1
        ]);

        if ($user) {
            // $message = urlencode("GIKSINDIA: Your registration details are approved verified by SSE. Your username is $user->mobileno and your password is $password.");
            // $MSG91 = new MSG91();
            // $MSG91->sendSMS($user->mobileno, $message);
            
            $MSG91 = new MSG91();
            $MSG91->sendDltSms('621a03629b02cf387538fab4', '91'.$user->mobileno, 'UP', [$user->mobileno, $password]);

            return back()->with('success', 'User verified successufully and moved to verified users list.');
        }

        return back()->with('error', 'Something went wrong. Try again!');
    }
}
