<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ballots extends Model
{
    protected $fillable = ['election_id', 'voter_id', 'cast_at', 'encrypted_choice'];

    protected $casts = [
        'cast_at' => 'datetime',
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function voteRecords()
    {
        return $this->hasMany(VoteRecord::class);
    }
}
