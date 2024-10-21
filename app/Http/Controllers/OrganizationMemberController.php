<?php

// app/Http/Controllers/OrganizationMemberController.php
namespace App\Http\Controllers;

use App\Models\Organizations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationMemberController extends Controller
{
    public function index(Organizations $organization)
    {
        // Mengambil semua anggota organisasi dengan relasinya
        $members = $organization->members()
            ->withPivot('role', 'created_at')
            ->get();
            
        return view('organizations.manage', compact('organization', 'members'));
    }

    public function invite(Request $request, Organizations $organization)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:member,admin'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        // Cek apakah user sudah menjadi anggota
        if ($organization->members()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User sudah menjadi anggota organisasi.');
        }

        // Tambahkan user sebagai anggota
        $organization->members()->attach($user->id, [
            'role' => $validatedData['role']
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function updateRole(Request $request, Organizations $organization, User $member)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:member,admin'
        ]);

        // Cek apakah pengguna yang sedang login adalah admin
        $currentUserRole = $organization->members()
            ->where('user_id', Auth::id())
            ->value('role');

        if ($currentUserRole !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengubah role.');
        }

        $organization->members()->updateExistingPivot($member->id, [
            'role' => $validatedData['role']
        ]);

        return back()->with('success', 'Role anggota berhasil diperbarui.');
    }

    public function remove(Organizations $organization, User $member)
    {
        // Cek apakah pengguna yang sedang login adalah admin
        $currentUserRole = $organization->members()
            ->where('user_id', Auth::id())
            ->value('role');

        if ($currentUserRole !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus anggota.');
        }

        $organization->members()->detach($member->id);
        return back()->with('success', 'Anggota berhasil dihapus dari organisasi.');
    }
}