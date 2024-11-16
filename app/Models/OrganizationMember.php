<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    public $incrementing = false; // Disable auto-incrementing for the primary key

    protected $keyType = 'string'; // Set the key type as string

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'user_id',
        'role_id'
    ];

    // Automatically generate a UUID for the id attribute
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function role()
    {
        return $this->belongsTo(OrganizationRole::class);
    }

    public function vote_member() {
        return $this->hasMany(OrganizationVoteMember::class);
    }
}
