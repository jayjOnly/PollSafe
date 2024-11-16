<?php

namespace App\Http\Controllers\organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\organizationMember\AddOrganizationMemberRequest;
use App\Http\Requests\organizationMember\DeleteOrganizationMemberRequest;
use App\Http\Requests\organizationMember\EditRoleOrganizationMemberRequest;
use App\Models\OrganizationRole;

class OrganizationMemberActionController extends Controller
{
    public function addOrganizationMember(AddOrganizationMemberRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['message' => $request->validator->errors()->first()], 400);
        }
        
        $validated = $request->validated();

        $organization = Organization::findOrFail($validated['organization_id']);

        $role = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first()
            ->role_id;

        if ($role !== OrganizationRole::ROLE_LEADER) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $target = User::where('email', $validated['email'])->first();

        if ($target === null) {
            return response()->json(['message' => 'This member doesn\'t exist'], 404);
        }

        if (OrganizationMember::where('user_id', $target->id)->where('organization_id', $validated['organization_id'])->exists()) {
            return response()->json(['message' => 'Already became a member!'], 429);
        }

        OrganizationMember::create([
            'organization_id' => $organization->id,
            'user_id' => $target->id,
            'role_id' => OrganizationRole::ROLE_MEMBER,
        ]);

        return response()->json(['message' => 'Success'], 200);
    }


    public function deleteOrganizationMember(DeleteOrganizationMemberRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['message' => $request->validator->errors()->first()], 400);
        }

        $validated = $request->validated();

        Organization::findOrFail($validated['organization_id']);
        
        $member = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($member->role_id !== OrganizationRole::ROLE_LEADER) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($member->id === $validated['member_id']) {
            return response()->json(['message' => 'You cannot delete yourself'], 403);
        }

        OrganizationMember::where('id', $validated['member_id'])->first()->delete();

        return response()->json(['message' => 'Success'], 200);
    }


    public function changeOrganizationMemberRole(EditRoleOrganizationMemberRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['message' => $request->validator->errors()->first()], 400);
        }
        
        $validated = $request->validated();

        Organization::findOrFail($validated['organization_id']);
        
        $role = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first()
            ->role_id;

        if ($role !== OrganizationRole::ROLE_LEADER) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        OrganizationMember::where('user_id', $validated['user_id'])->update([
            'role_id' => $validated['role']
        ]);

        return response()->json(['message' => 'Success'], 200);
    }
}
