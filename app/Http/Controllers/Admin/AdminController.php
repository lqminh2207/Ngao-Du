<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetRequest;
use App\Jobs\SendEmailJob;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function executeSignIn(LoginRequest $request) 
    {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect('login')->withInput()->with('error', __('content.login_fail'));
        }
    }
    
    public function formRegister()
    {
        return view('auth.register');
    }

    public function register2(RegisterRequest $request, Admin $admin) 
    {  
        $check = $admin->storeData($request);
          
        return redirect("login")->withSuccess('You have signed-in');
    }

    public function sendResetLinkEmail(ForgotRequest $request)  
    {
        $details = $request->email;
        try {
            dispatch(new SendEmailJob($details));
            return 'Please check your email';
        } catch(\Exception $exception) {
            return back()->with('status', 'We have emailed your password reset link!');
        }
    }

    public function formReset(Request $request) 
    {
        $email = $request->email;
        return view('auth.passwords.reset', compact('email'));
    }

    public function Reset(ResetRequest $request, Admin $admin) 
    {
        $admin = Admin::where('email', $request->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect('login')->with('status', 'Successful changed password');
    }
}
