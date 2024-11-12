<?php

namespace App\Http\Controllers\organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrganizationVoteActionController extends Controller
{
    // request: name + description
    public function addVote() {
        
    }
    // request: name + description + organization id
    public function setVote() {
        
    }
}
