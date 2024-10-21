<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Organizations extends Model
{
    use HasFactory;
    protected $table = 'organizations';

    protected $fillable = ['name', 'description', 'created_by', 'uuid'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'organizations_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function candidates()
    {
        return $this->hasMany(CandidateTable::class, 'organization_uuid', 'uuid');
    }
}