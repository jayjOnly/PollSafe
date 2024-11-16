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

class OrganizationController extends Controller
{
    public function show() {
        $user = User::with(['organization_members.organization' => function ($query) {
            $query->withCount('members')  // Get member count
                  ->with(['leader.user']); // Eager load leader information
        }])->findOrFail(Auth::user()->id);

        $organization_list = $user->organization_members->map(function ($member) {
            $organization = $member->organization;
            
            return [
                'id' => $organization->id,
                'name' => $organization->name,
                'description' => $organization->description,
                'leader' => $organization->leader->user->name, // Get the leader's name
                'member_count' => $organization->members_count, // Member count
                'created_at' => $organization->created_at,
            ];
        });

        Log::debug($organization_list);
        return view('organization.organization', compact('organization_list'));
    }
}
