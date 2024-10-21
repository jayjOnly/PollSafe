<?php

namespace App\Http\Controllers;

use App\Models\Organizations;
use App\Models\User;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Support\Facades\Auth;
use App\Policies\OrganizationPolicy;

class OrganizationsController extends Controller
{
    public function index()
    {
        $organizations = Organizations::with('creator')->get();
        return view('organizations.all', compact('organizations'));
    }

    public function create()
    {
        return view('organizations.create');
    }

    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organizations::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        $organization->members()->attach(Auth::id(), ['role' => 'admin']);

        return redirect()
            ->route('organizations.show', $organization->uuid)
            ->with('success', 'Organisasi berhasil dibuat!');
    }

    public function show(Organizations $organization)
    {
        $organization->load(['creator', 'members']);
        return view('organizations.show', compact('organization'));
    }

    public function edit(Organizations $organization)
    {
        return view('organizations.edit', compact('organization'));
    }

    public function update(UpdateOrganizationRequest $request, Organizations $organization)
    {
        $organization->update($request->validated());
        return redirect()
            ->route('organizations.show', $organization->uuid)
            ->with('success', 'Organisasi berhasil diperbarui!');
    }

    public function manage(Organizations $organization)
    {
        $this->authorize('manage', $organization);
        $users = User::whereNotIn('id', $organization->members->pluck('id'))->get();
        return view('organizations.manage', compact('organization', 'users'));
    }
}