<?php

namespace App\Http\Controllers;

use App\Models\Organizations;
use App\Models\User;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Support\Facades\Auth;
use App\Policies\OrganizationPolicy;
use App\Models\CandidateTable;

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
        $candidates = $organization->candidates;
        return view('organizations.show', compact('organization', 'candidates'));
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

    public function addCandidate(Organizations $organization)
    {
        return view('organizations.add_candidate', compact('organization')); 
    }

    public function storeCandidate(Request $request, Organizations $organization)
    {  
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'age' => 'required|integer',
            'description' => 'nullable|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|exists:users,email', 
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }


        $user = User::where('email', $validatedData['email'])->first();
        $validatedData['user_id'] = $user->id;

        CandidateTable::create([
            'organization_uuid' => $organization->uuid,
            ...$validatedData,
            'image_path' => 'images/' . $imageName,
        ]);

        return redirect()->route('organizations.show', $organization->uuid)
            ->with('success', 'Candidate added successfully!');
    }
}