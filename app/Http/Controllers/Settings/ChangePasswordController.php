<?php
namespace App\Http\Controllers\Settings;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showForm()
    {
        return view('settings.change-password');
    }

    public function postChangePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required'
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('warning', 'Your current password does not match.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        if ($user) {
            return back()->with('success', 'Password changed successfully. From next time login with new password.');
        }
        
        return back()->with('error', 'Something went wrong. Try again!');
    }
}
