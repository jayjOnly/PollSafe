<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Organization $organization)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Organization $organization)
    {
        return $user->id === $organization->created_by ||
               $organization->members()->where('user_id', $user->id)
                          ->where('role', 'admin')
                          ->exists();
    }

    public function manage(User $user, Organization $organization)
    {
        return $this->update($user, $organization);
    }
}