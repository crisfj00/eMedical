<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordExpireRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class ExpiredPasswordController extends Controller
{
    public function expired()
    {
        return view('auth.password.restart');
    }

    public function postExpired(PasswordExpiredRequest $request)
    {
        // Checking current password
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }

        $request->user()->update([
            'password' => Hash::make($request->password),
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect()->route('login')->with(['status' => 'Password changed successfully']);
    }
}