<?php
namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\MSG91;
use App\Models\Profile;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $locations = Location::orderBy('name', 'ASC')->where('isActive','=','1')->get();
        return view('auth.register', compact('locations'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:users'],
            'mobileno' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:10', 'unique:users'],
            'location_id' => ['required', 'numeric'],
            'housetype_id' => ['required', 'numeric'],
            'block_id' => ['required', 'numeric'],
            'qtrno' => ['required', 'numeric'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobileno' => $request->mobileno,
        ]);

        if ($user) {
            $user->roles()->attach(Role::where('slug', 'user')->first());

            Profile::create([
                'user_id' => $user->id,
                'location_id' => $request->location_id,
                'housetype_id' => $request->housetype_id,
                'block_id' => $request->block_id,
                'qtrno' => $request->qtrno
            ]);

            $otp = mt_rand(100000, 999999);
            //$message = urlencode("Thank you for registration with NRCMS. Your OTP is: $otp");
            //$MSG91 = new MSG91();
            Session::forget('OTP');
            Session::put('OTP', $otp);
            //$MSG91->sendSMS($user->mobileno, $message);
            
            $MSG91 = new MSG91();
            $MSG91->sendDltSms('62385ab87f0231333a04e445', '91'.$user->mobileno, 'OTP', [$otp]);

            return redirect()->route('provisional-registration', 
                [
                    'name' => $user->name,
                    'mobile' => $user->mobileno
                ]
            );
        }

        return back()->with('error', 'Something went wrong. Try again!');
    }

    public function provisionalRegistration($name, $mobile)
    {
        return view('auth.provisional-registration', compact('name', 'mobile'));
    }

    public function verifyMobileNumber(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if ($request->otp == session('OTP')) {
            $user = User::where('mobileno', $request->mobileno)->first();

            $user->update([
                'is_mobile_verified' => 1
            ]);

            if ($user) {
                Session::forget('OTP');
                return back()->with('verified', 1);
            }

            return back()->with('error', 'Something went wrong. Try again!');
        } else {
            return back()->with('warning', 'OTP you entered does not match which we sent on your mobile.');
        }

    }
}
