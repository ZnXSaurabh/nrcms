<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $token_data = DB::table('password_resets')->where('token', $request->token)->first();
        
        if ( $token_data === null ) {
            return back()->with('error', 'Token is invalid or mismatched.');
        }

        $user = User::where('mobileno', $token_data->email)->first();

        if ( !$user ) {
            return back()->with('warning', 'Mobile Number not found. Try again with correct mobile number.');
        }

        $user->password = Hash::make($request->password);

        $user->update();

        if ($user) {
            DB::table('password_resets')->where('email', $user->mobileno)->delete();

            return redirect('login')->with('success', 'Your password has been successfully changed. Now you can login through your new password.');
        }
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'mobileno' => 'required|digits:10|exists:users',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
