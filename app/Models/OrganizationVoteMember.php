<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationVoteMember extends Model
{
    protected $fillable = [
        'organization_vote_id',
        'organization_member_id',
        'organization_vote_candidate_id'
    ];

    public function vote()
    {
        return $this->belongsTo(OrganizationVote::class);
    }

    public function member()
    {
        return $this->belongsTo(OrganizationMember::class);
    }
}