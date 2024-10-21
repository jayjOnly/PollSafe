<?php

namespace App\Http\Controllers;

use App\Models\Organizations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CandidateTable;

class OrganizationsController extends Controller
{
    public function index()
    {
        $organizations = Organizations::all();
        return view('organizations.all', compact('organizations'));
    }

    public function create()
    {
        return view('organizations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login untuk membuat organisasi.');
        }

        $organizations = new Organizations($validatedData);
        $organizations->created_by = $user->id;
        $organizations->save();

        $organizations->members()->attach($user->id, ['role' => 'admin']);

        return redirect()->route('organizations.show', $organizations)
            ->with('success', 'Organisasi berhasil dibuat!');
    }

    public function show(Organizations $organization)
    {
        $candidates = $organization->candidates;

        return view('organizations.show', compact('organization', 'candidates'));
    }

    public function edit(Organizations $organization)
    {
        // validasi tidak berhasil
        // $this->authorize('update', $organizations);
        return view('organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organizations $organization)
    {
        // $this->authorize('update', $organization);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $organization->update($validatedData);

        return redirect()->route('organizations.show', $organization->uuid)
            ->with('success', 'Organisasi berhasil diperbarui!');
    }

    public function manage(Organizations $organization){
        $users = User::all();
        return view('organizations.manage', compact('organization','users'));
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