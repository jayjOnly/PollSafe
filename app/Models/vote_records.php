<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vote_records extends Model
{
    protected $fillable = ['ballot_id', 'candidate_id', 'timestamp'];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function ballot()
    {
        return $this->belongsTo(Ballot::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
