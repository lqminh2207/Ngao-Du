<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetRequest;
use App\Mail\SendEmail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\React;

class AdminController extends Controller
{
    public function register2(RegisterRequest $request, Admin $admin)
    {
        $data = $admin->storeData($request);
        $success['token'] =  $data->createToken('Personal Access Token')->accessToken;
        $success['name'] =  $data->name;

        return response()->json([
            'token' => $success['token'],
            'name' => $success['name'],     
            'message' => "Account successfully created,"
        ]);
    }
   
    public function executeSignIn(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)) {
            // $admin = Auth::user();
            $admin = $request->user();
            $success['token'] = $admin->createToken('Personal Access Token')->accessToken;
            $success['name'] = $admin->name;

            return response()->json([
                'token' => $success['token'],
                'name' => $success['name'], 
                'message' => "Login successfully"
            ]);
        } else {
            return response()->json([
                'message' => "Unauthorised"
            ]);
        }
    }

    public function sendResetLinkEmail(ForgotRequest $request)  
    {
        $details = $request->email;

        try {
            $token = Str::random(64);
            DB::table('password_resets')->where('email', $request->email)->delete();
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]);
            $email = new SendEmail($details, $token);
            Mail::to($details)->send($email);

            return response()->json([
                'message' => 'We have e-mailed your password reset link!'
            ]);
        } catch(\Exception $exception) {
            // dd($exception);
            return response()->json([
                'message' => 'Send email failed.'
            ]);
        }
    }

    public function formReset(ResetRequest $request, $token) 
    {
        $oldPass = DB::table('admins')->where([
            'password' => $request->password
        ]);

        $passwordReset = DB::table('password_resets')->where([
            'email' => $request->email
        ])->first();

        if (!$passwordReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 500);
        }
        
        if (! Hash::check($request->token, $passwordReset->token)) {
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 500);
        }

        $updatePassword = Admin::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        $passwordReset = DB::table('password_resets')->where([
            'email' => $request->email
        ])->delete();   

        return response()->json([
            'message' => 'Your password has been changed!'
        ]);
    }

    public function logout(Request $request)
    {
        // dd($request->user()->token());
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
