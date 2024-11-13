<?php

namespace App\Http\Controllers\organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationMember;
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

        // Prepare data for response
        $organization_detail = [
            'id' => $organization->id,
            'name' => $organization->name,
            'description' => $organization->description,
            'created_at' => $organization->created_at,
            'members' => $organization->members->map(function ($member) {
                return [
                    'id' => $member->user->uuid,
                    'name' => $member->user->name,
                    'email' => $member->user->email,
                    'role' => $member->role->role,
                    'joined_at' => $member->created_at,
                ];
            }),
        ];

        return view('organization.organization-detail', compact('organization_detail'));
    }
}
