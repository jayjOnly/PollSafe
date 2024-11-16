<?php

namespace App\Http\Controllers\organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\OrganizationRole;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class OrganizationDetailController extends Controller
{
    public function show($organization_id) {
        $user_id = Auth::id();
        $organization = Organization::whereHas('members', function ($query) use ($user_id, $organization_id) {
            $query->where('user_id', $user_id)
                  ->where('organization_id', $organization_id);
        })
        ->with(['members.user'])  // Load member user details
        ->findOrFail($organization_id);

        $is_leader = OrganizationMember::where('user_id', Auth::id())->where('organization_id', $organization_id)->first()->role_id === OrganizationRole::ROLE_LEADER;

        // Prepare data for response
        $organization_detail = [
            'id' => $organization->id,
            'name' => $organization->name,
            'description' => $organization->description,
            'created_at' => $organization->created_at,
            'members' => $organization->members->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->user->name,
                    'email' => $member->user->email,
                    'role' => $member->role->role,
                    'joined_at' => $member->created_at,
                    'is_leader' => $member->role_id === OrganizationRole::ROLE_LEADER,
                ];
            }),
        ];

        return view('organization.organization-detail', compact('organization_detail', 'is_leader'));
    }
}
