<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class organizations extends Model
{
    protected $fillable = ['name', 'description', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function elections()
    {
        return $this->hasMany(Election::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }
}
