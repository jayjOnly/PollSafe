<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationRole extends Model
{
    const ROLE_LEADER = 1;
    const ROLE_TREASURER = 2;
    const ROLE_SECRETARY = 3;
    const ROLE_MEMBER = 4;

    public function members()
    {
        return $this->hasMany(OrganizationMember::class);
    }
}
