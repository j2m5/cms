<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, CanResetPassword, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'ip',
        'banned',
        'server',
        'side',
        'char',
        'class',
        'spec',
        'guild',
        'age',
        'vk',
        'ok',
        'tw',
        'fb'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function accessAdmin()
    {
        if ($this->isAdmin() || $this->isEditor()) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        return $this->role_id === 4;
    }

    public function isEditor()
    {
        return $this->role_id === 3;
    }

    public function isModerator()
    {
        return $this->role_id === 2;
    }
}
