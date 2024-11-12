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
use App\Http\Requests\organizationMember\AddOrganizationMemberRequest;
use App\Http\Requests\organizationMember\DeleteOrganizationMemberRequest;
use App\Http\Requests\organizationMember\EditRoleOrganizationMemberRequest;

use function Psy\debug;

class OrganizationMemberActionController extends Controller
{
    public function addOrganizationMember(AddOrganizationMemberRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors([
                'error' => $request->validator->errors()->first(),
            ])->withInput();
        }
        
        $validated = $request->validated();

        $organization = Organization::findOrFail($validated['organization_id']);

        $role = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first()
            ->role;

        if ($role !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $target_id = User::where('email', $validated['email'])
        ->first()
        ->id;

        OrganizationMember::create([
            'organization_id' => $organization->id,
            'user_id' => $target_id,
            'role' => 4,
        ]);

        return redirect()->route('dashboard');
    }


    public function deleteOrganizationMember(DeleteOrganizationMemberRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors([
                'error' => $request->validator->errors()->first(),
            ])->withInput();
        }
        // Log::debug("yes");
        $validated = $request->validated();

        Organization::findOrFail($validated['organization_id']);
        
        $role = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first()
            ->role;

        if ($role !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        OrganizationMember::where('user_id', $validated['user_id'])->delete();

        return redirect()->route('dashboard');
    }


    public function changeOrganizationMemberRole(EditRoleOrganizationMemberRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors([
                'error' => $request->validator->errors()->first(),
            ])->withInput();
        }
        
        // Log::debug("yes");
        $validated = $request->validated();

        Organization::findOrFail($validated['organization_id']);
        
        $role = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first()
            ->role;

        if ($role !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        OrganizationMember::where('user_id', $validated['user_id'])->update([
            'role' => $validated['role']
        ]);

        return redirect()->route('dashboard');
    }
}
