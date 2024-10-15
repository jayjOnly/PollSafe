<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
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

        $organization = new Organization($validatedData);
        $organization->created_by = $user->id;
        $organization->save();

        $organization->members()->attach($user->id, ['role' => 'admin']);

        return redirect()->route('organizations.show', $organization)
            ->with('success', 'Organisasi berhasil dibuat!');
    }

    public function show(Organization $organization)
    {
        return view('organizations.show', compact('organization'));
    }

    public function edit(Organization $organization)
    {
        // validasi tidak berhasil
        // $this->authorize('update', $organization);
        return view('organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        // $this->authorize('update', $organization);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $organization->update($validatedData);

        return redirect()->route('organizations.show', $organization)
            ->with('success', 'Organisasi berhasil diperbarui!');
    }
}