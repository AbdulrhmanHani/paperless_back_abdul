<?php

namespace App\Policies;

use App\Models\Designer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DesignersPolicy
{
    use HandlesAuthorization;



    public function create(User $user): bool
    {
        return $user->role->name == 'admin';
    }

    public function update(User $user): bool
    {
        return $user->role->name == 'admin';
    }

    public function delete(User $user): bool
    {
        return $user->role->name == 'admin';
    }

}
