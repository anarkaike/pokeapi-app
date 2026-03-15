<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Pokemon;
use App\Models\User;

class PokemonPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Pokemon $pokemon): bool
    {
        return true;
    }

    public function import(User $user): bool
    {
        return $user->isEditor();
    }

    public function delete(User $user, Pokemon $pokemon): bool
    {
        return false;
    }

    public function favorite(User $user, Pokemon $pokemon): bool
    {
        return $user->isEditor();
    }
}
