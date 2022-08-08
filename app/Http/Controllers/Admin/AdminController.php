<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function executeSignIn(LoginRequest $request, Admin $adminadmin) 
    {
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect('login')->withInput()->with('error', __('content.login_fail'));
        }
    }
}
