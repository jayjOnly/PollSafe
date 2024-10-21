<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    protected $fillable = ['user_id', 'organization_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organizations::class);
    }

    public function ballots()
    {
        return $this->hasMany(Ballots::class);
    }
}
