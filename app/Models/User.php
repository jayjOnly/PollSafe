<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'two_factor_secret', 'two_factor_recovery_codes'
    ];

    protected $hidden = [
        'password', 'two_factor_secret', 'two_factor_recovery_codes'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'created_by');
    }

    public function voter()
    {
        return $this->hasOne(Voter::class);
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
