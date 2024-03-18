<?php

namespace App\Policies;

use App\Models\CoinPlan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoinPlanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, CoinPlan $coinPlan): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, CoinPlan $coinPlan): bool
    {
    }

    public function delete(User $user, CoinPlan $coinPlan): bool
    {
    }

    public function restore(User $user, CoinPlan $coinPlan): bool
    {
    }

    public function forceDelete(User $user, CoinPlan $coinPlan): bool
    {
    }
}
