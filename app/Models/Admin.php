<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    protected $table = "admins";
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ruleSignIn()
    {
        return [
            'email' => 'required|string|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/|max:100|exists:admins,email',
            'password' => 'required|string|min:6|max:32'
        ];
    }

    public function getByEmail($email)
    {
        return $this->whereEmail($email)->first();
    }   

    public function storeData($request) 
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        
        return $this->create($data);
    }
}
