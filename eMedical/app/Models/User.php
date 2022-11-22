<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use betterapp\LaravelDbEncrypter\Traits\EncryptableDbAttribute;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    use EncryptableDbAttribute;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $encryptable = [
        'name'
    ];

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role_id == 3;
    }

    public function isDoctor()
    {
        return $this->role_id == 2;
    }

    public function isPatient()
    {
        return $this->role_id == 1;
    }

    /*protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role_id == 3,
        );
    }*/
}
