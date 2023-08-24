<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\MSG91;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $messages = [
            'mobileno.exists' => 'We can\'t find a user with that mobile number.'
        ];
        $request->validate(['mobileno' => 'required|digits:10|exists:users'], $messages);

        $user = User::where('mobileno', $request->mobileno)->first();

        if ($user->is_account_verified) {
            if ( !$user ) {
                return back()->with('warning', 'User not found. Try again with correct mobile number.');
            }

            $token = app('auth.password.broker')->createToken($user);

            $reset_data = DB::table('password_resets')->insert([
                'email' => $request->mobileno,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        
            if ($reset_data) {
                //new added by Nitin
                $MSG91 = new MSG91();
                $MSG91->sendDltSms('626fbd6696bb755bd8438404', '91'.$user->mobileno, 'FORGOT', [$token]);
                
               // $message = urlencode('Your password reset link for NRCMS Application is ' . route('password.reset', $token) . '');
                //$MSG91 = new MSG91();
                //$MSG91->sendSMS($request->mobileno, $message);

                return back()->with('success', 'Password reset message has been sent to your registered mobile number. Please click the link in that message to reset your password.');
            }

            return back()->with('error', 'Something went wrong. Try again!');
        }

        return back()->with('warning', 'Your account is not verified yet. You can not reset your password.');
    }
}
