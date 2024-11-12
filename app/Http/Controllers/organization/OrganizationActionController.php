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

class OrganizationActionController extends Controller
{
    // request: name + description
    public function addOrganization() {
        
    }
    // request: name + description + organization id
    public function editOrganization() {
        
    }
    // request: organization id
    public function deleteOrganization() {
        // $userId = Auth::user()->id
        // $organizationId = organization id

        // $organization = OrganizationMember::where(organization_id, $organizationId)->and(user_id, $userId)->and(role_id, Leader);
        
        // if ()
    }
}
