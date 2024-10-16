<?php

namespace App\Http\Controllers;

use App\Models\Organizations;
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

    public function show(Organizations $organizations)
    {
        return view('organizations.show', compact('organizations'));
    }

    public function edit(Organizations $organization)
    {
        // validasi tidak berhasil
        // $this->authorize('update', $organizations);
        return view('organizations.edit', compact('organizations'));
    }

    public function update(Request $request, Organizations $organizations)
    {
        // $this->authorize('update', $organizations);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $organizations->update($validatedData);

        return redirect()->route('organizations.show', $organizations)
            ->with('success', 'Organisasi berhasil diperbarui!');
    }
}