<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballots extends Model
{
    protected $fillable = ['election_id', 'voter_id', 'cast_at', 'encrypted_choice'];

    protected $casts = [
        'cast_at' => 'datetime',
    ];

    public function election()
    {
        return $this->belongsTo(Elections::class);
    }

    public function voter()
    {
        return $this->belongsTo(Voters::class);
    }

    public function voteRecords()
    {
        return $this->hasMany(VoteRecords::class);
    }
}
