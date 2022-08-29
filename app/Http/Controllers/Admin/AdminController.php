<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetRequest;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
            // Cách 1 dispatch cho vào queue tránh bị quá tải
            // dispatch(new SendEmailJob($details));
            // Cách 2 không nên dùng
            $token = Str::random(64);
            DB::table('password_resets')->where('email', $request->email)->delete();
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]);
            $email = new SendEmail($details, $token);
            Mail::to($details)->send($email);

            return back()->with('message', 'We have e-mailed your password reset link!');
        } catch(\Exception $exception) {
            dd($exception);
            return Log::error("Message:" . $exception->getMessage() . 'Line:' . $exception->getLine());
        }
    }

    public function formReset(Request $request, $token) 
    {
        $email = $request->email;
        return view('auth.passwords.reset', ['token' => $token], compact('email'));
    }

    public function Reset(ResetRequest $request) 
    {
        // $admin = Admin::where('email', $request->email)->first();
        // $admin->password = Hash::make($request->password);
        // $admin->save();
        $oldPass = DB::table('admins')->where([
            'password' => $request->password
        ]);

        $passwordReset = DB::table('password_resets')->where([
            'email' => $request->email
        ])->first();

        if (!$passwordReset) {
            return back()->with('error', 'This password reset token is invalid.');
        }
        
        if (! Hash::check($request->token, $passwordReset->token)) {
            return back()->with('error', 'This password reset token is invalid.');
        }

        $updatePassword = Admin::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        $passwordReset = DB::table('password_resets')->where([
            'email' => $request->email
        ])->delete();   

        return redirect('login')->with('message', 'Your password has been changed!');
    }
}
