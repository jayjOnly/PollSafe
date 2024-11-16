<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class OrganizationVote extends Model
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
        'name',
        'description',
        'start_date',
        'end_date',
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

    public function vote_members() {
        return $this->hasMany(OrganizationVoteMember::class,'organization_vote_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
