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
use App\Http\Requests\organization\AddOrganizationRequest;
use App\Http\Requests\organization\EditOrganizationRequest;
use App\Http\Requests\organization\DeleteOrganizationRequest;
use App\Models\OrganizationRole;

class OrganizationActionController extends Controller
{
    // request: name + description
    public function addOrganization(AddOrganizationRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['message' => $request->validator->errors()->first()], 400);
        }

        $validated = $request->validated();

        $organization = Organization::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        OrganizationMember::create([
            'organization_id' => $organization->id,
            'user_id' => Auth::id(),
            'role_id' => OrganizationRole::ROLE_LEADER,
        ]);

        return response()->json(['message' => 'Success'], 200);
    }
    // request: name + description + organization id
    public function editOrganization(EditOrganizationRequest $request) {
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

        $organization->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return response()->json(['message' => 'Success'], 200);
    }

    public function deleteOrganization(DeleteOrganizationRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['message' => $request->validator->errors()->first()], 400);
        }

        $validated = $request->validated();

        $organization = Organization::findOrFail($validated['organization_id']);
        
        $role = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first()
            ->role_id;

        if ($role !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $organization->where('id', $organization->id)->delete();

        return response()->json(['message' => 'Success'], 200);
    }
}
