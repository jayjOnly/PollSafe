<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $incrementing = false; // Disable auto-incrementing for the primary key

    protected $keyType = 'string'; // Set the key type as string

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
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

    public function members() {
        return $this->hasMany(OrganizationMember::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'organization_members', 'organization_id', 'user_id');
    }

    //tambahan
    public function votes()
    {
        return $this->hasMany(OrganizationVote::class, 'organization_id');
    }

    public function leader() {
        return $this->hasOne(OrganizationMember::class)->where('role_id', OrganizationRole::ROLE_LEADER);
    }
}
