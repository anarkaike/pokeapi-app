<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $model): bool
    {
        return $user->is($model) || $user->isAdmin();
    }

    public function update(User $user, User $model): bool
    {
        return $user->is($model)|| $user->isAdmin();
    }

    public function delete(User $user, User $model): bool
    {
        if ($user->is($model)) return false;

        return $user->isAdmin();
    }
}
