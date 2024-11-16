<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\OrganizationRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateController extends Controller
{
    public function show($organization_id) {
        $user_id = Auth::id();
        $organization = Organization::whereHas('members', function ($query) use ($user_id, $organization_id) {
            $query->where('user_id', $user_id)
                  ->where('organization_id', $organization_id);
        })
        ->with(['members.user'])  // Load member user details
        ->findOrFail($organization_id);

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

        return view('voting.create', compact('organization_detail'));
    }
}
