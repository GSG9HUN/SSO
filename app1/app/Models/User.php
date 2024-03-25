<?php

namespace App\Models;

use App\Notifications\ResetPasswordEmail;
use App\Notifications\VerificationEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    private const USER= 1;
    private const ADMIN= 2;
    private const SUPER_ADMIN= 3;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role_id'
    ];

    protected $table ='users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin(): bool
    {
        return $this->role_id === self::ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role_id === self::USER;
    }

    public function IsSuperAdmin(): bool
    {
        return $this->role_id === self::SUPER_ADMIN;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerificationEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordEmail($token));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function logoutFromSSOServer(){
        $access_token = session()->get("access_token");
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Authorization"=>"Bearer ".$access_token
        ])->get(config("auth.sso_host")."/api/logout");
    }
}
