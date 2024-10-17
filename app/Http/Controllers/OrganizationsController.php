<?php

namespace App\Http\Controllers;

use App\Models\Organizations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('organizations.show', compact('organization'));
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
}